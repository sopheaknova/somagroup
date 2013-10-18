(function() {
    tinymce.create('tinymce.plugins.sp_buttons', {
		 
        init : function(ed, url){
            
			//Highlight
			ed.addButton('highlight', {
            title : 'Highlight text',
                onclick : function() {
					
                    ed.focus();
					ed.selection.setContent(' [highlight] ' + ed.selection.getContent() + ' [/highlight] ');
                   
                },
             image:  url +  "../../img/ed_highlight.png"
            });
			
			//Notifications
			ed.addCommand('notifications', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/notifications.php'+sp_wpml_lang,
					width : 350,
					height : 330,
					inline : 1
				});
			
			});
			
			ed.addButton('notifications', {
            title : 'Insert Notification',
               cmd : 'notifications',
               image:  url +  "../../img/ed_notifications.png"
            });
			
			//Buttons
			ed.addCommand('buttons', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/buttons.php'+sp_wpml_lang,
					width : 350,
					height : 560,
					inline : 1
				});
			
			});
						
			ed.addButton('buttons', {
            title : 'Insert Button',
               cmd : 'buttons',
               image:  url +  "../../img/ed_buttons.png"
            });
			
			//Separator line
			ed.addButton('divider', {
            title : 'Insert Separator line',
              image:  url +  "../../img/ed_divider.png",
			  onclick : function() {
                ed.selection.setContent("<hr>");
            }
            });
			
			//Toggles
			ed.addCommand('toggle', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/toggle.php'+sp_wpml_lang,
					width : 350,
					height : 320,
					inline : 1
				});
			
			});
						
			ed.addButton('toggle', {
            title : 'Insert Toggle',
               cmd : 'toggle',
               image:  url +  "../../img/ed_toggle.png"
            });
			
			//Tabs
			ed.addCommand('tabs', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/tabs.php'+sp_wpml_lang,
					width : 350,
					height : 380,
					inline : 1
				});
			
			});
			
			ed.addButton('tabs', {
            title : 'Insert Tabs',
                   cmd : 'tabs',
               image:  url +  "../../img/ed_tabs.png"
            });
			
			//Accordian
			ed.addCommand('accordian', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/accordion.php'+sp_wpml_lang,
					width : 350,
					height : 320,
					inline : 1
				});
			
			});
						
			ed.addButton('accordian', {
            title : 'Insert Accordian',
               cmd : 'accordian',
               image:  url +  "../../img/ed_accordian.png"
            });
			
			//Video
			ed.addCommand('video', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/video.php'+sp_wpml_lang,
					width : 350,
					height : 180,
					inline : 1
				});
			
			});
						
			ed.addButton('video', {
            title : 'Insert Video',
               cmd : 'video',
               image:  url +  "../../img/ed_video.png"
            });
			
			//Soundcloud
			ed.addCommand('soundcloud', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/soundcloud.php'+sp_wpml_lang,
					width : 350,
					height : 250,
					inline : 1
				});
			
			});
						
			ed.addButton('soundcloud', {
            title : 'Insert Soundcloud',
               cmd : 'soundcloud',
               image:  url +  "../../img/ed_soundcloud.png"
            });
			
			//Dropcaps
			ed.addButton('dropcaps', {
            title : 'Dropcaps',
                onclick : function() {
					
                    ed.focus();
					ed.selection.setContent(' [dropcaps] 1 [/dropcaps] ');
                   
                },
             image:  url +  "../../img/ed_dropcaps.png"
            });
            
            //Section title
			ed.addButton('section-title', {
            title : 'Section title',
                onclick : function() {
					
                    ed.focus();
					ed.selection.setContent(' [section_title] Section title [/section_title] ');
                   
                },
             image:  url +  "../../img/ed_section_title.png"
            });
            
            //Services Grid
			ed.addCommand('services-grid', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/services-grid.php'+sp_wpml_lang,
					width : 350,
					height : 360,
					inline : 1
				});
			
			});
						
			ed.addButton('services-grid', {
            title : 'Services Grid',
               cmd : 'services-grid',
               image:  url +  "../../img/ed_services.png"
            });
            
            //Latest blog
			ed.addCommand('latest-blog', function() {
				ed.windowManager.open({
					file : url +  '../../shortcodes/latest-blog.php'+sp_wpml_lang,
					width : 350,
					height : 240,
					inline : 1
				});
			
			});
						
			ed.addButton('latest-blog', {
            title : 'Latest News and Events',
               cmd : 'latest-blog',
               image:  url +  "../../img/ed_blog.png"
            });
            
            //Carousel
			ed.addButton('carousel', {
            title : 'Add partner carousel',
                onclick : function() {
					
                    ed.focus();
					ed.selection.setContent(' [carousel_partner]');
                   
                },
             image:  url +  "../../img/ed_carousel.png"
            });
			
        },
		createControl:function(d,e,url) {
			
			if(d=="columns"){
					
				d=e.createMenuButton( "columns",{
					title:"Insert Columns Shortcode",							
					icons:false							
					});
					
					var a=this;d.onRenderMenu.add(function(c,b){
						
						
						a.addImmediate(b,"Column 1/2", ' [two_fourth]  [/two_fourth] ');
						a.addImmediate(b,"Column 1/2 last", ' [two_fourth_last]  [/two_fourth_last] ');
						a.addImmediate(b,"Column 1/3", ' [one_third]  [/one_third] ');
						a.addImmediate(b,"Column 1/3 last", ' [one_third_last]  [/one_third_last] ');
						a.addImmediate(b,"Column 1/4", ' [one_fourth]  [/one_fourth] ');
						a.addImmediate(b,"Column 1/4 last", ' [one_fourth_last]  [/one_fourth_last] ');
						a.addImmediate(b,"Column 2/3", ' [two_third]  [/two_third] ');
						a.addImmediate(b,"Column 2/3 last", ' [two_third_last]  [/two_third_last] ');
						a.addImmediate(b,"Column 3/4", ' [three_fourth]  [/three_fourth] ');
						a.addImmediate(b,"Column 3/4 last", ' [three_fourth_last]  [/three_fourth_last] ');								
						
						b.addSeparator();
						
						a.addImmediate(b,"Clear", '[clear]');
						
						b.addSeparator();
						
						a.addImmediate(b,"Raw", ' [raw]  [/raw] ');
					});
				return d
			
			} // End IF Statement
					
			return null;
		},
		
		addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})},
		
		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
        getInfo : function() {
            return {
                longname : 'WP Editor Buttons',
                author : 'nova',
                authorurl : 'http://novacambodia.com',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }		
    });

    tinymce.PluginManager.add('sp_buttons', tinymce.plugins.sp_buttons);
})();