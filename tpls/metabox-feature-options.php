<script type="text/javascript" src="<?php echo plugins_url(); ?>/pricing-table/js/admin/jquery.tablednd_0_5.js"></script>
<script>   
    jQuery(document).ready(function() {
    // Initialise the table
    jQuery("#pricetable").tableDnD({dragHandle: "dh"});    
    });
    jQuery("#pricetable tr").hover(function() {
        jQuery(this.cells[0]).addClass('showDragHandle');
    }, function() {
        jQuery(this.cells[0]).removeClass('showDragHandle');
    });
    jQuery('body').on('click', '.deleterow', function() {
        if(confirm("Are you sure you want to delete?")){            
            jQuery("."+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});         
            }
    });
    jQuery('body').on('click','.deletecol', function() {
        if(confirm("Are you sure you want to delete?")){            
            jQuery("."+jQuery(this).attr('rel')).remove();         
        }
    });
 
    jQuery('body').on('click', '.featured-package', function() {
        var fid=jQuery(this).attr("id");
        var isf = jQuery('#'+fid).attr('src');
        jQuery('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png');
        if(isf!="<?php echo plugins_url(); ?>/pricing-table/images/featured.png") {
            jQuery('#'+fid).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
            jQuery('#featured').val(jQuery('#'+fid).attr("rel"));
        } else {
            jQuery('#featured').val('');    
        }
    });
 
    jQuery('body').on('click', '.featured-package-edit', function() {
        var sptd=jQuery(this).attr("rel");
        var ppname=trim(jQuery('#'+sptd).text());

        var pname=prompt("Edit Package Name:",ppname);
        pname=trim(pname); 
        while(pname.length==0 ){
            pname=prompt("Edit Package Name");
            pname=trim(pname);    
        }
        jQuery('#'+sptd).text(pname);
        jQuery('#val_'+sptd.substr(2)).val(pname);   
    });
 
 
    jQuery('body').on('click', '.feature-edit', function() {
        var sptd=jQuery(this).attr("rel");
        var ppname=trim(jQuery('#'+sptd).text());
     
        var pname=prompt("Edit Feature Name:",ppname);
        pname=trim(pname); 
        while(pname.length==0 ){
            pname=prompt("Edit Feature Name");
            pname=trim(pname);    
        }
        jQuery('#'+sptd).text(pname);    
        jQuery('#val_'+sptd.substr(2)).val(pname);   
    });
 
    jQuery('body').on('click', '.feature-desc-edit', function() {
        var sptd=jQuery(this).attr("rel");
        var ppname=trim(jQuery('#'+sptd).val());
     
        var pname=prompt("Edit Feature Description:",ppname);
        pname=trim(pname); 
        while(pname.length==0 ){
            pname=prompt("Edit Feature Description");
            pname=trim(pname);    
        }
        jQuery('#'+sptd).val(pname);
        //alert(jQuery('#'+sptd).text(pname));
        jQuery('#val_desc_'+sptd.substr(3)).val(pname);    
    });
 
 </script>
 <style>
    #pricetable tr:nth-child(odd){
        background: #f5f5f5;
    }
</style>
 
<?php
    
    $data = get_post_meta($post->ID, 'pricing_table_opt',true); 
    $data_des = get_post_meta($post->ID, 'pricing_table_opt_description',true); 
    if(!is_array($data_des)) $data_des = array();
    $featured = get_post_meta($post->ID, 'pricing_table_opt_feature',true); 
    $feature_name = get_post_meta($post->ID, 'pricing_table_opt_feature_name',true);
    $feature_description = get_post_meta($post->ID, 'pricing_table_opt_feature_description',true);
    $package_name = get_post_meta($post->ID, 'pricing_table_opt_package_name',true); 
     
?>

<div style="width: 100%;float:left;margin-right: 25px;overflow: auto;">
              
 <table style="display: inline-table;">
 <tr><td></td><td></td></tr>
 <tr><td>
 <table id="pricetable" class="draggable widefat" border="0" width="100%" cellspacing="0" cellpadding="0" >
        
   <tr class="nodrag nodrop">
      <td class="frow">
        Packages/Features
      </td>  
      <input type="hidden" id="featured" name="featured" value="<?php echo $featured;?>">   
      <?php  
    $pkeys=@array_keys($package_name);

    $cnt=count($pkeys);   
    if($cnt > 0 ){
        $imgc=0;
        
    foreach($package_name as $index=> $value){ 
        $imgc++;
        if($featured==$value)$fimg="featured.png";else $fimg="unfeatured.png";

        $package_key=str_replace(" ","",$value);
        echo  '<td class="'.$index.'"><img src="'. plugins_url().'/pricing-table/images/delete.png" class="deletecol" rel="'.$index.'" title="Delete this column" />
        <strong><span id="sp'.$index.'">
        '.$value.'
        </span>
        </strong>
        <input type="hidden" name="package_name['.$index.']" id="val_'.$index.'" value="'.$value.'" />
        <img rel="'.$value.'"  id="f'.$imgc.'" class="featured-package" title="click here to feature" src="'. plugins_url().'/pricing-table/images/'.$fimg.'">
      <img rel="sp'.$index.'"  id="e'.$index.'" class="featured-package-edit" title="click here to edit" src="'. plugins_url().'/pricing-table/images/edit.png"  /> 
      </td>';
    }
    }
?>
   </tr>    
    <?php
    $fkeys = @array_keys($feature_name);
    $cnt = @count($data[$pkeys[0]]);
    if( is_array($fkeys) ){ 
    foreach($feature_name as $index1=> $value1){

        $feature_key = str_replace(" ","",$value1);
        if(in_array($value1, array('Price','Detail','ButtonURL','ButtonText'))) $class='nodrag nodrop';
        else $class='';  
        echo "<tr class='{$index1} $class'>";
        $t = 0;
        foreach($package_name as $index => $value){
            $package_key=str_replace(" ","",$value);
            $t++;
            if($t==1){
                $dh = '';
                if($class=='') $dh = 'dh';
                echo "<td  class='".$index1." $dh'>";
                if($value1 != "Price" && $value1!="Detail" && $value1!="ButtonURL" && $value1!="ButtonText" ){
                    
                    echo '<img class="rdndHandler" src="'.plugins_url().'/pricing-table/images/updown.png" />';
                    echo '<img rel="sf'.$index1.'"  id="e'.$index1.'" class="feature-edit" title="click here to edit Feature Name" src="'. plugins_url().'/pricing-table/images/edit.png"> ';
                    echo '<img rel="sfd'.$index1.'"  id="ed'.$index1.'" class="feature-desc-edit" title="click here to edit Feature Description" src="'. plugins_url().'/pricing-table/images/edit-desc.png"> ';
                    echo "<img src='". plugins_url()."/pricing-table/images/delete.png' class='deleterow' rel='{$index1}' title='Delete this row' /><br/>";
                }
                echo ' <input type="hidden" name="feature_name['.$index1.']" id="val_'.$index1.'" value="'.$value1.'" />';
                $tvs = !isset($feature_description[$index1])?"":$feature_description[$index1];
                echo ' <input type="hidden" name="feature_description['.$index1.']" id="val_desc_'.$index1.'" value="'.$tvs.'" />';
                if($value1=='Detail')
                echo "<strong><span id='sf".$index1."'>Package Description</span></strong>";
                else
                echo "<strong><span id='sf".$index1."'>"."{$value1}"."</span></strong>";
                
                if($value1 != "Price" && $value1!="Detail" && $value1!="PackageDescription" && $value1!="ButtonURL" && $value1!="ButtonText" ){ 
                    echo "<input type='hidden' name='' id='sfd".$index1."' value='".$feature_description[$index1]."'/>";
                } 
                echo "</td>";
            }
            //for making detail into package description
            //if($index1=="Detail")$nindex="PackageDescription";else $nindex=$index1;
            
            echo  '<td class="'.$index.'"><input type="text" class="t" id="features['.$index.']['.$index1.']" name="features['.$index.']['.$index1.'] " value="'
            .$data[$index][$index1].'" >';
            if(!in_array($index1, array('Price','Detail','ButtonURL'))){
            echo '<input class="d" placeholder="Tooltip Text" type="text" id="features_description['.$index.']['.$index1.']" name="features_description['.$index.']['.$index1.'] " value="'.$data_des[$index][$index1].'" />';
            }
            echo '</td>';
        }
        echo "</tr>";  
    }
    }else{
        ?>
        <tr class="nodrag nodrop" style="cursor: default;">
      <td class="Price">
        <strong>Price</strong> <input type="hidden" name="feature_name[Price]" id="feature_name['Price']" value="Price">
      </td>
      </tr>
      <tr class="nodrag nodrop" style="cursor: default;">
      <td class="Detail">
        <strong>Package Description</strong>   <input type="hidden" name="feature_name[Detail]" id="feature_name['Detail']" value="Detail">
      </td>
      </tr>
      <tr class="nodrag nodrop" style="cursor: default;">
      <td class="ButtonURL">
         <strong>Button URL</strong> <input type="hidden" name="feature_name[ButtonURL]" id="feature_name['ButtonURL']" value="ButtonURL">
      </td>
      </tr>
      <tr class="nodrag nodrop" style="cursor: default;">
      <td class="ButtonText">
         <strong>Button Text </strong> <input type="hidden" name="feature_name[ButtonText]" id="feature_name['ButtonText']" value="ButtonText">
      </td>
      </tr>
        <?php
        
    }
?>
   
</table></td><td valign="top" class="apcl"><a style="float: right;" href="#"  class="add-package" id="addcolumn">Add Package</a></td></tr>
 <tr><td class="afr"><a href="#" class="add-feature" id="addrow">Add Feature</a>  </td><td></td></tr>
 </table> <br /><br />      
<table class="widefat">
<thead>
<tr>
<th colspan="2">
PayPal Setting ( Only "rock" template supports paypal )
</th>
</tr>
</thead>
<tr>
<td>
Return URL
</td>
<td>
<input size="80" type="text" placeholder="Available in pro only!" disabled="disabled" name="__wppt_returnurl" id="__wppt_returnurl" value="<?php echo get_post_meta($post->ID, '__wppt_returnurl',true);  ?>">
</td>
</tr>
<tr>
<td>
Cancel URL
</td>
<td>
<input size="80" type="text" placeholder="Available in pro only!" disabled="disabled" name="__wppt_cancelurl" id="__wppt_cancelurl" value="<?php echo get_post_meta($post->ID, '__wppt_cancelurl',true);  ?>">
</td>
</tr>
<tr>
<td>
Currency Code
</td>
<td>
<input size="80" type="text" placeholder="Available in pro only!" disabled="disabled" name="__wppt_currency_code" id="__wppt_currency_code" value="<?php echo get_post_meta($post->ID, '__wppt_currency_code',true);  ?>">
</td>
</tr>
    <tr>
<td>
PayPal Account Email
</td>
<td>
<input size="80" type="text" placeholder="Available in pro only!" disabled="disabled" name="__wppt_business" id="__wppt_business" value="<?php echo get_post_meta($post->ID, '__wppt_business',true);  ?>">
</td>
</tr>


</table><br /><br />

<!-- <table class="widefat">
     <thead>
     <tr>
         <th colspan="2">
             Alternate Labels
         </th>
     </tr>
     </thead>
     <tr>
         <td>
             Label for "Feature"
         </td>
         <td>
             <input size="80" type="text" name="alt_feature" id="alt_feature" value="<?php echo get_post_meta($post->ID, 'alt_feature',true);  ?>">
         </td>
     </tr>
     <tr>
         <td>
             Label for "Price"
         </td>
         <td>
             <input size="80" type="text" name="alt_price" id="alt_price" value="<?php echo get_post_meta($post->ID, 'alt_price',true);  ?>">
         </td>
     </tr>
     <tr>
         <td>
             Label for "Package Description"
         </td>
         <td>
             <input size="80" type="text" name="alt_detail" id="alt_detail" value="<?php echo get_post_meta($post->ID, 'alt_detail',true);  ?>">
         </td>
     </tr>
 </table>-->

     <script language="JavaScript">   
      function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
    }


    jQuery(function(){
      jQuery('#addrow').click(function(){
          
          var feat;
          feat=prompt("Feature Name:");   //alert(feat); 
          feat=trim(feat);  
          while(feat.length==0 ){
               feat=prompt("Feature Name:");
               feat=trim(feat);    
          }
          var tmp_fid = "ftr_"+new Date().getTime();
          $ftr_info = "<span id='sf"+tmp_fid+"'>"+feat+"</span><br/><input type='hidden' name='feature_name["+tmp_fid+"]' value='"+feat+"'/><input type=hidden id='val_desc_"+tmp_fid+"' class='d' placeholder='Tooltip Text' name='feature_description["+tmp_fid+"]' value=''/>"; 
          
           jQuery('#pricetable tbody tr:last').clone(true).insertAfter('#pricetable tbody>tr:last');
              
            
           
           var ht="";
           
           jQuery("#pricetable tbody tr:last").find("td").each(function() {
               
               
               var ccl,pos1;
               var nclassname="";
               ccl=jQuery(this).attr("class");
               ccl=trim(new String(ccl));
               
               pos1= ccl.indexOf(" ");
               
               if(pos1 != -1){
                  nclassname=ccl.substr(0,pos1+1);                   
               }
               nclassname += tmp_fid;
               
               jQuery(this).attr("class",nclassname);
               ht= jQuery(this).find('input.t').attr('name');
               ht=new String(ht); 
               if(ht != "undefined"){
                   var pos= ht.indexOf("]");  
                   var cnam=ht.substr(0,pos+1);
                   var nnam=cnam+"["+tmp_fid+"]"; 
                   jQuery(this).find('input.t').attr("name",nnam);
                   jQuery(this).find('input.t').attr("id",nnam);
                   
               } 
               htd= jQuery(this).find('input.d').attr('name');
   
               htd=new String(htd); 
               if(htd != "undefined"){
                   var posd= htd.indexOf("]");  
                   var cnamd=htd.substr(0,posd+1);
                   var nnamd=cnamd+"["+tmp_fid+"]"; 
                   
                   jQuery(this).find('input.d').attr("name",nnamd);
                   jQuery(this).find('input.d').attr("id",nnamd);
                   
               } 
               
           });
           
             
           jQuery('#pricetable tbody tr:last td:first').html('<img class="rdndHandler" src="<?php echo plugins_url();?>/pricing-table/images/updown.png" /><img rel="sf'+tmp_fid+'"  id="e'+tmp_fid+'" class="feature-edit" title="click here to edit Feature Name" src="<?php echo plugins_url();?>/pricing-table/images/edit.png"><img rel="val_desc_'+tmp_fid+'"  id="ed'+tmp_fid+'" class="feature-desc-edit" title="Click here to edit Feature Description" src="<?php echo plugins_url();?>/pricing-table/images/edit-desc.png"><img src="<?php echo plugins_url();?>/pricing-table/images/delete.png" class="deleterow" title="Delete this row" /><br/>');
           jQuery('#pricetable tbody tr:last td:first').append($ftr_info); 
           jQuery('#pricetable tbody tr:last td:first').css("font-weight","bold"); 
           jQuery('#pricetable tbody tr:last td:first').attr("class",tmp_fid);
           jQuery('#pricetable tbody tr:last').attr("class",tmp_fid);
           jQuery('#pricetable tbody tr:last td:first .deleterow').attr("rel",tmp_fid);
           //jQuery('.add-feature').css('width',jQuery('.Price').width());   
           return false;    
      });
     
     
      jQuery('#addcolumn').click(function(){
           var cid = 1; 
          
          //check whether any features exists or not. if no feature then create feature first
          //alert(jQuery('#pricetable tbody tr:last td:first').html());
          if(trim(jQuery('#pricetable tbody tr:last td:first').html())=="Packages/Features"){
              alert("Create Features first");
          }else{
              var package=prompt("Package Name:");
              package=trim(package); 
              while(package.length==0 ){
                   package=prompt("Package Name:");
                   package=trim(package);    
              }
              
               var tmp_pid = "pkg_"+new Date().getTime();
               
               var htm;  
              jQuery("#pricetable").find("tr").each(function() {
                  //alert(jQuery(this).find('td:first').html());
              
               var rw="";
               rw= jQuery(this).find('td:first').attr("class");
               //alert(rw);
               
               htm="features["+tmp_pid+"]["+rw+"]"; 
               htm_desc="features_description["+tmp_pid+"]["+rw+"]"; 
               jQuery(this).find('td:last').after( '<td ></td>' ); 
               jQuery(this).find('td:last').addClass(tmp_pid + " "+ rw.replace(" ",""));
               if(trim(jQuery(this).find('td:first').html())!="Packages/Features"){                          
                    jQuery(this).find('td:last').append('<input  name="'+htm+'" class="t" type="text" >'); 
                    if(jQuery.trim(rw) != "Price" && jQuery.trim(rw) != "Detail" && jQuery.trim(rw) != "ButtonURL"){
                         
                        jQuery(this).find('td:last').append('<br/><input  name="'+htm_desc+'" class="d" placeholder="Tooltip Text" type="text" >');                   
                    }
                     cid++; 
                      
               }         
               });
               
              
               $pkg_info = "<span id='sp"+tmp_pid+"'>"+package+"</span><input type=hidden name='package_name["+tmp_pid+"]' value='"+package+"'/>"; 
               jQuery('#pricetable tbody tr:first td:last').html($pkg_info); 
               jQuery('#pricetable tbody tr:first td:last').append("<img class='deletecol' rel='"+tmp_pid+"' title='Delete this row' src='<?php echo plugins_url();?>/pricing-table/images/delete.png' />"); 
               jQuery('#pricetable tbody tr:first td:last').append('<img rel="'+package+'"  id="f'+tmp_pid+'" class="featured-package" title="click here to feature" src="<?php echo plugins_url();?>/pricing-table/images/unfeatured.png" > <img rel="sp'+tmp_pid+'"  id="e'+tmp_pid+'" class="featured-package-edit" title="click here to edit" src="<?php echo plugins_url();?>/pricing-table/images/edit-desc.png"> ');  
               jQuery('#pricetable tbody tr:first td:last').css("font-weight","bold");
               jQuery('#pricetable tbody tr:first td:last').attr("class",tmp_pid);
               jQuery('.add-feature').css('width',jQuery('.Price').width());    
          }
          return false;
    });
      });
    
    </script>
    <br clear="all"> 
    <br clear="all">    
    </div>
    
    <br clear="all">
