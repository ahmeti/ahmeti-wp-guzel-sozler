<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<h2>Söz Düzenle</h2>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$quote = ahmeti_wp_db()->get_row(ahmeti_wp_db()->prepare('SELECT * FROM '.AHMETI_WP_QUOTES_TABLE.' WHERE quote_id = %d', [$id]));

?>
<div style="display: block;padding: 0 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>&islem=guncelle_ok" method="post"><!-- onsubmit="return false;" -->
        <h3 style="margin-bottom: 1px;">Söz</h3>
        <textarea id="soz" name="soz" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"><?php echo $quote->quote; ?></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Açıklama</h3>
        <textarea name="aciklama" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"><?php echo $quote->quote_desc; ?></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Yazar</h3>
        <select name="author_id">
            <option value="">Seçiniz...</option>
        <?php
            $authors = ahmeti_wp_guzel_sozler_authors([], ['author_id', 'DESC'], [0, 99999]);
            foreach($authors as $author){
                echo '<option value="'.$author->author_id.'" '.($author->author_id == $quote->quote_author_id ? 'selected' : '').'>'.$author->author_name.'</option>';
            }
        ?>
        </select>
        <br/><br/>
        <input type="submit" value="Sözü Güncelle" class="button" id="gonder_button"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </form>
</div>
