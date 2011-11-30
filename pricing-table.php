<?php 
/*
Plugin Name: Pricing table
Plugin URI: http://shaon.info/pricing-table-builder-plugin-for-wordpress/
Description: Display important message/notice from site admin to visitor. Use simple short-code <strong>[ahm-pricing-table id=999]</strong> ( <strong>999</strong> = use any table id here) inside page or post content to embed pricing table
Author: Shaon
Version: 1.0.0
Author URI: http://shaon.info/
*/
 
include("libs/class.plugin.php");
global $ahm_plugin;
$ahm_plugin = new ahm_plugin('pricing-table');


$plugindir = str_replace('\\','/',dirname(__FILE__));
 

define('PLUGINDIR',$plugindir);  

 


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


function wppt_table($params){
     $pid = $params['id'];
     $template = $params['template'];     
     ob_start();
     include("tpls/price_table.php"); 
     $data = ob_get_contents();     
     ob_clean();
     return $data;
}

 

wp_enqueue_script("jquery");
if(is_admin()){
  
    wp_enqueue_script("jquery-form",plugins_url().'/wordpress-perfection/jquery.form.js');    
   
    
}
 
$ahm_plugin->load_scripts(); 
$ahm_plugin->load_styles(); 
$ahm_plugin->load_modules(); 

 
add_action('init', 'wppt_custom_init'); 


add_shortcode("ahm-pricing-table",'wppt_table');
