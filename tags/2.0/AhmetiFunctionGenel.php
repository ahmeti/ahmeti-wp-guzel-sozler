<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
    function Sayfala($site_url,$top_sayfa,$page,$limit,$page_url)
    {
        // Sayfalama Şeridimiz

        if ($top_sayfa > $limit) :

        echo '<div id="sayfala"><span class="say_sabit">Sayfalar</span>';

        $x = 5; // Aktif sayfadan önceki/sonraki sayfa gösterim sayisi
        $lastP = ceil($top_sayfa / $limit);

        // sayfa 1'i yazdir
        if ($page==1){
            echo '<span class="say_aktif">1</span>';
        }else{
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'">1</a>';
        }

        // "..." veya direkt 2
        if ($page-$x>2){
            echo '<span class="say_b">...</span>';
            $i = $page-$x;
        }else{
            $i = 2;
        }
        // +/- $x sayfalari yazdir
        for ($i; $i<=$page+$x; $i++){
            if ($i==$page)
            echo '<span class="say_aktif">'.$i.'</span>';
            else
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$i.'">'.$i.'</a>';
            if ($i==$lastP)
            break;
        }

        // "..." veya son sayfa
        if ($page+$x<$lastP-1){
            echo '<span class="say_b">...</span>';
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
        }elseif ($page+$x==$lastP-1){
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
        }
        echo '</div>';//#sayfala
        endif;
    }
    
    
    
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

    
    
function ee_debug($data)
{
    ob_start();
    print_r($data);
    $out = ob_get_contents();
    ob_end_clean();
    echo '<pre font-size="10">';
    echo htmlentities($out,ENT_QUOTES,'UTF-8');
    echo '</pre>';
}
    
?>
