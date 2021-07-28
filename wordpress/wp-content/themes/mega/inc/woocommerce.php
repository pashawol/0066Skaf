<?php

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

/*
* Opening div for our content wrapper
*/
add_action('woocommerce_before_main_content', 'iconic_open_div', 5);

function iconic_open_div()
{
    echo '';
}

add_action('woocommerce_after_main_content', 'iconic_close_div', 50);
function iconic_close_div()
{
    echo '';
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
// remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// удаляем стили
function grd_woocommerce_script_cleaner()
{
    remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));

    if (!is_cart()) {
        wp_dequeue_style('woocommerce_frontend_styles');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce_fancybox_styles');
        wp_dequeue_style('woocommerce_chosen_styles');
        wp_dequeue_style('woocommerce_prettyPhoto_css');

    }
    wp_dequeue_script('selectWoo');
    wp_deregister_script('selectWoo');
    wp_dequeue_script('wc-add-payment-method');
    wp_dequeue_script('wc-lost-password');
    wp_dequeue_script('wc_price_slider');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-add-to-cart');
    wp_dequeue_script('wc-cart-fragments');
    wp_dequeue_script('wc-credit-card-form');
    wp_dequeue_script('wc-checkout');
    wp_dequeue_script('wc-add-to-cart-variation');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-cart');
    wp_dequeue_script('wc-chosen');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('prettyPhoto');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_script('jquery-blockui');
    wp_dequeue_script('jquery-placeholder');
    wp_dequeue_script('jquery-payment');
    wp_dequeue_script('fancybox');
    wp_dequeue_script('jqueryui');

    // }

}

add_action('wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99);
//отключаем стили tablepress
add_action('wp_print_styles', 'mytheme_dequeue_css_from_plugins', 100);
function mytheme_dequeue_css_from_plugins($c)
{
    if (!is_admin()) {
        wp_dequeue_style("tablepress-default");
    }
}

$typePostavka = [
    '1' => 'Основная поставка',
    '2' => 'Электронная поставка',
    '3' => 'USB поставка'
];

// тип продукта
function getTypeProduct()
{
    global $product, $typePostavka;
    $type_variant = get_field('type_variant');

    $html = '';
    $arrType = [];

    $price = $product->get_price();
    if (empty($price)) {
        $price = 0;
    }
    $arrType[$type_variant] = '
                <label class="radio-prod">
                    <input type="radio" name="additional" checked="checked"/>
                    <span class="radio-prod__wrapper">
                        <span class="radio-prod__lab"></span>
                        <span class="row">
                            <span class="radio-prod__title col">' . $typePostavka[$type_variant] . '</span>
                            <span class="radio-prod__price col-auto">
                                ' . number_format($price, 0, ',', ' ') . ' <span class="i-font">o</span>
                            </span>
                        </span>
                    </span>
                </label>
    ';

    $product_1 = get_field('product_1');
    if ($product_1) {
        $product1 = wc_get_product($product_1);
        $type_variant = get_field('type_variant', $product_1);
        $link = get_the_permalink($product_1);
        $price1 = $product1->get_price();
        if (empty($price1)) {
            $price1 = 0;
        }
        $arrType[$type_variant] = '
                <label class="radio-prod linkRadio" data-link="' . $link . '">
                    <input type="radio" name="additional" />
                    <span class="radio-prod__wrapper">
                        <span class="radio-prod__lab"></span>
                        <span class="row">
                            <span class="radio-prod__title col">' . $typePostavka[$type_variant] . '</span>
                            <span class="radio-prod__price col-auto">
                                ' . number_format($price1, 0, ',', ' ') . ' <span class="i-font">o</span>
                            </span>
                        </span>
                    </span>
                </label>
              ';

    }

    $product_2 = get_field('product_2');
    if ($product_2) {
        $product2 = wc_get_product($product_2);
        $type_variant = get_field('type_variant', $product_2);
        $link = get_the_permalink($product_2);
        $price2 = $product2->get_price();
        if (empty($price2)) {
            $price2 = 0;
        }
        $arrType[$type_variant] = '
                <label class="radio-prod linkRadio" data-link="' . $link . '">
                    <input type="radio" name="additional" />
                    <span class="radio-prod__wrapper">
                        <span class="radio-prod__lab"></span>
                        <span class="row">
                            <span class="radio-prod__title col">' . $typePostavka[$type_variant] . '</span>
                            <span class="radio-prod__price col-auto">
                                ' . number_format($price2, 0, ',', ' ') . ' <span class="i-font">o</span>
                            </span>
                        </span>
                    </span>
                </label>
              ';

    }
    if (isset($arrType['1'])) echo $arrType['1'];
    if (isset($arrType['2'])) echo $arrType['2'];
    if (isset($arrType['3'])) echo $arrType['3'];

}

// для вариантного товара
function getVariantProduct()
{
    global $product;
    $available_variations = $product->get_available_variations();
    $arVariation = [];
    $arJson = [];
    $arFirstResults = false;
    $html = '';

    foreach ($available_variations as $value) {
        $variation_obj = wc_get_product($value['variation_id']);
        $title = "";
        foreach ($value['attributes'] as $key => $attribute) {
            $taxonomy = str_replace('attribute_', "", $key);
            $term_obj = get_term_by('slug', $attribute, $taxonomy);
            $title = $term_obj->name;
        }
        $sku = $variation_obj->get_sku();
        $regularprice = $variation_obj->get_regular_price();
        $saleprice = $variation_obj->get_sale_price();
        $arVariation[$value['variation_id']] = [
            'title' => $title,
            'sku' => $sku,
            'regularprice' => $regularprice,
            'saleprice' => empty($saleprice)? 0 :$saleprice
        ];

    }
    if ($arVariation) {
        $i = 0;
        foreach ($arVariation as $k => $var) {
            $checked = '';
            if ($i === 0) {
                $checked = "checked";
                $arFirstResults = [
                    'price' => number_format($var['regularprice'], 0, ',', ' '),
                    'sale' => empty($var['saleprice'])?0:number_format($var['saleprice'], 0, ',', ' '),
                    'sku' => $var['sku'],
                    'variation_id' => $k
                ];
                $html .= '<input type="hidden" name="variation_id" value="' . $k . '" >';
            }
            if($var['saleprice']>0){
                $thisPrice=number_format($var['saleprice'], 0, ',', ' ');
            }else{
                $thisPrice=number_format($var['regularprice'], 0, ',', ' ');
            }

            $html .= '
                <label class="radio-prod variantRadio">
                    <input type="radio" name="additionalVariant" ' . $checked . ' value="' . $k . '" />
                    <span class="radio-prod__wrapper">
                        <span class="radio-prod__lab"></span>
                        <span class="row">
                            <span class="radio-prod__title col">' . $var['title'] . '</span>
                            <span class="radio-prod__price col-auto">
                                ' . $thisPrice . ' <span class="i-font">o</span>
                            </span>
                        </span>
                    </span>
                </label>
              ';
            $i++;
        }
    }
    return [
        'html' => $html,
        'arFirstResults' => $arFirstResults,
        'arVariation' => $arVariation
    ];

}

// для вариантного  цена
function getVariantProductPrice($product = false)
{
    if (!$product) {
        global $product;
    }

    $available_variations = $product->get_available_variations();
    if ($available_variations) {
        return [
            'price' => number_format($available_variations[0]["display_price"], 0, ',', ' '),
            'variation_id' => $available_variations[0]["variation_id"],
            'sku' => $available_variations[0]["sku"]
        ];
    } else {
        return 0;
    }
}

// добавить в корзину
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX:: get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo wp_send_json($data);
    }
    wp_die();
}


add_filter('woocommerce_product_subcategories_hide_empty', 'ts_hide_empty_categories', 10, 1);
function ts_hide_empty_categories($hide_empty)
{
    $hide_empty = FALSE;
}

add_filter('woocommerce_currency_symbol', 'misha_symbol_to_bukvi', 9999, 2);
function misha_symbol_to_bukvi($valyuta_symbol, $valyuta_code)
{
    if ($valyuta_code === 'RUB') {
        if (!is_admin()) {
            return '<span class="i-font">o</span>';
        }

    }
    return $valyuta_symbol;
}

/*
 *  Search
 */
add_filter('pre_get_posts', 'tgm_io_cpt_search');
function tgm_io_cpt_search($query)
{
    if ($query->is_search) {
        $query->set('post_type', array('product'));
    }
    return $query;
}

// заказ
add_action('wp_ajax_orderCreate', 'orderCreate_callback');
add_action('wp_ajax_nopriv_orderCreate', 'orderCreate_callback');
function orderCreate_callback()
{
    global $woocommerce;
    $address = array(
        'first_name' => $_POST['first_name'],
        'last_name' => '',
        'company' => '',
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address_1' => '',
        'address_2' => '',
        'city' => '',
        'state' => '',
        'postcode' => '',
        'country' => 'RU'
    );
    $products = json_decode(str_replace('\"', '"', $_POST['product']), true);
    $order = wc_create_order();
    foreach ($products as $key => $v) {
        $order->add_product(wc_get_product($v['product_id']), $v['quantity']);
    }
    $order->set_address($address, 'billing');
    $order->set_address($address, 'shipping');
    $order->calculate_totals();
    $order->update_status("wc-processing", '');
    $woocommerce->cart->empty_cart();
    wp_die();
}

// ************************************ shopto **********************************************************************
$GLOBALS['SHOPTO_CAT_ID'] = 67;
$GLOBALS['SHOPTO_CATEGORYARTICLE_ID'] = 5253;
//*******************************************************************************************
function so22835795_loop_shop_per_page() {
    $getCategoryShopto=getCategoryShopto();
    if($getCategoryShopto['shopto']||$getCategoryShopto['cat_id']){
        return 20;
    }
    return 400;
};

add_filter('loop_shop_per_page', 'so22835795_loop_shop_per_page', 10, 0);

function getCategoryShopto(){
    $results=[
        'cat_id'=>false,
         'shopto'=>false
    ];
    $childSopTO=false;
    if(isset($_GET['really_curr_tax'])){
        $really_curr_tax=$_GET['really_curr_tax'];
        $cat_id=str_replace('-product_cat','',$really_curr_tax);
        $results['cat_id']=$cat_id;
        $childSopTO=true;
    }elseif (is_product_category()){
        $catId = get_queried_object_id();
        $parentcats = get_ancestors($catId, 'product_cat');
        if(in_array($GLOBALS['SHOPTO_CAT_ID'],$parentcats)){
            $childSopTO=true;
        }
    }elseif (is_product()){
        global $post;
        $terms = get_the_terms( $post->ID, 'product_cat' );
        foreach ($terms as $term) {
            if($GLOBALS['SHOPTO_CAT_ID']==$term->term_id){
                $childSopTO=true;
            }
        }
    }
    if($childSopTO){
        $results['shopto']=true;
    }
    return  $results;
}

