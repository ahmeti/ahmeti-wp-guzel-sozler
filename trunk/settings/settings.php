<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<h2>Kullanım 1 :</h2>
Sözü nerede göstermek istiyorsanız. 
<pre style="display: inline;"><span style="background-color:#ddd;">&lt;?php echo ahmeti_wp_guzel_sozler(); ?&gt;</span> eklemeniz yeterlidir.</pre>

<br/>

<h2>Kullanım 2 :</h2>
Kişiselleştirin. Değişkenleri parçalara bölerek kullanın...<br/>
Daha sonra sözü, yazarı ve söz açıklamasını istediğiniz yerde gösteriniz.<br/>
Sadece sözü, sadece yazarı veya sadece açıklamayı gösterebilirsiniz.<br/>
<h4>Örneğin :</h4>
<pre style="display: inline;"><span style="background-color:#ddd;">&lt;?php $Ahmeti_Soz=ahmeti_wp_guzel_sozler_ayri(); ?&gt;</span></pre> fonksiyonunu kullanarak dönen değerleri değişkene aktarın.
<pre><span style="background-color:#ddd;">&lt;?php echo $Ahmeti_Soz['Soz']; ?&gt;</span></pre>
<pre><span style="background-color:#ddd;">&lt;?php echo $Ahmeti_Soz['Yazar']; ?&gt;</span></pre>
<pre><span style="background-color:#ddd;">&lt;?php echo $Ahmeti_Soz['Aciklama']; ?&gt;</span></pre>

<div style="display: block;padding: 10px 0 10px 0">
    <form id="form_ayarlar" action="<?php echo PHP_D_URL; ?>&islem=ayar_kaydet" method="post">
    <h2>Kullanım 3 :</h2>
    Eklediğiniz sözlerin tamımını ziyaretçileriniz ile paylaşabilirsiniz.<br/>
    Bunun için ilk önce <pre style="display: inline"><span style="background-color:#ddd;">Wp-Admin -> Sayfalar -> Yeni Sayfa Ekle</span></pre> menüsünden bir sayfa oluşturmalısınız.<br/>
    Sayfanın <pre style="display: inline"><span style="background-color:#ddd;">Yazı Kısa</span></pre> (Sef Link) adını aşağıdaki Sayfa Benzersiz Adı kutusuna yazınız. Örneğin; harika-sozler<br/>
    Daha sonra kullandığınız temanın <pre style="display: inline"><span style="background-color:#ddd;">page.php</span></pre> dosyasının içine <pre style="display: inline"><span style="background-color:#ddd;">&lt;?php the_content(); ?&gt;</span></pre> fonksiyonundan <span style="color: red;font-weight: bold">sonra</span> bu <pre style="display: inline"><span style="background-color:#ddd;">&lt;?php ahmeti_wp_guzel_sozler_in_page(); ?&gt;</span></pre> fonksiyonu ekleyiniz.<br/>
     <h3 style="margin-bottom: 1px;">Sayfa Benzersiz Adı</h3>
        <input type="text" name="sozListSlug" value="<?php echo @AHMETI_SOZ_LIST_SLUG; ?>" size="60"/>
        
        
        
        <div style="margin-bottom: 40px;"></div>
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

