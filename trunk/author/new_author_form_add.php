<?php
if (!empty($_POST)){



    $kisi=mysql_real_escape_string(trim(stripslashes($_POST['kisi'])));
    $author_content=mysql_real_escape_string(trim(stripslashes($_POST['author_content'])));

    if(empty($kisi)){

        echo '<p class="ahmeti_hata">Boş alan bırakmayınız.</p>';

    }else{

        function Sef_Link($link_yap)
        {
                $link_yap = trim($link_yap);
                $link_yap = html_entity_decode($link_yap, ENT_QUOTES, 'UTF-8');

                $link_yap = str_replace('Ç','c', $link_yap);
                $link_yap = str_replace('ç','c', $link_yap);
                $link_yap = str_replace('Ğ','g', $link_yap);
                $link_yap = str_replace('ğ','g', $link_yap);
                $link_yap = str_replace('I','i', $link_yap);
                $link_yap = str_replace('ı','i', $link_yap);
                $link_yap = str_replace('İ','i', $link_yap);
                $link_yap = str_replace('Ö','o', $link_yap);
                $link_yap = str_replace('ö','o', $link_yap);
                $link_yap = str_replace('Ş','s', $link_yap);
                $link_yap = str_replace('ş','s', $link_yap);
                $link_yap = str_replace('Ü','u', $link_yap);
                $link_yap = str_replace('ü','u', $link_yap);
                $link_yap = str_replace(' ','-',  $link_yap);
                $link_yap = preg_replace("@[^A-Za-z0-9\-_]+@i","",$link_yap); // Harfler hariç tüm simgeleri kaldıralım
                $link_yap = str_replace('-----','-',$link_yap);
                $link_yap = str_replace('----','-',$link_yap);
                $link_yap = str_replace('---','-',$link_yap);
                $link_yap = str_replace('--','-', $link_yap);
                $link_yap = str_replace('--','-', $link_yap);
                $link_yap = strtolower($link_yap);
                $link_yap = trim($link_yap,'-');
                return $link_yap;
        }

        $slug_kisi=Sef_Link($kisi);

        $soz_yaz=mysql_query("insert into wp_soz_author (wp_soz_author_name,wp_soz_author_slug,author_content) values ('$kisi','$slug_kisi','$author_content')");

        if ($soz_yaz){
            echo '<p class="ahmeti_ok">Kişi başarıyla eklendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Kişi eklenirken hata oluştu.</p>';
        }                
    }
}
?>