<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$authorName = isset($_POST['kisi']) ? $_POST['kisi'] : '';
$authorContent = isset($_POST['author_content']) ? $_POST['author_content'] : '';

if( empty($authorName) ){

    echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

}else{

	$status = ahmeti_wp_db()->insert(AHMETI_WP_AUTHORS_TABLE, [
		'author_name' => $authorName,
		'author_slug' => ahmeti_wp_guzel_sozler_sef_link($authorName),
		'author_content' => $authorContent,
	]);

    if ( $status ){
        echo '<p class="ahmeti_ok">Yazar başarıyla eklendi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Yazar eklenirken hata oluştu.</p>';
    }
}