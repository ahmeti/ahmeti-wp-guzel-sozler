<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$orderByType = isset($_POST['sirala']) && in_array($_POST['sirala'], ['ASC', 'DESC']) ? $_POST['sirala'] : 'DESC';
$pageLimit = isset($_POST['sayfa_limit']) && $_POST['sayfa_limit'] > 0 && $_POST['sayfa_limit'] < 101 ? $_POST['sayfa_limit'] : 20;
$pageSlug = isset($_POST['page_slug']) && ! empty($_POST['page_slug']) ? $_POST['page_slug'] : 'harika-sozler';

$status = update_option('ahmeti_soz_setting', $orderByType.','.$pageLimit.','.$pageSlug);

if ( $status ){
    echo '<p class="ahmeti_ok">Ayarlar başarıyla güncellendi.</p>';
}else{
	echo '<p class="ahmeti_hata">Ayarlar güncellenirken hata oluştu.</p>';
}