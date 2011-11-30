 <!--
<form action="" method="post" name="pricf">
Select Table
<select name="pricing_tableid" id="pricing_tableid" onchange="document.pricf.submit();">
 <?php
 
$tables = get_posts( $args );

foreach($tables as $mypost){
    
    if($mypost->ID == $_POST['pricing_tableid']) $select="selected='selected'";else $select="";
    echo "<option value='".$mypost->ID."' ".$select.">".$mypost->post_title."</option> ";
}
?>
</select>
 </form>
 -->
 <?php   
    $data = get_post_meta($pid, 'pricing_table_opt',true);
    $featured=  get_post_meta($pid, 'pricing_table_opt_feature',true);  
     /*echo "<pre>";     
     print_r($data);
     echo "</pre>";
     */  
?>
<div style="clear: both;"></div>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/tpls/css/reset.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/tpls/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/tpls/css/960.css"> 

<div class="container_12" style="display: block;margin-bottom: 80px;">
  
    <div class="grid_12">
    <div class="pricing-table">
        <div class="col1">
            <div class="featureTitle">
            <span>FEATURE</span></div>
            
            <div class="feature-content">
                <ul>
                <?php
    $pkeys=array_keys($data);
    $fkeys=array_keys($data[$pkeys[0]]); 
 
     for($i=0;$i<count($fkeys);$i++){
         if(strtolower($fkeys[$i])!="button url" && strtolower($fkeys[$i])!="button text")    
         echo "<li>".$fkeys[$i]."</li>";
     }
?>

                </ul>
            </div>

                        
        </div>
        
        <?php
    foreach($data as $key=> $value){
?>
        
        <div class="col1">
            <?php if($featured==$key){?>
            <div class="selectedpriceTitle">
            <div class="offer-tag"><a href=""><img src="<?php echo plugins_url(); ?>/pricing-table/tpls/images/offer-tag.png"></a></div>
            <span><?php echo $key;?></span></div>
            <div class="selectePrice-content"> 
             <?php }else{
              ?>
              <div class="priceTitle"><span><?php echo $key;?></span></div>
              <div class="price-content">
              <?php   
             }
             ?>
              
                <ul>
                
                <?php foreach($value as $key1=>$value1){
                    if( strtolower($key1)!="button url" && strtolower($key1)!="button text")
                    echo "<li>".$value1."</li>";
                }
                ?>
               <!-- <li>$49</li>
                <li>2 for 1 (?)</li> 
                <li>N/A</li> 
                <li>Yes</li> 
                <li>Yes</li> 
                <li>No</li> 
                <li>No</li> 
                <li>Unlimited</li>
                -->
                
                </ul>     
                <?php
    if($featured==$key) echo "<span>No risk. Cancel at anytime.
No hidden fees.(***)</span>";
?>           
                <a class="signup" href="<?php echo $value['Button URL']?>"><?php echo $value['Button Text']?></a>
                
                
            </div>
            
        </div>
        <?php } ?>
        
       <!-- <div class="col1">

            <div class="selectedpriceTitle">
            <div class="offer-tag"><a href=""><img src="images/offer-tag.png"></a></div> 
            <span>Professional</span></div>

                 <div class="selectePrice-content">
                <ul>
                <li>$49</li>
                <li>2 for 1 (?)</li> 
                <li>N/A</li> 
                <li>Yes</li> 
                <li>Yes</li> 
                <li>No</li> 
                <li>No</li> 
                <li>Unlimited</li> 
                </ul>
                
                <span>No risk. Cancel at anytime.
No hidden fees.(***)</span>
                
                <a class="signup" href="">Sign up</a>
                
                
            </div>
            
        </div>
        
        <div class="col1">
            <div class="priceTitle"><span>Business</span></div> 
            <div class="price-content">
                <ul>
                <li>$49</li>
                <li>2 for 1 (?)</li> 
                <li>N/A</li> 
                <li>Yes</li> 
                <li>Yes</li> 
                <li>No</li> 
                <li>No</li> 
                <li>Unlimited</li> 
                </ul>                
                <a class="signup" href="">Sign up</a>
                
                
            </div>
                       
        </div>
        <div class="col1">
            <div class="priceTitle"><span>Unlimited</span></div>
            
            <div class="price-content">
                <ul>
                <li>$49</li>
                <li>2 for 1 (?)</li> 
                <li>N/A</li> 
                <li>Yes</li> 
                <li>Yes</li> 
                <li>No</li> 
                <li>No</li> 
                <li>Unlimited</li> 
                </ul>                
                <a class="signup" href="">Sign up</a>
                
                
            </div>
           
        </div> 
        -->
        
    </div>  
        
        
    </div>
  
  
  </div>
   <div style="clear: both;"></div> 
  </div>
  
  <div style="clear: both;"></div> 