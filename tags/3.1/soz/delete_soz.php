<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
// Söz Silme Sayfası

$id=(int)$_GET['id'];
$ahmetiPre=AHMETI_WP_PREFIX;
$sil=mysql_query("DELETE FROM {$ahmetiPre}soz WHERE soz_id=$id");

if ($sil){
    echo '<p class="ahmeti_ok">Söz başarıyla silindi.</p>';
}else{
    echo '<p class="ahmeti_hata">Söz silinirken hata oluştu.</p>';
}
?>
