<?php

function ahmeti_wp_guzel_sozler_install()
{
	global $wpdb;

	$tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
	$tables = array_map(function ($item){ return $item[0]; }, $tables);

	// AUTHORS TABLE CHECK
	if ( ! in_array(AHMETI_WP_AUTHORS_TABLE, $tables, true) ){
		$sql = "CREATE TABLE ".AHMETI_WP_AUTHORS_TABLE." (
            `author_id` mediumint unsigned NOT NULL AUTO_INCREMENT,
            `author_name` varchar(255) NOT NULL,
            `author_slug` varchar(255) NOT NULL,
            `author_content` mediumtext NOT NULL,
            PRIMARY KEY (`author_id`),
            UNIQUE KEY `wp_soz_author_slug` (`author_slug`)
        ) ".$wpdb->get_charset_collate().";";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
	}

    // QUOTES TABLE CHECK
    if ( ! in_array(AHMETI_WP_QUOTES_TABLE, $tables, true) ){
	    $sql = "CREATE TABLE ".AHMETI_WP_QUOTES_TABLE." (
            `quote_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
            `quote_author_id` mediumint(8) unsigned NOT NULL,
            `quote` mediumtext NOT NULL,
            `quote_desc` mediumtext,
            PRIMARY KEY (`quote_id`)
        ) ".$wpdb->get_charset_collate().";";

	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	    dbDelta($sql);
    }

    // CREATE SAMPLES
	if ( ! in_array(AHMETI_WP_AUTHORS_TABLE, $tables, true) && ! in_array(AHMETI_WP_QUOTES_TABLE, $tables, true) ){
		$wpdb->insert(AHMETI_WP_AUTHORS_TABLE, [
            'author_id' => 1,
            'author_name' => 'Ahmeti',
            'author_slug' => 'ahmeti',
            'author_content' => '',
        ]);

		$wpdb->insert(AHMETI_WP_QUOTES_TABLE, [
			'quote_id' => 1,
			'quote_author_id' => 1,
			'quote' => 'Hayata karşı keskin olmayın. Gün gelir "Hayatta yapmam!" dedikleriniz alışkanlıklarınıza dönüşür.',
			'quote_desc' => 'Bursa sokaklarında yürürken aklıma gelmiş bir söz...',
		]);

		$wpdb->insert(AHMETI_WP_QUOTES_TABLE, [
			'quote_id' => 2,
			'quote_author_id' => 1,
			'quote' => 'Bugün kendime sordum: "Çalışmak için mi yaşıyorum, yoksa yaşamak için mi çalışıyorum" diye...',
			'quote_desc' => '',
		]);

		$wpdb->insert(AHMETI_WP_QUOTES_TABLE, [
			'quote_id' => 3,
			'quote_author_id' => 1,
			'quote' => 'Günün sonunda kendimize şöyle bir soru sorabiliriz; "Bugün yaptıklarımızın hayatımıza ne faydası oldu."',
			'quote_desc' => '',
		]);
    }

    // Ayar Meta Var mı?
    /*if ( get_option('ahmeti_soz_setting') == false ){
        add_option('ahmeti_soz_setting', 'ASC,10');
    }*/
}

function ahmeti_wp_guzel_sozler_admin_head()
{
    wp_register_style('AhmetiWpGuzelSozlerAdminCss', plugins_url().'/ahmeti-wp-guzel-sozler/css/style.css');
    wp_enqueue_style('AhmetiWpGuzelSozlerAdminCss');
}

function ahmeti_wp_guzel_sozler_admin_menu()
{
    /* Admin Menü */
    add_action('admin_init', 'ahmeti_wp_guzel_sozler_admin_head' );
    add_menu_page('Ahmeti Wp Güzel Sözler', 'Söz Arşivi', 'edit_pages', 'ahmeti_wp_guzel_sozler/index.php', 'ahmeti_index', plugins_url('ahmeti-wp-guzel-sozler/images/ahmeti-icon.png'), 6);
}

function ahmeti_wp_guzel_sozler()
{
    $ahmetiPre=AHMETI_WP_PREFIX;
    $row=mysql_fetch_assoc(mysql_query("SELECT soz,aciklama,wp_soz_author_name,wp_soz_author_slug FROM {$ahmetiPre}soz_view ORDER BY RAND() LIMIT 0,1"));

    $AhmetiSoz=htmlspecialchars(strip_tags($row['soz']), ENT_QUOTES, 'UTF-8');
    $AhmetiYazar=htmlspecialchars(strip_tags($row['wp_soz_author_name']), ENT_QUOTES, 'UTF-8');
    $AhmetiAciklama=htmlspecialchars(strip_tags($row['aciklama']), ENT_QUOTES, 'UTF-8');
    
    $soz='<div class="gunun_sozu" style="padding: 45px 0 15px 235px;width: 490px;font-size: 15px;letter-spacing: 0.5px;display: block;line-height: 2em; font:oblique 15px/2em Georgia,serif;">';
    $soz .='<span style="font-size: 40px;font-weight: bold;float:left;">&ldquo;</span>';
    $soz .='<p id="soz_soz" style="text-indent:20px;line-height: 2em;margin-top:10px">'.$AhmetiSoz;

    if ($row['aciklama']==''){
    }else{
        $soz .='<span id="soz_aciklama" style="display:block;font-size:11px;">'.$AhmetiAciklama.'</span>';
    }

    $soz .='</p>';
    $soz .='<p id="soz_sahibi" style="margin-top: 5px;text-align: right;"><a style="color: #B96400;"href="#">'.$AhmetiYazar.'</a></p>';
    $soz.='</div>';
    return $soz;
}



function ahmeti_wp_db()
{
    global $wpdb;
    return $wpdb;
}

function ahmeti_wp_guzel_sozler_sayfala($site_url, $top_sayfa, $page, $limit, $page_url)
{
    if( $limit >= $top_sayfa){ return ''; }

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
    if ( $page -$x > 2 ){
        echo '<span class="say_b">...</span>';
        $i = $page-$x;
    }else{
        $i = 2;
    }

    // +/- $x sayfalari yazdir
    for ($i; $i <= $page + $x; $i++){
        if ( $i == $page ){
	        echo '<span class="say_aktif">'.$i.'</span>';
        }else{
	        echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$i.'">'.$i.'</a>';
        }
        if ( $i == $lastP ){
	        break;
        }
    }

    // "..." veya son sayfa
    if ( $page + $x < $lastP - 1 ){
        echo '<span class="say_b">...</span>';
        echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
    }elseif( $page + $x == $lastP - 1 ){
        echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
    }
    echo '</div>';
}

function ahmeti_wp_guzel_sozler_sef_link($link_yap)
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

function ahmeti_wp_guzel_sozler_quotes($columns=[], $orderBy=['quote_id', 'DESC'], $limit = [0, 20])
{
	$columns = empty($columns) ? '*' : implode(',', $columns);

	global $wpdb;
	return $wpdb->get_results($wpdb->prepare(
		'SELECT '.$columns.' FROM '.AHMETI_WP_QUOTES_TABLE.' as quote '.
		'LEFT JOIN '.AHMETI_WP_AUTHORS_TABLE.' as author ON author.author_id = quote.quote_author_id '.
		'ORDER BY '.$orderBy[0].' '.$orderBy[1].' '.
		'LIMIT '.$limit[0].', '.$limit[1]
		, ['']));
}

function ahmeti_wp_guzel_sozler_authors($columns=[], $orderBy=['author_id', 'DESC'], $limit = [0, 20])
{
	$columns = empty($columns) ? '*' : implode(',', $columns);

	global $wpdb;
	return $wpdb->get_results($wpdb->prepare(
		'SELECT '.$columns.' FROM '.AHMETI_WP_AUTHORS_TABLE.' as author '.
		'ORDER BY '.$orderBy[0].' '.$orderBy[1].' '.
		'LIMIT '.$limit[0].', '.$limit[1]
		, ['']));
}

function ahmeti_wp_guzel_sozler_header()
{
    $logo = plugins_url('ahmeti-wp-guzel-sozler/images/icon.png');

	return
    '<div id="ahmeti_wrap" style="padding:10px">'.

        '<div style="overflow: hidden;margin-bottom: 10px">'.
            '<div style="float: left">'.
                '<h1 style="font:oblique 30px/30px Georgia,serif; color:grey;background-image: url(\''.$logo.'\');background-repeat: no-repeat;padding: 20px 10px 10px 37px;background-position: 0 0;">Ahmeti WP Güzel Sözler'.
                    '<sup style="font-size: 12px">'.AHMETI_WP_QUOTES_VERSION.'</sup>'.
                '</h1>'.
            '</div>'.

            '<div style="float: left">'.
                '<form action="'.PHP_D_URL.'&islem=search" method="post" style="margin-left: 58px;margin-top: 43px;">'.
                    '<input type="text" name="AhmetiSearch" size="40" placeholder="Yazar, söz, açıklama arayabalirsiniz."/>'.
                    '<input type="submit" value="&nbsp;&nbsp;ARA&nbsp;&nbsp;" /><br/>'.
                '</form>'.
            '</div>'.
        '</div>'.

        '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'">Söz Listesi</a>'.
        '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=yeni_ekle">Yeni Söz Ekle</a>'.

        '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=author_list">Yazar Listesi</a>'.
        '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=yeni_author_ekle">Yeni Yazar Ekle</a>'.

        '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=ayarlar">Ayarlar</a>'.

        /* '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=export_page">Sözleri Al</a>'.
         '<a style="margin-right:15px;" class="button" href="'.PHP_D_URL.'&islem=import_page">Sözleri Yükle</a>'.*/

        '<div style="margin-top: 15px;clear: both;padding:5px;"></div>';
}

function ahmeti_wp_guzel_sozler_footer()
{
	return
		'<br/><br/>'.
		'<p style="margin:30px 0 0 0 ;display:inline;font:oblique 11px/1em Georgia,serif">'.
            'Geliştirici: <a target="_blank" href="https://ahmetimamoglu.com.tr">Ahmet İmamoğlu</a> | '.
            '<a target="_blank" href="https://ahmetimamoglu.com.tr/ahmeti-wp-guzel-sozler-1-0">Eklenti Sayfası</a> | '.
            '<a target="_blank" href="https://github.com/ahmeti/ahmeti-wp-guzel-sozler">Github</a>'.
		'</p>'.
    '</div>';
}


// Front Functions

function ahmeti_wp_guzel_sozler_shortcode()
{
	ahmeti_wp_guzel_sozler_random();

	$urlSegments = array_values(array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))));

	if( count($urlSegments) == 2 && isset($urlSegments[0]) && isset($urlSegments[1]) ){
		// Quotes
		return ahmeti_wp_guzel_sozler_shortcode_quotes($urlSegments[0], $urlSegments[1]);
	}elseif( count($urlSegments) == 1 && isset($urlSegments[0]) ){
		// Authors
		return ahmeti_wp_guzel_sozler_shortcode_authors($urlSegments[0]);
	}
}

function ahmeti_wp_guzel_sozler_shortcode_authors($urlSegment)
{
	$authors = ahmeti_wp_guzel_sozler_authors(['author_id', 'author_name', 'author_slug'], ['author_name', 'ASC'], [0, 99999]);
	echo '<ul id="ahmeti_wp_author_list">';
	foreach($authors as $author){
		echo '<li><a href="'.home_url().'/'.$urlSegment.'/'.$author->author_slug.'">'.$author->author_name.'</a></li>';
	}
	echo '</ul>';
}

function ahmeti_wp_guzel_sozler_shortcode_quotes($urlSegment, $authorSlug)
{
	global $wpdb;
	$author = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.AHMETI_WP_AUTHORS_TABLE.' WHERE author_slug = %s LIMIT 0,1', [$authorSlug]));

	if ( empty($author->author_id) ){
		echo 'Bu kişi hakkında söz eklenmemiş.';
	}else{
		?>
        <a style="float: right;font-weight: bold;margin-top: 7px;" href="<?php echo home_url().'/'.$urlSegment; ?>">&lt; Harika Sözler</a>
        <h1 class="entry-title"><a href="<?php  echo home_url().'/'.$urlSegment.'/'.$authorSlug ?>" rel="bookmark"><?php echo $author->author_name; ?> Sözleri</a></h1>

		<?php

		if ( ! empty ($author->author_content) ){

			preg_match('/\[gallery.*ids=.(.*).\]/', $author->author_content, $ids);

			if ( ! empty($ids) ){
				$array_ids = explode(',', $ids[1]);
				$i_foreach=0;
				foreach($array_ids as $thumb_id){
					echo '<dl class="gallery-item">'.
					     '<dt class="gallery-icon">'.
					     '<a href="'.wp_get_attachment_url( $thumb_id ).'" title="'.$author->author_name.'" rel="lightbox['.$thumb_id.']">'.
					     '<img width="150" height="150" src="'.wp_get_attachment_thumb_url($thumb_id).'" class="attachment-thumbnail" alt="1">'.
					     '</a>'.
					     '</dt>'.
					     '</dl>';

					$i_foreach++;

					if ( $i_foreach == 3 ){
						$i_foreach=0;
						echo '<br style="clear: both">';
					}
				}

				if( ! empty($thumb_id) ){
					echo '<br style="clear: both">';
				}

				$author->author_content = str_replace($ids[0], '', $author->author_content);
				$author->author_content = str_replace('<p></p>', '', $author->author_content);
			}

			echo $author->author_content;
		}

		$quotes = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.AHMETI_WP_QUOTES_TABLE.' WHERE quote_author_id = %d ORDER BY quote_id DESC', [$author->author_id]));

		echo '<ul>';
		foreach($quotes as $quote){
			echo '<li style="margin-bottom:5px">'.$quote->quote;
			if ( ! empty($quote->quote_desc) ){
				echo '<span style="font-size:11px;font-style:italic;color:gray">&nbsp;&nbsp;'.$quote->quote_desc.'</span>';
			}
			echo'</li>';
		}
		echo '</ul>';
	}
}

function ahmeti_wp_guzel_sozler_random()
{
	global $wpdb;
    $columns = 'quote_id, author_id, author_name, author_slug, quote, quote_desc';
	$quote = $wpdb->get_row($wpdb->prepare('SELECT '.$columns.' FROM '.AHMETI_WP_QUOTES_TABLE.' quote LEFT JOIN '.AHMETI_WP_AUTHORS_TABLE.' as author ON author.author_id = quote.quote_author_id ORDER BY RAND()', ['']));
    return (object)[
        'quote_id' => isset($quote->quote_id) ? $quote->quote_id : null,
        'author_id' => isset($quote->author_id) ? $quote->author_id : null,
        'author_name' => isset($quote->author_name) ? $quote->author_name : null,
        'author_slug' => isset($quote->author_slug) ? $quote->author_slug : null,
        'quote' => isset($quote->quote) ? $quote->quote : null,
        'quote_desc' => isset($quote->quote_desc) ? $quote->quote_desc : null,
    ];
}