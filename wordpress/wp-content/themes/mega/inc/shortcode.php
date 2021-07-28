<?php 


	/*
	* *****************************************************
	*/
	add_shortcode('header', 'header_func');
	function header_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();
	 
		 ?>
        <!-- start headerBlock-->
        <div class="headerBlock section" id="headerBlock">
            <div class="container">
                <div class="headerBlock__row row">
                    <div class="headerBlock__left-col col-lg-6">
                        <div class="headerBlock__slider-wrap">
                            <div class="swiper-container headerBlock-slider-js">
                                <div class="swiper-wrapper">
                                        <?php
                                        $images = get_field('слайдер_01');
                                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                                        $sizeLG = 'large'; // (thumbnail, medium, large, full or custom size)
                                       ?>
                                    <?php foreach( $images as $image_id ): ?>
                                        <div class="swiper-slide">
                                            <a class="headerBlock__img-link" href="<?php echo esc_url($image_id['url']); ?>" data-fancybox="headerBlockGalery">
                                                <img loading="lazy" src="<?php echo esc_url($image_id['sizes']['large']); ?>" alt="<?php echo esc_attr($image_id['alt']); ?>" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-prev">
                                    <svg class="icon icon-arrow-circle-l ">
                                        <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-l"></use>
                                    </svg>
                                </div>
                                <div class="swiper-next">
                                    <svg class="icon icon-arrow-circle-r ">
                                        <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-r"></use>
                                    </svg>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="headerBlock__video"><span>Смотрите видео от нашего эксперта какие у нас есть шкафы и как мы работаем.</span><a class="headerBlock__play" data-fancybox="video-gallery" data-src="<?php echo the_field('видео_01'); ?>" data-fancybox="video"><img loading="lazy" src="<?php echo $get_template_directory_uri ?>/public/img/svg/yellow-play.svg" alt=""/></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl">
                        <?php echo the_field('текст_01'); ?>
                        <div class="headerBlock__v-row row">
        <?php $rows = get_field('список_01' );  if($rows ):    while ( have_rows('список_01') ) : the_row();
        $index = array_rand( $rows );
        ?>
                            <div class="col-4">
                                <div class="headerBlock__v-sub-row row">
                                    <div class="col-sm-auto col-lg-12 col-xl-auto">
                                        <div class="headerBlock__ball"><img loading="lazy" src="<?php echo the_sub_field('иконка'); ?>" alt=""/>
                                        </div>
                                    </div>
                                    <div class="col-sm col-lg-12 col-xl">
                                        <div class="headerBlock__v-txt"><?php echo the_sub_field('текст'); ?></div>
                                    </div>
                                </div>
                            </div>
        <?php  endwhile;  else :  endif;    ?>

                        </div>
                        <div class="text-center text-lg-start"><a class="headerBlock__advise-btn" href="#sForm">Получите советы от эксперта по выбору шкафа прямо сейчас</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end headerBlock-->
			<?php
    return ob_get_clean();

}
	/*
	* *****************************************************
	*/
	add_shortcode('Catalog', 'Catalog_func');
	function Catalog_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();
        $tel = get_field('телефон', 'option');
		 $tel_str = str_replace(" ","", $tel);
		 $logo = get_field('logo', 'option');
		 $logoText = get_field('текст_под_лого', 'option');
		 $addr = get_field('адрес', 'option');
		 $map = get_field('карта', 'option');
		 ?>
        <!-- start sCatalog-->
        <section class="sCatalog sCatalog--js section" id="sCatalog">
            <div class="sCatalog__container container">
                <div class="section-title text-center">
                    <?php echo the_field('заголовок_03'); ?>
                </div>
                <div class="sCatalog__slider-wrap">
                    <div class="swiper-container sCatalog-slider-js">
                        <div class="swiper-wrapper">
        <?php $rows = get_field('товары' );  if($rows ):    while ( have_rows('товары') ) : the_row();
        $index = get_row_index() + 1;
        ?>
                            <div class="swiper-slide">
                                <div class="sCatalog__item">
                                    <a class="sCatalog__img" href="#modal-prod-<?php echo $index; ?>" data-fancybox>
                                        <img loading="lazy" src="<?php echo the_sub_field('изображение'); ?>" alt=""/>
                                    </a>
                                    <div class="sCatalog__title"><?php echo the_sub_field('название'); ?></div>
                                    <div class="sCatalog__btn-cont">
                                        <a class="sCatalog__btn" href="#modal-prod-<?php echo $index; ?>" data-fancybox>Узнать подробнее</a>
                                    </div>
                                </div>
                            </div>
        <?php  endwhile;  else :  endif;    ?>

                        </div>
                    </div>
                    <div class="">
                        <div class="swiper-prev">
                            <svg class="icon icon-arrow-circle-l ">
                                <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-l"></use>
                            </svg>
                        </div>
                        <div class="swiper-next">
                            <svg class="icon icon-arrow-circle-r ">
                                <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-r"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <?php $rows2 = get_field('товары' );  if($rows2 ):    while ( have_rows('товары') ) : the_row();
        $index = get_row_index() + 1;
        ?>
            <div class="modal-win modal-win--lg bg-dark text-center" id="modal-prod-<?php echo $index; ?>" style="display: none">
                <div class="form-wrap">
                    <div class="row">
                        <div class="col-4">
                            <div class="sCatalog__img" >
                                <img loading="lazy" src="<?php echo the_sub_field('изображение'); ?>" alt=""/>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="sCatalog__img"  >
                                <img loading="lazy" src="<?php echo the_sub_field('изображение_2'); ?>" alt=""/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sCatalog__img" >
                                <img loading="lazy" src="<?php echo the_sub_field('изображение_3'); ?>" alt=""/>
                            </div>
                        </div>

                    </div>
                    <div class="sCatalog__title h4 text-white">«Впишите данные! <br> Мы подберем и пришлем Вам лучшие варианты шкафов»</div>
                    <div class="sCatalog__title text-white"><?php echo the_sub_field('название'); ?></div>
                    <div class="sCatalog__title text-white">Цена от <?php echo the_sub_field('цена'); ?> рублей</div>
                    <div class="sForm__inputs">
                    <?php  echo do_shortcode( '[contact-form-7 id="118" title="Форма"]' );?>
                </div>
                <div class="footer__sub-row row align-items-center justify-content-center pb-3">
                        <div class="col-auto"><a class="footer__tel" href="tel:<?php echo $tel_str?>"><?php echo $tel?></a>
                        </div>
                        <div class="col-auto">
                            <div class="soc-row row">
                                <?php $rows = get_field('месенджеры' , 'option' );  if($rows ):    while ( have_rows('месенджеры', 'option' ) ) : the_row();
                                $index = array_rand( $rows );
                                ?>
                                <div class="col-auto">
                                    <div class="col-auto"><a class="soc-row__item" target="_blank" href="<?php echo the_sub_field('ссылка', 'option' ); ?>"><img loading="lazy" src="<?php echo the_sub_field('иконка', 'option' ); ?>" alt=""/></a>
                                    </div>
                                </div>
                                <?php  endwhile;  else :  endif;    ?>
                            </div>
                        </div>
                    </div>
                <div class="sForm__policy">
                    Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с
                    <a href="/wp-content/uploads/2021/07/Politika_shkaffmarket.ru_.pdf" target="_blank">Пользовательским соглашением.</a>
                </div>
            </div>
        </div>
        
        <?php  endwhile;  else :  endif;    ?>
        <!-- end sCatalog-->
   <?php return ob_get_clean();

}

/*
	* *****************************************************
	*/
	add_shortcode('sWhat', 'sWhat_func');
	function sWhat_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();

		 ?>
        <!-- start sWhat-->
        <section class="sWhat section" id="sWhat">
            <div class="container">
                <div class="section-title text-center">
                    <h2><?php echo the_field('заголовок_04'); ?></h2>
                </div>
                <div class="sWhat__box">
                    <?php echo the_field('текст_04'); ?>

                <div class="sWhat__bot text-center">
                    <a class="sWhat__btn link-modal-js" data-fancybox data-src="#modal-call" href="#">Получить бесплатную консультацию</a>
                </div>
            </div>
        </section>
        <!-- end sWhat-->
   <?php return ob_get_clean();

}
/*
	* *****************************************************
	*/
	add_shortcode('video', 'video_func');
	function video_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();

		 ?>
        <!-- start sVideo-->
        <section class="sVideo section" id="sVideo">
            <div class="container">
                <div class="section-title text-center">
                    <?php echo the_field('заголовок_05'); ?>
                </div>
                <div class="sVideo__box">
                    <div class="sVideo__bg-img d-none d-xl-block">
                        <!-- <img loading="lazy" src="<?php // echo $get_template_directory_uri ?>/public/img/@2x/sVideo-cat.png" alt=""/> -->
                    </div><a class="sVideo__video-box" href="<?php echo the_field('видео_05'); ?>" data-fancybox="video"><span class="sVideo__v-img"><img loading="lazy" src="<?php echo $get_template_directory_uri ?>/public/img/@2x/sVideo-bg.jpg" alt=""/></span></a>
                </div>
                <div class="text-center"><a class="sVideo__btn  link-modal-js" data-fancybox data-src="#modal-call" href="#">Подобрать свой идеальный шкаф</a>
                </div>
            </div>
        </section>
        <!-- end sVideo-->
   <?php return ob_get_clean();

}
/*
	* *****************************************************
	*/
	add_shortcode('form', 'form_func');
	function form_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();

		 ?>
        <!-- start sForm-->
        <section class="sForm section" id="sForm">
            <div class="container">
                <div class="section-title d-sm-none text-center">
                    <h2><?php echo the_field('заголовок_06'); ?></h2>
                </div>
                <div class="sForm__row row">
                    <div class="col-lg-6 d-none d-sm-block">
                        <div class="sForm__gray-box">
                            <div class="sForm__g-row row">
                                <div class="col-auto align-self-end">
                                    <div class="sForm__img"><img loading="lazy" src="<?php echo $get_template_directory_uri ?>/public/img/@2x/sForm-man.png" alt=""/>
                                    </div>
                                </div>
                                <div class="col">
                                    <h2 class="sForm__title"><?php echo the_field('заголовок_формы'); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sForm__blue-box text-center">
                            <div class="sForm__white-title">Оставьте свои данные и мы отправим Вам  файл "6 главных советов по выбору шкафа"
                            </div>
                                <div class="sForm__inputs">
                                    <?php  echo do_shortcode( '[contact-form-7 id="118" title="Форма"]' );?>
                                </div>
                            <div class="sForm__policy">
                                Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с
                                <a href="/wp-content/uploads/2021/07/Politika_shkaffmarket.ru_.pdf" target="_blank">Пользовательским соглашением.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end sForm-->
   <?php return ob_get_clean();

}
/*
	* *****************************************************
	*/
	add_shortcode('Conditions', 'Conditions_func');
	function Conditions_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();

		 ?>
        <!-- start sConditions-->
        <section class="sConditions section" id="sConditions">
            <div class="container">
                <div class="section-title text-center">
                    <h2><?php echo the_field('заголовок_07'); ?></h2>
                </div>
                <div class="sConditions__box">
                    <div class="sConditions__row row">
                        <div class="col-md-auto">
                            <div class="sConditions__img"><img loading="lazy" src="<?php echo the_field('изображение_07'); ?>" alt=""/>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="sConditions__items">
                                <?php echo the_field('текст_07'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end sConditions-->
   <?php return ob_get_clean();

}

/*
	* *****************************************************
	*/
	add_shortcode('FeedBack', 'FeedBack_func');
	function FeedBack_func()
	{
		 global $get_template_directory_uri, $delay;
		 ob_start();

		 ?>
        <!-- start sFeedBack-->
        <section class="sFeedBack section" id="sFeedBack">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Отзывы</h2>
                    <p>Мы получили уже более ... отзывов, вот некоторые из них.</p>
                </div>
                <div class="sFeedBack__slider-wrap">
                    <div class="swiper-container sFeedBack-slider-js">
                        <div class="swiper-wrapper">
                            <?php $rows = get_field('отзывы' );  if($rows ):    while ( have_rows('отзывы') ) : the_row();
                            $index = array_rand( $rows );
                            ?>
                                <div class="swiper-slide">
                                    <div class="swiper-slide__text">
                                        
                                        <?php echo the_sub_field('текст_отзыва'); ?>
                                    </div>
                                </div>
                            <?php  endwhile;  else :  endif;    ?>
                        </div>
                        <div class="swiper-prev">
                            <svg class="icon icon-arrow-circle-l ">
                                <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-l"></use>
                            </svg>
                        </div>
                        <div class="swiper-next">
                            <svg class="icon icon-arrow-circle-r ">
                                <use xlink:href="<?php echo $get_template_directory_uri ?>/public/img/svg/sprite.svg#arrow-circle-r"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="text-center"><a class="sFeedBack__btn link-modal-js" data-fancybox data-src="#modal-call" href="#">Хочу так же</a>
                </div>
            </div>
        </section>
        <!-- end sFeedBack-->
   <?php return ob_get_clean();

}


