<?php
if(!class_exists('ahm_plugin')){
class ahm_plugin{
    public $plugin_dir;
    public $plugin_url;
    protected $header_tabs;
    function __construct($plugin){
             $this->plugin_dir = WP_PLUGIN_DIR.'/'.$plugin;
             $this->plugin_url = plugins_url().'/'.$plugin;
    }

    function new_header_tab($title, $link, $callback){
            $this->header_tabs[] = array('title'=>$title,'link'=>$link,'callback'=>$callback);
            return $this;
    }
    
    function render_plugin($title, $active_tab){
        
    }
    
    function load_styles(){
        $dir = is_admin()?'admin':'site';
        $cssdir = $this->plugin_dir.'/css/'.$dir.'/';
        $cssurl = $this->plugin_url.'/css/'.$dir.'/';
        $files = scandir($cssdir);
        foreach($files as $file){
            $tt = explode(".",$file);
            if(!is_dir($file)&&end($tt)=='css')
            wp_enqueue_style(uniqid(),$cssurl.$file);
        }
    }
    
    function load_scripts(){
        wp_enqueue_script('jquery');
        $dir = is_admin()?'admin':'site';
        $jsdir = $this->plugin_dir.'/js/'.$dir.'/';
        $jsurl = $this->plugin_url.'/js/'.$dir.'/';
        $files = scandir($jsdir);
        foreach($files as $file){
            $tt = explode(".",$file);
            if(!is_dir($file)&&end($tt)=='js')
            wp_enqueue_script(uniqid(),$jsurl.$file);
        }
    }
    
    function load_modules(){       
        $mdir = $this->plugin_dir.'/modules/';
        
        $files = scandir($mdir);
        foreach($files as $file){
            $tt = explode(".",$file);
            if(!is_dir($file)&&end($tt)=='php')
            include($mdir.$file);
        }
    }
    
    function action(){
        
    }
    
    function filter(){
        
    }
    
    function prepeare(){
        
    }
    
    
    
}

}

 