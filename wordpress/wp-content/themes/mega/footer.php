<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mega
 */
global $get_template_directory_uri;
//		 ob_start();
		 $tel = get_field('телефон', 'option');
		 $tel_str = str_replace(" ","", $tel);
		 $logo = get_field('logo', 'option');
		 $logoText = get_field('текст_под_лого', 'option');
		 $addr = get_field('адрес', 'option');
		 $map = get_field('карта', 'option');
?>
    <div class="sMap" id="sMap">
        <div class="sMap__map"><?php echo $map?></div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer__row row gy-3">
                <div class="col"><a class="footer__logo" href="/"><img loading="lazy" src="<?php echo $logo?>" alt=""/></a>
                    <div class="footer__logo-txt"><?php echo $logoText?></div>
                    <div class="footer__location">
                        <div class="footer__l-row row">
                            <div class="footer__l-icon-col col-auto">
                                <svg class="icon icon-location ">
                                    <use xlink:href="<?php echo $get_template_directory_uri?>/public/img/svg/sprite.svg#location"></use>
                                </svg>
                            </div>
                            <div class="col">
                                <div class="footer__loc-txt"><?php echo $addr?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="footer__sub-row row align-items-center gy-3">
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
                        <div class="col-auto">
                            <a class="footer__btn link-modal-js" data-fancybox data-src="#modal-call" href="#">Перезвоните мне</a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <p>Информация на сайте предназначена только для совершеннолетних (18+)
Данный интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой статьями 437 ГК РФ.
</p>
        </div>
    </footer>
    </div>
    <!--  start modals-->
    <div class="modal-win bg-dark text-center" id="modal-call" style="display: none">
        <div class="form-wrap">
            <div class="sForm__white-title h2">Оставьте заявку
            </div>
            <div class="sForm__inputs">
                <?php  echo do_shortcode( '[contact-form-7 id="118" title="Форма"]' );?>
            </div>
            <div class="sForm__policy">
                Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с
                <a href="/wp-content/uploads/2021/07/Politika_shkaffmarket.ru_.pdf" target="_blank">Пользовательским соглашением.</a>
        </div>
    </div>
    <div class="modal-win bg-dark text-center" id="modal-thanks" style="display: none">
        <div class="form-wrap">
            <div class="sForm__white-title h2">Спасибо за Вашу заявку! </div>
            <p class="text-white">Мы свяжемся с Вами в <br>  ближайшее время!</p> 
        </div>
    </div>

<?php wp_footer(); ?>
 
</body>
</html>
