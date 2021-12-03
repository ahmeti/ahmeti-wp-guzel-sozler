<?php if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<h2>Kullanım 1:</h2>
<p>Yazar listesini hangi sayfada göstermek istiyorsanız; sayfanın, yazının içine <code>[ahmeti_wp_guzel_sozler]</code> eklemeniz yeterlidir.</p>

<h2>Kullanım 2:</h2>
<p>Kişiselleştirin. Değişkenleri parçalara bölerek kullanın...<br/>
Daha sonra sözü, yazarı ve söz açıklamasını istediğiniz yerde gösteriniz.<br/>
Sadece sözü, sadece yazarı veya sadece açıklamayı gösterebilirsiniz.</p>

<h4>Örneğin;</h4>
<p><code>&lt;?php $soz = ahmeti_wp_guzel_sozler_random(); ?&gt;</code> fonksiyonunu kullanarak dönen değerleri değişkene aktarın.</p>
<p><code>&lt;?php echo $soz->quote_id; ?&gt;</code></p>
<p><code>&lt;?php echo $soz->author_id; ?&gt;</code></p>
<p><code>&lt;?php echo $soz->author_name; ?&gt;</code></p>
<p><code>&lt;?php echo $soz->author_slug; ?&gt;</code></p>
<p><code>&lt;?php echo $soz->quote; ?&gt;</code></p>
<p><code>&lt;?php echo $soz->quote_desc; ?&gt;</code></p>

<div style="display: block;padding: 10px 0 10px 0">
    <form id="form_ayarlar" action="<?php echo PHP_D_URL; ?>&islem=ayar_kaydet" method="post">

        <h3 style="margin-bottom: 1px;">Sayfa Benzersiz Adı</h3>
        <input type="text" name="author_page_name" value="<?php echo ahmeti_wp_guzel_sozler_get_option('author_page_name'); ?>" size="60" />
        <br/><br/>

        <a style="margin-right:15px;" class="button" href="<?php echo admin_url(); ?>plugin-editor.php?file=ahmeti-wp-guzel-sozler%2Fcss%2Fstyle.css&plugin=ahmeti-wp-guzel-sozler%2Fstyle.css">CSS Sitili Düzenle</a>
        <input type="submit" value="Ayarları Güncelle" class="button" />

    </form>
</div>

