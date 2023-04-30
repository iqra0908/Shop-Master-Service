<?php
if ( ! class_exists( 'WczFee_Shipping_Method' ) ) {
    class WczFee_Shipping_Method extends WC_Shipping_Method {
        /**
         * Constructor for your shipping class
         *
         * @access public
         * @return void
         */
        public function __construct() {
            $this->id                 = 'wczfee'; 
            $this->method_title       = __( 'Flat Shipping Rate by ZipCode', 'wczfee' );  
            $this->method_description = __( 'You can set your shipping cost by user selected postcode', 'wczfee' ); 

            $this->init();

            $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
            $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'Wc ZipCode', 'wczfee' );

            add_action('woocommerce_update_options_shipping_methods', array(&$this, 'process_admin_options'));

        }

        /**
         * Init your settings
         *
         * @access public
         * @return void
         */
        function init() {
            // Load the settings API
            $this->init_form_fields(); 
            $this->init_settings(); 

            // Save settings in admin if you have any defined
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        function admin_options() {
            ?>
            <h2><?php _e('Flat Shipping Rate by ZipCode','woocommerce'); ?></h2>
            <table class="form-table">
            <?php $this->generate_settings_html(); ?>
            <?php $this->postcodes_form_fiels(); ?>
            </table> <?php
        }

        function getPostcodes(){
            global $wpdb;
            $table = WCZFEE_TABLE;
            return $wpdb->get_results("SELECT id, postcode, cost FROM $table", OBJECT);
        }

        function postcodes_form_fiels(){
            global $wpdb;

            if(isset( $_POST['postcodes'] )){
                $this->update_postcodes();
            }

            $postcodes = $this->getPostcodes();

            ?>
            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label for="woocommerce_wczfee_postcodes"><?php _e('Postcodes', 'wczfee') ?></label>
                </th>
                <td id="wcc_fee_rows">
                    <?php 
                    if(count($postcodes)) { 
                        foreach($postcodes as $code){
                    ?> 
                        <div class="wcc_fee_row">
                        <input type="text" name="postcodes[<?php esc_attr_e($code->id) ?>]" value="<?php esc_attr_e($code->postcode) ?>" class="input-text regular-input" placeholder="<?php _e('ZipCode', 'wczfee') ?>">
                        <span class="wczfee_currency"><?php echo get_woocommerce_currency_symbol() ?></span>
                        <input type="text" name="postcodes_fee[<?php esc_attr_e($code->id) ?>]" value="<?php esc_attr_e($code->cost) ?>" class="input-text regular-input wczfee_postcodes_fee" placeholder="0">
                        <span class="dashicons dashicons-trash wczfee_delpostcode" data-id="<?php esc_attr_e($code->id) ?>"></span>
                        </div>
                    <?php }} else { ?>
                        <div class="wcc_fee_row">
                        <input type="text" name="postcodes[]" value="" class="input-text regular-input" placeholder="<?php _e('ZipCode', 'wczfee') ?>">
                        <span class="wczfee_currency"><?php echo get_woocommerce_currency_symbol() ?></span>
                        <input type="text" name="postcodes_fee[]" value="" class="input-text regular-input wczfee_postcodes_fee" placeholder="0">
                        <span class="dashicons dashicons-trash wczfee_delpostcode"></span>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr valign="top">
                <th style="padding-top:0"></th>
                <td style="padding-top:0" id="del_citites">
                    <button class="button-primary wczfee_addpostcode" type="button"><span class="dashicons dashicons-plus-alt"></span> <?php _e('Add ZipCode', 'wczfee') ?></button>
                    <?php wp_nonce_field('postcode_nonce', 'wczfee_nonce'); ?>
                </td>
            </tr>
            <style>
                .wcc_fee_row { display: flex; margin-bottom: 5px; }
                .wczfee_postcodes_fee { 
                    width:80px !important; 
                    margin: 0 6px !important; 
                    padding-left: 20px !important; 
                }
                .wczfee_addpostcode .dashicons { margin: 4px 4px 0 0; }
                .wczfee_delpostcode:hover { color: red; }
                #wcc_fee_rows { padding-bottom: 5px; }
                .wczfee_delpostcode {
                    margin-top: 4px;
                    color: #d54e21;
                    cursor: pointer;
                }
                .wczfee_currency {
                    width: 0;
                    position: relative;
                    left: 14px;
                    top: 6px;
                }
            </style>
            <?php
        }

        function update_postcodes(){
            global $wpdb;

            $postcodes =  array_map( 'sanitize_text_field', $_POST['postcodes']);
            $fees   = array_map( 'sanitize_text_field', $_POST['postcodes_fee'] );
            $table  = WCZFEE_TABLE;

            if(!wp_verify_nonce( $_POST['wczfee_nonce'], 'postcode_nonce')) die('nonce failed');

            foreach($postcodes as $id => $code){
                $postcode = [
                    'postcode' => $code,
                    'cost' => $fees[$id]
                ];
                $check = $wpdb->get_results("SELECT id FROM $table where id = '$id' ORDER BY id ASC", OBJECT);

                if($check)
                $result = $wpdb->update($table, $postcode, ['id' => $id]);
                else
                $result = $wpdb->insert($table, $postcode);
            }

            if(isset($_POST['delpostcode'])){
                $delpostcode = array_map( 'sanitize_text_field', $_POST['delpostcode']);
                foreach($delpostcode as $del){
                    $wpdb->delete( $table, ['id' => $del] );
                }
            }


        }

        /**
         * Define settings field for this shipping
         * @return void 
         */
        function init_form_fields() { 

            $this->form_fields = array(

                'enabled' => array(
                    'title' => __( 'Enable', 'wczfee' ),
                    'type' => 'checkbox',
                    'description' => __( 'Enable this shipping.', 'wczfee' ),
                    'default' => 'yes'
                ),

                'title' => array(
                    'title' => __( 'Title', 'wczfee' ),
                    'type' => 'text',
                    'description' => __( 'Title to be display on site', 'wczfee' ),
                    'default' => __( 'WC postcode Fee', 'wczfee' )
                ),

            );

        }

        /**
         * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
         *
         * @access public
         * @param mixed $package
         * @return void
         */
        public function calculate_shipping( $package = array() ) {
            
            $weight = 0;
            $cost = 0;
            $address = $package["destination"]; // country, state, postcode, postcode, address, address_1, address_2

            // print_r(json_encode($package));
            // die;

            // foreach ( $package['contents'] as $item_id => $values ) 
            // { 
            //     $_product = $values['data']; 
            //     $weight = $weight + $_product->get_weight() * $values['quantity']; 
            // }
            // $weight = wc_get_weight( $weight, 'kg' );

            $cost = $this->getpostcodeFee($address['postcode']);

            // print_r($cost);
            // die;

            if(isset($cost['cost'])){
                $rate = array(
                    'id' => $this->id,
                    'label' => $this->title,
                    'cost' => $cost
                );
                $this->add_rate( $rate );
            }
            
        }

        public function getpostcodeFee($postcode){
            global $wpdb;
            $table = WCZFEE_TABLE;
            return $wpdb->get_row("SELECT cost FROM $table where postcode = '$postcode'", ARRAY_A);
        }
    }
}
