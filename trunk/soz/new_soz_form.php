<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<br/><br/>
<h2>Yeni Söz Ekle</h2>
<div style="display: block;padding: 0 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>" method="post"><!-- onsubmit="return false;" -->
        <h3 style="margin-bottom: 1px;">Söz</h3>
        <textarea id="soz" name="soz" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Açıklama</h3>
        <textarea name="aciklama" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Sahibi</h3>
        <select name="author_id">
            <option value="">Seçiniz...</option>
        <?php
            $sql_author=mysql_query("SELECT * FROM wp_soz_author ORDER BY wp_soz_author_name ASC");
            while($row_author=mysql_fetch_object($sql_author)){
            ?>
                <option value="<?php echo $row_author->wp_soz_author_id; ?>"><?php echo $row_author->wp_soz_author_name; ?></option>
            <?php
            }
        ?>
        </select>

        <br/><br/>
        <input type="submit" value="Sözü Ekle" class="button" id="gonder_button"/>
        <input type="hidden" name="islem" value="yeni_ekle_ok" />
    </form>
</div>