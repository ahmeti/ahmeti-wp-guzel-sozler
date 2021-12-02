=== Ahmeti Wp Güzel Sözler ===
Contributors: ahmeti
Tags: harika sözler, güzel sözler, söz arşivi, quotes, author
Requires at least: 3.3
Tested up to: 5.8.2
Stable tag: 5.8.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 5.4

Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...

== Description ==

Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...

Güzel sözler arşivi oluşturmak istiyorsanız sizin için biçilmiş kaftan :)

Tüm yazarların listesini göstermek için; Wordpress'te standart bir yazı veya sayfa oluşturun. içeriğine aşağıdaki kısa kodu yazınız.

`[ahmeti_wp_guzel_sozler]`

Aşağıdaki kodu rastgele bir sözü nerede kullanmak isterseniz ekleyiniz. Sayfa yenilendiğinde söz de değişecektir.

`<php ahmeti_wp_guzel_sozler_random(true); ?>`

Kişiselleştirin ve değişkenleri parçalara bölerek kullanın...

`<?php

    $soz = ahmeti_wp_guzel_sozler_random();

    echo $soz->quote_id;
    echo $soz->author_id;
    echo $soz->author_name;
    echo $soz->author_slug;
    echo $soz->quote;
    echo $soz->quote_desc;

?>`

[Detaylar için Yükleme Sayfasına Bakın](http://wordpress.org/plugins/ahmeti-wp-guzel-sozler/installation/)

[İlgili Yazıyı Takip Edin](https://ahmetimamoglu.com.tr/ahmeti-wp-guzel-sozler-1-0)

== Installation ==

1. `/wp-content/plugins/` klasörünün içerisine .zip dosyasından çıkan "ahmeti-wp-guzel-sozler" klasörünü atınız.
1. "Plugins" menüsünden eklentiyi aktif ediniz.

== Changelog ==

= 4.0 =
* $wpdb ile uyumluluk sağlandı.
* shortcode desteği ilave edildi.

= 3.2 =
* VIEW tablosu güncellendi.

= 3.1 =
* Söz listeleme sayfasındaki küçük hata giderildi.

= 3.0 =
* Yazar ve söz listesinin ziyaretçilere gösterilmesi eklendi.
* Arama özelliği eklendi.
* Küçük hatalar giderildi.

= 2.1 =
* Söz ve yazar listesindeki sayfalama hatası giderildi.

= 2.0 =
* Yedekleme / Geri Yükleme özelliği eklendi.
* Ekran görüntüleri eklendi.
* Eklenti ayarları sayfası güncellendi.
* Eklenti ikonu eklendi.

= 1.2 =
* Listeleme hatası düzeltildi.

= 1.1 =
* Ekran görüntüsü eklendi.

= 1.0 =
* İlk versiyon.


== Frequently Asked Questions ==

Sıkça sorulan soru bulunmamaktadır.

== Upgrade Notice ==

Yedekleme / Geri Yükleme özelliği eklendi.
Ekran görüntüleri eklendi.

== Screenshots ==
1. Eklenti Sayfası
1. Eklenti Ayarlar Sayfası
1. Örnek `<?php echo ahmeti_wp_guzel_sozler(); ?>` Fonksiyonu Çıktı Görüntüsü
1. Genel Sayfa Görüntüsü

syncdir /Users/ahmet/code/ahmeti-wp-guzel-sozler/trunk /Users/ahmet/code/wordpress-test/wp-content/plugins/ahmeti-wp-guzel-sozler -w