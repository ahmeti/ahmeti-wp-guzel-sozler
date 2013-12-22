<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Yazar Listesi</h2>
<?php

/* Sayfalama İçin */
$page=@$_GET['is_page'];
$page_limit=AHMETI_SOZ_LIMIT;
$ahmetiPre=AHMETI_WP_PREFIX;
$soz_listesi_row=mysql_fetch_assoc(mysql_query("SELECT COUNT(wp_soz_author_id) FROM {$ahmetiPre}soz_author"));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}
$toplam_sayfa=$soz_listesi_row['COUNT(wp_soz_author_id)'];
$baslangic=($baslangic-1)*$page_limit;
$siralama=AHMETI_SIRALAMA;

$soz_listesi=mysql_query("SELECT wp_soz_author_id,wp_soz_author_name FROM {$ahmetiPre}soz_author ORDER BY wp_soz_author_name ASC LIMIT $baslangic,$page_limit");


if($toplam_sayfa > 0){
    ?>
    <table class="admin_soz_table">
        <tr class="tr_baslik">
            <td style="width: 50px;">ID</td>
            <td style="width: 250px;">Yazar</td>
            <td style="width: 80px;">Düzenle</td>
            <td style="width: 80px;">Sil</td>
        </tr>
        <?php
        while ($soz=mysql_fetch_object($soz_listesi)){
        ?>
        <tr>
            <td><?php echo $soz->wp_soz_author_id; ?></td>
            <td><?php echo $soz->wp_soz_author_name; ?></td>
            <td>
                <a href="<?php echo PHP_D_URL; ?>&islem=author_guncelle&id=<?php echo $soz->wp_soz_author_id; ?>">Düzenle</a>
            </td>
            <td>
                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="<?php echo PHP_D_URL; ?>&islem=delete_author&id=<?php echo $soz->wp_soz_author_id; ?>">Sil</a>
            </td>
            
        </tr>
        <?php
        }

        ?>
    </table>

    <?php            

        sayfala(PHP_D_URL,$toplam_sayfa,$page,$page_limit,'&islem=author_list');
        

}else{
    // Söz yok ise uyarı mesajı ver.
    ?>
    <p class="ahmeti_hata">Hiç yazar eklememişsiniz :(</p>
    <?php
}
?>