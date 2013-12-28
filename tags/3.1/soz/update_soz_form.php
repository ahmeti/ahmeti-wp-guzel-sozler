<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Söz Düzenle</h2>
<?php
// Söz Güncelleme Sayfası

$id=(int)$_GET['id'];
$ahmetiPre=AHMETI_WP_PREFIX;
$row=mysql_fetch_object(mysql_query("SELECT * FROM {$ahmetiPre}soz WHERE soz_id=$id"));

?>
<div style="display: block;padding: 0 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>&islem=guncelle_ok" method="post"><!-- onsubmit="return false;" -->
        <h3 style="margin-bottom: 1px;">Söz</h3>
        <textarea id="soz" name="soz" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"><?php echo $row->soz; ?></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Açıklama</h3>
        <textarea name="aciklama" style="width: 400px;height: 200px;border: 1px solid #ddd;padding: 5px"><?php echo $row->aciklama; ?></textarea>
        <br/><br/>
        <h3 style="margin-bottom: 1px;">Yazar</h3>
        <select name="author_id">
            <option value="">Seçiniz...</option>
        <?php
            $sql_author=mysql_query("SELECT * FROM {$ahmetiPre}soz_author ORDER BY wp_soz_author_name ASC");
            while($row_author=mysql_fetch_object($sql_author)){
            ?>
            <option value="<?php echo $row_author->wp_soz_author_id; ?>" <?php if ($row_author->wp_soz_author_id==$row->soz_author_id) : echo 'selected="selected"'; endif; ?>><?php echo $row_author->wp_soz_author_name; ?></option>
            <?php
            }
        ?>
        </select>
        <br/><br/>
        <input type="submit" value="Sözü Güncelle" class="button" id="gonder_button"/>
        <input type="hidden" name="id" value="<?php echo $row->soz_id; ?>" />
    </form>
</div>
