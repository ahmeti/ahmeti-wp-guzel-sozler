<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<div id="ahmeti_wrap" style="padding:10px">

    <div style="overflow: hidden">
        <div style="float: left">
            <h1 style="font:oblique 30px/30px Georgia,serif; color:grey;background-image: url('<?php echo plugins_url(); ?>/ahmeti-wp-guzel-sozler/images/icon.png');background-repeat: no-repeat;padding: 20px 10px 10px 37px;background-position: 0 0;">Ahmeti WP Güzel Sözler <sup style="font-size: 12px">3.1</sup></h1>            
        </div>
        
        <div style="float: left">
            <form action="<?php echo PHP_D_URL; ?>&islem=search" method="post" style="margin-left: 58px;margin-top: 43px;">
                <!--<span>Arama:</span>-->
                <input type="text" name="AhmetiSearch" size="40"/>
                <input type="submit" value="&nbsp;&nbsp;Ara&nbsp;&nbsp;" /><br/>
                <span style="font-size: 10px;color: #0066CC">[?] Yazar / Söz / Açıklama arayabalirsiniz.</span>
            </form>
        </div>
    </div>
    


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

    <div style="margin-top: 15px;clear: both;padding:5px;">
        
    </div>