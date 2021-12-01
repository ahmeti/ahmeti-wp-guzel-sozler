<?php if(!defined('AHMETI_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
function ahmeti_soz_kurulum()
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
    if ( get_option('ahmeti_soz_setting') == false ){
        add_option('ahmeti_soz_setting', 'ASC,10,harika-sozler');
    }
}



function ahmeti_admin_head()
{
    /* Wp Admin Head */
    //wp_enqueue_script('jquery');
    

    //wp_register_script('AhmetiWpGuzelSozlerAdminJs', plugins_url().'/ahmeti-wp-guzel-sozler/js/kontrol.js', array( 'jquery' ));
    //wp_enqueue_script('AhmetiWpGuzelSozlerAdminJs');
    
    wp_register_style( 'AhmetiWpGuzelSozlerAdminCss', plugins_url().'/ahmeti-wp-guzel-sozler/css/style.css');
    wp_enqueue_style( 'AhmetiWpGuzelSozlerAdminCss' );
    
    
}



function ahmeti_wp_head()
{
    /* Wp Head */
    wp_register_style( 'AhmetiWpGuzelSozlerAdminCss', plugins_url().'/ahmeti-wp-guzel-sozler/css/style.css',array(),'','screen' );
    wp_enqueue_style( 'AhmetiWpGuzelSozlerAdminCss' );
    
}



function ahmeti_admin_menu()
{
    /* Admin Menü */
    //add_action('admin_head','ahmeti_admin_head');
    add_action( 'admin_init', 'ahmeti_admin_head' );
    add_menu_page( 'Ahmeti Wp Güzel Sözler', 'Söz Arşivi', 'edit_pages', 'ahmeti_wp_guzel_sozler/index.php', 'ahmeti_index', plugins_url('ahmeti-wp-guzel-sozler/images/ahmeti-icon.png'), 6 );
    
    //add_action('admin_head','ahmeti_admin_head');
    
    
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



function ahmeti_wp_guzel_sozler_ayri()
{
    $ahmetiPre=AHMETI_WP_PREFIX;
    $row=mysql_fetch_assoc(mysql_query("SELECT soz,aciklama,wp_soz_author_name,wp_soz_author_slug FROM {$ahmetiPre}soz_view ORDER BY RAND() LIMIT 0,1"));

    $AhmetiSoz=htmlspecialchars(strip_tags($row['soz']), ENT_QUOTES, 'UTF-8');
    $AhmetiYazar=htmlspecialchars(strip_tags($row['wp_soz_author_name']), ENT_QUOTES, 'UTF-8');
    $AhmetiAciklama=htmlspecialchars(strip_tags($row['aciklama']), ENT_QUOTES, 'UTF-8');

    $dondur=array('Soz'=>$AhmetiSoz,'Yazar'=>$AhmetiYazar,'Aciklama'=>$AhmetiAciklama);
    
    return $dondur;
}



/* Special Page Functions */
function my_flush_rules(){
    
    $rules = get_option('rewrite_rules');

    if ( ! isset( $rules['('.AHMETI_SOZ_LIST_SLUG.')/([a-zA-Z0-9-]+)$'] )  || ! isset( $rules['('.AHMETI_SOZ_LIST_SLUG.')/([a-zA-Z0-9-]+)/([a-zA-Z0-9-]+)$'] ) ) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
}
    
function my_insert_rewrite_rules( $rules ){
    $newrules = array();
    $newrules['('.AHMETI_SOZ_LIST_SLUG.')/([a-zA-Z0-9-]+)$'] = 'index.php?pagename=$matches[1]&soz_sahibi=$matches[2]'; 
    $newrules['('.AHMETI_SOZ_LIST_SLUG.')/([a-zA-Z0-9-]+)/([a-zA-Z0-9-]+)$'] = 'index.php?pagename=$matches[1]&soz_sahibi=$matches[2]&soz_sayfa=$matches[3]';

    return $newrules + $rules; 
}

function my_insert_query_vars( $vars ){
    array_push($vars, 'soz_sahibi');
    array_push($vars, 'soz_sayfa');

    return $vars;
}
/* Special Page Functions */

if ( AHMETI_SOZ_LIST_SLUG != '' ){

    add_action( 'wp_loaded','my_flush_rules' );
    add_filter( 'rewrite_rules_array','my_insert_rewrite_rules' );
    add_filter( 'query_vars','my_insert_query_vars' );
}

function ahmeti_wp_guzel_sozler_in_page(){
    
    if ( is_page() && AHMETI_SOZ_LIST_SLUG == get_query_var('pagename')  ){

        // Ahmeti Wp Güzel Sözler Listesi İçin Url'den Gelen Talep Varsa...
        $aa_soz_sayfa=get_query_var('soz_sayfa');
        $sozSahibiSef=get_query_var('soz_sahibi');
        
        if (!empty($sozSahibiSef)){
            ahmeti_wp_guzel_sozler_author_soz_list($sozSahibiSef);
        }else{
            ahmeti_wp_guzel_sozler_author_list();
        }
    }
    
}

function ahmeti_wp_guzel_sozler_author_list(){
    ?>
    <h1 class="entry-title">
        <a href="<?php echo site_url(); ?>/<?php echo AHMETI_SOZ_LIST_SLUG; ?>/" rel="bookmark">Harika Sözler</a>
    </h1>

    <?php
    // INDEX
    $ahmetiPre=AHMETI_WP_PREFIX;
    $sql_ahmeti=mysql_query("SELECT wp_soz_author_name,wp_soz_author_slug FROM {$ahmetiPre}soz_author ORDER BY wp_soz_author_name ASC");
    echo '<ul id="ahmeti_wp_author_list">';
    while($row_ahmeti=mysql_fetch_object($sql_ahmeti)){

        echo '<li><a href="'.site_url().'/'.AHMETI_SOZ_LIST_SLUG.'/'.$row_ahmeti->wp_soz_author_slug.'/">'.$row_ahmeti->wp_soz_author_name.'</a></li>';
    }
    echo '</ul>';    
}

function ahmeti_wp_guzel_sozler_author_soz_list($sozSahibiSef){
    
    // SOZ SAHIBI SAYFASI
    $ahmetiPre=AHMETI_WP_PREFIX;
    $sql_author=mysql_fetch_object(mysql_query("SELECT wp_soz_author_id,wp_soz_author_name FROM {$ahmetiPre}soz_author WHERE wp_soz_author_slug='$sozSahibiSef'"));

    if (empty($sql_author->wp_soz_author_id)){
        echo 'Bu kişi hakkında söz eklenmemiş.'; 
    }else{
    ?> 
        <a style="float: right;font-weight: bold;margin-top: 7px;" href="<?php echo site_url(); ?>/<?php echo AHMETI_SOZ_LIST_SLUG; ?>/">&lt; Harika Sözler</a>
        <h1 class="entry-title"><a href="<?php echo site_url(); ?>/<?php echo AHMETI_SOZ_LIST_SLUG; ?>/<?php echo $sozSahibiSef; ?>" rel="bookmark"><?php echo $sql_author->wp_soz_author_name; ?> Sözleri</a></h1>

        <?php
        $sql_soz_list=mysql_query("SELECT soz,aciklama,author_content FROM {$ahmetiPre}soz_view WHERE wp_soz_author_id='$sql_author->wp_soz_author_id' ");

        $i=true;
        while($row_soz_list=mysql_fetch_object($sql_soz_list)){

            if ($i==true && !empty($row_soz_list->author_content)){

                preg_match('/\[gallery.*ids=.(.*).\]/', $row_soz_list->author_content, $ids);

                if (!empty($ids)){
                    $array_ids=explode(',',$ids[1]);
                    $i_foreach=0;
                    foreach($array_ids as $thumb_id){
                        echo '<dl class="gallery-item"><dt class="gallery-icon"><a href="'.wp_get_attachment_url( $thumb_id ).'" title="'.$sql_author->wp_soz_author_name.'" rel="lightbox['.$thumb_id.']"><img width="150" height="150" src="'.wp_get_attachment_thumb_url($thumb_id).'" class="attachment-thumbnail" alt="1"></a></dt></dl>';
                        $i_foreach++;
                        if ($i_foreach==3){$i_foreach=0; echo '<br style="clear: both">';}
                    }

                    if(@!empty($thumb_id)){
                        echo '<br style="clear: both">';
                    }


                    //echo jqlb_apply_lightbox(do_shortcode($ids[0]));

                    $row_soz_list->author_content=str_replace($ids[0],'',$row_soz_list->author_content);
                    $row_soz_list->author_content=str_replace('<p></p>','',$row_soz_list->author_content);                    
                }

                echo $row_soz_list->author_content;

            }

            if ($i==true){
                echo '<ul>';
            }

            $i=false;

            echo '<li style="margin-bottom:5px">'.$row_soz_list->soz;
            if (!empty($row_soz_list->aciklama)){
                echo '<span style="font-size:11px;font-style:italic;color:gray">&nbsp;&nbsp;'.$row_soz_list->aciklama.'</span>';
            }
            echo'</li>';
        }
        echo '</ul>';

    }
    
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