<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Söz Listesi</h2>
<?php

/* Sayfalama İçin */
$page=@$_GET['is_page'];
$page_limit=AHMETI_SOZ_LIMIT;
$ahmetiPre=AHMETI_WP_PREFIX;
$soz_listesi_row=mysql_fetch_assoc(mysql_query("SELECT COUNT(soz_id) FROM {$ahmetiPre}soz_view"));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}

$toplam_sayfa=$soz_listesi_row['COUNT(soz_id)'];
$baslangic=($baslangic-1)*$page_limit;

$siralama=AHMETI_SIRALAMA;

$soz_listesi=mysql_query("SELECT * FROM {$ahmetiPre}soz_view ORDER BY soz_id $siralama LIMIT $baslangic,$page_limit");

if($toplam_sayfa > 0){
    ?>
    <table style="width: 700px" class="admin_soz_table">
        <tr class="tr_baslik">
            <td style="width: 50px;">ID</td>
            <td style="width: 100px;">Yazar</td>
            <td style="width: 400px;">Söz</td>
            <td style="width: 190px">Açıklama</td>
            <td style="width: 80px;">Düzenle</td>
            <td style="width: 80px;">Sil</td>
        </tr>
        <?php
        while ($soz=mysql_fetch_assoc($soz_listesi)){
        ?>
        <tr>
            <td><?php echo $soz['soz_id']; ?></td>
            <td><?php echo $soz['wp_soz_author_name']; ?></td>
            <td><?php echo $soz['soz']; ?></td>
            <td><?php echo $soz['aciklama']; ?></td>
            <td>
                <a href="<?php echo PHP_D_URL; ?>&islem=guncelle&id=<?php echo $soz['soz_id']; ?>">Düzenle</a>
            </td>
            <td>
                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="<?php echo PHP_D_URL; ?>&islem=sil&id=<?php echo $soz['soz_id']; ?>">Sil</a>
            </td>
            
        </tr>
        <?php
        }

        ?>
    </table>

    <?php            

        
        sayfala(PHP_D_URL,$toplam_sayfa,$page,$page_limit,'');

}else{
    // Söz yok ise uyarı mesajı ver.
    ?>
    <p class="ahmeti_hata">Hiç söz eklememişsiniz :(</p>
    <?php
}
?>