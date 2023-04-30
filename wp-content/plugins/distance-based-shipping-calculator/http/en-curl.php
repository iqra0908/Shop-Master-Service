<?php
/**
 * Curl http request.
 */

namespace EnDistanceBaseShippingCurl;

/**
 * Generic http request.
 * Class EnDistanceBaseShippingCurl
 * @package EnDistanceBaseShippingCurl
 */
class EnDistanceBaseShippingCurl
{
    /**
     * @param satring $url
     * @param array $post_data
     * @param string $method
     * @param string string $step_for
     * @return string|encoded
     */
    static public function EN_DISTANCE_BASE_SHIPPING_sent_http_request($url, $post_data, $method, $step_for = '')
    {
        $curl_response = '';
        if (strlen($url) > 0 && is_array($post_data) && !empty($post_data)) {

            // Eniture Execution Time
            $en_time_start = microtime(true);

            // Eniture Debug Mood
            do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " $step_for Request ", $post_data);

            $method == 'POST' ? $post_data = http_build_query($post_data) : '';
            $method == 'POST_ENCODED' ? $post_data = json_encode($post_data) : '';
            
            // Eniture Debug Mood
            do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " $step_for Build Query ", $post_data);

            $response = wp_remote_post($url,
                [
                    'method' => $method,
                    'timeout' => 60,
                    'redirection' => 5,
                    'blocking' => true,
                    'body' => $post_data,
                ]
            );
            $curl_response = wp_remote_retrieve_body($response);

        }

        // Eniture Debug Mood
        do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " $step_for Response ", json_decode($curl_response));

        // Eniture Execution Time
        $en_time_end = microtime(true) - $en_time_start;
        do_action("eniture_debug_mood", EN_DISTANCE_BASE_SHIPPING_NAME . " $step_for Execution Time ", $en_time_end);

        return $curl_response;
    }
}
