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
    
    
    add_action('wp_head', 'ahmeti_wp_head');
 
    function ahmeti_wp_guzel_sozler(){
        
        $row=mysql_fetch_assoc(mysql_query("SELECT soz,aciklama,wp_soz_author_name,wp_soz_author_slug FROM soz_view ORDER BY RAND() LIMIT 0,1"));
  
        $soz='<div class="gunun_sozu" style="padding: 45px 0 15px 235px;width: 490px;font-size: 15px;letter-spacing: 0.5px;display: block;line-height: 2em; font:oblique 15px/2em Georgia,serif;">';
        $soz .='<span style="font-size: 40px;font-weight: bold;float:left;">&ldquo;</span>';
        $soz .='<p id="soz_soz" style="text-indent:20px;line-height: 2em;margin-top:10px">'.htmlspecialchars(strip_tags($row['soz']), ENT_QUOTES, 'UTF-8');
        
        if ($row['aciklama']==''){
            
        }else{
            $soz .='<span id="soz_aciklama" style="display:block;font-size:11px;">'.htmlspecialchars(strip_tags($row['aciklama']), ENT_QUOTES, 'UTF-8').'</span>';
        }
        
        $soz .='</p>';
        
        $soz .='<p id="soz_sahibi" style="margin-top: 5px;text-align: right;"><a style="color: #B96400;"href="#">'.htmlspecialchars(strip_tags($row['wp_soz_author_name']), ENT_QUOTES, 'UTF-8').'</a></p>';
        

        
        $soz.='</div>';
        
  
        return $soz;
}
?>
