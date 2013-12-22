<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if ($_POST['sirala']=="DESC" || $_POST['sirala']=="ASC"){
    if($_POST['sayfa_limit'] > 0 || $_POST['sayfa_limit'] < 101){
        $deger=$_POST['sirala'].','.$_POST['sayfa_limit'].','.trim($_POST['sozListSlug']);
        $guncelle=mysql_query("UPDATE wp_options SET option_value='$deger' WHERE option_name='ahmeti_soz_setting'");

        if ($guncelle){
            echo '<p class="ahmeti_ok">Ayarlar başarıyla güncellendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Ayarlar güncellenirken hata oluştu.</p>';
        }
    }
}
?>