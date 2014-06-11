<style>
    select{
        display: block !important;
        clear: both !important;
        margin-bottom: 15px !important;
    }
</style>
<div class="wrap">
<div class="icon32" id="icon-tools"><br></div>
<h2>ShortCode Generator</h2> <br>

<fieldset style="width: 200px"><legend>Embed Pricing Table</legend>
<select  id="fl">
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

<select  id="ptt">
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
                echo "<option value='".$file."'>".$file."</option>";
            }
        }
    }
    ?>

</select>
<div id="acolor" class="tplopts" style="display: none;">
    <small>Select Color:</small>
    <select  id="color">
        <option value="">Green</option>
        <option value="blue">Blue</option>
        <option value="red">Red</option>
    </select>
    <input type="checkbox" value="1" id="hdf"> Hide "Feature" label<br/>
    <input type="checkbox" value="1" id="hdd"> Hide "Details" row<br/>
    <input type="checkbox" value="1" id="hdr"> Hide "Price" row<br/>
</div>
<div id="rock_styles" class="tplopts" style="display: none;">
    <div >
        <b>Skins &amp; Styles</b><br/>
        <input type="checkbox" value="flat" class="pptc"> Flat<br>
        <input type="checkbox" value="singular-head" class="pptc"> Similar Header<br>
        <input type="checkbox" value="hover-effect" class="pptc"> Hover Effect<br>
        <input type="checkbox" value="long-shadow" class="pptc"> Long Shadow<br>
        <input type="checkbox" value="skin-smooth" class="pptc"> Smooth<br>
        <input type="checkbox" value="arrowed" class="pptc"> Arrowed<br>
    </div><div >
        <strong>Style</strong><br>
        <input type="radio" value="style-1" name="style" class="pptc"> Style 1<br>
        <input type="radio" value="style-2" name="style" class="pptc"> Style 2<br>
        <input type="radio" value="style-3" name="style" class="pptc"> Style 3<br>
        <input type="radio" value="style-2 style-3" name="style" class="pptc"> Style 4<br>
    </div><div >
        <strong>Color</strong><br>
        <input type="radio" value="default" name="color" class="pptc"> Default<br>
        <input type="radio" value="skin-blue" name="color" class="pptc"> Blue<br>
        <input type="radio" value="skin-dark-blue" name="color" class="pptc"> Dark Blue<br>
        <input type="radio" value="skin-coffee" name="color" class="pptc"> Coffee<br>
        <input type="radio" value="skin-green" name="color" class="pptc"> Green<br>
        &nbsp;<br>
    </div><div style="clear: both"></div>
    <script>
        var scc = "";
        jQuery(function(){
            jQuery('.pptc').on('click',function(){
                var cls = "";
                jQuery('.pptc').each(function(){
                    // if(!this.checked) jQuery('#shaon-pricing-table').removeClass(jQuery(this).val());
                });
                jQuery('.pptc').each(function(){
                    if(this.checked) scc += jQuery(this).val()+ " ";
                    //jQuery('#shaon-pricing-table').addClass(jQuery(this).val());
                });});
        });
    </script>

</div>
<div id="mega_styles" class="tplopts" style="display: none;">
    <small>Style:</small>
    <select  id="mccolor">
        <option value="2">--Select Style--</option>
        <option value="1">Style 1</option>
        <option value="2">Style 2</option>
        <option value="3">Style 3</option>
        <option value="4">Style 4</option>
        <option value="5">Style 5</option>
        <option value="6">Style 6</option>
        <option value="7">Style 7</option>
        <option value="8">Style 8</option>
        <option value="9">Style 9</option>
    </select>

</div>
<div id="override_styles" class="tplopts" style="display: none;">
    <small>Style:</small>
    <select  id="mccolor">
        <option value="1">--Select Style--</option>
        <option value="1">Style 1 (Black)</option>
        <option value="2">Style 2 (Orange)</option>
        <option value="3">Style 3 (Red)</option>
        <option value="4">Style 4 (Gray-Red)</option>
        <option value="5">Style 5 (Mixed Colors)</option>
        <option value="6">Style 6 (Red-Orange)</option>
        <option value="7">Style 7 (Mixed Colors)</option>
        <option value="8">Style 8 (Yellow-Red)</option>
        <option value="9">Style 9 (Green-StepUp)</option>
        <option value="10">Style 10 (Blue-StepUp)</option>
        <option value="11">Style 11 (Orange-StepUp)</option>
        <option value="12">Style 12 (Mixed Colors)</option>
    </select>

</div>

<div id="lucid_styles" class="tplopts" style="display: none;">
    <small>Style:</small>
    <select  id="lucid_mccolor">
        <option value="1">--Select Style--</option>
        <option value="1">Style 1 </option>
        <option value="2">Style 2 </option>
        <option value="3">Style 3 </option>
        <option value="4">Style 4 </option>
        <option value="5">Style 5 </option>
        <option value="6">Style 6 </option>
        <option value="7">Style 7 </option>
        <option value="8">Style 8 </option>
        <option value="9">Style 9 </option>
        <option value="10">Style 10 </option>
    </select>

</div>

<div id="radiance_styles" class="tplopts" style="display: none;">
    <small>Style:</small>
    <select  id="radiance_mccolor">
        <option value="1">--Select Style--</option>
        <option value="1">Style 1 </option>
        <option value="2">Style 2 </option>
        <option value="3">Style 3 </option>
        <option value="4">Style 4 </option>
        <option value="5">Style 5 </option>
        <option value="6">Style 6 </option>
        <option value="7">Style 7 </option>
        <option value="8">Style 8 </option>
        <option value="9">Style 9 </option>
    </select>

</div>

<div id="epic_styles" class="tplopts" style="display: none;">
    <small>Style:</small>
    <select  id="epic_mccolor">
        <option value="1">--Select Style--</option>
        <option value="1">Style 1 </option>
        <option value="2">Style 2 </option>
        <option value="3">Style 3 </option>
        <option value="4">Style 4 </option>
        <option value="5">Style 5 </option>
        <option value="6">Style 6 </option>
        <option value="7">Style 7 </option>
        <option value="8">Style 8 </option>
        <option value="9">Style 9 </option>
    </select>

</div>


<div id="prices_color" class="tplopts" style="display: none;">
    <small>Select Regular Column Color:</small>
    <select  id="rccolor">
        <option value="">--Select Color--</option>
        <option value="bronze">Bronze</option>
        <option value="blue">Blue</option>
        <option value="brown">Brown</option>
        <option value="red">Red</option>
        <option value="cyan">Cyan</option>
        <option value="gold">Gold</option>
        <option value="green">Green</option>
        <option value="grey">Grey</option>
        <option value="magenta">Magenta</option>
        <option value="orange">Orange</option>
        <option value="purple">Purple</option>
        <option value="silver">Silver</option>
        <option value="yellow">Yellow</option>
    </select>
    <small>Select Featured Column Color:</small>
    <select  id="fccolor">
        <option value="">--Select Color--</option>
        <option value="bronze">Bronze</option>
        <option value="blue">Blue</option>
        <option value="brown">Brown</option>
        <option value="red">Red</option>
        <option value="cyan">Cyan</option>
        <option value="gold">Gold</option>
        <option value="green">Green</option>
        <option value="grey">Grey</option>
        <option value="magenta">Magenta</option>
        <option value="orange">Orange</option>
        <option value="purple">Purple</option>
        <option value="silver">Silver</option>
        <option value="yellow">Yellow</option>
    </select>
</div>
<input type="checkbox" id="respo" value="1" name="respo">    Fluid-Width
<input type="submit" id="addtopost" class="button button-primary" name="addtopost" value="Insert into post" />
</fieldset>   <br>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
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
        if(scc!='' && jQuery('#ptt').val()=='rock') tstyle = 'skin="'+scc+'" style=""';
        if(jQuery('#fccolor').val()!='') fccolor = 'fccolor="'+jQuery('#fccolor').val()+'"';
        if(jQuery('#mccolor').val()!='') tstyle = 'style="'+jQuery('#mccolor').val()+'"';
        if(jQuery('#lucid_mccolor').val()!=''&&jQuery('#ptt').val()=='lucid') tstyle = 'style="'+jQuery('#lucid_mccolor').val()+'"';
        if(jQuery('#radiance_mccolor').val()!=''&&jQuery('#ptt').val()=='radiance') tstyle = 'style="'+jQuery('#radiance_mccolor').val()+'"';
        if(jQuery('#epic_mccolor').val()!=''&&jQuery('#ptt').val()=='epic') tstyle = 'style="'+jQuery('#epic_mccolor').val()+'"';

        win.send_to_editor('[ahm-pricing-table id='+jQuery('#fl').val()+' template='+jQuery('#ptt').val()+' '+tstyle+' '+color+' '+hide+' '+respo+' '+rccolor+' '+fccolor+']');
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

</div>