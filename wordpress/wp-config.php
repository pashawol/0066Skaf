<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'scaf' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'pF9*V*|ow ^_Hfh)=+i]9g}9+d`f%/^%s8?n/HH4{ Gk1`l,#[xw]}GA)=+[dq=K' );
define( 'SECURE_AUTH_KEY',  'S3ny`IJ,24V6v[}LPBws[%|7zW_&k!?;mj7+ule#$OWOn[K2YwJ=Bb:M|QwZ[axt' );
define( 'LOGGED_IN_KEY',    'W7{Ino1a$E_5De%1x~aEOGezEpJwmu{Pb7*c3sf4o]/kBa/>-E!uQz^Nf}}_Rh1$' );
define( 'NONCE_KEY',        'YlJdE7kP4MS# LMoR(NNy$99?DU*1fOSSNxt{ow4Xb{Z|AB-xNX`Xs3y25f9X##o' );
define( 'AUTH_SALT',        'okV}8I!*fp{D%7tF0@tSyHl}@-8mBDuP@A]*&Qb24sznaP&0`dYpAYIH5>Z|stH ' );
define( 'SECURE_AUTH_SALT', 'k}-U4Npq[nhho7cgo%Y5lW.gUY/apN1G]#bz7|co0Ef]wCh-ZYcfC%O@-9vQsO|$' );
define( 'LOGGED_IN_SALT',   'n#|4D+T;sKz}k^~wD$,Fl|}6wmN.NE7#[jI.-bn6l:zn-zK:FG2s_j 8/!+Y@O&U' );
define( 'NONCE_SALT',       'CWlV8pwNUp|_6iXXGk6?#(0DI|[t3CP>=SL#flOKT!]ZiHs9NR@6&(e|y:An*y*A' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'scaf_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
