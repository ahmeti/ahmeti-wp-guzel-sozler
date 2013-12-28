<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<br>
<br>

<h2>Sözleri Bilgisayarınıza Kaydedin...</h2>
<p>Aşağıdaki kodları bir metin dosyasına kaydedebilirsiniz...</p>
<?php
 //@set_time_limit(0);

$xml_data ='<root>';

$sql=mysql_query("SELECT * FROM soz_view");
while($row=mysql_fetch_assoc($sql)){
    $xml_data.='<Item>';
        $xml_data.='<soz_id>'.$row['soz_id'].'</soz_id>';
        $xml_data.='<wp_soz_author_id>'.$row['wp_soz_author_id'].'</wp_soz_author_id>';
        $xml_data.='<soz>'.$row['soz'].'</soz>';
        $xml_data.='<aciklama>'.$row['aciklama'].'</aciklama>';
        $xml_data.='<wp_soz_author_name>'.$row['wp_soz_author_name'].'</wp_soz_author_name>';
        $xml_data.='<wp_soz_author_slug>'.$row['wp_soz_author_slug'].'</wp_soz_author_slug>';
        $xml_data.='<author_content>'.$row['author_content'].'</author_content>';
        
    $xml_data.='</Item>';
}
$xml_data.='</root>';
?>
<br/>
<textarea id="export_soz" style="width: 700px;height: 500px;" onClick="SelectAll('export_soz');">
<?php echo htmlspecialchars($xml_data); ?>
</textarea>
