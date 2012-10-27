<?php 
/*
Plugin Name: Pricing table
Plugin URI: http://wpeden.com
Description: Generate Pricing Table Easily. Use simple short-code <strong>[ahm-pricing-table id=999]</strong> ( <strong>999</strong> = use any table id here) inside page or post content to embed pricing table
Author: Shaon
Version: 1.1.3
Author URI: http://wordpresspricingtable.com
*/
 
include("libs/class.plugin.php");
global $pricingtable_plugin;
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
     ob_start();
     include("tpls/price_table-$template.php"); 
     $data = ob_get_contents();     
     ob_clean();
     $data = str_replace(array("\n","\r"),"",$data);
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
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID} template=gray]' size=35 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
            echo "<input type=text readonly=readonly value='[ahm-pricing-table id={$post->ID} template=green]' size=35 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
            break;
    }
}
 
 if(is_admin()){
     add_action("admin_menu","wppt_menu");
 } 



function pricingtable_enqueue_scripts(){    
global $pricingtable_plugin;
//$pricingtable_plugin->load_scripts(); 
//$pricingtable_plugin->load_styles(); 
wp_enqueue_script("jquery");
}

$pricingtable_plugin->load_modules(); 

 
add_action('wp_enqueue_scripts', 'pricingtable_enqueue_scripts');  
add_action('admin_enqueue_scripts', 'pricingtable_enqueue_scripts'); 
add_action('init', 'wppt_custom_init'); 
add_shortcode("ahm-pricing-table",'wppt_table');
add_filter( 'manage_edit-pricing-table_columns', 'wppt_columns_struct', 10, 1 );
add_action( 'manage_posts_custom_column', 'wppt_column_obj', 10, 1 );
