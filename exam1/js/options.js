(function () {
	"use strict";
	jQuery(function () {

		jQuery('.theme-options-button').click(function(){

			var that     = jQuery(this),
				buttons  = that.parent().children(),
				parent   = that.parent().parent(),
				target   = that.attr('data-target'),
				sections = jQuery('#theme-options-container').children();


			if ( parent.hasClass('o--on') && that.hasClass('o--active') ) {
				parent.removeClass('o--on').addClass('o--off');
				set_cookie( 'options_state', 'o--off' );
			} else {
				sections.removeClass('o--active').filter('#' + target).addClass('o--active');
				parent.removeClass('o--off').addClass('o--on');
				set_cookie( 'options_target', target );
				set_cookie( 'options_state', 'o--on' );

				if ( target == 'section--theme-options' ) {
					load_thubms();
				}

				if ( target == 'section--theme-homepages' ) {
					load_homepages();
				}

			}

			buttons.removeClass('o--active');
			that.addClass('o--active');

		});

		var pfix = 'env';
		var customizer = '#theme-options';
		var customizer_el = jQuery(customizer);

		/**
		 *	Sets Cookies
		 */
		var set_cookie = function( id, key ){

			//if( document.cookie.indexOf(pfix + '_' + id) == -1 ){

				var date = new Date();
				date.setTime( date.getTime() + 3600000 );

				document.cookie = pfix + '_' + id + '=' + key + ';' +  ' expires=' + date.toUTCString() +'; path=/';

			//}

		}

		var get_cookie = function( id ){
			var c_name = pfix + '_' + id;

			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");

			if ( c_start == -1 ) {
				c_start = c_value.indexOf(c_name + "=");
			}

			if (c_start == -1) {
				c_value = null;

			} else {
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);

				if (c_end == -1) {
					c_end = c_value.length;
				}

				c_value = unescape(c_value.substring(c_start,c_end));
			}

			return c_value;
		}

		var _reload = function() {

			/**
			 *	Check Cookies Enabled
			 */
			set_cookie( 'is_enabled', true );
			if(document.cookie.indexOf(pfix + '_is_enabled') != -1) {
				window.location.reload();

			}

		}


		/**
		 *	Change Layout
		 */
		var layout_change = function() {
			var layout = get_cookie('site_layout');
			var body = jQuery('body');

			if ( layout == 'boxed' ) {

				var background_image = get_cookie('boxed_background');
				if ( ! background_image ) {
					background_image = CloudFwOp.themeurl + '/lib/patterns/wood_texture.png';
				} else {}

				var background_image_link = jQuery('a[data-src="'+ background_image +'"]', '.theme-options--boxed-background');
				var background_repeat = background_image_link.attr('data-bg-repeat');
				var background_size = background_image_link.attr('data-bg-size');
				var background_attachment = background_image_link.attr('data-bg-attachment');
				var background_position = background_image_link.attr('data-bg-position');

				body.addClass('layout--boxed').css({
					'background-image'		: 'url('+ background_image +')',
					'background-repeat'		: background_repeat,
					'background-size'		: background_size,
					'background-attachment'	: background_attachment,
					'background-position'	: background_position
				});
				jQuery(window).resize();

			} else if ( layout == 'default' ) {
				body.removeClass('layout--boxed').css({
					'background-image'		: '',
					'background-repeat'		: '',
					'background-size'		: '',
					'background-attachment'	: '',
					'background-position'	: ''
				});
				jQuery(window).resize();
			}

		}

		/**
		 *	Event Listeners
		 */
		jQuery('#theme-options--layout', customizer).change(function(){
			var value = jQuery(this).find('option:selected').val();

			set_cookie( 'site_layout', value );
			layout_change();
		});

		/**
		 *	Skins
		 */
		jQuery('#theme-options--skin a', customizer).click(function(){
			var value = jQuery(this).attr('data-id');

			set_cookie( 'custom_skin', value );
			_reload();
		});

		/**
		 *	Background Images
		 */
		jQuery('.theme-options--boxed-background a', customizer).click(function(){
			var value = jQuery(this).attr('data-src');

			set_cookie( 'boxed_background', value );
			jQuery('#theme-options--layout', customizer).find('option:contains("Boxed")').prop('selected', true).change();

			//layout_change();
		});

		/**
		 *	Background Images
		 */
		jQuery('#theme-options--reset', customizer).click(function(){
			set_cookie( 'custom_skin', null );
			set_cookie( 'site_layout', null );
			set_cookie( 'boxed_background', null );

			_reload();
		});


		layout_change();


		var load_homepages = function(){
			var homepages_div = jQuery('#section--theme-homepages');

			if ( ! customizer_el.hasClass('o--on') || ! homepages_div.hasClass('o--active') || homepages_div.hasClass('o--done') ) {
				return false;
			}

			homepages_div.addClass('o--done').find('img').each(function(){
				jQuery(this).attr('src', jQuery(this).attr('data-src'));
			});

			homepages_div.imagesLoaded(function(){
				var homepages = jQuery('.theme-options--homepages > a'),
					height = parseInt( homepages.first().height(), 10 );

				homepages.each(function(){

					var that = jQuery(this),
						image = that.find('img'),
						image_height = parseInt( image.height(), 10 );


					if ( image_height > height ) {
						image.css({
							marginBottom: ( height - image_height )
						});
					}

				});

			});

		}


		var load_thubms = function(){
			var thumbs_div = jQuery('#section--theme-options');

			if ( ! customizer_el.hasClass('o--on') || ! thumbs_div.hasClass('o--active') || thumbs_div.hasClass('o--done') ) {
				return false;
			}

			thumbs_div.addClass('o--done').find('[data-thumb-bg-src]').each(function(){
				var item = jQuery(this); 
				item.css({'background-image': 'url(' + item.attr('data-thumb-bg-src') + ')'});
			});

		}

		jQuery(document).ready( load_thubms );
		jQuery(document).ready( load_homepages );

	});
}(jQuery));