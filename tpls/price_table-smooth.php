 
 <?php   
    $data = get_post_meta($pid, 'pricing_table_opt',true);
    $featured=  get_post_meta($pid, 'pricing_table_opt_feature',true);  
    
?>
 <link rel="stylesheet" href="<?php echo plugins_url(); ?>/pricing-table/tpls/css/minimal.css" type="text/css" />
  
  <div id="shaon-pricing-table">  
    <div class="minimal">
    
 <?php
    foreach($data as $key=> $value){
    ?>
    <div class="highlight plan p1">
   
        <h3><?php if($featured==$key){?><span class="featured f4"></span><?php } ?><?php echo $key;?></h3>
        <h4><span class="amount"><span><?php echo $currency; ?></span><?php echo $value['Price']; ?></span><span class="interval"><?php echo $value['Detail']; ?></span></h4>
        <div class="features">
        <ul>
            
            <?php foreach($value as $key1=>$value1){
                    if(strtolower($key1)=='detail')
                    echo "";
                    else if( strtolower($key1)!="button url" && strtolower($key1)!="button text" && strtolower($key1)!="price"){
                    $value1 = explode("|",$value1);    
                    if($value1[1]!='')
                    echo "<li><b title='{$value1[1]}'>".$value1[0]."</b> $key1</li>";
                    else
                    echo "<li><b>".$value1[0]."</b> $key1</li>";
                    }
                }
            ?>
           
        </ul> 
        </div>  
        <div class="select">
                <div>
                <a class="pt-button" href="<?php echo $value['Button URL']?>"><span><?php echo $value['Button Text']?></span></a>
                </div>
        </div>       
    </div >
  <?php } ?>
      
    </div>
  </div>
 