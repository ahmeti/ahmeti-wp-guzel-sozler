<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_POST)){


    $id=(int)$_POST['id'];
    $kisi=mysql_real_escape_string(trim(stripslashes($_POST['kisi'])));
    $author_content=mysql_real_escape_string(trim(stripslashes($_POST['author_content'])));

    
    if(empty($kisi) || empty($id)){

        echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

    }else{

        $slug_kisi=Sef_Link($kisi);
        $ahmetiPre=AHMETI_WP_PREFIX;
        $sql=mysql_query("UPDATE wp_soz_author SET {$ahmetiPre}soz_author_name='$kisi',wp_soz_author_slug='$slug_kisi',author_content='$author_content' WHERE wp_soz_author_id=$id") or die(mysql_error());
        

        if ($sql){
            echo '<p class="ahmeti_ok">Kişi başarıyla güncellendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Kişi güncellenirken hata oluştu.</p>';
        }                
    }
}
?>