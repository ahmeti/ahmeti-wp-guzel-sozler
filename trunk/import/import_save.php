<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<br/>
<br/>
<?php

if ( empty($_POST['soz_xml']) ){
    
    echo '<p class="ahmeti_hata">Sözler yüklenemedi.</p>';
    
}else{

    mysql_query("DELETE FROM wp_soz_author") or die(mysql_error());
    mysql_query("DELETE FROM wp_soz") or die(mysql_error());
    
    $query=null;
    $xml=simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?>'.$_POST['soz_xml']);
    foreach ($xml->children() as $child){
        
        $child->soz=mysql_real_escape_string(stripcslashes($child->soz));
        $child->aciklama=mysql_real_escape_string(stripcslashes($child->aciklama));
        $child->wp_soz_author_name=mysql_real_escape_string(stripcslashes($child->wp_soz_author_name));
        $child->author_content=mysql_real_escape_string(stripcslashes($child->author_content));
        
        $varmi=mysql_fetch_assoc(mysql_query("SELECT COUNT(wp_soz_author_id) as say FROM wp_soz_author WHERE wp_soz_author_slug='$child->wp_soz_author_slug'")) or die ( mysql_error() );
        
        if ($varmi['say'] < 1){
            mysql_query("INSERT INTO wp_soz_author (wp_soz_author_id,wp_soz_author_name,wp_soz_author_slug,author_content) values ('$child->wp_soz_author_id','$child->wp_soz_author_name','$child->wp_soz_author_slug','$child->author_content')") or die ( mysql_error().' '.exit() );
        }
        
        
        
        mysql_query("INSERT INTO wp_soz (soz_id,soz_author_id,soz,aciklama) values ('$child->soz_id','$child->wp_soz_author_id','$child->soz','$child->aciklama')") or die ( mysql_error() );

        /*mysql_query("INSERT INTO soz_view (soz_id,wp_soz_author_id,soz,aciklama,wp_soz_author_name,wp_soz_author_slug,author_content)
        values ('$child->soz_id','$child->wp_soz_author_id','$child->soz','$child->aciklama','$child->wp_soz_author_name','$child->wp_soz_author_slug','$child->author_content')");*/
    }
    
    
    echo '<p class="ahmeti_ok">Yazarlar ve sözler başarıyla eklendi.</p>';
    
}



 
?>
