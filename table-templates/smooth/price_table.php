<?php
 $data = get_post_meta($pid, 'pricing_table_opt',true);
 $featured=  get_post_meta($pid, 'pricing_table_opt_feature',true);
 $feature_description =  get_post_meta($pid, 'pricing_table_opt_feature_description',true);
 $data_des = get_post_meta($pid, 'pricing_table_opt_description',true);
 //print_r($data_des);

 $feature_name=  get_post_meta($pid, 'pricing_table_opt_feature_name',true);
 $package_name=  get_post_meta($pid, 'pricing_table_opt_package_name',true);

 $kc = 0;

 ?>
 <link rel="stylesheet" href="<?php echo plugins_url(); ?>/pricing-table/table-templates/smooth/css/minimal.css" type="text/css" />
  
<div id="shaon-pricing-table">  
    <div class="minimal">
    
 <?php
    foreach($data as $key=> $value){
    ?>
    <div class="highlight plan p1">
   
        <h3><?php if($featured==$key){?><span class="featured f4"></span><?php } ?><?php echo $package_name[$key];?></h3>
        <h4><span class="amount"><span><?php echo $currency; ?></span><?php echo $value['Price']; ?></span><span class="interval"><?php echo $value['Detail']; ?></span></h4>
        <div class="features">
        <ul>
            
            <?php foreach($value as $key1=>$value1){
                if( strtolower($key1)!="buttonurl" && strtolower($key1)!="buttontext" && strtolower($key1)!="price"){
                    if($data_des[$key][$key1]!=''){
                        $value1 = "<a class='wppttip' href='#' title='{$data_des[$key][$key1]}'>".$value1."</a>";
                    }
                    $ftr = strtolower($key1)!='detail'?$feature_name[$key1]:'';
                    echo "<li><b>".$value1.' <span class="feature-name">'.$ftr."</span></b></li>";
                }

                }
            ?>
           
        </ul> 
        </div>  
        <div class="select">
            <div>
                <a class="pt-button" href="<?php echo $value['ButtonURL']?>"><span><?php echo $value['ButtonText']?></span></a>
            </div>
        </div>       
    </div>
  <?php } ?>
      
    </div>
</div>
 <div style="clear:both"></div>
 