<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_POST)){

    $kisi=mysql_real_escape_string(trim(stripslashes($_POST['kisi'])));
    $author_content=mysql_real_escape_string(trim(stripslashes($_POST['author_content'])));

    if(empty($kisi)){

        echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

    }else{

        $slug_kisi=Sef_Link($kisi);

        $soz_yaz=mysql_query("insert into wp_soz_author (wp_soz_author_name,wp_soz_author_slug,author_content) values ('$kisi','$slug_kisi','$author_content')");

        if ($soz_yaz){
            echo '<p class="ahmeti_ok">Kişi başarıyla eklendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Kişi eklenirken hata oluştu.</p>';
        }                
    }
}
?>