<?php
/*
Plugin Name: Pricing Table
Plugin URI: http://wpeden.com/product/wordpress-pricing-table-plugin/
Description: WordPress Plugin for creating colorful pricing tables
Author: Shaon
Version: 1.4.1
Author URI: http://wpeden.com/
*/



include(dirname(__FILE__)."/modules/metabox.php");
include(dirname(__FILE__)."/modules/wppt-free-mce-button.php");

global $enque;


$enque = 1;

$plugindir = str_replace('\\','/',dirname(__FILE__));


define('WPPT_PLUGINDIR',$plugindir);


function wppt_custom_init()
{
    $labels = array(
        'name' => _x('Pricing Tables', 'post type general name'),
        'singular_name' => _x('Pricing Table', 'post type singular name'),
        'add_new' => _x('Add New', 'pricing-table'),
        'add_new_item' => __('Add New Pricing Table'),
        'edit_item' => __('Edit Pricing Table'),
        'new_item' => __('New Pricing Table'),
        'all_items' => __('All Pricing Tables'),
        'view_item' => __('View Pricing Table'),
        'search_items' => __('Search Pricing Tables'),
        'not_found' =>  __('No Pricing Table found'),
        'not_found_in_trash' => __('No Pricing Tables found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Pricing Table'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title'),
        'menu_icon' => plugins_url().'/pricing-table/images/table.gif'
    );
    register_post_type('pricing-table',$args);
}


function wppt_preview_table($content){
    global $wp_query;
    if(get_post_type()!='pricing-table') return $content;
    $pid = get_the_ID();
    $template = isset($_REQUEST['template'])?$_REQUEST['template']:'rock';
    $responsive = isset($params['responsive'])?'responsive':'';
    $styles = array('epic'=>9,'mega'=>9,'lucid'=>10,'override'=>9);

    ob_start();
    ?>
    <form action="">
        <input type="hidden" name="pricing-table" value="<?php echo $wp_query->query_vars['pricing-table']; ?>">
        <b>Select Template</b><br/>
        <select name="template" class="button input" id="ptt">
            <option value="">Select Template</option>
            <?php
            $directory = ABSPATH."/wp-content/plugins/pricing-table/table-templates";
            $directory_list = opendir($directory);
            while (FALSE !== ($file = readdir($directory_list))){
                // if the filepointer is not the current directory
                // or the parent directory
                if($file != '.' && $file != '..'){
                    $sel = $_GET['template']==$file?'selected=selected':'';
                    $path = $directory.'/'.$file;
                    if(is_dir($path)){
                        echo "<option $sel value='".$file."'>".strtoupper($file)."</option>";
                    }
                }
            }
            ?>

        </select> 
        <input type="submit" value="Preview"><br/>
        <?php if(isset($styles[$template]) && $styles[$template]>0){ ?>
            <b>Select Style</b><br/>
            <select onchange="jQuery('#ptts').attr('href','<?php echo plugins_url('pricing-table/table-templates/'.$template.'/style');?>'+this.value+'.css')">
                <option value="">Select Style</option>
                <?php for($dx = 1; $dx <= $styles[$template]; $dx++){ ?>
                    <option value="<?php echo $dx; ?>">Style <?php echo $dx; ?></option>

                <?php } ?>
            </select>
        <?php } ?>

    </form>

    <?php
    include("table-templates/{$template}/price_table.php");
    $data = ob_get_contents();
    ob_clean();
    $code[] = "[y]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/yes.png")."' />";
    $code[] = "[n]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/no.png")."' />";
    $code[] = "[na]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/na.png")."' />";
    $data = str_replace($code, $icons, $data);
    return $content.$data;
}

function wppt_table($params){
    $pid = $params['id'];
    if(isset($params['style']))
    $style = $params['style'];
    extract($params);

    $template = isset($params['template'])?$params['template']:'rock';
    $responsive = isset($params['responsive'])?'responsive':'';
    ob_start();
    include("table-templates/{$template}/price_table.php");
    $data = ob_get_contents();
    ob_clean();
    $shortcode = get_option("_wppt_shortcode",array());
    if(is_array($shortcode)){
        foreach($shortcode as $c){
            if(in_array(strtolower(end(explode('.',$c))),array('png','jpg','gif','jpeg')))
                $icons[] = "<img src='$c' />";
            else
                $icons[] = $c;
        }}

    $code=get_option("_wppt_code");
    $code = @array_values($code);
    $code[] = "[y]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/yes.png")."' />";
    $code[] = "[n]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/no.png")."' />";
    $code[] = "[na]";
    $icons[] = "<img src='".plugins_url("pricing-table/images/na.png")."' />";
    $data = str_replace($code, $icons,$data);
    return $data;
}


function wppt_columns_struct( $columns ) {
    $column_shorcode = array( 'shortcode' => 'Short-Code' );
    $columns = array_slice( $columns, 0, 2, true ) + $column_shorcode + array_slice( $columns, 2, NULL, true );
    return $columns;
}

function wppt_column_obj( $column ) {
    global $post;
    if($post->post_type=='pricing-table'){
    switch ( $column ) {
        case 'shortcode':
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID}]' size=25 style=\"box-shadow:none;border:1px solid #ddd;text-align:Center;font-family:'Courier New';font-size:10pt;pading:5px 10px;\" onclick='this.select()' />";
            break;
    }}
}



function wppt_help(){
    include(dirname(__FILE__)."/tpls/help.php");
}

function wppt_shortcodes(){
    include(dirname(__FILE__)."/tpls/short-codes.php");
}
function wppt_save_shortcode(){
    $sc = array();
    $sc = $_POST['shortcode'];
    foreach ($sc as $key=>$value) {
        $sc[$key] = stripslashes($value);
    }
    $c = array();
    $c = $_POST['code'];
    foreach ($c as $key=>$value) {
        $c[$key] = stripslashes($value);
    }
    
    update_option('_wppt_shortcode', $sc);
    update_option('_wppt_code', $c);
}

function wppt_menu(){
    add_submenu_page('edit.php?post_type=pricing-table', 'Short Codes', 'Short Codes', 'administrator', 'short-codes', 'wppt_shortcodes');
    add_submenu_page('edit.php?post_type=pricing-table', 'Help', 'Help', 'administrator', 'help', 'wppt_help');

}


if(is_admin()){
    add_action("admin_menu","wppt_menu");
}

function wppt_admin_enqueue_scripts(){
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery-form");
    wp_enqueue_script('wppt-datatable', plugins_url('pricing-table/js/admin/dragtable.js'));
    wp_enqueue_script('wppt-tablednd', plugins_url('pricing-table/js/admin/jquery.tablednd_0_5.js'));
    wp_enqueue_style("wppt-my", plugins_url('pricing-table/css/admin/my.css'));
    wp_enqueue_style("wppt-tablestyle", plugins_url('pricing-table/css/admin/tablestyle.css'));
    
    wp_enqueue_script("tiptipjs", plugins_url()."/pricing-table/js/site/jquery.tipTip.minified.js",array('jquery'));
    wp_enqueue_style("tiptipcss", plugins_url()."/pricing-table/css/site/tipTip.css");
}

function admin_tiptip_init(){
    ?>
        <script language="JavaScript">
            jQuery(function(){
                jQuery(".feature-desc-edit").tipTip({defaultPosition:'bottom'});
                jQuery(".featured-package").tipTip({defaultPosition:'bottom'});
                jQuery(".deletecol").tipTip({defaultPosition:'bottom'});
                jQuery(".featured-package-edit").tipTip({defaultPosition:'bottom'});
                jQuery(".deleterow").tipTip({defaultPosition:'bottom'});
                jQuery(".feature-edit").tipTip({defaultPosition:'bottom'});
            });
        </script>
    <?php
}

function wppt_enqueue_scripts(){
    global $enque;
    if($enque==1){
        wp_enqueue_script("jquery");

        wp_enqueue_script('wppt-tablednd', plugins_url('pricing-table/js/site/icon.js'));

        wp_enqueue_script("tiptipjs", plugins_url()."/pricing-table/js/site/jquery.tipTip.minified.js",array('jquery'));
        wp_enqueue_style("tiptipcss", plugins_url()."/pricing-table/css/site/tipTip.css");
    }
}


function wppt_tiptip_init(){
    global $enque;

    if($enque==1){
        ?>
        <script language="JavaScript">
            jQuery(function(){
                jQuery(".wppttip").tipTip({defaultPosition:'bottom'});
            });

        </script>
    <?php
    }
}

function wppt_baseurl(){
    global $enque;

    if($enque==1){
        ?>
        <script language="JavaScript">
            var wppt_url = "<?php echo plugins_url('/pricing-table/'); ?>";
        </script>
    <?php
    }
}


function wppt_detect_shortcode()
{
    global $post, $enque;
    $pattern = get_shortcode_regex();
    if(!is_object($post) || is_admin()) return;
    if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
        && array_key_exists( 2, $matches )
        && in_array( 'ahm-pricing-table', $matches[2] ) )
    {
        $enque = 1;
    }
}

function wppt_post_row_actions($actions, $post){
    if($post->post_type=='pricing-table')
        $actions['clone'] = "<a style='color:#2D873F' href='".admin_url()."?task=wpptclone&clone={$post->ID}'>Clone</a>";
    return $actions;
}

function wppt_clone(){
    if(!isset($_GET['task']) || $_GET['task']!='wpptclone'||!is_admin()) return false;
    $pid = $_GET['clone'];
    $data = get_post_meta($pid, 'pricing_table_opt',true);
    $featured=  get_post_meta($pid, 'pricing_table_opt_feature',true);
    $feature_description =  get_post_meta($pid, 'pricing_table_opt_feature_description',true);
    $data_des = get_post_meta($pid, 'pricing_table_opt_description',true);
    $feature_name=  get_post_meta($pid, 'pricing_table_opt_feature_name',true);
    $package_name=  get_post_meta($pid, 'pricing_table_opt_package_name',true);
    $npid = wp_insert_post(array("post_title"=>'New Pricing Table','post_status'=>'draft','post_type'=>'pricing-table'));

    update_post_meta($npid,'pricing_table_for_post',$featured);
    update_post_meta($npid,'pricing_table_opt',$data);
    update_post_meta($npid,'pricing_table_opt_description',$data_des);
    update_post_meta($npid,'pricing_table_opt_feature',$featured);
    update_post_meta($npid,'pricing_table_opt_feature_name',$feature_name);
    update_post_meta($npid,'pricing_table_opt_feature_description',$feature_description);
    update_post_meta($npid,'pricing_table_opt_package_name',$package_name);
    header("location: post.php?post={$npid}&action=edit");
    die();

}

add_action( 'wp', 'wppt_detect_shortcode' );

//register_activation_hook(__FILE__,'wppt_install');

add_filter('post_row_actions', 'wppt_post_row_actions',10, 2);
add_action('wp_head', 'wppt_baseurl');
add_action('wp_footer', 'wppt_tiptip_init');
add_action('init', 'wppt_clone');
add_action('init', 'wppt_custom_init');
add_shortcode("ahm-pricing-table",'wppt_table');
add_filter("the_content",'wppt_preview_table');
add_filter( 'manage_edit-pricing-table_columns', 'wppt_columns_struct', 10, 1 );
add_action( 'manage_posts_custom_column', 'wppt_column_obj', 10, 1 );
add_action('wp_ajax_wppt_save_shortcode', 'wppt_save_shortcode');
add_action('wp_enqueue_scripts', 'wppt_enqueue_scripts');
add_action('admin_enqueue_scripts', 'wppt_admin_enqueue_scripts'); 
//add_filter('admin_footer','admin_tiptip_init');



        
