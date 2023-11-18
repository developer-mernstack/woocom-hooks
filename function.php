<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('hello-elementor', 'hello-elementor', 'hello-elementor-theme-style'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION

function test_function()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            // Add a container for validation messages
            var validationMessageContainer = $("<div id='validation-message' style='color: red; margin-top: 5px;'></div>");
            $("#width, #height").after(validationMessageContainer);

            $("#width, #height").on("input", function () {
                var height = $("#height").val();
                var width = $("#width").val();
                var validationMessage = $("#validation-message");

                if (isValidInput(height, width)) {
                    var price = calculatePrice(height, width);

                    // Update product price in the WooCommerce product page
                    $(".price .amount").text("$" + price.toFixed(2));

                    // Clear validation message
                    validationMessage.text("");
                } else {
                    validationMessage.text("Invalid input! Please enter values within the specified range.");

                    // Reset the displayed price in the WooCommerce product page
                    $(".price .amount").text("");
                }
            });

            function isValidInput(height, width) {
                var validHeightRange = height >= 1 && height < 10;
                var validWidthRange = width >= 10 && width < 50;
                return validHeightRange && validWidthRange;
            }

            function calculatePrice(height, width) {
                var fixedPrice  = 10; 
                return fixedPrice ;
            }
        });
    </script>
    <div style="margin-bottom: 20px;">
        <label for="height">Height</label>
        <input type="number" id="height" class="form-control" placeholder="0"> <br>
        <label for="width">Width</label>
        <input type="number" id="width" class="form-control" placeholder="0"> <br>
        <!-- Display validation message below the input fields -->
        <div id="validation-message"></div>
        <!-- Displayed price -->
        <p><strong>Total Price: </strong><span class="price amount"></span></p>
    </div>
    <?php
}

add_action('woocommerce_single_product_summary', 'test_function', 4);

// Hook to calculate the price based on width and height before displaying
add_action('woocommerce_before_calculate_totals', 'calculate_custom_price', 10, 1);


function calculatePrice($height, $width) {
                 $fixedPrice = 10; 
                return $fixedPrice;
            }


function calculate_custom_price($cart_object) {
    foreach ($cart_object->get_cart() as $cart_item_key => $cart_item) {
        // Get the entered values of width and height for each item in the cart
        $height = isset($cart_item['height']) ? $cart_item['height'] : 0;
        $width = isset($cart_item['width']) ? $cart_item['width'] : 0;

        // Calculate the custom price based on your logic
        $custom_price = calculatePrice($height, $width);

        // Set the calculated price for the item
        $cart_object->cart_contents[$cart_item_key]['data']->set_price($custom_price);
    }
}
