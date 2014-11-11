<?php
$data = get_post_meta($pid, 'pricing_table_opt',true);
$featured=  get_post_meta($pid, 'pricing_table_opt_feature',true);
$feature_description =  get_post_meta($pid, 'pricing_table_opt_feature_description',true);
$data_des = get_post_meta($pid, 'pricing_table_opt_description',true);
//print_r($data_des);
$feature_name=  get_post_meta($pid, 'pricing_table_opt_feature_name',true);
$package_name=  get_post_meta($pid, 'pricing_table_opt_package_name',true);
$returnurl =  get_post_meta($pid, '__wppt_returnurl',true);
$cancelurl =  get_post_meta($pid, '__wppt_cancelurl',true);
$business =  get_post_meta($pid, '__wppt_business',true);
$notifyurl = home_url('/?__wppt_payment_notify='.$pid);
$pt = get_post($pid);
$alt_feature=get_post_meta($pid, 'alt_feature',true);
$alt_price=get_post_meta($pid, 'alt_price',true);
$alt_detail=get_post_meta($pid, 'alt_detail',true);
$style = isset($style)?$style:'';

$currency_code = get_post_meta($pid, '__wppt_currency_code',true);
$currency_code = $currency_code?$currency_code:'USD';
$currency = isset($currency)?$currency:'$';

$paypal = '';
?>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Roboto|Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css'>
<link href="<?php echo plugins_url('pricing-table/table-templates/rock/css/bootstrap.css');?>" rel="stylesheet">
<link href="<?php echo plugins_url('pricing-table/table-templates/rock/css/style.css');?>" rel="stylesheet">
<link href="<?php echo plugins_url('pricing-table/table-templates/rock/css/ribbons/hang-ribbon.css');?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

<div class="w3eden">
	<div class="container-fluid top50">
    	<div class="row shaon-pricing-table skin-blue style-2" id="shaon-pricing-table">
            <div class="col-md-12">
            	<div class="row">

                    <?php
                    $scolor = array('blue','free','free','free','free','free','free','free');
                    $count=0;
                    $total=count($data);
                    foreach($data as $key=> $value){
                        $count++;
                        if($count == 1)
                            $col_id = "top-li-first";
                        elseif($count < $total)
                            $col_id = "";
                        else $col_id = "top-li-last";

                    ?>

                	<div class="col-md-<?php echo intval(12/count($package_name)); ?>">
                    	<div class="free  pricing-table <?php if($package_name[$key]==$featured) echo ' active'; ?>">
                            <ul>
                                <li class="wppt-package-name <?php echo $col_id;?>"><?php if($package_name[$key]==$featured) echo '<div class="wrap-ribbon left-corner lred"><span></span></div>'; ?><h5><?php echo $package_name[$key];?></h5></li>
                               
                                <li class="wppt-package-info free-row-2">
                                    <div class="wppt-info-circle">
                                    <h1><?php echo $currency.$value['Price'];?></h1>
                                    <p style="margin: 0 !important;"><?php echo $value['Detail'];?></p>
                                    </div>
                                </li>

                                <?php
                                $rc = $fc = 0;
                                $rs = '';
                                foreach($value as $key1=>$value1){
                                    $rc++;
                                    $data = array('##btntxt##' => $value['ButtonText'], '##price##' => $value['Price'], '##currency##' => 'USD', '##name##' => $package_name[$key], '##id##' => uniqid());
                                    $eo = $rc%2?'odd':'even';
                                    if( strtolower($key1)!="buttonurl" && strtolower($key1)!="buttontext" && strtolower($key1)!="price" && strtolower($key1)!="detail"){
                                        $fc++;
                                        $fft = $fc==1?'first-feature':'';
                                        if($rc)
                                            $ftr = strtolower($key1)!='detail'?$feature_name[$key1]:'';
                                        if($data_des[$key][$key1]=='')
                                            echo "<li class='feature {$fft} pricing-content-row-{$eo} {$rs} ".(strpos('--'.$value1,'[n]')?'text-danger':'')."'><label class='label label-".(strpos('--'.$value1,'[n]')?'danger':(strpos('--'.$value1,'[na]')?'warning':'success'))."'>".str_replace(array('[y]','[n]','[na]'), array('<i class="fa fa-check"></i>','<i class="fa fa-times"></i>','<i class="fa fa-warning"></i>'),$value1)."</label> &nbsp; <span class='ftr'>$ftr</span></li>";
                                        else
                                            echo "<li class='feature {$fft} pricing-content-row-{$eo} {$rs} ".(strpos('--'.$value1,'[n]')?'text-danger':'')."'><i class='fa fa-plus-circle pull-right wppttip' style='margin-top:2px;cursor:pointer;'  title='{$data_des[$key][$key1]}'></i><label class='label label-".(strpos('--'.$value1,'[n]')?'danger':(strpos('--'.$value1,'[na]')?'warning':'success'))."'>".str_replace(array('[y]','[n]','[na]'), array('<i class="fa fa-check"></i>','<i class="fa fa-times"></i>','<i class="fa fa-warning"></i>'),$value1)."</label> &nbsp; <span class='ftr'>$ftr</span></li>";
                                    }

                                    $rs = !isset($rs) || $rs == '' ? $scolor[$count-1].'-row-gray' : '';
                                }
                                ?>                               

                                <li class="pricing-footer footer-row"> <?php if(isset($paypal_button)) echo str_replace(array_keys($data), array_values($data), $paypal); else { ?><a href="<?php echo $value['ButtonURL']?>" class="btn-pricing btn btn-success btn-block"><?php echo $value['ButtonText']?></a> <?php } ?> </li>
                            </ul>
                        </div>
                   	</div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>