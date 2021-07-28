<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package datex
 */
function sdfsd_body_classes($classes)
{
    if ('post' === get_post_type() || is_category()||'page-template/page-rent2.php'==get_page_template_slug()) {
        $classes[] = ' search-hidden ';
    }
    return $classes;
}
add_filter('body_class', 'sdfsd_body_classes');

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
function add_async_attribute($tag, $handle)
{
    if (!is_admin()) {
        if ('jquery-core' == $handle) {
            return $tag;
        }
        return str_replace(' src', ' defer src', $tag);
    } else {
        return $tag;
    }
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Основные настройки',
        'menu_title' => 'Основные настройки',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Текстовые блоки в шаблоне',
        'menu_title' => 'Text',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Калькулятор',
        'menu_title' => 'Калькулятор',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Сквозные блоки',
        'menu_title' => 'Сквозные блоки',
        'parent_slug' => 'theme-general-settings',
    ));


}
$custom_logo_global = get_custom_logo();
$customLogoId = get_theme_mod('custom_logo');

if(isset($_COOKIE['city'])){
    if( "Самара"==$_COOKIE['city']){
        $phone_global = '+7 (846) 300-48-40';
        $phone_link_global = '+78463004840';
    }else{
        $phone_global = get_field('phone', 'option');
        $phone_link_global = '+' . preg_replace('/\D+/', '', $phone_global);
    }
}else{
    $phone_global = get_field('phone', 'option');
    $phone_link_global = '+' . preg_replace('/\D+/', '', $phone_global);
}

$partner_1s = get_field('сертифицированные_партнеры_1с', 'option');
$socials = get_field('соцсети', 'option');
$socials_html = "";
if ($socials) {
    foreach ($socials as $social) {
        if ($social['link'] !== "") {
            $socials_html .= '
          <a class="soc__item" href="' . $social['link'] . '" target="_blank">
                <svg class="icon icon-' . $social['class'] . ' ">
                      <use xlink:href="' . $get_template_directory_uri . '/img/svg/sprite.svg#' . $social['class'] . '"></use>
                </svg>
          </a>
        ';
        }
    }
}
// убираем мусор из шапки
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
// убираем с сайта эти идиотские emoje
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

function filesize_formatted($size)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

/*
 * с формы демо доступа
 */
add_action('wp_ajax_demomail', 'my_demomail');
add_action('wp_ajax_nopriv_demomail', 'my_demomail');
function my_demomail()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $multiple_to_recipients = array(
        'origin-lp@yandex.ru',
        'sale@datexsoft.ru',
        'alekslv74@gmail.com',
    );
    $html = '
    Имя: ~' . $_POST['name'] . '~
    Email: ~' . $_POST['email'] . '~
    Телефон:~' . $_POST['phone'] . '~</p>
    Продукт:~' . $_POST['promouser'] . '~
    IP: ~' . $ip . '~
    URL: ~' . $_SERVER['HTTP_REFERER'] . '~
    Заявка на аренду
    ';
    wp_mail($multiple_to_recipients, 'Заявка с сайта Datexsoft.ru', $html);
    wp_die();
}

/*
 * калькулятор
 */
add_action('wp_ajax_calc', 'my_calc_callback');
add_action('wp_ajax_nopriv_calc', 'my_calc_callback');
function my_calc_callback()
{
    $kol = intval($_POST['kol']);
    $program_name = $_POST['program'];
    $programs = get_field('programs', 'option');
    $response = [];
    foreach ($programs as $program) {
        if ($program['name'] == $program_name) {
            $response['photo'] = $program["photo"];
            if ($kol > 10) {
                $worker_id = $program["times"][1]["worker"];
            } else {
                $worker_id = $program["times"][0]["worker"];
            }
            break;
        }
    }
    if ($worker_id) {
        $response['worker'] = get_field('фамилия_', $worker_id) . ' <span class="text-primary">' . get_field('имя', $worker_id) . '</span>';
        $response['worker_name'] = get_the_title($worker_id);
        $response['worker_photo'] = get_field('фото_для_калькулятора', $worker_id);
        $response['worker_text'] = get_field('текст_для_калькулятора', $worker_id);
    }
    echo json_encode($response);
    wp_die();
}



add_filter('body_class', 'my_class_names');
function my_class_names($classes)
{

    global $post;
    if ($post->ID == 2665) {
        $classes[] = ' rent-page ';
    }

    if (in_array('page-id-969', $classes)) {
        $classes[] = 'prld-on';
    }
    if (is_shop()) {
        $classes[] = 'it_is_shop';
    }
    if (is_cart()) {
        $classes[] = ' body-basket ';
    }
    if (($key = array_search('search-results', $classes)) !== false) {
        unset($classes[$key]);
    }
    return $classes;
}

/*
 * "Хлебные крошки" для WordPress
*/
function dimox_breadcrumbs()
{

    /* === ОПЦИИ === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author'] = 'Статьи автора %s'; // текст для страницы автора
    $text['404'] = 'Ошибка 404'; // текст для страницы 404
    $text['page'] = 'Страница %s'; // текст 'Страница N'
    $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before = '<nav class="breadcrumb about-bread" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after = '</nav><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep = ''; // разделитель между "крошками"
    $before = '<span class="breadcrumb-item active">'; // тег перед текущей "крошкой"
    $after = '</span>'; // тег после текущей "крошки"

    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url = home_url('/');
    $link = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link .= '<a  class="breadcrumb-item"  href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link .= '<meta itemprop="position" content="%3$s" />';
    $link .= '</span>';
    $parent_id = ($post) ? $post->post_parent : '';
    $home_link = sprintf($link, $home_url, $text['home'], 1);

    if (is_home() || is_front_page()) {

        if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ($show_home_link) {
            $position += 1;
            echo $home_link;
        }

        if (is_category()) {
            $parents = get_ancestors(get_query_var('cat'), 'category');
            foreach (array_reverse($parents) as $cat) {
                $position += 1;
                if ($position > 1) echo $sep;
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            if (get_query_var('paged')) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1) echo $sep;
                    echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                } elseif ($show_last_sep) echo $sep;
            }

        } elseif (is_search()) {
            if (get_query_var('paged')) {
                $position += 1;
                if ($show_home_link) echo $sep;
                echo sprintf($link, $home_url . '?s=' . get_search_query(), sprintf($text['search'], get_search_query()), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1) echo $sep;
                    echo $before . sprintf($text['search'], get_search_query()) . $after;
                } elseif ($show_last_sep) echo $sep;
            }

        } elseif (is_year()) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . get_the_time('Y') . $after;
            elseif ($show_home_link && $show_last_sep) echo $sep;

        } elseif (is_month()) {
            if ($show_home_link) echo $sep;
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
            if ($show_current) echo $sep . $before . get_the_time('F') . $after;
            elseif ($show_last_sep) echo $sep;

        } elseif (is_day()) {
            if ($show_home_link) echo $sep;
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
            $position += 1;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), $position);
            if ($show_current) echo $sep . $before . get_the_time('d') . $after;
            elseif ($show_last_sep) echo $sep;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $position += 1;
                $post_type = get_post_type_object(get_post_type());
                if ($position > 1) echo $sep;
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->labels->name, $position);
                if ($show_current) echo $sep . $before . get_the_title() . $after;
                elseif ($show_last_sep) echo $sep;
            } else {
                $cat = get_the_category();
                $catID = $cat[0]->cat_ID;
                $parents = get_ancestors($catID, 'category');
                $parents = array_reverse($parents);
                $parents[] = $catID;
                foreach ($parents as $cat) {
                    $position += 1;
                    if ($position > 1) echo $sep;
                    echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                }
                if (get_query_var('cpage')) {
                    $position += 1;
                    echo $sep . sprintf($link, get_permalink(), get_the_title(), $position);
                    echo $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                } else {
                    if ($show_current) echo $sep . $before . get_the_title() . $after;
                    elseif ($show_last_sep) echo $sep;
                }
            }

        } elseif (is_post_type_archive()) {
            $post_type = get_post_type_object(get_post_type());
            if (get_query_var('paged')) {
                $position += 1;
                if ($position > 1) echo $sep;
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label, $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . $post_type->label . $after;
                elseif ($show_home_link && $show_last_sep) echo $sep;
            }

        } elseif (is_attachment()) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID);
            $catID = $cat[0]->cat_ID;
            $parents = get_ancestors($catID, 'category');
            $parents = array_reverse($parents);
            $parents[] = $catID;
            foreach ($parents as $cat) {
                $position += 1;
                if ($position > 1) echo $sep;
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            $position += 1;
            echo $sep . sprintf($link, get_permalink($parent), $parent->post_title, $position);
            if ($show_current) echo $sep . $before . get_the_title() . $after;
            elseif ($show_last_sep) echo $sep;

        } elseif (is_page() && !$parent_id) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . get_the_title() . $after;
            elseif ($show_home_link && $show_last_sep) echo $sep;

        } elseif (is_page() && $parent_id) {
            $parents = get_post_ancestors(get_the_ID());
            foreach (array_reverse($parents) as $pageID) {
                $position += 1;
                if ($position > 1) echo $sep;
                echo sprintf($link, get_page_link($pageID), get_the_title($pageID), $position);
            }
            if ($show_current) echo $sep . $before . get_the_title() . $after;
            elseif ($show_last_sep) echo $sep;

        } elseif (is_tag()) {
            if (get_query_var('paged')) {
                $position += 1;
                $tagID = get_query_var('tag_id');
                echo $sep . sprintf($link, get_tag_link($tagID), single_tag_title('', false), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                elseif ($show_home_link && $show_last_sep) echo $sep;
            }

        } elseif (is_author()) {
            $author = get_userdata(get_query_var('author'));
            if (get_query_var('paged')) {
                $position += 1;
                echo $sep . sprintf($link, get_author_posts_url($author->ID), sprintf($text['author'], $author->display_name), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
                elseif ($show_home_link && $show_last_sep) echo $sep;
            }

        } elseif (is_404()) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . $text['404'] . $after;
            elseif ($show_last_sep) echo $sep;

        } elseif (has_post_format() && !is_singular()) {
            if ($show_home_link && $show_current) echo $sep;
            echo get_post_format_string(get_post_format());
        }

        echo $wrap_after;

    }
}
// end of dimox_breadcrumbs()

/*
 * filesize
 */
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

/*
 * убираем  рубрика
 */
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    return $title;
});

/*
 * пагинация
 */
if ( !function_exists( 'wpex_pagination' ) ) {
    function wpex_pagination() {
        $prev_arrow = '<svg class="icon icon-pag-prev ">
								  <use xlink:href="/wp-content/themes/datex/img/svg/sprite.svg#pag-prev"></use>
					   </svg>';
        $next_arrow = '<svg class="icon icon-pag-next ">
                           <use xlink:href="/wp-content/themes/datex/img/svg/sprite.svg#pag-next"></use>
                       </svg>';
        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999;
        if( $total > 1 )  {
            if( !$current_page = get_query_var('paged') )
                $current_page = 1;
            if( get_option('permalink_structure') ) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            echo '  <div class="pagination-wrapper">';
            echo paginate_links(array(
                'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'		=> $format,
                'current'		=> max( 1, get_query_var('paged') ),
                'total' 		=> $total,
                'mid_size'		=> 3,
                'type' 			=> 'list',
                'prev_text'		=> $prev_arrow,
                'next_text'		=> $next_arrow,
            ) );
            echo '</div>';
        }
    }
}

// редирект
function rr_404_my_event() {
    global $post;
    if ( isset($_GET['route'])&& ($_GET['route']=="product/category" ||$_GET['route']=='product/product'||$_GET['route']=='account/voucher'||
                                  $_GET['route']=='account/register'||$_GET['route']=='information/information'
                                 ||$_GET['route']=='affiliate/register'||$_GET['route']=='product/manufacturer/info')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
    }
}
add_action( 'wp', 'rr_404_my_event' );

//******************** expert
function kama_excerpt( $args = '' ){
    global $post;
    if( is_string($args) )
        parse_str( $args, $args );
    $rg = (object) array_merge( array(
        'maxchar'   => 75,   // Макс. количество символов.
        'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
        'autop'     => false,  // Заменить переносы строк на <p> и <br> или нет?
        'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
        'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
    ), $args );
    $rg = apply_filters( 'kama_excerpt_args', $rg );
    if( ! $rg->text )
        $rg->text = $post->post_excerpt ?: $post->post_content;
    $text = $rg->text;
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
    $text = trim( $text );
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );
        $text = trim( $mm[1] );
        $text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }
    if( $rg->autop ){
        $text = preg_replace(
            array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }
    $text = apply_filters( 'kama_excerpt', $text, $rg );
    if( isset($text_append) )
        $text .= $text_append;

    return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}