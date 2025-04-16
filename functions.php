<?php
$themePrefix = 'themeName';
//Theme Support
add_action('after_setup_theme' , 'coderitem_basic');
function coderitem_basic(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    load_theme_textdomain('coderlang', get_template_directory().'/lang');

    register_nav_menus(array(
            'main-menu' => __('Main Menu' , 'coderitem'),
            'footer-menu' => __('Footer Menu' , 'coderitem'),
        ));

    add_theme_support( 'woocommerce' );
}
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');
//svg support
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');



function load_insta_gallery_textdomain() {
    load_plugin_textdomain( 'insta-gallery', false, plugin_dir_path( __FILE__ ) . 'languages' );
}
add_action( 'init', 'load_insta_gallery_textdomain' );




//stylsheet
add_action('wp_enqueue_scripts','css_script');
function css_script(){
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/assets/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome-cdn','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fonts-custom',get_template_directory_uri().'/assets/fonts/fonts.css');
    //
    wp_enqueue_style('main-stylecss',get_template_directory_uri().'/assets/css/style.css');
    wp_enqueue_style('style',get_stylesheet_uri());
    wp_enqueue_style('responsive',get_template_directory_uri().'/assets/css/responsive.css');
}



//////////JavaScripts/////////
function coder_js() {
    //bootstrap
    wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'),'1.1', true);
    wp_enqueue_script('bootstrap');
    //modernizr
  
    //scripts
    wp_register_script('scripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'),'1.1', true);
    wp_enqueue_script('scripts');

}
 
add_action( 'wp_enqueue_scripts', 'coder_js' );  




function ensure_wc_scripts() {
    if (function_exists('is_woocommerce')) {
        wp_enqueue_script('wc-add-to-cart');
    }
}
add_action('wp_enqueue_scripts', 'ensure_wc_scripts');






// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Ajouter au panier', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Ajouter au panier', 'woocommerce' );
}



// Auto Redirect After Login
add_filter( 'woocommerce_login_redirect', 'redirect_to_online_shop_after_login', 10, 2 );

function redirect_to_online_shop_after_login( $redirect, $user ) {
    return home_url( '/online-shop/' ); // adjust if your slug is different
}




 // AJAX functionality  Search

function custom_enqueue_ajax_search_script() {
    wp_enqueue_script( 'jquery' );
    
    // Register your custom script
    wp_register_script( 'ajax-search', get_template_directory_uri() . '/assets/js/ajax-search.js', array( 'jquery' ), null, true );

    // Pass the ajax URL to the script
    wp_localize_script( 'ajax-search', 'ajaxsearch', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ) // This is where we'll send the AJAX request
    ));

    wp_enqueue_script( 'ajax-search' );
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_ajax_search_script' );

// Steps to Search Only by Product Name:

function handle_ajax_search() {
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    // Perform the product search query, restricting to product titles only
    $args = array(
        'post_type' => 'product', // Search only products
        'posts_per_page' => 5, // Limit the number of results
        's' => $search_query, // The search query
        'fields' => 'ids', // Get only post IDs to optimize the query
        'post_status' => 'publish', // Ensure only published products are fetched
        'meta_query' => array(), // Ensures no custom fields are included in the search
    );

    // Custom WP Query to search by product title only
    $args['search_columns'] = array('post_title'); // Search only the post title (product name)

    $query = new WP_Query($args);

    // If there are results, loop through and output the results
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="search-result-item">
                <a href="<?php the_permalink(); ?>">
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<p>No products found.</p>';
    }

    // Reset post data after the custom query
    wp_reset_postdata();

    die(); // This is required to terminate the AJAX request properly
}
add_action('wp_ajax_ajax_search', 'handle_ajax_search'); // If called from admin panel
add_action('wp_ajax_nopriv_ajax_search', 'handle_ajax_search'); // If called from elsewhere







// Add custom discount field to user profile
function add_reseller_discount_field( $user ) {
    ?>
    <h3><?php _e('Reseller Discount', 'your-theme'); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="reseller_discount"><?php _e('Discount Percentage (%)', 'your-theme'); ?></label></th>
            <td>
                <input type="number" name="reseller_discount" id="reseller_discount" value="<?php echo esc_attr( get_the_author_meta( 'reseller_discount', $user->ID ) ); ?>" class="regular-text" />
                <p class="description"><?php _e('Enter the discount percentage for this reseller (e.g., 20 for 20%).', 'your-theme'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'add_reseller_discount_field' );
add_action( 'edit_user_profile', 'add_reseller_discount_field' );

// Save the custom field value
function save_reseller_discount_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    update_user_meta( $user_id, 'reseller_discount', $_POST['reseller_discount'] );
}
add_action( 'personal_options_update', 'save_reseller_discount_field' );
add_action( 'edit_user_profile_update', 'save_reseller_discount_field' );




// Apply discount based on user meta field
function apply_reseller_discount( $cart ) {
    // Ensure the user is logged in
    if ( ! is_user_logged_in() ) {
        return;
    }

    // Get the current user ID
    $user_id = get_current_user_id();

    // Get the reseller discount from the user meta
    $discount_percentage = get_user_meta( $user_id, 'reseller_discount', true );

    // If the user has a discount set
    if ( ! empty( $discount_percentage ) ) {
        // Calculate the discount amount
        $discount_amount = ( $discount_percentage / 100 ) * $cart->subtotal;

        // Apply the discount
        $cart->add_fee( 'Reseller Discount (' . $discount_percentage . '%)', -$discount_amount );
    }
}
add_action( 'woocommerce_cart_calculate_fees', 'apply_reseller_discount' );








// Add Custom Field for Delivery Method at Checkout
function add_delivery_method_field( $fields ) {
    $fields['billing']['delivery_method'] = array(
        'type'        => 'select',
        'label'       => 'Delivery Method',
        'options'     => array(
            ''            => 'Select Delivery Method',
            'Pick Up In Store'      => 'Pick Up In Store',
            'Home Delivery'    => 'Home Delivery',
        ),
        'required'    => true,
    );
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'add_delivery_method_field' );


// Display Delivery Method on Order Review page
function display_delivery_method_in_order_summary( $order_id ) {
    $order = wc_get_order( $order_id );
    $delivery_method = $order->get_meta( 'delivery_method' );

    if ( ! empty( $delivery_method ) ) {
        echo '<p><strong>Delivery Method:</strong> ' . ucfirst( $delivery_method ) . '</p>';
    }
}
add_action( 'woocommerce_order_details_after_order_table', 'display_delivery_method_in_order_summary', 10, 1 );


// Save Delivery Date and Time to Order
function save_delivery_date_and_time( $order_id ) {
    if ( ! empty( $_POST['delivery_date'] ) ) {
        update_post_meta( $order_id, '_delivery_date', sanitize_text_field( $_POST['delivery_date'] ) );
    }
    if ( ! empty( $_POST['delivery_time'] ) ) {
        update_post_meta( $order_id, '_delivery_time', sanitize_text_field( $_POST['delivery_time'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_delivery_date_and_time' );




// Display Delivery Date and Time in Order Details
function display_delivery_date_and_time_in_order( $order ) {
    $delivery_date = get_post_meta( $order->get_id(), '_delivery_date', true );
    $delivery_time = get_post_meta( $order->get_id(), '_delivery_time', true );

    if ( ! empty( $delivery_date ) ) {
        echo '<p><strong>Delivery Date:</strong> ' . esc_html( $delivery_date ) . '</p>';
    }
    if ( ! empty( $delivery_time ) ) {
        echo '<p><strong>Delivery Time:</strong> ' . esc_html( $delivery_time ) . '</p>';
    }
}
add_action( 'woocommerce_order_details_after_order_table', 'display_delivery_date_and_time_in_order', 10, 1 );


// Display Delivery Method in WooCommerce Admin Order Details
function display_delivery_method_in_admin_order( $order ) {
    // Get the delivery method meta data saved for the order
    $delivery_method = get_post_meta( $order->get_id(), '_delivery_method', true );

    if ( ! empty( $delivery_method ) ) {
        echo '<p><strong>' . __( 'Delivery Method', 'your-textdomain' ) . ':</strong> ' . ucfirst( $delivery_method ) . '</p>';
    }
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_delivery_method_in_admin_order', 10, 1 );

// Save Delivery Method to Order Meta
function save_delivery_method_to_order( $order_id ) {
    if ( isset( $_POST['delivery_method'] ) ) {
        update_post_meta( $order_id, '_delivery_method', sanitize_text_field( $_POST['delivery_method'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_delivery_method_to_order' );






// .....................

// Add Delivery Date and Preferred Delivery Time fields to the Checkout page
function add_delivery_date_and_time_fields( $fields ) {
    // Delivery Date Field
    $fields['billing']['billing_delivery_date'] = array(
        'type'        => 'text',
        'label'       => __('Delivery Date'),
        'placeholder' => __('Select your delivery date (48 hours in advance)'),
        'class'       => array('form-row-wide'),
        'required'    => true,
    );

    // Preferred Delivery Time Field
    $fields['billing']['billing_delivery_time'] = array(
        'type'        => 'time',
        'label'       => __('Preferred Delivery Time'),
        'placeholder' => __('Select your preferred delivery time'),
        'class'       => array('form-row-wide'),
        'required'    => false,
    );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'add_delivery_date_and_time_fields' );


// Enqueue jQuery UI Datepicker for the delivery date field
function enqueue_checkout_scripts() {
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

    // Custom JS for Datepicker and validation
    wp_enqueue_script('checkout-custom-scripts', get_template_directory_uri() . '/assets/js/checkout-scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_checkout_scripts');


// Display Preferred Delivery Time in Admin Order Details with AM/PM format
function display_delivery_time_in_admin_order( $order ) {
    // Retrieve the preferred delivery time from the order
    $delivery_time = get_post_meta( $order->get_id(), '_billing_delivery_time', true );

    // Check if the delivery time is available
    if ( ! empty( $delivery_time ) ) {
        // Convert to 12-hour format with AM/PM (e.g., 03:53 PM)
        $formatted_delivery_time = date('h:i A', strtotime($delivery_time));  // 'h:i A' for 12-hour format with AM/PM
        
        // Display the formatted delivery time in the order details
        echo '<p><strong>' . __( 'Preferred Delivery Time', 'your-textdomain' ) . ':</strong> ' . esc_html( $formatted_delivery_time ) . '</p>';
    }
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_delivery_time_in_admin_order', 10, 1 );













// Save custom fields (delivery date and delivery time) to order meta
function save_delivery_date_and_time_update( $order_id ) {
    if ( isset( $_POST['billing_delivery_date'] ) ) {
        update_post_meta( $order_id, '_billing_delivery_date', sanitize_text_field( $_POST['billing_delivery_date'] ) );
    }

    if ( isset( $_POST['billing_delivery_time'] ) ) {
        update_post_meta( $order_id, '_billing_delivery_time', sanitize_text_field( $_POST['billing_delivery_time'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_delivery_date_and_time_update' );




// Display custom fields in the Admin Order Details
function display_delivery_date_and_time_in_admin_order( $order ) {
    $delivery_date = get_post_meta( $order->get_id(), '_billing_delivery_date', true );
    $delivery_time = get_post_meta( $order->get_id(), '_billing_delivery_time', true );

    if ( ! empty( $delivery_date ) ) {
        echo '<p><strong>' . __( 'Delivery Date', 'your-textdomain' ) . ':</strong> ' . esc_html( $delivery_date ) . '</p>';
    }

    // Uncomment the following if you want to display the preferred delivery time
    // if ( ! empty( $delivery_time ) ) {
    //     echo '<p><strong>' . __( 'Preferred Delivery Time', 'your-textdomain' ) . ':</strong> ' . esc_html( $delivery_time ) . '</p>';
    // }
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_delivery_date_and_time_in_admin_order', 10, 1 );






// Add a custom "Customer Notes" field to the Billing section on the checkout page
function add_customer_notes_field_to_checkout( $fields ) {
    $fields['billing']['billing_customer_notes'] = array(
        'type'        => 'textarea',
        'label'       => __('Customer Notes', 'your-theme'),
        'placeholder' => __('Enter any comments or special instructions here'),
        'class'       => array('form-row-wide'),
        'required'    => false, // Make it optional, change to true to make it mandatory
    );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'add_customer_notes_field_to_checkout' );


// Save the "Customer Notes" to order meta
function save_customer_notes_to_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_customer_notes'] ) ) {
        update_post_meta( $order_id, '_billing_customer_notes', sanitize_textarea_field( $_POST['billing_customer_notes'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_customer_notes_to_order_meta' );



// Display "Customer Notes" in the Admin Order Details
function display_customer_notes_in_admin_order( $order ) {
    $customer_notes = get_post_meta( $order->get_id(), '_billing_customer_notes', true );

    if ( ! empty( $customer_notes ) ) {
        echo '<p><strong>' . __( 'Customer Notes', 'your-textdomain' ) . ':</strong> ' . nl2br( esc_html( $customer_notes ) ) . '</p>';
    }
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_customer_notes_in_admin_order', 10, 1 );








// .................................
// .................................

// .................................

// .................................

// .................................





// add_filter( 'manage_users_columns', function( $columns ) {
//     $columns['special_customer'] = __( 'Special Customer', 'your-textdomain' );
//     return $columns;
// });

// add_action( 'manage_users_custom_column', function( $value, $column_name, $user_id ) {
//     if ( 'special_customer' === $column_name ) {
//         return '<input type="checkbox" disabled="disabled" ' . checked( get_user_meta( $user_id, 'special_customer', true ), 1, false ) . ' />';
//     }
//     return $value;
// }, 10, 3 );


// add_action( 'show_user_profile', 'add_special_customer_checkbox' );
// add_action( 'edit_user_profile', 'add_special_customer_checkbox' );
// function add_special_customer_checkbox( $user ) {
//     echo '<h3>Special Customer</h3><table class="form-table"><tr><th><label for="special_customer">Special Customer?</label></th><td><input type="checkbox" name="special_customer" id="special_customer" value="1" ' . checked( get_user_meta( $user->ID, 'special_customer', true ), 1, false ) . ' /><span class="description">Allow access to restricted products.</span></td></tr></table>';
// }
// add_action( 'personal_options_update', 'save_special_customer_checkbox' );
// add_action( 'edit_user_profile_update', 'save_special_customer_checkbox' );
// function save_special_customer_checkbox( $user_id ) {
//     update_user_meta( $user_id, 'special_customer', isset( $_POST['special_customer'] ) ? 1 : 0 );
// }









//  Allow Product Visibility Based on Specific User IDs (with conditional field)


// Allow Product Visibility Based on Specific User IDs (with conditional field)
//Allow Product Visibility Based on Specific User IDs (with conditional field)

// 1. Product Edit Page: Restrict Option + User Selector
add_action( 'woocommerce_product_options_general_product_data', function() {
    global $post;
    $is_restricted = get_post_meta( $post->ID, '_restrict_to_specific_users', true );
    $allowed_users = get_post_meta( $post->ID, '_allowed_user_ids', true );
    if ( ! is_array( $allowed_users ) ) $allowed_users = [];

    $all_users = get_users([ 'fields' => ['ID', 'display_name'] ]);

    echo '<div class="options_group">';

    woocommerce_wp_select([
        'id'          => '_restrict_to_specific_users',
        'label'       => 'Restrict Product Visibility?',
        'options'     => ['no' => 'No (visible to all)', 'yes' => 'Yes (only specific users)'],
        'description' => 'Choose whether this product should only be visible to selected users.'
    ]);

    echo '<p class="form-field show-if-restricted"><label for="_allowed_user_ids">Allowed Users</label>';
    echo '<select name="_allowed_user_ids[]" multiple style="width:100%;">';
    foreach ( $all_users as $user ) {
        $sel = in_array( $user->ID, $allowed_users ) ? 'selected' : '';
        echo '<option value="' . esc_attr($user->ID) . '" ' . $sel . '>' . esc_html($user->display_name) . ' (#' . $user->ID . ')</option>';
    }
    echo '</select><span class="description">Hold Ctrl or Cmd to select multiple users.</span></p>';
    echo '</div>';

    // JS to show/hide user select on dropdown change
    echo '<script>
    jQuery(function($){
        function toggleField() {
            if ($("#_restrict_to_specific_users").val() === "yes") {
                $(".show-if-restricted").show();
            } else {
                $(".show-if-restricted").hide();
            }
        }
        toggleField();
        $("#_restrict_to_specific_users").change(toggleField);
    });
    </script>';
});

// 2. Save Product Meta
add_action( 'woocommerce_process_product_meta', function( $post_id ) {
    update_post_meta( $post_id, '_restrict_to_specific_users', $_POST['_restrict_to_specific_users'] ?? 'no' );

    if ( isset( $_POST['_allowed_user_ids'] ) ) {
        $ids = array_map( 'intval', (array) $_POST['_allowed_user_ids'] );
        update_post_meta( $post_id, '_allowed_user_ids', $ids );
    } else {
        delete_post_meta( $post_id, '_allowed_user_ids' );
    }
});

// 3. Restrict Product Visibility Post-Query (final and reliable)
add_filter('the_posts', function( $posts, $query ) {
    if ( is_admin() || ! is_main_query() ) return $posts;
    if ( ! is_page_template('online-shop.php') && ! is_shop() && ! is_product_category() && ! is_search() && ! is_post_type_archive('product') ) return $posts;

    $user_id = get_current_user_id();
    $filtered = [];

    foreach ( $posts as $post ) {
        $restricted = get_post_meta( $post->ID, '_restrict_to_specific_users', true );
        $allowed = get_post_meta( $post->ID, '_allowed_user_ids', true );

        if ( $restricted !== 'yes' ) {
            $filtered[] = $post; // public
        } elseif ( is_array($allowed) && in_array( $user_id, $allowed ) ) {
            $filtered[] = $post; // assigned
        }
        // else skip (hidden from user)
    }

    return $filtered;
}, 10, 2 );

// 4. Shortcode visibility (used in custom shop templates)
add_filter( 'woocommerce_shortcode_products_query', function( $args ) {
    $user_id = get_current_user_id();

    $args['meta_query'][] = [
        'relation' => 'OR',
        [ 'key' => '_restrict_to_specific_users', 'compare' => 'NOT EXISTS' ],
        [ 'key' => '_restrict_to_specific_users', 'value' => 'no', 'compare' => '=' ],
        [
            'relation' => 'AND',
            [ 'key' => '_restrict_to_specific_users', 'value' => 'yes', 'compare' => '=' ],
            [ 'key' => '_allowed_user_ids', 'value' => $user_id, 'compare' => 'LIKE' ]
        ]
    ];

    return $args;
}, 10 );

// 5. Footer debug output for testing visibility logic
// add_action('wp_footer', function() {
//     if ( is_user_logged_in() ) {
//         $user_id = get_current_user_id();
//         $products = wc_get_products(['limit' => 100]);

//         echo '<div style="background:#fff;padding:10px;font-size:14px;">';
//         echo 'Logged in as User ID: <strong>' . $user_id . '</strong><br><br>';

//         foreach ( $products as $product ) {
//             $allowed = get_post_meta( $product->get_id(), '_allowed_user_ids', true );
//             $is_restricted = get_post_meta( $product->get_id(), '_restrict_to_specific_users', true );

//             echo 'Product: <strong>' . $product->get_name() . '</strong><br>';
//             echo 'Restricted: ' . esc_html($is_restricted) . '<br>';
//             echo 'Allowed: ';
//             print_r($allowed);
//             echo '<br>User is in allowed: ';
//             echo is_array($allowed) && in_array($user_id, $allowed) ? '✅ YES' : '❌ NO';
//             echo '<hr>';
//         }

//         echo '</div>';
//     }
// });






// -- Add Article Number Field to Product Edit Page --
// -- Add Article Number Field to Product Edit Page --
add_action( 'woocommerce_product_options_general_product_data', function() {
    woocommerce_wp_text_input( [
        'id'          => '_article_number',
        'label'       => 'Article Number',
        'desc_tip'    => true,
        'description' => 'Internal reference / article number.',
    ] );
});

add_action( 'woocommerce_process_product_meta', function( $post_id ) {
    if ( isset( $_POST['_article_number'] ) ) {
        update_post_meta( $post_id, '_article_number', sanitize_text_field( $_POST['_article_number'] ) );
    }
});

// -- Show in Admin Product Table --
add_filter( 'manage_edit-product_columns', function( $columns ) {
    $columns['article_number'] = 'Article #';
    return $columns;
}, 15 );

add_action( 'manage_product_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'article_number' ) {
        echo esc_html( get_post_meta( $post_id, '_article_number', true ) );
    }
}, 10, 2 );

// -- Show on Single Product Page --
add_action( 'woocommerce_single_product_summary', function() {
    global $product;
    $article = get_post_meta( $product->get_id(), '_article_number', true );
    if ( $article ) {
        echo '<p class="product-article">Article #: <strong>' . esc_html( $article ) . '</strong></p>';
    }
}, 21 );

// -- Show AFTER Quantity in Cart & Checkout --
add_action( 'woocommerce_after_cart_item_name', function( $cart_item, $cart_item_key ) {
    if ( isset( $cart_item['product_id'] ) ) {
        $article = get_post_meta( $cart_item['product_id'], '_article_number', true );
        if ( $article ) {
            echo '<br><small><strong>Article #:</strong> ' . esc_html( $article ) . '</small>';
        }
    }
}, 10, 2 );


// -- Show in Order Email & Thank You Page --
add_filter( 'woocommerce_order_item_name', function( $item_name, $item, $is_visible ) {
    if ( is_admin() ) return $item_name; // backend no need change

    $product = $item->get_product();
    if ( $product && is_object( $product ) ) {
        $article = get_post_meta( $product->get_id(), '_article_number', true );
        if ( $article ) {
            // insert article AFTER the quantity
            $item_name = preg_replace(
                '/(<strong class="product-quantity">.*?<\/strong>)/',
                '$1<br><small><strong>Article #:</strong> ' . esc_html( $article ) . '</small>',
                $item_name
            );
        }
    }
    return $item_name;
}, 10, 3 );



// -- Add Article # below each product in order summary tables (emails, view order, thank you page)
add_action( 'woocommerce_order_item_meta_end', function( $item_id, $item, $order ) {
    $product = $item->get_product();
    if ( $product && is_object( $product ) ) {
        $article = get_post_meta( $product->get_id(), '_article_number', true );
        if ( $article ) {
            echo '<div style="margin-top:4px;"><small><strong>Article #:</strong> ' . esc_html( $article ) . '</small></div>';
        }
    }
}, 10, 3 );





// Payment enabled


// 1. Prevent WooCommerce Admin trying to fetch plugin info for this gateway
add_filter( 'woocommerce_should_load_payment_method_integration', function( $should_load, $gateway_id ) {
    if ( $gateway_id === 'pay_with_cash' ) {
        return false; // Prevent Admin crash
    }
    return $should_load;
}, 10, 2 );

add_filter( 'woocommerce_admin_payment_gateway_use_admin_settings_api', function( $use_api, $gateway_id ) {
    if ( $gateway_id === 'pay_with_cash' ) {
        return false; // Prevent Admin crash
    }
    return $use_api;
}, 10, 2 );

// 2. Define Gateway
add_action( 'plugins_loaded', function() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

    class WC_Gateway_Pay_With_Cash extends WC_Payment_Gateway {
        public function __construct() {
            $this->id = 'pay_with_cash';
            $this->method_title = 'Pay with Cash';
            $this->method_description = 'Allow customers to pay in cash.';
            $this->has_fields = false;

            $this->init_form_fields();
            $this->init_settings();

            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->enabled = $this->get_option( 'enabled' );

            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options' ] );
        }

        public function init_form_fields() {
            $this->form_fields = [
                'enabled' => [
                    'title' => 'Enable/Disable',
                    'type' => 'checkbox',
                    'label' => 'Enable Pay with Cash',
                    'default' => 'yes',
                ],
                'title' => [
                    'title' => 'Title',
                    'type' => 'text',
                    'default' => 'Pay with Cash',
                ],
                'description' => [
                    'title' => 'Customer Message',
                    'type' => 'textarea',
                    'default' => 'Pay in cash when you pick up or receive the product.',
                ],
            ];
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            $order->payment_complete();
            $order->add_order_note( 'Paid with Cash' );

            return [
                'result' => 'success',
                'redirect' => $this->get_return_url( $order )
            ];
        }
    }

    // 3. Register Gateway
    add_filter( 'woocommerce_payment_gateways', function( $methods ) {
        $methods[] = 'WC_Gateway_Pay_With_Cash';
        return $methods;
    } );
});










/*Juery at footer -- if needed
function JQuery_footer() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'JQuery_footer' );
*/

// Post Type Examples
/*register_post_type( 'specialties',array(
    'labels' => array(
        'name' => 'Our Specialties',
        'add_new' => 'Add New Specialty'
    ),
    'public' => true,
    'supports' => array('title','editor','thumbnail',),
    'menu_icon' =>  'dashicons-buddicons-groups'
));
*/



//Requerd Files
require_once('inc/includes.php');
function coder_main_menu() {
    ?>  
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#"> Contact Us</a></li>
    </ul>
    <?php
}

add_shortcode('myfile','myfile');
function myfile(){
    return get_template_directory_uri().'/';
}
function theme_path(){
    return get_template_directory_uri();
}

