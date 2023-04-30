<?php

/**
 * Shipping quotes event handler.
 * Class _EnDistanceBaseShippingShippingRates
 */
class _EnDistanceBaseShippingShippingRates
{

    /**
     * Hook for call.
     * _EnDistanceBaseShippingShippingRates constructor.
     */
    public function __construct()
    {
        /**
         * Load class for shipping rates
         */
        add_action('woocommerce_shipping_init', 'en_distance_base_shipping_rates');
    }

}

/**
 * Hook function for call.
 */
function en_distance_base_shipping_rates()
{

    /**
     * Add class for shipping rates
     */
    class EnDistanceBaseShippingShippingRates extends WC_Shipping_Method
    {

        public $en_package = [];
        public $small_package = [];
        public $ltl_package = [];

        /**
         * Hook for call
         * EnDistanceBaseShippingShippingRates constructor.
         * @param int $instance_id
         */
        public function __construct($instance_id = 0)
        {
            $this->id = 'distance_base_shipping';
            $this->instance_id = absint($instance_id);
            $this->method_title = __('Distance Based Shipping Calculator');
            $this->method_description = __('Shipping rates calculated by the distance between the ship-from and ship-to addresses and a rate you specify.');
            $this->supports = array(
                'shipping-zones',
                'instance-settings',
                'instance-settings-modal',
            );
            $this->enabled = "yes";
            $this->title = 'Distance Based Shipping Calculator';
            $this->init();
        }

        /**
         * Let's start init function
         */
        public function init()
        {
            $this->init_form_fields();
            $this->init_settings();
            add_action('woocommerce_update_options_shipping_' . $this->id, [$this, 'process_admin_options']);
        }

        /**
         * Enable woocommerce shipping for App name
         */
        public function init_form_fields()
        {
            $this->instance_form_fields = [
                'enabled' => [
                    'title' => __('Enable / Disable', 'distance_base_shipping'),
                    'type' => 'checkbox',
                    'label' => __('Enable This Shipping Service', 'distance_base_shipping'),
                    'default' => 'yes',
                    'id' => 'EN_DISTANCE_BASE_SHIPPING_enable_disable_shipping'
                ]
            ];
        }

        /**
         * Calculate shipping rates woocommerce
         * @param array $package
         * @return array|void
         */
        public function calculate_shipping($package = [])
        {
            $action_arr = array();
            if ((is_admin() && !wp_doing_ajax()) || (in_array(current_action(), $action_arr)))
                return FALSE;

            if (get_option('en_connection_settings_suspend_distance_base_shipping') == 'yes') {
                return [];
            }

            // Eniture Debug Mood
            do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " Plan ", EN_DISTANCE_BASE_SHIPPING_PLAN);
            do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " Plan Message ", EN_DISTANCE_BASE_SHIPPING_PLAN_MESSAGE);

            // Eniture Execution Time
            $en_calculate_shipping_start = microtime(true);

            $en_package = apply_filters('en_package_converter', []);

            if (empty($en_package)) {
                $this->en_package = $en_package = \EnDistanceBaseShippingPackage\EnDistanceBaseShippingPackage::en_package_converter($package);
                add_filter('en_package_converter', [$this, 'en_recently_package_converter'], 10, 1);

                // Eniture Debug Mood
                do_action("eniture_debug_mood", "Eniture Packages", $en_package);
            }

            if(empty($en_package)){
                return [];
            }

            if(isset($en_package['receiverZip']) && empty($en_package['receiverZip'])) {
                $en_package['receiverZip'] = '00000';
            }
            $en_package = $this->en_filter_eniture_shipments($en_package);

            $reasons = apply_filters('EN_DISTANCE_BASE_SHIPPING_reason_quotes_not_returned', []);

            if (empty($reasons)) {

                // Eniture Debug Mood
                do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " Package ", $en_package);

                add_filter('en_eniture_shipment', [$this, 'en_eniture_shipment']);

                $en_package = array_merge(json_decode(EN_DISTANCE_BASE_SHIPPING_GET_CONNECTION_SETTINGS, true), $en_package, json_decode(EN_DISTANCE_BASE_SHIPPING_GET_QUOTE_SETTINGS, true));

                $response = \EnDistanceBaseShippingCurl\EnDistanceBaseShippingCurl::EN_DISTANCE_BASE_SHIPPING_sent_http_request(EN_DISTANCE_BASE_SHIPPING_HITTING_API_URL, $en_package, 'POST_ENCODED', 'Quotes');

                $en_rates = \EnDistanceBaseShippingResponse\EnDistanceBaseShippingResponse::en_rates(json_decode($response, true), $en_package);
                
                $accessorials = [
                    'R' => 'residential delivery',
                    'L' => 'liftgate delivery',
                    'T' => 'tailgate delivery',
                ];

                // Eniture Debug Mood
                do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " Rates ", $en_rates);

                foreach ($en_rates as $accessorial => $rate) {

                    // description detail set
                    if (isset($rate['label'], $rate['description']) && !empty($rate['description'])) {
                        $rate['label'] .= ' (' . $rate['description'] . ')';
                    }

                    if (isset($rate['eniture_meta_data'])) {
                        $rate['meta_data']['min_prices'] = wp_json_encode($rate['eniture_meta_data']);
                        unset($rate['eniture_meta_data']);
                    }

                    if (isset($rate['cost']) && is_numeric($rate['cost'])) {
                        $this->add_rate($rate);
                    }
                }
            }

            // Eniture Execution Time
            $en_calculate_shipping_end = microtime(true) - $en_calculate_shipping_start;
            do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " Total Execution Time ", $en_calculate_shipping_end);
            
            return $en_rates;
        }

        /**
         * List down both ltl or small packages
         * @param array $en_package
         * @return mixed
         */
        public function en_filter_eniture_shipments($en_package)
        {
            if (isset($en_package['shipment_type']) && is_array($en_package['shipment_type'])) {
                foreach ($en_package['shipment_type'] as $origin_zip => $shipment) {
                    if (isset($shipment['SMALL']) && count($shipment) == 1) {
                        $this->small_package[$origin_zip] = EN_DISTANCE_BASE_SHIPPING_DECLARED_TRUE;
                        unset($en_package['commdityDetails'][$origin_zip]);
                    }
                }
            }

            return $this->ltl_package = $en_package;
        }

        /**
         * Get last used array of packages
         * @param array $package
         * @return array
         */
        public function en_recently_package_converter($package)
        {
            return array_merge($package, $this->en_package);
        }

        /**
         * Set flag eniture shipment exist or not
         * @param array $eniture_shipment
         * @return array
         */
        public function en_eniture_shipment($eniture_shipment)
        {
            return array_merge($eniture_shipment, ['LTL' => $this->ltl_package]);
        }

    }

}
