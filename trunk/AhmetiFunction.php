<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
function ahmeti_soz_kurulum()
{
    // $wpdb adlı  WP'nin veritabanı sınıfını fonksiyonumuza çağırıyoruz.
    global $wpdb;

    // Veri Tabanı Oluştur...
    //
    //$wpdb isimli WP'nin veritabanı sınıfına $wpdb->soz olarak tanıtıyoruz
    $wpdb->soz = $wpdb->prefix . 'soz';
    $wpdb->soz_author = $wpdb->prefix . 'soz_author';
    $wpdb->soz_view = 'soz_view';
    
    
    
    /*
     * Tablolar Var Mı? Eğer varsa hiç bir şey yapma...
     */
    $table_list_array=array();
    
    $table_list=mysql_query("SHOW TABLES FROM ".DB_NAME);
    while($row=mysql_fetch_row($table_list)){
        $table_list_array[]=$row[0];
    }


    // wp_soz Tablosu
    if (in_array('wp_soz',$table_list_array)){
        //echo 'wp_soz var';
    }else{
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
    }
    
    
    
    // wp_soz_author Tablosu
    if (in_array('wp_soz_author',$table_list_array)){
        //echo 'wp_soz_author var';
    }else{
        // SQL ifadesi
        $db_sql="CREATE TABLE IF NOT EXISTS `$wpdb->soz_author` (
          `wp_soz_author_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
          `wp_soz_author_name` varchar(255) NOT NULL,
          `wp_soz_author_slug` varchar(255) NOT NULL,
          `author_content` mediumtext NOT NULL,
          PRIMARY KEY (`wp_soz_author_id`),
          UNIQUE KEY `wp_soz_author_slug` (`wp_soz_author_slug`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $wpdb->query($db_sql);
        
        $db_sql="INSERT INTO `wp_soz_author` (`wp_soz_author_id`, `wp_soz_author_name`, `wp_soz_author_slug`, `author_content`) VALUES
        (2, 'Ahmeti', 'ahmeti', '');";

        $wpdb->query($db_sql);
    }
    
    
    
    
    if (in_array('soz_view',$table_list_array)){
        //echo 'soz_view var';
    }else{
        // SQL ifadesi
        $db_sql="CREATE VIEW `$wpdb->soz_view` AS select `wp_soz`.`soz_id` AS `soz_id`,
        `wp_soz_author`.`wp_soz_author_id` AS `wp_soz_author_id`,`wp_soz`.`soz` AS `soz`,
        `wp_soz`.`aciklama` AS `aciklama`,`wp_soz_author`.`wp_soz_author_name` AS `wp_soz_author_name`,
        `wp_soz_author`.`wp_soz_author_slug` AS `wp_soz_author_slug`,
        `wp_soz_author`.`author_content` AS `author_content` from 
        (`wp_soz` join `wp_soz_author` on((`wp_soz_author`.`wp_soz_author_id` = `wp_soz`.`soz_author_id`)));";
        $wpdb->query($db_sql);   
        
        $db_sql="INSERT INTO `wp_soz` (`soz_id`, `soz_author_id`, `soz`, `aciklama`) VALUES
        (2, 2, 'Hayata karşı keskin olmayın. Gün gelir \"Hayatta yapmam!\" dedikleriniz alışkanlıklarınıza dönüşür.', 'Bursa sokaklarında yürürken aklıma gelmiş bir söz...'),
        (3, 2, 'Bugün kendime sordum: \"Çalışmak için mi yaşıyorum, yoksa yaşamak için mi çalışıyorum\" diye...', ''),
        (4, 2, 'Günün sonunda kendimize şöyle bir soru sorabiliriz: \"Bugün yaptıklarımızın hayatımıza ne faydası oldu.\"', '');";
        $wpdb->query($db_sql);
    }


    // Ayar Meta Var mı?
    if (get_option('ahmeti_soz_setting') == false ){
        add_option('ahmeti_soz_setting', 'ASC,10');
    }
    
}



function ahmeti_admin_head()
{
    /* Wp Admin Head */
    echo '<link rel="stylesheet" href="'.plugins_url().'/ahmeti-wp-guzel-sozler/css/style.css" type="text/css" media="all" />';
    //echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
    echo '<script type="text/javascript" src="'.plugins_url().'/ahmeti-wp-guzel-sozler/js/kontrol.js"></script>';
}



function ahmeti_wp_head()
{
    /* Wp Head */
    echo '<link rel="stylesheet" href="'.plugins_url().'/ahmeti-wp-guzel-sozler/css/style.css" type="text/css" media="all" />';
}



function ahmeti_admin_menu()
{
    /* Admin Menü */
    add_action('admin_head','ahmeti_admin_head'); 
    add_menu_page( 'Ahmeti Wp Güzel Sözler', 'Söz Arşivi', '5', 'ahmeti_wp_guzel_sozler/index.php', 'ahmeti_index', plugins_url('ahmeti-wp-guzel-sozler/images/ahmeti-icon.png'), 9 );
}



function ahmeti_wp_guzel_sozler()
{
    $row=mysql_fetch_assoc(mysql_query("SELECT soz,aciklama,wp_soz_author_name,wp_soz_author_slug FROM soz_view ORDER BY RAND() LIMIT 0,1"));

    $AhmetiSoz=htmlspecialchars(strip_tags($row['soz']), ENT_QUOTES, 'UTF-8');
    $AhmetiYazar=htmlspecialchars(strip_tags($row['wp_soz_author_name']), ENT_QUOTES, 'UTF-8');
    $AhmetiAciklama=htmlspecialchars(strip_tags($row['aciklama']), ENT_QUOTES, 'UTF-8');
    
    $soz='<div class="gunun_sozu" style="padding: 45px 0 15px 235px;width: 490px;font-size: 15px;letter-spacing: 0.5px;display: block;line-height: 2em; font:oblique 15px/2em Georgia,serif;">';
    $soz .='<span style="font-size: 40px;font-weight: bold;float:left;">&ldquo;</span>';
    $soz .='<p id="soz_soz" style="text-indent:20px;line-height: 2em;margin-top:10px">'.$AhmetiSoz;

    if ($row['aciklama']==''){
    }else{
        $soz .='<span id="soz_aciklama" style="display:block;font-size:11px;">'.$AhmetiAciklama.'</span>';
    }

    $soz .='</p>';
    $soz .='<p id="soz_sahibi" style="margin-top: 5px;text-align: right;"><a style="color: #B96400;"href="#">'.$AhmetiYazar.'</a></p>';
    $soz.='</div>';
    return $soz;
}



function ahmeti_wp_guzel_sozler_ayri()
{
    $row=mysql_fetch_assoc(mysql_query("SELECT soz,aciklama,wp_soz_author_name,wp_soz_author_slug FROM soz_view ORDER BY RAND() LIMIT 0,1"));

    $AhmetiSoz=htmlspecialchars(strip_tags($row['soz']), ENT_QUOTES, 'UTF-8');
    $AhmetiYazar=htmlspecialchars(strip_tags($row['wp_soz_author_name']), ENT_QUOTES, 'UTF-8');
    $AhmetiAciklama=htmlspecialchars(strip_tags($row['aciklama']), ENT_QUOTES, 'UTF-8');

    $dondur=array('Soz'=>$AhmetiSoz,'Yazar'=>$AhmetiYazar,'Aciklama'=>$AhmetiAciklama);
    
    return $dondur;
}



?>
