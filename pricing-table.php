<?php 
/*
Plugin Name: Pricing table
Plugin URI: http://wpeden.com
Description: Generate Pricing Table Easily. Use simple short-code <strong>[ahm-pricing-table id=999]</strong> ( <strong>999</strong> = use any table id here) inside page or post content to embed pricing table
Author: Shaon
Version: 1.2.1
Author URI: http://shaon.info
*/
 
include("libs/class.plugin.php");
global $pricingtable_plugin, $enque;

$enque = 0;

$pricingtable_plugin = new ahm_plugin('pricing-table');


$plugindir = str_replace('\\','/',dirname(__FILE__));
 

define('PLUGINDIR',$plugindir);  

 

function wppt_custom_init() 
{
  
  load_plugin_textdomain( 'pricing-table', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
    
  $labels = array(
    'name' => _x('Pricing Tables', 'pricing-table'),
    'singular_name' => _x('Pricing Table', 'pricing-table'),
    'add_new' => _x('Add New', 'pricing-table','pricing-table'),
    'add_new_item' => __('Add New Pricing Table','pricing-table'),
    'edit_item' => __('Edit Pricing Table','pricing-table'),
    'new_item' => __('New Pricing Table','pricing-table'),
    'all_items' => __('All Pricing Tables','pricing-table'),
    'view_item' => __('View Pricing Table','pricing-table'),
    'search_items' => __('Search Pricing Tables','pricing-table'),
    'not_found' =>  __('No Pricing Table found','pricing-table'),
    'not_found_in_trash' => __('No Pricing Tables found in Trash','pricing-table'), 
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


function wppt_table($params){
     $pid = $params['id'];
     $template = $params['template'];
     $template = $template?$template:'green';  
     $currency = isset($params['currency'])&&$params['currency']!=''?$params['currency']:'$';   
     ob_start();
     include("tpls/price_table-$template.php"); 
     $data = ob_get_contents();     
     ob_clean();
     $data = str_replace(array("\n","\r","[y]","[n]"),array("","","<img src='".plugins_url('/pricing-table/images/tick.png')."' />","<img src='".plugins_url('/pricing-table/images/cross.png')."' />"),$data);
     return $data;
}

function wppt_help(){
    include("tpls/help.php");
}

function wppt_menu(){
    add_submenu_page('edit.php?post_type=pricing-table', 'Help', 'Help', 'administrator', 'help', 'wppt_help');    
    
}


function wppt_columns_struct( $columns ) {     
    $column_shorcode = array( 'shortcode' => __('Embed Code','pricing-table') );    
    $columns = array_slice( $columns, 0, 2, true ) + $column_shorcode + array_slice( $columns, 2, NULL, true );
    return $columns;
}

function wppt_column_obj( $column ) {
    global $post;
    switch ( $column ) {       
        case 'shortcode':
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID} template=\"gray\" currency=\"\$\"]' size=35 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID} template=\"green\" currency=\"\$\"]' size=35 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID} template=\"smooth\" currency=\"\$\"]' size=35 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
            break;
    }
}
 
 if(is_admin()){
     add_action("admin_menu","wppt_menu");
 } 

function wppt_live_preview($content){
    global $post, $enque;
    $enque = 1;
    wppt_enqueue_scripts();
    if(get_post_type()!='pricing-table') return $content;
    echo do_shortcode("[ahm-pricing-table id={$post->ID}]");
}

function wppt_admin_enqueue_scripts(){    
    wp_enqueue_script("jquery");
    if(get_post_type()=='pricing-table')
    wp_enqueue_script("jquery-dragtable",plugins_url('/pricing-table/js/admin/dragtable.js'),array('jquery'));
    
}

function wppt_enqueue_scripts(){   
    global $enque; 
    wp_enqueue_script("jquery");    
    if($enque==1){        
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
                        jQuery(".wppttip").tipTip({defaultPosition:'right'});
                    });
         
        </script>
    <?php
    }
}

 
function wppt_detect_shortcode()
{
    global $post, $enque;
    $pattern = get_shortcode_regex();

    if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
        && array_key_exists( 2, $matches )
        && in_array( 'ahm-pricing-table', $matches[2] ) )
    {        
        $enque = 1;
    }
}

$pricingtable_plugin->load_modules();

add_action( 'wp', 'wppt_detect_shortcode' ); 
add_action('wp_enqueue_scripts', 'wppt_enqueue_scripts');  
add_action('admin_enqueue_scripts', 'wppt_admin_enqueue_scripts'); 
add_action('wp_footer', 'wppt_tiptip_init'); 
add_action('init', 'wppt_custom_init'); 
add_shortcode("ahm-pricing-table",'wppt_table');
add_filter( 'manage_edit-pricing-table_columns', 'wppt_columns_struct', 10, 1 );
add_filter( 'the_content', 'wppt_live_preview');
add_action( 'manage_posts_custom_column', 'wppt_column_obj', 10, 1 );
