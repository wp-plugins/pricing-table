<?php


 
add_filter('mce_external_plugins', "wppt_tinyplugin_register");
add_filter('mce_buttons', 'wppt_tinyplugin_add_button', 0);
 
function wppt_tinyplugin_add_button($buttons)
{
    array_push($buttons, "separator", "wppt_tinyplugin");
    return $buttons;
}

function wppt_tinyplugin_register($plugin_array)
{
    $url = plugins_url("/pricing-table/js/ext/editor_plugin.js");

    $plugin_array['wppt_tinyplugin'] = $url;
    return $plugin_array;
}


function wppt_free_tinymce(){
    global $wpdb;
    if(!isset($_GET['wppt_action']) || $_GET['wppt_action']!='wppt_tinymce_button') return false;
    ?>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title>Pricing Table &#187; Insert Table</title>
<style type="text/css">
*{font-family: Tahoma !important; font-size: 9pt; letter-spacing: 1px;}
select,input{padding:5px;font-size: 9pt !important;font-family: Tahoma !important; letter-spacing: 1px;margin:5px;}
.button{
    background: #7abcff; /* old browsers */

background: -moz-linear-gradient(top, #7abcff 0%, #60abf8 44%, #4096ee 100%); /* firefox */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7abcff), color-stop(44%,#60abf8), color-stop(100%,#4096ee)); /* webkit */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* ie */
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
border:1px solid #FFF;
color: #FFF;
}
 
.input{
 width: 340px;   
 background: #EDEDED; /* old browsers */

background: -moz-linear-gradient(top, #EDEDED 24%, #fefefe 81%); /* firefox */

background: -webkit-gradient(linear, left top, left bottom, color-stop(24%,#EDEDED), color-stop(81%,#fefefe)); /* webkit */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#EDEDED', endColorstr='#fefefe',GradientType=0 ); /* ie */
border:1px solid #aaa; 
color: #000;
}
.button-primary{cursor: pointer;}
fieldset{padding: 10px;}
select{
    clear: both;
    display: block;
}
</style> 
</head>
<body>    <br>

<fieldset><legend>Embed Pricing Table</legend>
    <select class="button input" id="fl">
    <?php
    query_posts('post_type=pricing-table&posts_per_page=1000');
    
    while(have_posts()){ the_post();
   // foreach($res as $row){
    ?>
    
    <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
    
    
    <?php    
        
    }
?>
    </select>
    Select Template
    
        <select class="button input" id="ptt"> 
        <?php
    
$directory = "../wp-content/plugins/pricing-table/table-templates";

$directory_list = opendir($directory);
while (FALSE !== ($file = readdir($directory_list))){
            // if the filepointer is not the current directory
            // or the parent directory
            if($file != '.' && $file != '..'){
                // we build the new path to scan
                $path = $directory.'/'.$file;
                 if(is_dir($path)){
                     $style = $file=='rock'?"style='font-weight:bold;background: #ECD7F7;'":"";
                     $file_label = ucwords(str_replace("-"," ", $file));
                     echo "<option value='".$file."' $style>".$file_label."</option>";
                 }
            }
}
    ?>
         
        </select>
   <div id="acolor" class="tplopts" style="display: none;">
   <small>Select Color:</small>
   <select class="button input" id="color">
   <option value="">Green</option>
   <option value="blue">Blue</option>
   <option value="red">Red</option>
   </select>
   <input type="checkbox" value="1" id="hdf"> Hide "Feature" label<br/>
   <input type="checkbox" value="1" id="hdd"> Hide "Details" row<br/>
   <input type="checkbox" value="1" id="hdr"> Hide "Price" row<br/>
   </div>  
   <div id="rock_styles" class="tplopts" style="display: none;">
       <div><em>Options are available in pro only!</em></div>
       <div style="width: 180px;float: left">
           <strong>Color</strong><br>
           <input type="radio" value="default" disabled="disabled" title="Available in pro only" name="color" class="pptc"> Default<br>
           <input type="radio" value="skin-blue" disabled="disabled" title="Available in pro only" name="color" class="pptc"> Blue<br>
           <input type="radio" value="skin-dark-blue" disabled="disabled" title="Available in pro only" name="color" class="pptc"> Dark Blue<br>
           <input type="radio" value="skin-coffee" disabled="disabled" title="Available in pro only" name="color" class="pptc"> Coffee<br>
           <input type="radio" value="skin-green" disabled="disabled" title="Available in pro only" name="color" class="pptc"> Green<br>
           &nbsp;<br>
       </div>
<div style="width: 180px;float: left">
           <b>Skins &amp; Styles</b><br/>
            <input type="checkbox" value="flat" disabled="disabled" title="Available in pro only" class="pptc"> Flat<br>
               <input type="checkbox" value="singular-head" disabled="disabled" title="Available in pro only" class="pptc"> Similar Header<br>
               <input type="checkbox" value="hover-effect" disabled="disabled" title="Available in pro only" class="pptc"> Hover Effect<br>
               <input type="checkbox" value="long-shadow" disabled="disabled" title="Available in pro only" class="pptc"> Long Shadow<br>
               <input type="checkbox" value="skin-smooth" disabled="disabled" title="Available in pro only" class="pptc"> Smooth<br>
               <input type="checkbox" value="arrowed" disabled="disabled" title="Available in pro only" class="pptc"> Arrowed<br>
</div><div style="width: 180px;float: left">
               <strong>Style</strong><br>
               <input type="radio" value="style-1" name="style" disabled="disabled" title="Available in pro only" class="pptc"> Style 1<br>
               <input type="radio" value="style-2" name="style" disabled="disabled" title="Available in pro only" class="pptc"> Style 2<br>
               <input type="radio" value="style-3" name="style" disabled="disabled" title="Available in pro only" class="pptc"> Style 3<br>
               <input type="radio" value="style-2 style-3" disabled="disabled" title="Available in pro only" name="style" class="pptc"> Style 4<br>
       </div><div style="clear: both"></div>

       <div style="margin:8px;padding: 10px;border: 1px solid #eeeeee">
           <label><input type="checkbox" id="paypal" value="1" disabled="disabled" title="Available in pro only"> Use PayPal</label><br/>

       </div>

   </div>

   <div id="override_styles" class="tplopts" style="display: none;">
        <small>Style:</small>
       <select class="button input" id="mccolor">
       <option value="1">--Select Style--</option>
       <option value="1">Style 1 (Black)</option>
       <option value="2" disabled="disabled">Style 2 (Orange)</option>
       <option value="3" disabled="disabled">Style 3 (Red)</option>
       <option value="4" disabled="disabled">Style 4 (Gray-Red)</option>
       <option value="5" disabled="disabled">Style 5 (Mixed Colors)</option>
       <option value="6" disabled="disabled">Style 6 (Red-Orange)</option>
       <option value="7" disabled="disabled">Style 7 (Mixed Colors)</option>
       <option value="8" disabled="disabled">Style 8 (Yellow-Red)</option>
       <option value="9" disabled="disabled">Style 9 (Green-StepUp)</option>
       <option value="10" disabled="disabled">Style 10 (Blue-StepUp)</option>
       <option value="11" disabled="disabled">Style 11 (Orange-StepUp)</option>
       <option value="12" disabled="disabled">Style 12 (Mixed Colors)</option>
       </select>
       
   </div>


    <input type="submit" id="addtopost" class="button button-primary" name="addtopost" value="Insert into post" />
</fieldset>   <br>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo home_url('/wp-includes/js/tinymce/tiny_mce_popup.js'); ?>"></script>
                <script type="text/javascript">
                    /* <![CDATA[ */    
                    jQuery.noConflict();
                    function script_init(){
                  
                        switch(jQuery('#ptt').val()){
                            case "override":
                                jQuery('.tplopts').slideUp();
                                jQuery('#override_styles').slideDown(); 
                                jQuery('#rccolor').val('');
                                jQuery('#fccolor').val(''); 
                            break; 
                            case "mega":
                                jQuery('.tplopts').slideUp();
                                jQuery('#mega_styles').slideDown(); 
                                jQuery('#rccolor').val('');
                                jQuery('#fccolor').val(''); 
                            break; 
                            case "light":
                                jQuery('.tplopts').slideUp(); 
                                jQuery('#acolor').slideDown();
                                jQuery('#rccolor').val('');
                                jQuery('#fccolor').val('');
                            break;
                            case "dark":
                                jQuery('.tplopts').slideUp();    
                                jQuery('#prices_color').slideDown();
                            break;
                            case "lucid":
                                jQuery('.tplopts').slideUp();
                                jQuery('#lucid_styles').slideDown();
                            break;
                            case "radiance":
                                jQuery('.tplopts').slideUp();
                                jQuery('#radiance_styles').slideDown();
                            break;
                            case "epic":
                                jQuery('.tplopts').slideUp();
                                jQuery('#epic_styles').slideDown();
                                break;
                            case "rock":
                                jQuery('.tplopts').slideUp();
                                jQuery('#rock_styles').slideDown();
                                break;
                            default:
                                jQuery('.tplopts').slideUp();    
                            break;
                        }
                    }
                    window.onload = script_init();
                    jQuery(function(){
                      jQuery('#ptt').change(function(){
                        script_init();
                       })  ; 
                        
                    });

                    var scc = '';
                    jQuery('.pptc').on('click',function(){
                        var cls = "";
                        scc = '';
                        jQuery('.pptc').each(function(){
                            // if(!this.checked) jQuery('#shaon-pricing-table').removeClass(jQuery(this).val());
                        });
                        jQuery('.pptc').each(function(){
                            if(this.checked) scc += jQuery(this).val()+ " ";
                            //jQuery('#shaon-pricing-table').addClass(jQuery(this).val());
                        });});

                    jQuery('#addtopost').click(function(){
                    var win = window.dialogArguments || opener || parent || top;                
                    var respo='', color = '',hide='';
                    if(jQuery('#color').val()!='') color = 'color="'+jQuery('#color').val()+'"';
                    if(jQuery('#respo').attr('checked')) respo = 'responsive=true';
                    if(jQuery('#hdf').attr('checked')) hide ="FeatureHeader|";
                    if(jQuery('#hdd').attr('checked')) hide +="Detail|";
                    if(jQuery('#hdr').attr('checked')) hide +="Price";
                    if(hide!='') hide = 'hide="'+hide+'"';
                    
                    var rccolor="",fccolor="", tstyle = "";
                    if(jQuery('#rccolor').val()!='') rccolor = 'rccolor="'+jQuery('#rccolor').val()+'"';
                    if(jQuery('#fccolor').val()!='') fccolor = 'fccolor="'+jQuery('#fccolor').val()+'"';
                    if(jQuery('#mccolor').val()!='') tstyle = 'style="'+jQuery('#mccolor').val()+'"';
                    if(jQuery('#lucid_mccolor').val()!=''&&jQuery('#ptt').val()=='lucid') tstyle = 'style="'+jQuery('#lucid_mccolor').val()+'"';
                    if(jQuery('#radiance_mccolor').val()!=''&&jQuery('#ptt').val()=='radiance') tstyle = 'style="'+jQuery('#radiance_mccolor').val()+'"';
                    if(jQuery('#epic_mccolor').val()!=''&&jQuery('#ptt').val()=='epic') tstyle = 'style="'+jQuery('#epic_mccolor').val()+'"';

                    if(scc!='' && jQuery('#ptt').val()=='rock') tstyle = 'skin="'+scc+'" style=""';
                    if(jQuery('#ptt').val()=='rock' && jQuery('#paypal').is(':checked')) respo = ' paypal_button=1 ';

                    win.send_to_editor('[ahm-pricing-table id='+jQuery('#fl').val()+' template='+jQuery('#ptt').val()+']');
                    tinyMCEPopup.close();
                    return false;                   
                    });
                    
                    /*
                    jQuery('#addtopostc').click(function(){
                    var win = window.dialogArguments || opener || parent || top;                
                    win.send_to_editor('{wppt_category='+jQuery('#flc').val()+'}');                   
                    tinyMCEPopup.close();
                    return false;                   
                    });  
                    */          
                  
                </script>

</body>    
</html>
    
    <?php
    
    die();
}
 

add_action('init', 'wppt_free_tinymce');

