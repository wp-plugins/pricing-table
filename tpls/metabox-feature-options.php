<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/css/admin/tablestyle.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/css/admin/my.css"> 
 <script>
 jQuery('.deleterow').live('click', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+$(this).attr('rel')).slideUp(function(){$(this).remove();});
         
    }
 });
 jQuery('.deletecol').live('click', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+$(this).attr('rel')).remove();
         
    }
 });
 
 jQuery('.featured-package').live('click', function() {   //alert(val);
    var fid=$(this).attr("id");
    $('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png')
    $('#'+fid).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
    $('#featured').val($('#'+fid).attr("rel"));
 });
 
 </script>
 <script type="text/javascript">
 /*function featur(r,fid){
     //alert(r+fid);
        $('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table/images/unfeatured.png')
        $('#'+fid).attr('src',"<?php echo plugins_url(); ?>/pricing-table/images/featured.png");
     
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
 <tr><td></td><td><a style="float: right;" href="#" class="button" id="addcolumn">Add Package</a> </td></tr>
 <tr><td>
 <table id="pricetable" border="0" width="100%" cellspacing="0" cellpadding="0" >       
   <tr>
      <td >
        Packages/Features
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
        echo "<tr class='{$value1}'>";
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
        <tr>
      <td class="Price">
        <strong>Price</strong>
      </td>
      </tr>
      <tr>
      <td class="Detail">
        <strong>Detail</strong>
      </td>
      </tr>
      <tr>
      <td class="Button URL ">
         <strong>Button URL</strong>
      </td>
      </tr>
      <tr>
      <td class="Button Text">
         <strong>Button Text </strong>
      </td>
      </tr>
        <?php
        
    }
?>
   
</table></td><td></td></tr>
 <tr><td><a href="#" class="button" id="addrow">Add Feature</a>  </td><td></td></tr>
 </table>       


     <script language="JavaScript">
      function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
    }


    jQuery(function(){
      jQuery('#addrow').click(function(){
          
          var feat;
          feat=prompt("Enter Feature");   //alert(feat); 
          feat=trim(feat);  
          while(feat.length==0 ){
               feat=prompt("Enter Feature");
               feat=trim(feat);    
          }
          
          
           $('#pricetable tbody tr:last').clone(true).insertAfter('#pricetable tbody>tr:last');
           $('#pricetable tbody tr:last td:first').text(feat);
            $('#pricetable tbody tr:last td:first').append("<div class='deleterow' title='Delete this row'>&nbsp;</div>");
           $('#pricetable tbody tr:last td:first').attr("class",feat);
           $('#pricetable tbody tr:last').attr("class",feat);
           $('#pricetable tbody tr:last td:first .deleterow').attr("rel",feat);
           
           var ht="";
           
           $("#pricetable tbody tr:last").find("td").each(function() {
               
               
               var ccl,pos1;
               var nclassname="";
               ccl=$(this).attr("class");
               ccl=trim(new String(ccl));
               
               pos1= ccl.indexOf(" ");
               
               if(pos1 != -1){
                  nclassname=ccl.substr(0,pos1+1); 
                  
                  
               }
               nclassname += feat;
               
               $(this).attr("class",nclassname);
               ht= $(this).find('input').attr('name');
               ht=new String(ht); 
               if(ht != "undefined"){
                   var pos= ht.indexOf("]");
                   var cnam=ht.substr(0,pos+1);
                   var nnam=cnam+"["+feat+"]";
                   $(this).find('input').attr("name",nnam);
                   $(this).find('input').attr("id",nnam);
                   
               } 
               
           });

           $('#pricetable tbody tr:last td:first').css("font-weight","bold"); 
           });
     
     
      jQuery('#addcolumn').click(function(){
           var cid = 1;
          //check whether any features exists or not. if no feature then create feature first
          //alert($('#pricetable tbody tr:last td:first').html());
          if(trim($('#pricetable tbody tr:last td:first').html())=="Packages/Features"){
              alert("Create Features first");
          }else{
              var package=prompt("Enter Package");
              package=trim(package); 
              while(package.length==0 ){
                   package=prompt("Enter Package");
                   package=trim(package);    
              }
               var htm;  
              $("#pricetable").find("tr").each(function() {
                  //alert($(this).find('td:first').html());
              
               var rw="";
               rw= trim($(this).find('td:first').text());
               
               htm="features["+package+"]["+rw+"]"; 
               $(this).find('td:last').after( '<td > &nbsp;</td>' ); 
               $(this).find('td:last').addClass(package + " "+ rw.replace(" ",""));
               if(trim($(this).find('td:first').html())!="Packages/Features"){                          
                    $(this).find('td:last').append('<input id="'+cid+'" name="'+htm+'" type="text" >');                   
                    
                     cid++;
               }         
               });
                
               $('#pricetable tbody tr:first td:last').text(package);
               $('#pricetable tbody tr:first td:last').append("<div class='deletecol' rel='"+package+"' title='Delete this row'>&nbsp;</div>");
               $('#pricetable tbody tr:first td:last').append('<img rel="'+package+'" style="cursor:pointer;float:right" id="f" class="featured-package" title="click here to feature" src="<?php echo plugins_url();?>/pricing-table/images/unfeatured.png" >');  
               $('#pricetable tbody tr:first td:last').css("font-weight","bold");
               $('#pricetable tbody tr:first td:last').attr("class",package);
          }
    });
      });
    
    </script>
    <br clear="all"> 
    <br clear="all">    
    </div>
    
    <br clear="all">