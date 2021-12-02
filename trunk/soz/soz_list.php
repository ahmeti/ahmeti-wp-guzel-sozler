<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Söz Listesi</h2>
<?php
$count = (ahmeti_wp_db()->get_row(ahmeti_wp_db()->prepare('SELECT COUNT(quote_id) as count FROM '.AHMETI_WP_QUOTES_TABLE, [])))->count;
$page = isset($_GET['is_page']) && (int)$_GET['is_page'] > 0 ? (int)$_GET['is_page'] : 1;
$start = ($page - 1) * AHMETI_SOZ_LIMIT;

$items = ahmeti_wp_guzel_sozler_quotes(
    ['quote_id', 'author_name', 'quote', 'quote_desc'],
    ['quote_id', 'DESC'],
    [$start, AHMETI_SOZ_LIMIT]
);

if( count($items) > 0 ){
    ?>
    <table class="admin_soz_table">
        <tr class="tr_baslik">
            <td>ID</td>
            <td>Düzenle</td>
            <td>Sil</td>
            <td style="width: 140px;">Yazar</td>
            <td>Söz</td>
            <td style="width: 140px">Açıklama</td>
        </tr>
        <?php
        foreach ($items as $item){
        ?>
        <tr>
            <td><?php echo $item->quote_id; ?></td>
            <td>
                <a href="<?php echo PHP_D_URL; ?>&islem=guncelle&id=<?php echo $item->quote_id; ?>">Düzenle</a>
            </td>
            <td>
                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="<?php echo PHP_D_URL; ?>&islem=sil&id=<?php echo $item->quote_id; ?>">Sil</a>
            </td>
            <td><?php echo $item->author_name; ?></td>
            <td><?php echo $item->quote; ?></td>
            <td><?php echo $item->quote_desc; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <?php            

        sayfala(PHP_D_URL, $count, $page, AHMETI_SOZ_LIMIT, '');

}else{
    // Söz yok ise uyarı mesajı ver.
    ?>
    <p class="ahmeti_hata">Hiç söz eklememişsiniz :(</p>
    <?php
}