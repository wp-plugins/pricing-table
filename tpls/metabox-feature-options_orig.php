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
 jQuery('.deleterow').live('click', function() {   
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
         
    }
 });
 jQuery('.deletecol').live('click', function() {   
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).remove();
         
    }
 });
 
 jQuery('.featured-package').live('click', function() {   
    var fid=jQuery(this).attr("id");
    var isf = jQuery('#'+fid).attr('src');
    jQuery('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png')
    if(isf!="<?php echo plugins_url(); ?>/pricing-table/images/featured.png") {
    jQuery('#'+fid).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
    jQuery('#featured').val(jQuery('#'+fid).attr("rel"));} else {
    jQuery('#featured').val('');    
    }
 });
 
 jQuery('.featured-package-edit').live('click', function() {   
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
 
 
 jQuery('.feature-edit').live('click', function() {   
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
 
 </script>
 
<?php
    $data = get_post_meta($post->ID, 'pricing_table_opt',true);  
    $featured=  get_post_meta($post->ID, 'pricing_table_opt_feature',true); 
    $feature_name=  get_post_meta($post->ID, 'pricing_table_opt_feature_name',true);
    $package_name=  get_post_meta($post->ID, 'pricing_table_opt_package_name',true); 
     
    
?>

<div style="width: 100%;float:left;margin-right: 25px;overflow: auto;">
    
        
        <br>
          
        <br>
        <span style="padding: 5px 0 5px 0;">&nbsp;</span>
 <table style="display: inline-table;">
 <tr><td></td><td></td></tr>
 <tr><td>
 <table id="pricetable" class="draggable" border="0" width="100%" cellspacing="0" cellpadding="0" >
        
   <tr class="nodrag nodrop">
      <td class="frow">
        Packages/Features
      </td>  
      <input type="hidden" id="featured" name="featured" value="<?php echo $featured;?>">   
      <?php  
    $pkeys=@array_keys($package_name);
    //print_r($package_name); 
    $cnt=count($pkeys);   
    if($cnt > 0 ){
        $imgc=0;
        
    foreach($package_name as $index=> $value){ 
        $imgc++;
        if($featured==$value)$fimg="featured.png";else $fimg="unfeatured.png";
        //echo  $fimg;
        
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
   $fkeys=@array_keys($feature_name);
    $cnt=count($data[$pkeys[0]]);
    if( is_array($fkeys) ){ 
    foreach($feature_name as $index1=> $value1){
        $feature_key = str_replace(" ","",$value1);
        if(in_array($value1, array('Price','Detail','ButtonURL','ButtonText'))) $class='nodrag nodrop';
        else $class='';
        echo "<tr class='{$value1} $class'>";
        $t=0;
        foreach($package_name as $index=> $value){
            $package_key=str_replace(" ","",$value);
            $t++;
            if($t==1){
                
                if($class=='') $dh = 'dh';
                echo "<td  class='".$index1." $dh'>";
                if($value1 != "Price" && $value1!="Detail" && $value1!="ButtonURL" && $value1!="ButtonText" ){
                    
                    echo '<img class="rdndHandler" src="'.plugins_url().'/pricing-table/images/updown.png" />';
                    echo '<img rel="sf'.$index1.'"  id="e'.$index1.'" class="feature-edit" title="click here to edit" src="'. plugins_url().'/pricing-table/images/edit.png"> ';
                    echo "<img src='". plugins_url()."/pricing-table/images/delete.png' class='deleterow' rel='{$index1}' title='Delete this row' />";
                }
                    echo ' <input type="hidden" name="feature_name['.$index1.']" id="val_'.$index1.'" value="'.$value1.'" />';
                echo "<strong><span id='sf".$index1."'>"."{$value1}"."</span></strong></td>";
            }
            echo  '<td class="'.$index.' '.$index1.'"><input type="text"  id="features['.$index.']['.$index1.']" name="features['.$index.']['.$index1.'] " value="'
            .$data[$index][$index1].'" >
            
          </td>';
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
        <strong>Detail</strong>   <input type="hidden" name="feature_name[Detail]" id="feature_name['Detail']" value="Detail">
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
   
</table></td><td valign="top"><a style="float: right;" href="#"  class="add-package" id="addcolumn">Add Package</a></td></tr>
 <tr><td><a href="#" class="add-feature" id="addrow">Add Feature</a>  </td><td></td></tr>
 </table>       
<table class="widefat">
<thead>
<tr>
<th colspan="2">
<h3>Alternate Labels</h3>
</th>
</tr>
</thead>
<tr>
<td>
Label for Feature
</td>
<td>
<input type="text" name="alt_feature" id="alt_feature" value="<?php echo get_post_meta($post->ID, 'alt_feature',true);  ?>"> 
</td>
</tr>
<tr>
<td>
Label for price
</td>
<td>
<input type="text" name="alt_price" id="alt_price" value="<?php echo get_post_meta($post->ID, 'alt_price',true);  ?>"> 
</td>
</tr>
<tr>
<td>
Label for detail
</td>
<td>
<input type="text" name="alt_detail" id="alt_detail" value="<?php echo get_post_meta($post->ID, 'alt_detail',true);  ?>"> 
</td>
</tr>


</table>

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
          $ftr_info = "<span id='sf"+tmp_fid+"'>"+feat+"</span><input type=hidden name='feature_name["+tmp_fid+"]' value='"+feat+"'/>"; 
          
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
               ht= jQuery(this).find('input').attr('name');
               ht=new String(ht); 
               if(ht != "undefined"){
                   var pos= ht.indexOf("]");  
                   var cnam=ht.substr(0,pos+1);
                   var nnam=cnam+"["+tmp_fid+"]"; 
                   jQuery(this).find('input').attr("name",nnam);
                   jQuery(this).find('input').attr("id",nnam);
                   
               } 
               
           });
           
           jQuery('#pricetable tbody tr:last td:first').html($ftr_info); 
           jQuery('#pricetable tbody tr:last td:first').css("font-weight","bold");   
           jQuery('#pricetable tbody tr:last td:first').append('<img class="rdndHandler" src="<?php echo plugins_url();?>/pricing-table/images/updown.png" /><img rel="sf'+tmp_fid+'"  id="e'+tmp_fid+'" class="feature-edit" title="click here to edit" src="<?php echo plugins_url();?>/pricing-table/images/edit.png"><img src="<?php echo plugins_url();?>/pricing-table/images/delete.png" class="deleterow" title="Delete this row" />');
           jQuery('#pricetable tbody tr:last td:first').attr("class",tmp_fid);
           jQuery('#pricetable tbody tr:last').attr("class",tmp_fid);
           jQuery('#pricetable tbody tr:last td:first .deleterow').attr("rel",tmp_fid);
           jQuery('.add-feature').css('width',jQuery('.Price').width());   
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
               jQuery(this).find('td:last').after( '<td > &nbsp;</td>' ); 
               jQuery(this).find('td:last').addClass(tmp_pid + " "+ rw.replace(" ",""));
               if(trim(jQuery(this).find('td:first').html())!="Packages/Features"){                          
                    jQuery(this).find('td:last').append('<input id="'+cid+'" name="'+htm+'" type="text" >');                   
                    
                     cid++; 
               }         
               });
               
              
               $pkg_info = "<span id='sp"+tmp_pid+"'>"+package+"</span><input type=hidden name='package_name["+tmp_pid+"]' value='"+package+"'/>"; 
               jQuery('#pricetable tbody tr:first td:last').html($pkg_info); 
               jQuery('#pricetable tbody tr:first td:last').append("<img class='deletecol' rel='"+tmp_pid+"' title='Delete this row' src='<?php echo plugins_url();?>/pricing-table/images/delete.png' />"); 
               jQuery('#pricetable tbody tr:first td:last').append('<img rel="'+package+'"  id="f'+tmp_pid+'" class="featured-package" title="click here to feature" src="<?php echo plugins_url();?>/pricing-table/images/unfeatured.png" > <img rel="sp'+tmp_pid+'"  id="e'+tmp_pid+'" class="featured-package-edit" title="click here to edit" src="<?php echo plugins_url();?>/pricing-table/images/edit.png"> ');  
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
