<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<div id="ahmeti_wrap" style="padding:10px">
      <h1 style="font:oblique 30px/30px Georgia,serif; color:grey;background-image: url('<?php echo plugins_url(); ?>/ahmeti-wp-guzel-sozler/images/icon.png');background-repeat: no-repeat;padding: 20px 10px 10px 37px;background-position: 0 0;">Ahmeti WP Güzel Sözler <sup style="font-size: 12px">2.1</sup></h1>

<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>">Söz Listesi</a>
<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=yeni_ekle">Yeni Söz Ekle</a>

&nbsp;&nbsp;

<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=author_list">Yazar Listesi</a>
<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=yeni_author_ekle">Yeni Yazar Ekle</a>

&nbsp;&nbsp;

<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=ayarlar">Ayarlar</a>

&nbsp;&nbsp;

<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=export_page">Sözleri Al</a>
<a style="margin-right:15px;" class="button" href="<?php echo PHP_D_URL; ?>&islem=import_page">Sözleri Yükle</a>