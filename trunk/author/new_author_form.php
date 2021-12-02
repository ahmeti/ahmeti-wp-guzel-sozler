<?php if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Yazar Ekle</h2>

<div style="width: 700px;display: block;padding: 5px 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>&islem=yeni_author_ekle_ok" method="post">
        <h3 style="margin-bottom: 1px;">Yazar Adı</h3>
        <input type="text" name="kisi" />
        <br/><br/>
        <?php wp_editor('', 'author_content', ['textarea_rows'=> 15 ,'wpautop' => false]);?>
        <br/><br/>
        <input type="submit" value="Yazar Ekle" class="button" id="gonder_button"/>
    </form>
</div>