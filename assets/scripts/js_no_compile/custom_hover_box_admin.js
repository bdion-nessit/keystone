console.log('test linkable');
(function ( $ ) {
	window.vc_custom_hover_box_view = window.VcColumnView.extend( {
		column_tag: 'vc_column_text',
		
		render: function () {
			var $content = this.content();
			if ( $content && $content.hasClass( 'vc_row-has-fill' ) ) {
				$content.removeClass( 'vc_row-has-fill' );
				this.$el.addClass( 'vc_row-has-fill' );
			}
			
			window.vc_custom_hover_box_view.__super__.render.call( this );
			return this;
		},
		ready: function (e) {
		
			var _this = this;
			jQuery.when(function() {
				window.vc_custom_hover_box_view.__super__.ready.call(this, e);
			}).then(function() {
				setTimeout(function() {
					children = _this.$content.get()[0];

					var num_children = children.childElementCount;

					if(!num_children) {
						var hoverBoxDefault = vc.shortcodes.create({
							shortcode:"vc_custom_hover_box_default",
							parent_id: _this.model.get( 'id' )
						}).view;
						hoverBoxDefault.model.attributes.parent_id = _this.model.get( 'id' );
						hoverBoxDefault.model.attributes.root_id = _this.model.get( 'root_id' );

						var hoverBoxHover = vc.shortcodes.create({
							shortcode:"vc_custom_hover_box_hover",
							parent_id: _this.model.get( 'id' )
						}).view;
						hoverBoxHover.model.attributes.parent_id = _this.model.get( 'id' );
						hoverBoxHover.model.attributes.root_id = _this.model.get( 'root_id' );

					}
			}, 250);
		});

		return this;
	},
		
		addShortcode: function(e) {
			
			window.vc_custom_hover_box_view.__super__.addShortcode.call(this, e);
			return;
		},
		addElement: function ( e ) {
			e && e.preventDefault();
			console.log('adding');
			
			window.vc_custom_hover_box_view.__super__.addElement.call(this, e);
		},
		createElement: function(e) {
			window.vc_custom_hover_box_view.__super__.createElement.call(this, e);
		},
		
		changeShortcodeParams: function (model) {
			window.vc_custom_hover_box_view.__super__.changeShortcodeParams.call(this, model);
		},
		changeShortcodeParent: function (model) {
			console.log('changing parent from box');
			window.vc_custom_hover_box_view.__super__.changeShortcodeParent.call(this, model);
		},

		changeLayout: function ( e ) {
			e && e.preventDefault();
			this.layoutEditor().render( this.model ).show();
		},
		layoutEditor: function () {
			if ( _.isUndefined( vc.row_layout_editor ) ) {
				vc.row_layout_editor = new vc.RowLayoutUIPanelFrontendEditor( { el: $( '#vc_ui-panel-row-layout' ) } );
			}
			return vc.row_layout_editor;
		},
		convertToWidthsArray: function ( string ) {
			return _.map( string.split( /_/ ), function ( c ) {
				var w = c.split( '' );
				w.splice( Math.floor( c.length / 2 ), 0, '/' );
				return w.join( '' );
			} );
		},
		content: function () {
			console.log(this.$content);
			if ( false === this.$content ) {
				this.$content = this.$el.find( '.vc_container-anchor:first' ).parent();
			}
			this.$el.find( '.vc_container-anchor:first' ).remove();
			return this.$content;
		},
		addLayoutClass: function () {
			this.$el.removeClass( 'vc_layout_' + this.layout );
			this.layout = _.reject( vc.shortcodes.where( { parent_id: this.model.get( 'id' ) } ), function ( model ) {
				return model.get( 'deleted' )
			} ).length;
			this.$el.addClass( 'vc_layout_' + this.layout );
		},
		convertRowColumns: function ( layout, builder ) {
			if ( ! layout ) {
				return false;
			}
			var column_params, new_model,
				columns_contents = [],
				columns = this.convertToWidthsArray( layout );
			vc.layout_change_shortcodes = [];
			vc.layout_old_columns = vc.shortcodes.where( { parent_id: this.model.get( 'id' ) } );
			_.each( vc.layout_old_columns, function ( column ) {
				column.set( 'deleted', true );
				columns_contents.push( {
					shortcodes: vc.shortcodes.where( { parent_id: column.get( 'id' ) } ),
					params: column.get( 'params' )
				} );
			} );
			_.each( columns, function ( column ) {
				var prev_settings = columns_contents.shift();
				if ( _.isObject( prev_settings ) ) {
					new_model = builder.create( {
						shortcode: this.column_tag,
						parent_id: this.model.get( 'id' ),
						order: vc.shortcodes.nextOrder(),
						params: _.extend( {}, prev_settings.params, { width: column } )
					} ).last();
					_.each( prev_settings.shortcodes, function ( shortcode ) {
						shortcode.save( {
								parent_id: new_model.get( 'id' ),
								order: vc.shortcodes.nextOrder()
							},
							{ silent: true } );
						vc.layout_change_shortcodes.push( shortcode );
					}, this );
				} else {
					column_params = { width: column };

					new_model = builder.create( {
						shortcode: this.column_tag,
						parent_id: this.model.get( 'id' ),
						order: vc.shortcodes.nextOrder(),
						params: column_params
					} ).last();
				}
			}, this );
			_.each( columns_contents, function ( column ) {
				_.each( column.shortcodes, function ( shortcode ) {
					shortcode.save( {
							parent_id: new_model.get( 'id' ),
							order: vc.shortcodes.nextOrder()
						},
						{ silent: true } );
					vc.layout_change_shortcodes.push( shortcode );
					shortcode.view.rowsColumnsConverted && shortcode.view.rowsColumnsConverted()
				}, this );
			}, this );
			builder.render( function () {
				_.each( vc.layout_change_shortcodes, function ( shortcode ) {
					shortcode.trigger( 'change:parent_id' );
					shortcode.view.rowsColumnsConverted && shortcode.view.rowsColumnsConverted();
				} );
				_.each( vc.layout_old_columns, function ( column ) {
					column.destroy();
				} );
				vc.layout_old_columns = [];
				vc.layout_change_shortcodes = [];
			} );
			return columns;
		},
		allowAddControl: function () {
			return vc_user_access().getState( 'shortcodes' ) !== 'edit';
		},
		allowAddControlOnEmpty: function () {
			return vc_user_access().getState( 'shortcodes' ) !== 'edit';
		},
		
	} );
	
	window.inner_hover_box_view = vc.shortcode_view.extend( {
		deleteElement: function() {
			return;
		},
		deleteShortcode: function() {
			return;
		},
		clone: function() {
			return;
		},
	});
})( window.jQuery );