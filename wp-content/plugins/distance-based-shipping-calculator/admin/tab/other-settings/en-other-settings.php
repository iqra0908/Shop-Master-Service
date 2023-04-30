<?php

/**
 * Test connection details.
 */

namespace EnDistanceBaseShippingOtherSettings;

/**
 * Add array for Settings.
 * Class EnDistanceBaseShippingOtherSettings
 * @package EnDistanceBaseShippingOtherSettings
 */
class EnDistanceBaseShippingOtherSettings
{

    static public $get_connection_details = [];
    static public $plugin_name;

    /**
     * Settings template.
     * @return array
     */
    static public function en_load()
    {
        $start_settings = [
            'en_other_settings_distance_base_shipping' => [
                'name' => __('', 'woocommerce-settings-distance-base-shipping'),
                'type' => 'title',
                'id' => 'en_connection_settings_distance_base_shipping',
            ],
        ];

        // App Name Connection Settings Detail
        $eniture_settings = self::en_set_other_settings_detail();

        $end_settings = [
            'en_connection_settings_end_distance_base_shipping' => [
                'type' => 'sectionend',
                'id' => 'en_connection_settings_end_distance_base_shipping'
            ]
        ];

        $settings = array_merge($start_settings, $eniture_settings, $end_settings);

        return $settings;
    }

    
    /**
     * Connection Settings Detail Set
     * @return array
     */
    static public function en_set_other_settings_detail()
    {
        return
            [
                'en_connection_settings_multi_shipment_label_distance_base_shipping' => [
                    'name' => __('Multi-shipment label', 'woocommerce-settings-distance-base-shipping'),
                    'type' => 'text',
                    'desc' => __('Enter the label to use when more than one shipment is required for the order', 'woocommerce-settings-distance-base-shipping'),
                    'id' => 'en_connection_settings_multi_shipment_label_distance_base_shipping'
                ],
                'en_settings_how_to_handle_multi_shipment_distance_base_shipping' => array(
                    'name' => __("In the case of a Cart that will result in multiple shipments", 'woocommerce-settings-distance-base-shipping'),
                    'type' => 'radio',
                    'default' => 'add',
                    'options' => array(
                        'add' => __("Add the calculated shipping rates together and display the total as the shipping rate", 'woocommerce'),
                        'expensive' => __("Only display the most expensive calculated shipping rate and discard the others", 'woocommerce'),
                        'cheapest' => __("Only display the cheapest calculated shipping rate and discard the others", 'woocommerce'),
                    ),
                    'id' => 'en_settings_how_to_handle_multi_shipment_distance_base_shipping',
                    'class' => 'en_settings_how_to_handle_multi_shipment_distance_base_shipping',
                ),
                'en_settings_error_management_not_in_profile_distance_base_shipping' => [
                    'name' => __('Error management', 'woocommerce-settings-distance-base-shipping'),
                    'type' => 'checkbox',
                    'desc' => 'Don\'t quote shipping if one or more items in the Cart are members of a Shipping Profile that will not return a shipping rate',
                    'id' => 'en_settings_error_management_not_in_profile_distance_base_shipping'
                ],
            ];
    }

}
