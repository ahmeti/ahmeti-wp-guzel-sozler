<?php
// Söz Silme Sayfası

$id=(int)$_GET['id'];

$soz_varmi=mysql_fetch_object(mysql_query("SELECT COUNT(soz_author_id) as say FROM wp_soz WHERE soz_author_id=$id"));

if ($soz_varmi->say > 0){
    
    echo '<p class="ahmeti_hata">Bu yazara ait söz bulunduğu için silinmedi.</p>';
    
}else{
    $sil=mysql_query("DELETE FROM wp_soz_author WHERE wp_soz_author_id=$id");
    
    if ($sil){
        echo '<p class="ahmeti_ok">Yazar başarıyla silindi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Yazar silinirken hata oluştu.</p>';
    }
}


?>
