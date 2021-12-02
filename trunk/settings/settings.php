<?php if( ! defined('AHMETI_KONTROL') ){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<h2>Kullanım 1:</h2>
<p>Sözü nerede göstermek istiyorsanız;<code>&lt;?php echo ahmeti_wp_guzel_sozler(); ?&gt;</code> eklemeniz yeterlidir.</p>

<h2>Kullanım 2:</h2>
<p>Kişiselleştirin. Değişkenleri parçalara bölerek kullanın...<br/>
Daha sonra sözü, yazarı ve söz açıklamasını istediğiniz yerde gösteriniz.<br/>
Sadece sözü, sadece yazarı veya sadece açıklamayı gösterebilirsiniz.</p>

<h4>Örneğin;</h4>
<p><code>&lt;?php $ahmetiSoz = ahmeti_wp_guzel_sozler_ayri(); ?&gt;</code> fonksiyonunu kullanarak dönen değerleri değişkene aktarın.</p>
<p><code>&lt;?php echo $ahmetiSoz['Soz']; ?&gt;</code></p>
<p><code>&lt;?php echo $ahmetiSoz['Yazar']; ?&gt;</code></p>
<p><code>&lt;?php echo $ahmetiSoz['Aciklama']; ?&gt;</code></p>

<h2>Kullanım 3:</h2>
<p>Eklediğiniz sözlerin tamımını ziyaretçileriniz ile paylaşabilirsiniz.</p>

<p>Bunun için ilk önce <code>Wp-Admin -> Sayfalar -> Yeni Sayfa Ekle</code> menüsünden bir sayfa oluşturmalısınız.</p>
<p>Sayfanın <code>sef link</code> adını aşağıdaki Sayfa Benzersiz Adı kutusuna yazınız. Örneğin; harika-sozler</p>
<p>Daha sonra kullandığınız temanın <code>page.php</code> dosyasının içine <code>&lt;?php the_content(); ?&gt;</code> fonksiyonundan önce <code>&lt;?php ahmeti_wp_guzel_sozler_in_page(); ?&gt;</code> fonksiyonu ekleyiniz.</p>


<div style="display: block;padding: 10px 0 10px 0">
    <form id="form_ayarlar" action="<?php echo PHP_D_URL; ?>&islem=ayar_kaydet" method="post">

        <h3 style="margin-bottom: 1px;">Sayfa Benzersiz Adı</h3>
        <input type="text" name="page_slug" value="<?php echo AHMETI_SOZ_LIST_SLUG; ?>" size="60" />
        <br/><br/>

        <h3 style="margin-bottom: 1px;">Panel Söz Sıraması</h3>
        <select name="sirala">
            <option value="ASC" <?php if( AHMETI_SIRALAMA=="ASC" ){ echo 'selected="selected"';} ?>>Eskinden Yeniye Doğru</option>
            <option value="DESC" <?php if( AHMETI_SIRALAMA=="DESC" ){ echo 'selected="selected"';} ?>>Yeniden Eskiye Doğru</option>
        </select>
        <br/><br/>

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
        <br/><br/>

        <a style="margin-right:15px;" class="button" href="<?php echo admin_url(); ?>plugin-editor.php?file=ahmeti-wp-guzel-sozler%2Fcss%2Fstyle.css&plugin=ahmeti-wp-guzel-sozler%2Fstyle.css">CSS Sitili Düzenle</a>
        <input type="submit" value="Ayarları Güncelle" class="button" />

    </form>
</div>

