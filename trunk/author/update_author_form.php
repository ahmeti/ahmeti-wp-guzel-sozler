<?php if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<h2>Yazar Düzenle</h2>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$author = ahmeti_wp_db()->get_row(ahmeti_wp_db()->prepare('SELECT * FROM '.AHMETI_WP_AUTHORS_TABLE.' WHERE author_id = %d', [$id]));
?>

<div style="display: block;padding: 0 0 10px 0;width: 700px">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>&islem=update_author_form_add" method="post">
        <h3 style="margin-bottom: 1px;">Yazar Adı</h3>
        <input type="text" name="kisi" size="40" value="<?php echo $author->author_name; ?>"/>
        <br/><br/>
        <?php wp_editor($author->author_content, 'author_content', ['textarea_rows'=> 15 ,'wpautop' => false]); ?>
        <br/><br/>
        <input type="submit" value="Yazarı Güncelle" class="button" id="gonder_button"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </form>
</div>