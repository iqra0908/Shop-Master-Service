<?php

namespace EnDistanceBaseShippingProfilePopup;

class EnDistanceBaseShippingProfilePopup {

    public function __construct() {
        $this->shippingProfilePopup();
    }

    /**
     * Shipping rates popup template
     */
    public function shippingProfilePopup() {
        global $wpdb;
        $en_profile_classes_table = $wpdb->prefix . 'en_profile_classes';
        $all_classess = $wpdb->get_col("SELECT shipping_classes FROM $en_profile_classes_table WHERE shipping_classes != -1");

        $html = '';
        $wc_shipping_classes = apply_filters('en_woo_get_all_shipping_classes', []);
        ?>
        <div class="en-add-shipping-profile-popup" id="en-add-shipping-profile-popup" style="display: none;">
            <div class="en-dbsc-popup_container">
                <div class="en-dbsc-popup_header en_profile_heading">
                    <h2>Add shipping profile</h2>
                    <a class="close en_hide_popup" href="#">×</a>
                </div>
                <div class="en-dbsc-popup_body">
                    <form method="post" id="en-dbsc-shipping-profile-form">
                        <div class="en-dbsc-shipping-class-search-div">
                            <div class="form-field">
                                <label>Nickname</label>
                                <input type="text" name="en_dbsc_shipping_profile_nickname"
                                       class="en_dbsc_shipping_profile_nickname"
                                       title="Nickname" placeholder="Nickname" value=""/>
                            </div>
                            <div class="form-field">
                                <label>Shipping class</label>
                                <select id="en-shipping-classes-list" multiple="multiple" data-attribute="en_shipping_classes"
                                        name="en_shipping_classes"
                                        data-placeholder="Search shipping classes"
                                        class="chosen_select en_profile_shipping_classes">

                                    <?php
                                    if (isset($wc_shipping_classes) && !empty($wc_shipping_classes)) {
                                        foreach ($wc_shipping_classes as $key => $class) {
                                            if ($class->slug != 'ltl_freight' && !in_array($class->term_id, $all_classess)) {
                                                echo "<option value='" . esc_attr($class->term_taxonomy_id) . "'>" . esc_html($class->name) . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <label id="en_shipping_classes_error_msg" class="error" for="en_shipping_classes"
                                style="display: none;">Shipping class is required.</label>
                            </div>
                            <div class="form-field en-dbsc-add-new-shipping-class-button-div">
                                <a href="javascript:;" class="en-dbsc-add-new-shipping-class">Add a new shipping
                                    class</a>
                            </div>
                            <input type="hidden" name="en_profile_action" value="add_profile" class="en_profile_action"/>
                            <input type="hidden" name="en_profile_id" value="add_profile" class="en_profile_id"/>
                        </div>

                        <div class="en-dbsc-add-shipping-class">
                            <div class="form-field">
                                <label>Shipping class</label>
                                <input type="text" name="en_dbsc_shipping_profile_shipping_class_name"
                                       class="en_dbsc_shipping_profile_shipping_class_name"
                                       title="Shipping class" placeholder="Class name"/>
                            </div>
                            <div class="form-field">
                                <label>Slug</label>
                                <input type="text" name="en_dbsc_shipping_profile_shipping_class_slug"
                                       class="en_dbsc_shipping_profile_shipping_class_slug"
                                       title="Slug" placeholder="Class slug"/>
                            </div>
                            <div class="form-field">
                                <label>Description</label>
                                <textarea name="en_dbsc_shipping_profile_shipping_class_description"
                                          class="en_dbsc_shipping_profile_shipping_class_description"
                                          title="Description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="en-dbsc-popup_footer">
                    <a href="javascript:;" class="button-primary en-dbsc-cancel-button en_hide_popup">Cancel</a>
                    <a href="" class="button-primary en-dbsc-Done-button" id="en-add-shipping-profile" add="profile">Save</a>
                </div>
            </div>
        </div>
        <?php
    }

}