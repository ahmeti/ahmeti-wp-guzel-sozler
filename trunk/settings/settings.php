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

        <?php /*
        <h3 style="margin-bottom: 1px;">Panel Söz Sıraması</h3>
        <select name="sirala">
            <option value="ASC" <?php if( AHMETI_SIRALAMA=="ASC" ){ echo 'selected="selected"';} ?>>Eskinden Yeniye Doğru</option>
            <option value="DESC" <?php if( AHMETI_SIRALAMA=="DESC" ){ echo 'selected="selected"';} ?>>Yeniden Eskiye Doğru</option>
        </select>
        <br/><br/> */ ?>

        <?php /*
        <h3 style="margin-bottom: 1px;">Panel Söz Sayfalama Limiti</h3>
        <select name="sayfa_limit">
            <option value="5" <?php if( AHMETI_SOZ_LIMIT=="5" ){ echo 'selected="selected"';} ?>>5</option>
            <option value="10"<?php if( AHMETI_SOZ_LIMIT=="10" ){ echo 'selected="selected"';} ?>>10</option>
            <option value="15"<?php if( AHMETI_SOZ_LIMIT=="15" ){ echo 'selected="selected"';} ?>>15</option>
            <option value="20"<?php if( AHMETI_SOZ_LIMIT=="20" ){ echo 'selected="selected"';} ?>>20</option>
            <option value="25"<?php if( AHMETI_SOZ_LIMIT=="25" ){ echo 'selected="selected"';} ?>>25</option>
            <option value="30"<?php if( AHMETI_SOZ_LIMIT=="30" ){ echo 'selected="selected"';} ?>>30</option>
            <option value="40"<?php if( AHMETI_SOZ_LIMIT=="40" ){ echo 'selected="selected"';} ?>>40</option>
            <option value="50"<?php if( AHMETI_SOZ_LIMIT=="50" ){ echo 'selected="selected"';} ?>>50</option>
            <option value="100"<?php if( AHMETI_SOZ_LIMIT=="100" ){ echo 'selected="selected"';} ?>>100</option>
        </select>
        <br/><br/> */ ?>

        <a style="margin-right:15px;" class="button" href="<?php echo admin_url(); ?>plugin-editor.php?file=ahmeti-wp-guzel-sozler%2Fcss%2Fstyle.css&plugin=ahmeti-wp-guzel-sozler%2Fstyle.css">CSS Sitili Düzenle</a>
        <?php /* <input type="submit" value="Ayarları Güncelle" class="button" /> */ ?>

    </form>
</div>

