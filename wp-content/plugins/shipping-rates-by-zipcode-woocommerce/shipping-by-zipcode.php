<?php
/**
 * Plugin Name: Shipping Rates by ZipCode for woocommerce
 * Description: Custom Shipping Method for WooCommerce
 * Version: 1.0
 * Author URI: https://logiceverest.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wczfee
 */
 
if ( ! defined( 'WPINC' ) ) die;
 


/** @class Wc postcode Fee */
class  WczFeeShippingPostCode {
    /**
     * Wc postcode Fee version.
     * @var string
     */
    public $version = '1.0';

    /**
     * Stores notices.
     * @var array
     */
    private static $notices = [];

    /**
     * Logger context.
     * @var array
     */
    public $context = ['source' => 'wczfee'];

    /** The single instance of the class. */
    protected static $_instance = null;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Wc postcode Fee Constructor.
     */
    private function __construct()
    {
        $this->defineConstants();
        $this->init_hooks();
        $this->session();
    }

    private function init_hooks()
	{
		/**
         * Activation/Deactivation
         */
        register_activation_hook(WCZFEE_PLUGIN_FILE, [$this, 'activation']);
		register_deactivation_hook(WCZFEE_PLUGIN_FILE, [$this, 'deactivation']);

		/**
         * Enqueue Scripts
         */
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
		

        /**
         * Check if WooCommerce is active
         */        
         if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

        /**
         * Shipping method init
         */
        add_action( 'woocommerce_shipping_init', [$this, 'wczfee_shipping_method'] );
        add_filter( 'woocommerce_shipping_methods', [$this, 'add_wczfee_shipping_method'] );

        // add settings link to plugin list
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), [$this, 'plugin_settings_link']);


        // add script in footer
        add_action('wp_footer', [$this, 'footer_script']);

        /**
         * order validation
         */
        // add_action( 'woocommerce_review_order_before_cart_contents', [$this, 'wczfee_validate_order'] );
        // add_action( 'woocommerce_after_checkout_validation', [$this, 'wczfee_validate_order'] );

        }
		
	}

	public function session()
    {
        if ( session_status() == PHP_SESSION_NONE ) {
            session_start();
        }
    }

    public function activation()
    {
        global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate = $wpdb->get_charset_collate();
        $table = WCZFEE_TABLE;
        $query = "CREATE TABLE IF NOT EXISTS $table (
            `id` int(11) AUTO_INCREMENT,
            `postcode` VARCHAR(255) NOT NULL,
            `cost` VARCHAR(25) NOT NULL,
            `status` VARCHAR(25) NULL,
            `create_date` DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) AUTO_INCREMENT=1001 $charset_collate;";
        dbDelta( $query );
    }

    public function deactivation() 
    {
		// deactivatation code
    }

    /**
     * Define Wc postcode Fee Constants.
     */
    private function defineConstants()
    {
        global $wpdb;       

        $this->define('WCZFEE_PLUGIN_FILE', __FILE__);
		$this->define('WCZFEE_VERSION', $this->version);
		$this->define('WCZFEE', 'wczfee');
        $this->define('WCZFEE_TABLE', $wpdb->prefix . "wczipfee_zipcodes");
		
    }

    function plugin_settings_link( $actions ) {

        $mylinks = array(
            '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=shipping&section=wczfee' ) . '">Settings</a>',
         );

         return array_merge($mylinks,  $actions  );
    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
    private function define( $name, $value )
    {
        if (!defined($name)) {
            define($name, $value);
        }
	}


	/**
	 * Enquene Scripts
	 */
	public function enqueueScripts()
    {
        // wp_enqueue_style(WCZFEE, plugins_url('/assets/scsm-style.css', WCZFEE_PLUGIN_FILE), [], WCZFEE_VERSION);

        wp_enqueue_script('jquery');
        // wp_enqueue_script(WCZFEE, plugins_url('/assets/wczfee.js', WCZFEE_PLUGIN_FILE), ['jquery'], WCZFEE_VERSION);
	}

	/**
	 * Enquene Admin Scripts
	 */
	public function enqueueAdminScripts()
	{
		wp_enqueue_script('jquery');
        wp_enqueue_script(WCZFEE, plugins_url('/assets/wczfee-admin.js', WCZFEE_PLUGIN_FILE), ['jquery'], WCZFEE_VERSION);
	}

    public function footer_script(){
    ?>
    <script>
        jQuery( function($) {
            $('#billing_postcode').change(function(){
                console.log('updated');
                jQuery('body').trigger('update_checkout');
            });
        });
    </script>
    <?php
    }
	

    function wczfee_shipping_method() {
        include_once "shipping-method-class.php";
    }
 
    
 
    function add_wczfee_shipping_method( $methods ) {
        $methods[] = 'WczFee_Shipping_Method';
        return $methods;
    }


    function wczfee_validate_order( $posted )   {
 
        $packages = WC()->shipping->get_packages();
 
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
         
        if( is_array( $chosen_methods ) && in_array( 'wczfee', $chosen_methods ) ) {
             
            foreach ( $packages as $i => $package ) {
 
                if ( $chosen_methods[ $i ] != "wczfee" ) {
                             
                    continue;
                             
                }
 
                $WczFee_Shipping_Method = new WczFee_Shipping_Method();
                $weightLimit = (int) $WczFee_Shipping_Method->settings['weight'];
                $weight = 0;
 
                foreach ( $package['contents'] as $item_id => $values ) 
                { 
                    $_product = $values['data']; 
                    $weight = $weight + $_product->get_weight() * $values['quantity']; 
                }
 
                $weight = wc_get_weight( $weight, 'kg' );
                
                if( $weight > $weightLimit ) {
 
                        $message = sprintf( __( 'Sorry, %d kg exceeds the maximum weight of %d kg for %s', 'wczfee' ), $weight, $weightLimit, $WczFee_Shipping_Method->title );
                             
                        $messageType = "error";
 
                        if( ! wc_has_notice( $message, $messageType ) ) {
                         
                            // wc_add_notice( $message, $messageType );
                      
                        }
                }
            }       
        } 
    }
	
}

/**
 * Returns the main instance of WC.
 *
 * @since  2.1
 * @return WooCommerce
 */
function wczipfee_shipping() {
	return WczFeeShippingPostCode::instance();
}

// Global for backwards compatibility.
$GLOBALS['wczfee'] = wczipfee_shipping();
