<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_POST)){

    $soz=mysql_real_escape_string(trim(stripslashes($_POST['soz'])));
    $aciklama=mysql_real_escape_string(trim(stripslashes($_POST['aciklama'])));
    $author_id=(int)$_POST['author_id'];

    if(empty($soz) || empty($author_id)){

        echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

    }else{
        $soz_yaz=mysql_query("insert into wp_soz (soz_author_id,soz,aciklama) values ('$author_id','$soz','$aciklama')");

        if ($soz_yaz){
            echo '<p class="ahmeti_ok">Söz başarıyla eklendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Söz eklenirken hata oluştu.</p>';
        }                
    }
}
?>