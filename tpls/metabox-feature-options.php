<script language="JavaScript" src="<?php echo plugins_url(); ?>/pricing-table/js/admin/dragtable.js"></script>
<script language="JavaScript" src="<?php echo plugins_url(); ?>/pricing-table/js/admin/jquery.tablednd_0_5.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/css/admin/tablestyle.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/css/admin/my.css"> 
 <script>
 jQuery('.deleterow').live('click', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
         
    }
 });
 jQuery('.deletecol').live('click', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).remove();
         
    }
 });
 
 jQuery('.featured-package').live('click', function() {   //alert(val);
    var fid=jQuery(this).attr("id");
    var iv = jQuery(this).attr('src'); //,"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
    jQuery('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png')
    if(iv=='<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png') {
    jQuery(this).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
    jQuery('#featured').val(jQuery(this).attr("rel"));
    }
 });
 
 </script>
 <script type="text/javascript">
 /*function featur(r,fid){
     //alert(r+fid);
        jQuery('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png')
        jQuery('#'+fid).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
     
 } */
 </script>
<?php
    $data = get_post_meta($post->ID, 'pricing_table_opt',true);  
    $featured=  get_post_meta($post->ID, 'pricing_table_opt_feature',true);  
    /* echo "<pre>";     
     print_r($data);
     echo "</pre>";
     */
     
?>

<div style="width: 100%;float:left;margin-right: 25px;">
    
        
        <br>
          
        <br>
        <span style="padding: 5px 0 5px 0;">&nbsp;</span>
 <table>
 <tr><td></td><td><a style="float: right;" href="#" class="button" id="addcolumn"><?php echo __('Add Package','pricing-table'); ?></a> </td></tr>
 <tr><td>
 <table class="draggable" id="pricetable" border="0" width="100%" cellspacing="0" cellpadding="0" >       
   <tr class="nodrag nodrop">
      <td >
        <?php echo __('Packages/Features','pricing-table'); ?>
      </td>  
      <input type="hidden" id="featured" name="featured" value="<?php echo $featured;?>">   
      <?php  
    $pkeys=@array_keys($data);//print_r($keys); 
    $cnt=count($pkeys);
    if($cnt > 0 ){
        $imgc=0;
    foreach($pkeys as $index=> $value){ 
        $imgc++;
        if($featured==$value)$fimg="featured.png";else $fimg="unfeatured.png";
        //echo  $fimg;
        
        $package_key=str_replace(" ","",$value);
        echo  '<td class="'.$package_key.'"><div class="deletecol" rel="'.$package_key.'" title="Delete this column" >&nbsp;</div><strong>
        '.$value.'
        </strong> <img rel="'.$value.'" style="cursor:pointer;float:right" id="f'.$imgc.'" class="featured-package" title="click here to feature or unfeatue" src="'. plugins_url().'/pricing-table/images/'.$fimg.'">
      </td>';
    }
    }
?>
   </tr>    
     <?php
   $fkeys=@array_keys($data[$pkeys[0]]);
    $cnt=count($data[$pkeys[0]]);
    if( is_array($fkeys) ){ 
    foreach($fkeys as $index1=> $value1){
        $feature_key = str_replace(" ","",$value1);
        if(in_array($value1,array('Price','Detail','Button URL','Button Text'))) $cls = "nodrag nodrop";
        else $cls = "";
        echo "<tr class='{$value1} $cls'>";
        $t=0;
        foreach($pkeys as $index=> $value){
            $package_key=str_replace(" ","",$value);
            $t++;
            if($t==1){
                echo "<td  class='".$feature_key."'>";
                if($value1 != "Price" && $value1!="Detail" && $value1!="Button URL" && $value1!="Button Text" )
                    echo "<div class='deleterow' rel='{$feature_key}' title='Delete this row'>&nbsp;</div>";
                echo "<strong>".$value1."</strong></td>";
            }
            echo  '<td class="'.$package_key.' '.$feature_key.'"><input type="text"  id="features['.$value.']['.$value1.']" name="features['.$value.']['.$value1.'] " value="'
            .$data[$value][$value1].'" >
            
          </td>';
        }
        echo "</tr>";  
    }
    }else{
        ?>
        <tr class="nodrag nodrop">
      <td class="Price">
        <strong><?php echo __('Price','pricing-table'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Detail">
        <strong><?php echo __('Detail','pricing-table'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Button URL ">
         <strong><?php echo __('Button URL','pricing-table'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Button Text">
         <strong><?php echo __('Button Text','pricing-table'); ?></strong>
      </td>
      </tr>
        <?php
        
    }
?>
   
</table></td><td></td></tr>
 <tr><td><a href="#" class="button" id="addrow"><?php echo __('Add Feature','pricing-table'); ?></a>  </td><td></td></tr>
 </table>       


     <script language="JavaScript">
      function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
    }


    jQuery(function(){
      
        jQuery('#pricetable').tableDnD();  
        
      jQuery('#addrow').click(function(){
          
          var feat;
          feat=prompt("Enter Feature");   //alert(feat); 
          feat=trim(feat);  
          while(feat.length==0 ){
               feat=prompt("Enter Feature");
               feat=trim(feat);    
          }
          
          
           jQuery('#pricetable tbody tr:last').clone(true).insertAfter('#pricetable tbody>tr:last');
           jQuery('#pricetable tbody tr:last td:first').text(feat);
            jQuery('#pricetable tbody tr:last td:first').append("<div class='deleterow' title='Delete this row'>&nbsp;</div>");
           jQuery('#pricetable tbody tr:last td:first').attr("class",feat);
           jQuery('#pricetable tbody tr:last').attr("class",feat);
           jQuery('#pricetable tbody tr:last td:first .deleterow').attr("rel",feat);
           
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
               nclassname += feat;
               
               jQuery(this).attr("class",nclassname);
               ht= jQuery(this).find('input').attr('name');
               ht=new String(ht); 
               if(ht != "undefined"){
                   var pos= ht.indexOf("]");
                   var cnam=ht.substr(0,pos+1);
                   var nnam=cnam+"["+feat+"]";
                   jQuery(this).find('input').attr("name",nnam);
                   jQuery(this).find('input').attr("id",nnam);
                   
               } 
               
           });

           jQuery('#pricetable tbody tr:last td:first').css("font-weight","bold"); 
           });
     
     
      jQuery('#addcolumn').click(function(){
           var cid = 1;
          //check whether any features exists or not. if no feature then create feature first
          //alert(jQuery('#pricetable tbody tr:last td:first').html());
          if(trim(jQuery('#pricetable tbody tr:last td:first').html())=="Packages/Features"){
              alert("Create Features first");
          }else{
              var package=prompt("Enter Package");
              package=trim(package); 
              while(package.length==0 ){
                   package=prompt("Enter Package");
                   package=trim(package);    
              }
               var htm;  
              jQuery("#pricetable").find("tr").each(function() {
                  //alert(jQuery(this).find('td:first').html());
              
               var rw="";
               rw= trim(jQuery(this).find('td:first').text());
               
               htm="features["+package+"]["+rw+"]"; 
               jQuery(this).find('td:last').after( '<td > &nbsp;</td>' ); 
               jQuery(this).find('td:last').addClass(package + " "+ rw.replace(" ",""));
               if(trim(jQuery(this).find('td:first').html())!="Packages/Features"){                          
                    jQuery(this).find('td:last').append('<input id="'+cid+'" name="'+htm+'" type="text" >');                   
                    
                     cid++;
               }         
               });
                
               jQuery('#pricetable tbody tr:first td:last').text(package);
               jQuery('#pricetable tbody tr:first td:last').append("<div class='deletecol' rel='"+package+"' title='Delete this row'>&nbsp;</div>");
               jQuery('#pricetable tbody tr:first td:last').append('<img rel="'+package+'" style="cursor:pointer;float:right" id="f" class="featured-package" title="click here to feature" src="<?php echo plugins_url();?>/pricing-table/images/unfeatured.png" >');  
               jQuery('#pricetable tbody tr:first td:last').css("font-weight","bold");
               jQuery('#pricetable tbody tr:first td:last').attr("class",package);
          }
    });
      });
    
    </script>
    <br clear="all"> 
    <br clear="all">    
    </div>
    
    <br clear="all">