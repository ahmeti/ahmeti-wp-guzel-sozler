<?php
// Söz Güncelleme Sayfası

$id=(int)$_GET['id'];

$row=mysql_fetch_object(mysql_query("SELECT * FROM wp_soz_author WHERE wp_soz_author_id=$id"));


/* Soru ve şıklar için TinyMce */
function ShowTinyMCE() {
    // conditions here
    wp_enqueue_script( 'common' );
    wp_enqueue_script( 'jquery-color' );
    wp_print_scripts('editor');
    if (function_exists('add_thickbox')) add_thickbox();
    wp_print_scripts('media-upload');
    if (function_exists('wp_tiny_mce')) wp_tiny_mce();
    wp_admin_css();
    wp_enqueue_script('utils');
    do_action("admin_print_styles-post-php");
    do_action('admin_print_styles');
}
add_filter('admin_head','ShowTinyMCE');


?>

<div style="display: block;padding: 20px 0 10px 0">
    <form id="form_gonder" action="<?php echo PHP_D_URL; ?>" method="post">
        <h3 style="margin-bottom: 1px;">Kişi Adı</h3>
        <input type="text" name="kisi" value="<?php echo $row->wp_soz_author_name; ?>"/>
        <br/><br/>
        <?php wp_editor($row->author_content,'author_content',$settings = array('textarea_rows'=> 5 ,'wpautop' => false));?>
        <br/><br/>
        <input type="submit" value="Kişiyi Güncelle" class="button" id="gonder_button"/>
        <input type="hidden" name="islem" value="update_author_form_add" />
        <input type="hidden" name="id" value="<?php echo $row->wp_soz_author_id; ?>" />
    </form>
</div>