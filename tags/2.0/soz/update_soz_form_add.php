<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
// Güncelle ok

$id=mysql_real_escape_string($_POST['id']);
$soz=mysql_real_escape_string(trim(stripslashes($_POST['soz'])));
$aciklama=mysql_real_escape_string(trim(stripslashes($_POST['aciklama'])));
$author_id=(int)$_POST['author_id'];

if(empty($soz) || empty($author_id)){

    echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

}else{

    $sql=mysql_query("UPDATE wp_soz SET soz='$soz',aciklama='$aciklama',soz_author_id='$author_id' WHERE soz_id=$id");

    if ($sql){
        echo '<p class="ahmeti_ok">Söz başarıyla güncellendi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Söz güncellenirken hata oluştu.</p>';
    }
}
?>
