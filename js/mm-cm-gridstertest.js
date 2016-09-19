
            
            
            (function($){
				$('.button a').click( function(e) {
							e.preventDefault();
							add_widget();
							return false;
							} );
				$('.button-primary a').click( function(e) {
								e.preventDefault();
							save_edit();
							} );
                $(".gridster ul").gridster({
                    widget_base_dimensions: [200, 200],
					widget_margins: [10, 10],
                    resize: {
                        enabled: true,
                        stop: save,
                        axes: ['both']
                    },
                    draggable: {
                        stop: save
                    },
                    serialize_params: function($w, wgd){ 
					var obj = {col: wgd.col, row: wgd.row, size_x: wgd.size_x, size_y: wgd.size_y, content: decodeURIComponent($w[0].getAttribute("data-content"))} ; // Typo from decode to encode caused me lot of problems!
                     return obj;
                    }                 });

                 gridster = $(".gridster ul").gridster().data('gridster');
			
				//if(saved_data !== ''){// avoiding syntax error for undefined saved_data in case of new post
                 saved_data = JSON.parse(saved_data);
				  // MAking object from already jason encoded var from above


                 for(var iii = 0; iii < saved_data.length; iii++)
					{	/* This add_widget populates when the post is saved or reloaded */
					gridster.add_widget("<li style='background-color: #ed3a00;'data-content=\""+encodeURIComponent(saved_data[iii].content)+"\"> <button onclick=\"remove_widget(event);\">Remove Box</button> <button onclick=\"edit(event);\">Edit</button></li>", saved_data[iii].size_x, saved_data[iii].size_y);       
					/* data-content is custom html5 attribute */
					/* encodeURIComponent encodes special characters in URI */
					}
				//}
                 save();
             })(jQuery);

             function add_widget() {
				gridster.add_widget("<li style='background-color: #96d200;list-style: none;' data-content=\"\"><button onclick=\"remove_widget(event);\">Remove Box</button><button onclick=\"edit(event);\">Edit</button></li>", 1, 1);
                 save();
             }

             function remove_widget(e)
             {
                 e.target.parentNode.setAttribute("id", "remove_box");
                 gridster.remove_widget($('.gridster li#remove_box'));
                 save();
                 e.preventDefault();
             }

             function edit(e)
             {
                 currently_editing = e.target.parentNode;
				// console.log(currently_editing);
				document.getElementById("gridster_edit").value = decodeURIComponent(currently_editing.getAttribute("data-content"));
                 e.preventDefault();
             }

             function save_edit()
             {
			currently_editing.setAttribute("data-content", encodeURIComponent(document.getElementById("gridster_edit").value));
                 save();
             }

             function save()
             {
                 var json_str = JSON.stringify(gridster.serialize());
				 //console.log(json_str);
                 document.getElementById("complete_layout_data").value = json_str;
             }
        