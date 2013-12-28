=== Plugin Name ===
Contributors: ahmeti
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HUXL44BC8SRHQ
Tags: harika sözler, güzel sözler, söz arşivi, 
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 3.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...

== Description ==

Harika sözleri arşivleyebileceğiniz ve istediğiniz sayfalarda paylaşabileceğiniz bir eklenti...
Güzel sözler arşivi oluşturmak istiyorsanız sizin için biçilmiş kaftan :)
Kullanımı ise oldukça kolaydır. 2.1 versiyonu ile yedekleme ve geri yükleme özelliği eklenmiştir.

**Kişiselleştirin.**

Değişkenleri parçalara bölerek kullanın...
Daha sonra sözü, yazarı ve söz açıklamasını istediğiniz yerde gösterin.
Sadece sözü, sadece yazarı veya sadece açıklamayı gösterebilirsiniz.


[Detaylar için Yükleme Sayfasına Bakın](http://wordpress.org/plugins/ahmeti-wp-guzel-sozler/installation/) | 
[İlgili Yazıyı Takip Edin](http://ahmeti.net/ahmeti-wp-guzel-sozler-1-0/)

== Installation ==

1. `/wp-content/plugins/` klasörünün içerisine .zip dosyasından çıkan "ahmeti-wp-guzel-sozler" klasörünü atınız.
1. "Plugins" menüsünden eklentiyi aktif ediniz.
1. `<?php echo ahmeti_wp_guzel_sozler(); ?>` kodunu sözü nerede kullanmak isterseniz ekleyiniz veya
1. Kişiselleştirin. Değişkenleri parçalara bölerek kullanın... Daha sonra sözü, yazarı ve söz açıklamasını istediğiniz yerde gösteriniz. Sadece sözü, sadece yazarı veya sadece açıklamayı gösterebilirsiniz.
`<?php $Ahmeti_Soz=ahmeti_wp_guzel_sozler_ayri(); ?>` fonksiyonunu kullanarak dönen değerleri değişkene aktarın.
`<?php echo $Ahmeti_Soz['Soz']; ?>`
`<?php echo $Ahmeti_Soz['Yazar']; ?>`
`<?php echo $Ahmeti_Soz['Aciklama']; ?>`

== Changelog ==

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

