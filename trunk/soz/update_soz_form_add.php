<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
    return '';
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$quote = isset($_POST['soz']) ? $_POST['soz'] : '';
$quoteDesc = isset($_POST['aciklama']) ? $_POST['aciklama'] : '';
$authorId = isset($_POST['author_id']) ? $_POST['author_id'] : '';


if( empty($id) || empty($quote) || empty($authorId)){

    echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

}else{

    global $wpdb;
    $status = $wpdb->update(AHMETI_WP_QUOTES_TABLE, [
        'quote_author_id' => $authorId,
        'quote' => $quote,
        'quote_desc' => $quoteDesc,
    ], [
        'quote_id' => $id
    ]);

    if ( $status ){
        echo '<p class="ahmeti_ok">Söz başarıyla güncellendi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Söz güncellenirken hata oluştu.</p>';
    }
}