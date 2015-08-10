<?php
function wppt_add_custom_box() {
    add_meta_box( 'pricing-table-feature-options', __( 'Packages/Features', 'wppt' ), 'wppt_individual_features', 'pricing-table', 'normal','core' );
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

function wppt_info_metabox_html($post){
    ?>
    <style>
        .wppt-info{
            text-align: center;
        }
        .wppt-btn{            
            border-width: 3px;
            border-radius: 3px;
            border-style: solid;           
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 16px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s ease 0s;
            margin: 20px 0px;
        }
        .btn-gopro{
            background: #f1c40f;
            border-color: #f1c40f #f1c40f #f39c12;
        }
        .btn-gopro:hover{
            border-color: #f1c40f;
        }
        .btn-rate{
            background: #1bcbaa;
            border-color: #1bcbaa #1bcbaa #16a085;
        }
        .btn-rate:hover{
            border-color: #1bcbaa;
        }
        .btn-suprt{
            background: #34495e;
            border-color: #34495e #34495e #2c3e50;
        }
        .btn-suprt:hover{
            border-color: #34495e;
        }
        .wppt-btn:hover{
            color: #fff;
        }
        .wppt-mb-p{
            font-size: 15px;
        }
    </style>
    <div class="wppt-info">
        <p class="wppt-mb-p">Get Pro Version for Unlimited Table Templates and More Options.</p>
        <div style="margin: 20px 0px;">
            <a class="wppt-btn btn-gopro" target="_blank" href="http://wpeden.com/product/wordpress-pricing-table-plugin">Upgrade To Premium</a>
        </div>
        <p class="wppt-mb-p">If you like WordPress Pricing Table please leave us a <b style="color: #E6B800;">★★★★★</b> rating. <b>THANKS</b> in advance!</p>
        <div style="margin: 20px 0px;">
            <a class="wppt-btn btn-rate" target="_blank" href="http://wordpress.org/support/view/plugin-reviews/pricing-table?rate=5#postform">Rate Now</a>       
        </div>
        <p class="wppt-mb-p">Need Help? We are happy to answer any question you might have.</p>
        <div style="margin: 20px 0px;">
            <a class="wppt-btn btn-suprt" target="_blank" href="http://wpeden.com/forums/forum/general-questions/">Create a Topic</a>       
        </div>
    </div>
    
    <?php
}

function wppt_info_metabox() {
    add_meta_box( 'pricing-table-info-metabox',
                  'Pricing Table Quick Links', 
                  'wppt_info_metabox_html', 
                  'pricing-table', 
                  'side',
                  'default' 
                );
}
add_action( 'add_meta_boxes', 'wppt_info_metabox');

add_action( 'add_meta_boxes', 'wppt_add_custom_box');
add_action( 'save_post', 'wppt_save_pricing_table' );  