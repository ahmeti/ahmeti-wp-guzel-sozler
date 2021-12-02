<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<h2>Yeni Söz Ekle</h2>

<div style="display: block;padding: 0 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>&islem=yeni_ekle_ok" method="post"><!-- onsubmit="return false;" -->
        <h3 style="margin-bottom: 1px;">Söz</h3>
        <textarea id="soz" name="soz" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Açıklama</h3>
        <textarea name="aciklama" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Yazar</h3>
        <select name="author_id">
            <option value="">Seçiniz...</option>
        <?php
            $items = ahmeti_wp_guzel_sozler_authors([], ['author_id', 'DESC'], [0, 99999]);
            foreach($items as $item){
            ?>
                <option value="<?php echo $item->author_id; ?>"><?php echo $item->author_name; ?></option>
            <?php
            }
        ?>
        </select>
        <br/><br/>
        <input type="submit" value="Sözü Ekle" class="button" id="gonder_button"/>
    </form>
</div>