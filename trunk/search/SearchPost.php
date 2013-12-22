<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Arama Sonuçları</h2>
<?php
$ahmetiPre=AHMETI_WP_PREFIX;
@$search=mysql_real_escape_string($_POST['AhmetiSearch']);

if(empty($search)){
    echo '<div class="ahmeti_hata">Aranacak Birşey girmediniz.</div>';
}else{

    $aramaSql=mysql_query("SELECT * FROM {$ahmetiPre}soz_view WHERE 
        soz LIKE '%{$search}%' 
        OR aciklama LIKE '%{$search}%'
        OR wp_soz_author_name LIKE '%{$search}%'
        OR wp_soz_author_slug LIKE '%{$search}%'
        OR author_content LIKE '%{$search}%' ORDER BY wp_soz_author_name ASC");

    ?>
    <table class="admin_soz_table" style="width: 700px">
        <tr class="tr_baslik">
            <td style="width: 100px;">Yazar</td>
            <td>Söz</td>
            <td style="width: 150px;">Açıklama</td>
            <td style="width: 50px;">Düzenle</td>
            <td style="width: 50px;">Sil</td>
        </tr>
        <?php
        while ($soz=mysql_fetch_object($aramaSql)){
        ?>
        <tr>
            <td><?php echo $soz->wp_soz_author_name; ?></td>
            <td><?php echo $soz->soz; ?></td>
            <td><?php echo $soz->aciklama; ?></td>
            <td>
                <a href="<?php echo PHP_D_URL; ?>&islem=guncelle&id=<?php echo $soz->soz_id; ?>">Düzenle</a>
            </td>
            <td>
                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="<?php echo PHP_D_URL; ?>&islem=sil&id=<?php echo $soz->soz_id; ?>">Sil</a>
            </td>

        </tr>
        <?php
        }

        ?>
    </table>
<?php
}
?>