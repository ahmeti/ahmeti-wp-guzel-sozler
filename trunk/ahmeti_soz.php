<?php

/*
    Plugin Name: Ahmeti Wp Güzel Sözler
    Plugin URI: http://ahmeti.net/
    Description: Güzel sözler ekleyip düzenleyebileceğiniz WP eklentisi.
    Author: Ahmet İmamoğlu
    Version: 1.0
    Author URI: http://ahmeti.net/
*/

/*
    Copyright 2012 Ahmet İmamoğlu ( ahmet363@gmail.com )

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


// Veri Tabanı Oluştur...
//
//$wpdb isimli WP'nin veritabanı sınıfına $wpdb->soz olarak tanıtıyoruz
$wpdb->soz = $wpdb->prefix . 'soz';
$wpdb->soz_author = $wpdb->prefix . 'soz_author';
$wpdb->soz_view = 'soz_view';


function ahmeti_soz_kurulum() {
    
    // $wpdb adlı  WP'nin veritabanı sınıfını fonksiyonumuza çağırıyoruz.
    global $wpdb;

    // SQL ifadesi
    $db_sql="CREATE TABLE IF NOT EXISTS `$wpdb->soz` (
    `soz_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `soz_author_id` mediumint(8) unsigned NOT NULL,
    `soz` mediumtext NOT NULL,
    `aciklama` mediumtext,
    PRIMARY KEY (`soz_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
    
    $wpdb->query($db_sql);

    $db_sql="CREATE TABLE IF NOT EXISTS `$wpdb->soz_author` (
      `wp_soz_author_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
      `wp_soz_author_name` varchar(255) NOT NULL,
      `wp_soz_author_slug` varchar(255) NOT NULL,
      `author_content` mediumtext NOT NULL,
      PRIMARY KEY (`wp_soz_author_id`),
      UNIQUE KEY `wp_soz_author_slug` (`wp_soz_author_slug`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

    $wpdb->query($db_sql);

    $db_sql="CREATE VIEW `$wpdb->soz_view` AS select `wp_soz`.`soz_id` AS `soz_id`,
    `wp_soz_author`.`wp_soz_author_id` AS `wp_soz_author_id`,`wp_soz`.`soz` AS `soz`,
    `wp_soz`.`aciklama` AS `aciklama`,`wp_soz_author`.`wp_soz_author_name` AS `wp_soz_author_name`,
    `wp_soz_author`.`wp_soz_author_slug` AS `wp_soz_author_slug`,
    `wp_soz_author`.`author_content` AS `author_content` from 
    (`wp_soz` join `wp_soz_author` on((`wp_soz_author`.`wp_soz_author_id` = `wp_soz`.`soz_author_id`)));";
    
    $wpdb->query($db_sql);
    
    $db_sql="INSERT INTO `wp_soz_author` (`wp_soz_author_id`, `wp_soz_author_name`, `wp_soz_author_slug`, `author_content`) VALUES
    (2, 'Ahmeti', 'ahmeti', '');";
    
    $wpdb->query($db_sql);
    
    $db_sql="INSERT INTO `wp_soz` (`soz_id`, `soz_author_id`, `soz`, `aciklama`) VALUES
    (2, 2, 'Hayata karşı keskin olmayın. Gün gelir \"Hayatta yapmam!\" dedikleriniz alışkanlıklarınıza dönüşür.', 'Bursa sokaklarında yürürken aklıma gelmiş bir söz...'),
    (3, 2, 'Bugün kendime sordum: \"Çalışmak için mi yaşıyorum, yoksa yaşamak için mi çalışıyorum\" diye...', ''),
    (4, 2, 'Günün sonunda kendimize şöyle bir soru sorabiliriz: \"Bugün yaptıklarımızın hayatımıza ne faydası oldu.\"', '');";
  
    // SQL çalıştır
    $wpdb->query($db_sql);

    // Sözleri nerede göstersin?
    add_option('ahmeti_soz_setting', 'ASC,10');

}


if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
    // Eğer kullanıcı "Etkinleştir" bağlantısına tıkladıysa, fonksiyonunu çağır 
    //echo 'Etkinleştirdikten sonra...';
    add_action('init', 'ahmeti_soz_kurulum');
}

/* Kurulum Bitti */



/* Uygulama */

//Admin Panel - Yonetim Paneli Olusturma
add_action('admin_menu', 'yonetime_ekle');

function yonetime_ekle() {
    define('PHP_D_ADI', 'ahmeti_soz');
    define('PHP_D_URL', admin_url().'options-general.php?page=ahmeti_soz/ahmeti_soz.php');
    
    //add_action('wp_head', 'ahmeti_head');
    
    /* Admin Page İçin CSS */
    add_action('admin_head','ahmeti_admin_head'); 
    
    
    add_submenu_page('options-general.php', 'Ahmeti WP Güzel Sözler', 'Ahmeti WP Güzel Sözler', 10, __FILE__, 'ahmeti_index');

}



function ahmeti_admin_head (){
    /* Admin Eklenti Sayfası Style CSS */
    echo '<link rel="stylesheet" href="'.plugins_url().'/ahmeti_soz/style.css" type="text/css" media="all" />';
    echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
    echo '<script type="text/javascript" src="'.plugins_url().'/ahmeti_soz/kontrol.js"></script>';
}


function ahmeti_wp_head (){
    /* Gösterim Eklenti Sayfası Style CSS */
    echo '<link rel="stylesheet" href="'.plugins_url().'/ahmeti_soz/style.css" type="text/css" media="all" />';
}



function ahmeti_index(){
   
    global $wpdb;
    
    /* Ayarları Al */
    $ayar=get_option('ahmeti_soz_setting');
    $ayarlar=explode(',',$ayar);
    define('AHMETI_SIRALAMA',$ayarlar[0]); // Sıralama ASC veya DESC
    define('AHMETI_SOZ_LIMIT',$ayarlar[1]); // Gosterim adeti 5,10,15,20
    
    echo '<div id="ahmeti_wrap" style="padding:10px">
          <h1 style="font:oblique 30px/30px Georgia,serif; color:grey;">Ahmeti WP Güzel Sözler</h1>';
    
    require_once 'header.php';
    
    
    
    
    /*      İ Ş L E M L E R     */
    
    
    if ($_GET['islem']=='yeni_ekle'){
        require_once 'soz/new_soz_form.php';
        
    }elseif ($_POST['islem']=='yeni_ekle_ok'){
        require_once 'soz/new_soz_form_add.php';
        
    }elseif ($_GET['islem']=='yeni_author_ekle'){
        require_once 'author/new_author_form.php';
            
    }elseif ($_POST['islem']=='yeni_author_ekle_ok'){
        require_once 'author/new_author_form_add.php';
        
    }elseif ($_GET['islem'] == 'author_list'){
        require_once 'author/author_list.php';

    }elseif ($_GET['islem']=='author_guncelle'){
        require_once 'author/update_author_form.php';
        
    }elseif ($_POST['islem']=='update_author_form_add'){
        require_once 'author/update_author_form_add.php';
        
    }elseif ($_GET['islem']=='delete_author'){
        require_once 'author/delete_author.php';
        
    }elseif ($_GET['islem']=='guncelle'){
        require_once 'soz/update_soz_form.php';
        
    }elseif ($_POST['islem']=='guncelle_ok'){
        require_once 'soz/update_soz_form_add.php';
        
    }elseif ($_GET['islem']=='sil'){
        require_once 'soz/delete_soz.php';
        
    }elseif($_GET['islem']=='ayarlar'){
        require_once 'settings/settings.php';

        
    }elseif($_POST['islem']=='ayar_kaydet'){
        require_once 'header.php';
        
        if ($_POST['sirala']=="DESC" || $_POST['sirala']=="ASC"){
            if($_POST['sayfa_limit'] > 0 || $_POST['sayfa_limit'] < 101){
                $deger=$_POST['sirala'].','.$_POST['sayfa_limit'];
                $guncelle=mysql_query("UPDATE wp_options SET option_value='$deger' WHERE option_name='ahmeti_soz_setting'");
                
                if ($guncelle){
                    echo '<p class="ahmeti_ok">Ayarlar başarıyla güncellendi.</p>';
                }else{
                    echo '<p class="ahmeti_hata">Ayarlar güncellenirken hata oluştu.</p>';
                }
            }
        }
        
    }else{
        require_once 'soz/soz_list.php';
        
    }
    

    echo '<p style="margin:30px 0 0 0 ;display:block;font:oblique 11px/1em Georgia,serif">Geliştirici: <a target="_blank" href="http://ahmeti.net/">Ahmet İmamoğlu</a></p>';
    echo '</div>'; //wrap_div
   
}

require_once 'function.php';
?>