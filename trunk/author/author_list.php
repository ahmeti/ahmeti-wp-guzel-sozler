<?php

/* Sayfalama İçin */
$page=@$_GET['is_page'];
$page_limit=AHMETI_SOZ_LIMIT;
$soz_listesi_row=mysql_fetch_assoc(mysql_query("SELECT COUNT(wp_soz_author_id) FROM wp_soz_author"));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}
$toplam_sayfa=$soz_listesi_row['COUNT(wp_soz_author_id)'];
$baslangic=($baslangic-1)*$page_limit;
$siralama=AHMETI_SIRALAMA;
$soz_listesi=mysql_query("SELECT wp_soz_author_id,wp_soz_author_name FROM wp_soz_author ORDER BY wp_soz_author_name ASC LIMIT $baslangic,$page_limit");
$say=mysql_fetch_assoc(mysql_query("SELECT COUNT(wp_soz_author_id) FROM wp_soz_author ORDER BY wp_soz_author_name ASC LIMIT $baslangic,$page_limit"));

if($say['COUNT(wp_soz_author_id)'] > 0){
    ?>
    <br/><br/>  
    <table style="width: 700px">
        <tr>
            <td style="padding: 5px;border: 1px solid #ddd;width: 20px;font-weight: bold">ID</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 100px;font-weight: bold">Sahibi</td>
            <td style="padding: 5px;border: 1px solid #ddd;width: 80px;font-weight: bold">Düzenle</td>
        </tr>
        <?php
        while ($soz=mysql_fetch_object($soz_listesi)){
        ?>
        <tr>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz->wp_soz_author_id; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;"><?php echo $soz->wp_soz_author_name; ?></td>
            <td style="padding: 5px;border: 1px solid #ddd;">
                <a href="<?php echo PHP_D_URL; ?>&islem=author_guncelle&id=<?php echo $soz->wp_soz_author_id; ?>"><img src="<?php echo plugins_url().'/ahmeti-wp-guzel-sozler/add.png'; ?>" /></a>
                <a href="<?php echo PHP_D_URL; ?>&islem=delete_author&id=<?php echo $soz->wp_soz_author_id; ?>"><img src="<?php echo plugins_url().'/ahmeti-wp-guzel-sozler/cancel.png'; ?>" /></a>
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
    <p class="ahmeti_hata">Hiç yazar eklememişsiniz...</p>
    <?php
}
?>