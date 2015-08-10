 
(function() {

    tinymce.create('tinymce.plugins.wppt_tinyplugin', {

        init : function(ed, url){            
            ed.addCommand('wppt_mcedonwloadmanager', function() {
                                ed.windowManager.open({
                                        title: 'WordPress Pricing Table Plugin',
                                        file : 'admin.php?wppt_action=wppt_tinymce_button',
                                        height: 450,
                                        width:600,
                                        inline : 1
                                }, {
                                        plugin_url : url, // Plugin absolute URL
                                        some_custom_arg : 'custom arg' // Custom argument
                                });
                        });
            
            ed.addButton('wppt_tinyplugin', {
                title : 'Insert Pricing Table',
                cmd : 'wppt_mcedonwloadmanager',
                image:  url+"/images/table.png"
            });
        },                       

        getInfo : function() {
            return {
                longname : 'WPDC - TinyMCE Button Add-on',
                author : 'Shaon',
                authorurl : 'http://www.wpdownloadmanager.com',
                infourl : 'http://www.wpdownloadmanager.com',
                version : "1.0"
            };
        }
    });

    tinymce.PluginManager.add('wppt_tinyplugin', tinymce.plugins.wppt_tinyplugin);
    
})();
