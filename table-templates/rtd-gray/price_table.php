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

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table/table-templates/rtd-gray/css/style.css"> 
<div style="clear: both;"></div>

<div id="shaon-pricing-table" class="wppt-img-left" style="clear: both;display: block;">
 <?php
    $num_of_plans = count($data);
    $cnt = 0;
    foreach($data as $key=> $value){ $cnt++;
    ?>
    <div class="plan <?php echo $responsive; ?>" <?php if($cnt==$num_of_plans) echo 'style="-moz-border-radius: 0 5px 5px 0; -webkit-border-radius: 0 5px 5px 0; border-radius: 0 5px 5px 0;"'; ?><?php if($featured==$package_name[$key]){?> id="most-popular"<?php } ?> >
   
        <h3><?php echo $package_name[$key];?><span><?php echo $value['Price']; ?></span></h3>
        <a class="signup" href="<?php echo $value['ButtonURL']?>"><?php echo $value['ButtonText']?></a>         
        <ul>
            
            <?php foreach($value as $key1=>$value1){
                    if( strtolower($key1)!="buttonurl" && strtolower($key1)!="buttontext" && strtolower($key1)!="price" ){
                        if($data_des[$key][$key1]!=''){
                            $value1 = "<a class='wppttip' href='#' title='{$data_des[$key][$key1]}'>".$value1."</a>";
                        }
                        $ftr = strtolower($key1)!='detail'?$feature_name[$key1]:'';
                        echo "<li><b>".$value1.' <span class="feature-name">'.$ftr."</span></b></li>";
                    }
                }
            ?>
           
        </ul> 
    </div >
  <?php } ?>  
   <div style="clear: both;"></div>

</div>

<!-- price table designed by red-team-design.com -->

