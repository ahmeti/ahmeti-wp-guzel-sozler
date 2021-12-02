<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$authorName = isset($_POST['kisi']) ? $_POST['kisi'] : '';
$authorContent = isset($_POST['author_content']) ? $_POST['author_content'] : '';

if( empty($id) || empty($authorName) ){

    echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

}else{

	$status = ahmeti_wp_db()->update(AHMETI_WP_AUTHORS_TABLE, [
		'author_name' => $authorName,
		'author_slug' => ahmeti_wp_guzel_sozler_sef_link($authorName),
		'author_content' => $authorContent,
	], [
		'author_id' => $id
	]);

    if ( $status ){
        echo '<p class="ahmeti_ok">Yazar başarıyla güncellendi.</p>';
    }else{
        echo '<p class="ahmeti_hata">Yazar güncellenirken hata oluştu.</p>';
    }
}
