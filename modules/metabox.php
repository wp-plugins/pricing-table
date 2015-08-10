<?php
/* Define the custom box */



// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */


/* Adds a box to the main column on the Post and Page edit screens */
function wppt_add_custom_box() {
    add_meta_box( 'pricing-table-feature-options', __( 'Packages/Features', 'wppt' ).' <div style="margin:5px 0;background: #18BC9C;padding:5px 10px;border-radius:2px"><a target="_blank" href="http://wpeden.com/product/wordpress-pricing-table-plugin/" style="text-decoration:none;font-size:13pt;font-weight:300;color:#fff;" title="Link will open in new window">Get Pro for Unlimited Table Tamplates and More Options</a> <a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/pricing-table?rate=5#postform" title="Link will open in new window" style="text-decoration:none;font-size:13pt;font-weight:300;float:right;color:#fff;">A 5* rating at wp.org will be very inspiring :)</a></div>', 'wppt_individual_features', 'pricing-table', 'normal','core' );
}

function wppt_individual_features( $post ) {

    include(WPPT_PLUGINDIR."/tpls/metabox-feature-options.php");
}

function wppt_save_pricing_table( $post_id ) {
     
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( !current_user_can( 'edit_post', $post_id ) ) return;
    if(get_post_type()!='pricing-table') return;
    //print_r($_POST['features_description']); 
    //exit;
    if(isset($_POST['features']))
        update_post_meta($post_id,'pricing_table_for_post',$_POST['features']);
    if(isset($_POST['features'])){
        update_post_meta($post_id,'pricing_table_opt',$_POST['features']);
        update_post_meta($post_id,'pricing_table_opt_description',$_POST['features_description']);
        update_post_meta($post_id,'pricing_table_opt_feature',$_POST['featured']);
        update_post_meta($post_id,'pricing_table_opt_feature_name',$_POST['feature_name']);
        update_post_meta($post_id,'pricing_table_opt_feature_description',$_POST['feature_description']);
        update_post_meta($post_id,'pricing_table_opt_package_name',$_POST['package_name']); 

    
    update_post_meta($post_id,'alt_feature',$_POST['alt_feature']);
    update_post_meta($post_id,'alt_price',$_POST['alt_price']);
    update_post_meta($post_id,'alt_detail',$_POST['alt_detail']);

    update_post_meta($post_id,'__wppt_returnurl',$_POST['__wppt_returnurl']);
    update_post_meta($post_id,'__wppt_cancelurl',$_POST['__wppt_cancelurl']);
    update_post_meta($post_id,'__wppt_currency_code',$_POST['__wppt_currency_code']);
    update_post_meta($post_id,'__wppt_business',$_POST['__wppt_business']);
    }
}

 
add_action( 'add_meta_boxes', 'wppt_add_custom_box');
add_action( 'save_post', 'wppt_save_pricing_table' );  