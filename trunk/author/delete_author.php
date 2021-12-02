<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

$id = isset($_GET['id']) ? $_GET['id'] : '';

$count = (ahmeti_wp_db()->get_row(ahmeti_wp_db()->prepare('SELECT COUNT(quote_id) as count FROM '.AHMETI_WP_QUOTES_TABLE.' WHERE quote_author_id = %d', [$id])))->count;

if ( $count > 0 ){
    
    echo '<p class="ahmeti_hata">Bu yazara ait söz bulunduğu için silinmedi.</p>';
    
}else{

    $status = ahmeti_wp_db()->delete(AHMETI_WP_AUTHORS_TABLE, [
        'author_id' => $id
    ]);
    
    if ( $status ){
        echo '<p class="ahmeti_ok">Yazar başarıyla silindi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Yazar silinirken hata oluştu.</p>';
    }

}