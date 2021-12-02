<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$quote = isset($_POST['soz']) ? $_POST['soz'] : '';
$quoteDesc = isset($_POST['aciklama']) ? $_POST['aciklama'] : '';
$authorId = isset($_POST['author_id']) ? $_POST['author_id'] : '';

if( empty($quote) || empty($authorId) ){

    echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

}else{

    $status = ahmeti_wp_db()->insert(AHMETI_WP_QUOTES_TABLE, [
	    'quote_author_id' => $authorId,
	    'quote' => $quote,
	    'quote_desc' => $quoteDesc,
    ]);

    if ( $status ){
        echo '<p class="ahmeti_ok">Söz başarıyla eklendi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Söz eklenirken hata oluştu.</p>';
    }
}
