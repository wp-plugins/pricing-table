<?php
/* Define the custom box */



// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */


/* Adds a box to the main column on the Post and Page edit screens */
function wppt_add_custom_box() {
    add_meta_box( 'pricing-table-feature-options', __( 'Packages/Features', 'wppt' ), 'wppt_individual_features', 'pricing-table', 'normal','core' );
   
}

function wppt_individual_features( $post ) {
    global $ahm_plugin;     
    include($ahm_plugin->plugin_dir."/tpls/metabox-feature-options.php");
}

function wppt_save_pricing_table( $post_id ) {
     
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( !current_user_can( 'edit_post', $post_id ) ) return;

     
    if($_POST['features'])
    update_post_meta($post_id,'pricing_table_for_post',$_POST['features']);
    if($_POST['features']){
    update_post_meta($post_id,'pricing_table_opt',$_POST['features']);
    update_post_meta($post_id,'pricing_table_opt_feature',$_POST['featured']); 
    }
  
}

 
add_action( 'add_meta_boxes', 'wppt_add_custom_box');
add_action( 'save_post', 'wppt_save_pricing_table' );  