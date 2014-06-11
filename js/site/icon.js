jQuery(function(){
    var nth = 0, mh = 0, mrh=0, cnt = 0;
     
    //jQuery('#shaon-pricing-table').css('width',jQuery('#shaon-pricing-table').parent().width()+'px');
    /*
    jQuery('.pt_container_12.responsive_cont').css('max-width','100%');     
    jQuery('.pt_container_12.responsive_cont .pt_grid_12').css('max-width','100%');     
    
    jQuery('.shaon-pricing-table .responsive').css('width',(90/(jQuery('.shaon-pricing-table .responsive').length/jQuery('.shaon-pricing-table').length))+'%');     
    
    
    jQuery('#shaon-pricing-table li img').addClass('aligncenter').css('border','0px').css('padding-top','0px').css('padding-bottom','0px').css('margin-bottom','0px'); 
    jQuery('.wppt-img-left li img').css('float','none').removeClass('aligncenter');
    jQuery('#shaon-pricing-table li').each(function(){   
        if(jQuery(this).height()>mh) {mh = jQuery(this).height(); nth = cnt; }
    });
    
    var rows = jQuery('#shaon-pricing-table ul li').length/jQuery('#shaon-pricing-table ul').length;
    for(i=1;i<=rows; i++){ 
        mrh = 0;
        jQuery('#shaon-pricing-table ul').each(function(){  
          //  alert(jQuery('li:nth-child('+i+')', this).height());
                if(jQuery('li:nth-child('+i+')', this).height()>mrh) {mrh = jQuery('li:nth-child('+i+')', this).height(); }
           
        }); 
    
        jQuery('#shaon-pricing-table ul li:nth-child('+i+')').height(mrh+'px').css('vertical-align','middle');
     } 
	 
var rows = jQuery('#shaon-pricing-table1 ul li').length/jQuery('#shaon-pricing-table1 ul').length;
    for(i=1;i<=rows; i++){ 
        mrh = 0;
        jQuery('#shaon-pricing-table1 ul').each(function(){  
            //alert(jQuery('li:nth-child('+i+')', this).height());
                if(jQuery('li:nth-child('+i+')', this).height()>mrh) {mrh = jQuery('li:nth-child('+i+')', this).height(); }
           
        }); 
    
        jQuery('#shaon-pricing-table1 ul li:nth-child('+i+')').height(mrh+'px').css('vertical-align','middle');
     } 

     */
    
     //alert(cnt);
    //mh = mh-8;    
    mh = mh<25?25:mh;         
    //if(!jQuery('#shaon-pricing-table').hasClass('skiph'))
    //jQuery('#shaon-pricing-table li').css('height',mh+'px').css('min-height','25px');
    
    
});