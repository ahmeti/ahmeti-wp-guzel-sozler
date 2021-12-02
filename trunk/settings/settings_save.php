<?php

if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); }

if ( empty($_POST) ){
	return '';
}

$orderByType = isset($_POST['sirala']) && in_array($_POST['sirala'], ['ASC', 'DESC']) ? $_POST['sirala'] : 'DESC';
$pageLimit = isset($_POST['sayfa_limit']) && $_POST['sayfa_limit'] > 0 && $_POST['sayfa_limit'] < 101 ? $_POST['sayfa_limit'] : 20;

$currrentOption = $orderByType.','.$pageLimit;
$getOption = get_option('ahmeti_soz_setting');

if( $getOption !== $currrentOption ){
	$status = update_option('ahmeti_soz_setting', $orderByType.','.$pageLimit);
}else{
	$status = true;
}

if ( $status ){
    echo '<p class="ahmeti_ok">Ayarlar başarıyla güncellendi.</p>';
}else{
	echo '<p class="ahmeti_hata">Ayarlar güncellenirken hata oluştu.</p>';
}