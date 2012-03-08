<?php
/* Define the custom box */



// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */


/* Adds a box to the main column on the Post and Page edit screens */
function wppt_add_custom_box() {
    add_meta_box( 'pricing-table-feature-options', __( 'Packages/Features ( <a target="_blank" href="http://wpeden.com/product/wordpress-pricing-table-plugin/">Get pro for more templates &#187;</a> )', 'wppt' ), 'wppt_individual_features', 'pricing-table', 'normal','core' );
    add_meta_box( 'pricing-table-op', __( 'My Other Plugins', 'wppt' ), 'wppt_plugins', 'pricing-table', 'side','core' );
   
}

function wppt_plugins( $post ) {
    ?>
   <a href="http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/?ref=pricing-table" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">Drag & Drop Page Layout Builder</h3><img src="<?php echo plugins_url('pricing-table/images/minimax.png'); ?>" /></a>
   <a href="http://www.wpdownloadmanager.com/?ref=pricing-table" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Download Manager Pro</h3><img src="<?php echo plugins_url('pricing-table/images/wpdm.png'); ?>" /></a>
   <a href="http://www.wpmarketplaceplugin.com/?ref=pricing-table" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Marketplace Plugin</h3><img vspace="12" src="<?php echo plugins_url('pricing-table/images/wpmp.png'); ?>" /></a>
   <a href="http://wpeden.com/?ref=pricing-table" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Themes & Plugins Collection</h3><img src="<?php echo plugins_url('pricing-table/images/wpeden.png'); ?>" /></a>
   <div style="clear: both;"></div>
    <?php
}

function wppt_individual_features( $post ) {
    global $pricingtable_plugin;     
    include($pricingtable_plugin->plugin_dir."/tpls/metabox-feature-options.php");
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