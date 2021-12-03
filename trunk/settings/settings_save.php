<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$authorPageName = isset($_POST['author_page_name']) && strlen(trim($_POST['author_page_name'])) > 0 ? $_POST['author_page_name'] : 'harika-sozler';

$currrentOptions = [
	'author_page_name' => $authorPageName,
];

$getOptions = get_option('ahmeti_wp_guzel_sozler');

if ( empty($getOptions) ){
	$status = add_option('ahmeti_wp_guzel_sozler', serialize($currrentOptions), '', true);

}elseif( $getOptions !== serialize($currrentOptions) ){
	$status = update_option('ahmeti_wp_guzel_sozler', serialize($currrentOptions), true);

}else{
	$status = true;
}


if ( $status ){
    echo '<p class="ahmeti_ok">Ayarlar başarıyla güncellendi.</p>';
}else{
	echo '<p class="ahmeti_hata">Ayarlar güncellenirken hata oluştu.</p>';
}