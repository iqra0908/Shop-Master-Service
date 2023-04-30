=== Distance Based Shipping Calculator ===
Contributors: Eniture Technology
Tags: Distance, Distance calculator, Distance Based Shipping, shipping rates, shipping calculator, shipping estimate, shipping estimator,woocommerce shipping, eniture, eniture technology, shipping quotes
Requires at least: 5.7
Tested up to: 6.2
Stable tag: 2.0.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin retrieves the distance between your shipping origins and your customer and applies a rate per unit of distance (mile or kilometer) to calculate the shipping rate estimate.

== Description ==

This Woocommerce shipping calculator is a Distance x Rate calculator. If you are looking for a plugin to retrieve your negotiated carrier rates in real-time, look over our complete list of [Woocommerce plugins] (https://eniture.com/woocommerce). We have a wide selection of plugins available for LTL freight and parcel carriers.

**Key Features**

Using a shipping calculator to present shipping rates to your online shoppers is an excellent alternative when shipping costs aren’t available from your transportation providers in real-time. This plugin retrieves the distance between your shipping origins and your customer and applies a rate per unit of distance (mile or kilometer) to calculate the shipping rate estimate. Online merchants who use the following modes of transportation to ship or price online orders will find this plugin indispensable:

<ul>
<li>Same day delivery services.</li>
<li>Local delivery services.</li>
<li>Courier services.</li>
<li>Self-delivery service.</li>
<li>Truckload (Full Truckload) service.</li>
<li>Partial truckload service.</li>
<li>Refrigerated truckload service.</li>
<li>Flatbed truckload service.</li>
<li>Intermodal freight.</li>
<li>International air freight.</li>
<li>Ocean freight.</li>
<li>White-glove delivery service.</li>
<li>Time-critical freight.</li>
<li>Any type of transportation you want to be estimated with a distance x rate calculation.</li>
</ul>

**Requirements**

* WooCommerce 5.7 or newer.

* A license from Eniture Technology.

== Installation ==

**Installation Overview**

If you are taking advantage of a trial subscription, the plugin will stop working when the trial period ends. Be sure to read the Manage Your License section to learn how to upgrade your subscription.

A more extensive and graphically illustrated set of instructions can be found on the *Documentation* tab at

[eniture.com](https://eniture.com/woocommerce-distance-based-shipping-calculator).

**1. Install and activate the plugin**

In your WordPress dashboard, go to Plugins => Add New. Search for "Distance Based Shipping Calculator", and click Install Now.

After the installation process completes, click the Activate Plugin link to activate the plugin.

**2. Get a license from Eniture Technology**

Go to [Eniture Technology](https://eniture.com/woocommerce-distance-based-shipping-calculator) and pick

"Get a free 15 day trial" package. When you complete the registration process you will receive an email containing your license key and

your login to eniture.com. Keep your login information in a safe place. You will need it to access your customer dashboard

where you can manage your licenses and subscriptions. A credit card is not required for the free trial. If you opt for the free

trial you will need to login to your [Eniture Technology](http://eniture.com) dashboard before the trial period expires to purchase a subscription to the license. Without a paid subscription, the plugin will stop working once the trial period expires.

**3. Populate the plugin Settings page**

Go to WooCommerce => Settings => Distance Shipping Calculator. Use the *Settings* tab to gain access to the plugin configuration settings. Use the links at the top of the page to navigate between the Settings and Shipping Rates settings. Start with the Settings page.

**4. Plugin License Key**

The plugin license key is issued by Eniture Technology to registered users only. When you registered for a license, a license key was emailed to you. You can also retrieve your license key from the Customer Dashboard as described in the step, [Register for the plugin License Key](https://eniture.com/woocommerce-distance-based-shipping-calculator/#register), at the beginning of this guide. If you don’t have a license key, click the link to the right of this field to obtain one..

**5. Auto-renew**

When the plugin is first installed, your active subscription will be the free trial plan. The free trial provides up to 50 free transactions in the current monthly billing period. The plan you select in the Auto-renew dropdown will become the subscription plan when the current billing period ends, or the 50 free transactions are depleted, whichever occurs first.

**6. Define your Shipping Rates**

Go to WooCommerce => Settings => Distance Shipping Calculator. Using the links at the top of the page, select Shipping Rates. The plugin will allow you to create multiple shipping profiles. Each shipping profile can have one or more ship-from addresses and one or more shipping zones. Each shipping zone can have one or more shipping methods.

**6a. General Profile**

The General Profile always exists. By default, all of your products are included in the General Profile unless they are associated with another shipping profile. Products are associated with other shipping profiles by their Shipping Class. If you want, you can limit what is included in the General Profile to specific Shipping Classes by editing the General Profile settings.

**6b. Identify the Ship-From locations

You can define one or more ship-from locations in a shipping profile. When more than one location exists, the location with the closest proximity to the ship-to address will be selected for quoting purposes.

**6c. Create the Shipping Zones

You can create one or more Shipping Zones in each Ship-From location. When the Ship-To address matches the Shipping Zone, the Shipping Methods in the Shipping Zone will be triggered to provide a shipping rate.

**7. Enable the plugin**

Go to WooCommerce => Settings => Shipping. Click on the Shipping Zones link. Add a US domestic shipping zone if one doesn’t already exist. Click the “+” sign to add a shipping method to the US domestic shipping zone and choose Distance Shipping Calculator from the list.

**8. Configure your products**

The fields you see here will vary depending on the plugins you have installed. The instructions below are relevant only to the fields that affect the behavior of the Distance Based Shipping Calculator.

**Weight** Enter the weight of the product in pounds.

**Dimensions** Enter the dimensions of the product. Not required if none of the shipping methods are enabled for dimensions.

**Shipping Class** If you have Shipping Classes that are being used to include products in specific Shipping Profiles, this field is important. Identify the Shipping Class you have associated with a specific Shipping Profile.

If your product is a Variable Product, set the shipping parameters for each product variation on the Variations page.

When you are done click the Update button located in the Publish widget located at the top right of the page.

== Frequently Asked Questions ==

= How does this plugin work? =

Depending on your settings, the plugin will identify the distance between the ship-from and ship-to address as either the route (driving) distance or as a straight line. It will multiply the distance by a rate you specify to calculate the shipping rate estimate. You can also specify a minimum and maximum rate, and only trigger the calculation to occur if certain conditions are met.

= What countries will this plugin work for? =

The plugin will work for any country.

= What types of shipping methods does this plugin support? =

The plugin isn’t specific to any type of shipping method. It simply calculates a shipping rate based on the distance between the ship-from and ship-to address and applies a rate per unit of distance (mile or kilometer). Therefore, you can use the plugin to approximate the shipping charges for any type of shipping or delivery. The plugin is best suited for types of shipping that don’t have a schedule of rates that can be retrieved real-time via an Application Programming Interface (API). Common types of shipping this plugin is used for include: Same day delivery services, local delivery services, courier services, self-delivery service, truckload (full truckload) services, partial truckload service, refrigerated truckload service, flatbed truckload service, intermodal freight, international air freight, ocean freight, white-glove delivery service, time-critical freight, brokered transportation services.

= How am I billed for the plugin subscription? =

After the free trial transactions expire or are depleted, the credit card you have on file will be charged for the plan selected in the plugin settings. Plans range from $5/month for 100 transactions (5¢ each), to $30/month for 3000 transactions (1¢ each). The plan will automatically renew at the end of the monthly billing cycle, or when the number of transactions is depleted. (Charges are billed in US dollars.)

= How do I get a license key for the plugin? =

You must register the plugin, regardless of whether you are taking advantage of the trial period or purchased a license. At the conclusion of the registration process, an email will be sent to you that will include the license key. You can also login to eniture.com using the username and password you created during the registration process and retrieve the license key from the My Licenses tab.

= How do I change my plugin license from the trial version to one of the paid subscriptions? =

Provided you have a credit card on file, the plugin license will automatically transition to a paid subscription after the trial transactions expire or are depleted. If you don’t have a credit card on file, the plugin will stop working. If you haven’t provided a credit card, follow the instructions in the article in our knowledge base titled, [How To Update Your Credit Card On File](https://support.eniture.com/how-to-update-your-payment-method).

= How do I install the plugin on another website? =

The plugin has a single site license. To use it on another website you will need to purchase an additional license. If you want to change the website with which the plugin is registered, login to eniture.com and navigate to the My Licenses tab. There you will be able to change the domain name that is associated with the license key.

= Do I have to purchase a second license for my staging or development site? =

No. Each license allows you to identify one domain for your production environment and one domain for your staging or development environment. The rate estimates returned in the staging environment will have the word “Sandbox” appended to them.

= How do I install the plugin on another website? =

If you can successfully test your credentials from the Connection page (WooCommerce > Settings > Distance Shipping Calculator > Connections) then you have one or more of the following licensing issues: 1) You are using the license key on more than one domain. The licenses are for single sites. You will need to purchase an additional license. 2) Your trial period has expired. 3) Your current license has expired and we have been unable to process your form of payment to renew it. Login to eniture.com and go to the My Licenses tab to resolve any of these issues.

== Screenshots ==

1. Carrier inclusion page
2. Quote settings page
3. Quotes displayed in cart

== Changelog ==

= 2.0.10 =
* Update: Introduced settings for minimum/maximum cart value. 

= 2.0.9 =
* Fix: Fixed shipping method label in case of zero shipping price

= 2.0.8 =
* Update: Removed "Don't quote shipping if one or more items are missing the required shipping parameters" from error management

= 2.0.7 =
* Update: Introduced erro from error management in the plugin settings

= 2.0.6 =
* Update: Improvements to the usage reporting in the plugin settings.

= 2.0.5 =
* Update: Compatibility with WordPress version 6.1
* Update: Compatibility with WooCommerce version 7.0.1

= 2.0.4 =
* Update: Introduced connectivity from the plugin to FreightDesk.Online using Company ID
* Update: Compatibility with WordPress multisite network
* Update: Accept origin address of all over the globe 

= 2.0.3 =
* Fix: Fix a PHP error in dimensions type casting. 

= 2.0.2 =
* Update: An update to accept a Portuguese postal code.

= 2.0.1 =
* Fix: Fixed a PHP error in composer class.

= 2.0.0 =
* Update: Added a module, "Residential Address Detection" 

= 1.0.6 =
* Update: Show free shipping on negative distance
* Update: Renamed Settings as Connection Settings

= 1.0.5 =
* Update: Added other settings tab

= 1.0.4 =
* Update: Bug fixes

= 1.0.3 =
* Added: Distance and rates adjustments with ability to display distance on checkout

= 1.0.2 =
* Added: Distance based rates tiers

= 1.0.1 =
* Update: Added distance based rates tiers.
* Update: Added the flat rate option.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==