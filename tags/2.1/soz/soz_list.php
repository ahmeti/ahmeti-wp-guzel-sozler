<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<br/><br/>
<h2>Söz Listesi</h2>
<?php

/* Sayfalama İçin */
$page=@$_GET['is_page'];
$page_limit=AHMETI_SOZ_LIMIT;

$soz_listesi_row=mysql_fetch_assoc(mysql_query("SELECT COUNT(soz_id) FROM wp_soz"));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}

$toplam_sayfa=$soz_listesi_row['COUNT(soz_id)'];
$baslangic=($baslangic-1)*$page_limit;

$siralama=AHMETI_SIRALAMA;
$soz_listesi=mysql_query("SELECT * FROM soz_view ORDER BY soz_id $siralama LIMIT $baslangic,$page_limit");

if($toplam_sayfa > 0){
    ?>
    <table style="width: 700px">
        <tr>
            <td style="padding: 5px;border: 1px solid #ddd;width: 20px;font-weight: bold">ID</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 100px;font-weight: bold">Sahibi</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 400px;font-weight: bold">Söz</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 190px;font-weight: bold">Açıklama</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 80px;font-weight: bold">Düzenle / Sil</td>
        </tr>
        <?php
        while ($soz=mysql_fetch_assoc($soz_listesi)){
        ?>
        <tr>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz['soz_id']; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz['wp_soz_author_name']; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz['soz']; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz['aciklama']; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;">
                <a href="<?php echo PHP_D_URL; ?>&islem=guncelle&id=<?php echo $soz['soz_id']; ?>"><img src="<?php echo plugins_url().'/ahmeti-wp-guzel-sozler/images/add.png'; ?>" /></a>
                <a href="<?php echo PHP_D_URL; ?>&islem=sil&id=<?php echo $soz['soz_id']; ?>"><img src="<?php echo plugins_url().'/ahmeti-wp-guzel-sozler/images/cancel.png'; ?>" /></a>
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