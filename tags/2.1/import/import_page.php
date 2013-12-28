<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<br>
<br>
<h2>Kaydettiğiniz sözleri yükleyin...</h2>
<p>&quot;Sözleri Al&quot; sayfasından aldığını kodları yapıştırın...</p>
<p style="font-weight: bold;color: red">Dikkat: Önce veritabanındaki tüm sözler silinecek daha sonra sizin kodlarınızdaki sözler eklenecektir.</p>
<form action="<?php echo PHP_D_URL; ?>&islem=import_kaydet" method="post">
    <textarea name="soz_xml" style="width: 700px;height: 500px;" ></textarea>
    <br/>
    <br/>
    <input type="submit" class="button" value="Sözleri Yükle" />
</form>

