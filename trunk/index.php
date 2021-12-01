<?php
/*
    Plugin Name: Ahmeti Wp Güzel Sözler
    Plugin URI: http://ahmeti.net/
    Description: Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...
    Author: Ahmet İmamoğlu
    Version: 3.2
    Author URI: http://ahmeti.net/
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

define('AHMETI_KONTROL', true);
define('AHMETI_WP_PREFIX', $wpdb->prefix);
define('AHMETI_WP_AUTHORS_TABLE', $wpdb->prefix.'ahmeti_wp_author');
define('AHMETI_WP_QUOTES_TABLE', $wpdb->prefix.'ahmeti_wp_quote');
define('PHP_D_URL', admin_url().'admin.php?page=ahmeti_wp_guzel_sozler/index.php');


/* Ayarları Al */
$ayarlar = explode(',', (string)get_option('ahmeti_soz_setting'));
define('AHMETI_SIRALAMA', isset($ayarlar[0]) ? $ayarlar[0] : 'DESC'); // Sıralama ASC veya DESC
define('AHMETI_SOZ_LIMIT', isset($ayarlar[1]) ? $ayarlar[1] : 20); // Gosterim adeti 5,10,15,20
define('AHMETI_SOZ_LIST_SLUG', isset($ayarlar[2]) ? $ayarlar[2] : 'harika-sozler'); // Söz Listesini göstermek için "Page Slug" değeri


require_once 'AhmetiFunction.php';
require_once 'AhmetiFunctionGenel.php';

if ( isset($_GET['activate']) && $_GET['activate'] == 'true' )
{
	add_action("activated_plugin", "ahmeti_soz_kurulum");
}

// Admin Panel - Yonetim Paneli Olusturma
add_action('admin_menu', 'ahmeti_admin_menu');

function ahmeti_index(){
   
    require_once 'header.php';

	// $routes = [];

    
    /*      İ Ş L E M L E R     */
    
    $islem=@$_GET['islem'];
    
    
    /* Söz */
    if ($islem=='soz_list'){
        require_once 'soz/soz_list.php';
        
    }elseif ($islem=='yeni_ekle'){
        require_once 'soz/new_soz_form.php';
        
    }elseif ($islem=='yeni_ekle_ok'){
        require_once 'soz/new_soz_form_add.php';
        
    }elseif ($islem=='guncelle'){
        require_once 'soz/update_soz_form.php';
        
    }elseif ($islem=='guncelle_ok'){
        require_once 'soz/update_soz_form_add.php';
        
    }elseif ($islem=='sil'){
        require_once 'soz/delete_soz.php';        

        
    /* Yazar */
    }elseif ($islem == 'author_list'){
        require_once 'author/author_list.php';
        
    }elseif ($islem=='yeni_author_ekle'){
        require_once 'author/new_author_form.php';
            
    }elseif ($islem=='yeni_author_ekle_ok'){
        require_once 'author/new_author_form_add.php';

    }elseif ($islem=='author_guncelle'){
        require_once 'author/update_author_form.php';
        
    }elseif ($islem=='update_author_form_add'){
        require_once 'author/update_author_form_add.php';
        
    }elseif ($islem=='delete_author'){
        require_once 'author/delete_author.php';

        
    /* Ayarlar */
    }elseif($islem=='ayarlar'){
        require_once 'settings/settings.php';
        
    }elseif($islem=='ayar_kaydet'){
        require_once 'settings/settings_save.php';
        

    /* Export */
    }elseif($islem=='export_page'){
        require_once 'export/export_page.php';
        
    }elseif($islem=='export_kaydet'){
        require_once 'export/export_save.php';
        
        
    /* Import */
    }elseif($islem=='import_page'){
        require_once 'import/import_page.php';
        
    }elseif($islem=='import_kaydet'){
        require_once 'import/import_save.php';
        
     
    /* Arama */
    }elseif($islem=='search'){
        require_once 'search/SearchPost.php';
        
        
    /* Anasyafa */
    }else{
        require_once 'soz/soz_list.php';
    }

    
    require_once 'footer.php';
}