<?php
if (!empty($_POST)){


    $id=(int)$_POST['id'];
    $kisi=mysql_real_escape_string(trim(stripslashes($_POST['kisi'])));
    $author_content=mysql_real_escape_string(trim(stripslashes($_POST['author_content'])));

    
    if(empty($kisi) || empty($id)){

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

        $sql=mysql_query("UPDATE wp_soz_author SET wp_soz_author_name='$kisi',wp_soz_author_slug='$slug_kisi',author_content='$author_content' WHERE wp_soz_author_id=$id") or die(mysql_error());
        

        if ($sql){
            echo '<p class="ahmeti_ok">Kişi başarıyla güncellendi.</p>';
        }else{
            echo '<p class="ahmeti_hata">Kişi güncellenirken hata oluştu.</p>';
        }                
    }
}
?>