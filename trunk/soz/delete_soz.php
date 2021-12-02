<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

$id = isset($_GET['id']) ? $_GET['id'] : '';

$status = ahmeti_wp_db()->delete(AHMETI_WP_QUOTES_TABLE, [
    'quote_id' => $id
]);

if ( $status ){
    echo '<p class="ahmeti_ok">Söz başarıyla silindi.</p>';
}else{
    echo '<p class="ahmeti_hata">Söz silinirken hata oluştu.</p>';
}