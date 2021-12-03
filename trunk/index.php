<?php
/*
    Plugin Name: Ahmeti Wp Güzel Sözler
    Plugin URI: https://ahmetimamoglu.com.tr/ahmeti-wp-guzel-sozler-1-0
    Description: Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...
    Author: Ahmet İmamoğlu
    Version: 4.0
    Author URI: http://ahmetimamoglu.com.tr
*/

/*
    Copyright 2012 Ahmet İmamoğlu ( ahmet@ahmeti.net )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

global $wpdb;

define('AHMETI_WP_QUOTES_VERSION', '4.0');
define('AHMETI_KONTROL', true);
define('AHMETI_WP_PREFIX', $wpdb->prefix);
define('AHMETI_WP_AUTHORS_TABLE', $wpdb->prefix.'ahmeti_wp_author');
define('AHMETI_WP_QUOTES_TABLE', $wpdb->prefix.'ahmeti_wp_quote');
define('PHP_D_URL', admin_url().'admin.php?page=ahmeti_wp_guzel_sozler/index.php');

require_once 'AhmetiFunction.php';

if( is_admin() ){

	// ADMIN
	if (
		isset($_GET['action']) &&
		isset($_GET['plugin']) &&
		$_GET['action'] == 'activate' &&
		$_GET['plugin'] == 'ahmeti-wp-guzel-sozler/index.php'
	){
		add_action('activated_plugin', 'ahmeti_wp_guzel_sozler_install');
	}

	add_action('admin_menu', 'ahmeti_wp_guzel_sozler_admin_menu');

}else{

	// USER
	add_shortcode('ahmeti_wp_guzel_sozler', 'ahmeti_wp_guzel_sozler_shortcode');
}

function ahmeti_index(){

	$route = isset($_GET['islem']) ? (string)$_GET['islem'] : '';

	$routes = [
		'soz_list' => 'soz/soz_list.php',
		'yeni_ekle' => 'soz/new_soz_form.php',
		'yeni_ekle_ok' => 'soz/new_soz_form_add.php',
		'guncelle' => 'soz/update_soz_form.php',
		'guncelle_ok' => 'soz/update_soz_form_add.php',
		'sil' => 'soz/delete_soz.php',

		'author_list' => 'author/author_list.php',
		'yeni_author_ekle' => 'author/new_author_form.php',
		'yeni_author_ekle_ok' => 'author/new_author_form_add.php',
		'author_guncelle' => 'author/update_author_form.php',
		'update_author_form_add' => 'author/update_author_form_add.php',
		'delete_author' => 'author/delete_author.php',

		'ayarlar' => 'settings/settings.php',
		'ayar_kaydet' => 'settings/settings_save.php',

		// 'export_page' => 'export/export_page.php',
		// 'export_kaydet' => 'export/export_save.php',

		// 'import_page' => 'import/import_page.php',
		// 'import_kaydet' => 'import/import_save.php',

		'search' => 'search/SearchPost.php',
	];


	echo ahmeti_wp_guzel_sozler_header();

	if( array_key_exists($route, $routes) ){
		require_once $routes[$route];
	}else{
		require_once 'soz/soz_list.php';
	}
    
    echo ahmeti_wp_guzel_sozler_footer();
}