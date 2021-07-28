<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mega
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="viewport"
		content="width=device-width, shrink-to-fit=no, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <link type="image/ico" href="favicon.ico" rel="shortcut icon">

	<?php wp_head(); ?>
</head>
<?php  // $tel = get_field('телефон', 'option');
					// 	$tel_str = str_replace(" ","", $tel);

global $get_template_directory_uri;
//		 ob_start();
$tel = get_field('телефон', 'option');
$tel_str = str_replace(" ","", $tel);
$logo = get_field('logo_copy', 'option');
$logoText = get_field('текст_под_лого', 'option');
$addr = get_field('адрес', 'option');
    ?>
<!-- <body  > -->

<body >

<div class="main-wrapper">
    <!-- start top-nav-->
    <div class="top-nav block-with-lazy">
        <div class="container">
            <div class="top-nav__main-row row align-items-center">
                <div class="top-nav__logo-col col-lg">
                    <div class="top-nav__logo"><img loading="lazy" src="<?php echo $logo?>" alt=""/>
                    </div>
                    <div class="top-nav__txt"><?php echo $addr?></div>
                </div>
                <div class="col col-lg-auto"><a class="top-nav__tel" href="tel:<?php echo $tel_str?>"><?php echo $tel?></a>
                </div>
                <div class="col-auto">
                    <div class="soc-row row">
                        <?php $rows = get_field('месенджеры', 'option' );  if($rows ):    while ( have_rows('месенджеры', 'option') ) : the_row();
                            $index = array_rand( $rows );
                            ?> 
                                <div class="col-auto">
                                    <a class="soc-row__item" href="<?php echo the_sub_field('ссылка', 'option'); ?>" target="_blank"><img loading="lazy" src="<?php echo the_sub_field('иконка', 'option'); ?>" alt=""/></a>
                                </div> 
                        <?php  endwhile;  else :  endif;    ?>

                    </div>
                </div>
                <div class="col-auto"><a class="top-nav__btn link-modal-js" data-fancybox data-src="#modal-call" href="#">Перезвоните мне</a>
                </div>
            </div>
        </div>
    </div>