<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Yazar Listesi</h2>
<?php

$count = (ahmeti_wp_db()->get_row(ahmeti_wp_db()->prepare('SELECT COUNT(author_id) as count FROM '.AHMETI_WP_AUTHORS_TABLE, [])))->count;
$page = isset($_GET['is_page']) && (int)$_GET['is_page'] > 0 ? (int)$_GET['is_page'] : 1;
$start = ($page - 1) * AHMETI_SOZ_LIMIT;

$items = ahmeti_wp_guzel_sozler_authors(
	['author_id', 'author_name', 'author_slug', 'author_content'],
	['author_id', 'DESC'],
	[$start, AHMETI_SOZ_LIMIT]
);

if( count($items) > 0 ){
    ?>
    <table class="admin_soz_table">
        <tr class="tr_baslik">
            <td style="white-space: nowrap">ID</td>
            <td style="white-space: nowrap">Düzenle</td>
            <td style="white-space: nowrap">Sil</td>
            <td>Yazar</td>
        </tr>
        <?php
        foreach ($items as $item){ ?>
        <tr>
            <td><?php echo $item->author_id; ?></td>
            <td>
                <a href="<?php echo PHP_D_URL; ?>&islem=author_guncelle&id=<?php echo $item->author_id; ?>">Düzenle</a>
            </td>
            <td>
                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="<?php echo PHP_D_URL; ?>&islem=delete_author&id=<?php echo $item->author_id; ?>">Sil</a>
            </td>
            <td><?php echo $item->author_name; ?></td>
        </tr>
        <?php } ?>
    </table>

    <?php sayfala(PHP_D_URL, $count, $page, AHMETI_SOZ_LIMIT, '&islem=author_list');

}else{
    echo '<p class="ahmeti_hata">Hiç yazar eklememişsiniz :(</p>';
}