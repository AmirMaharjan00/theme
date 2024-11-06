/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *  
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	const themeCalls = {
		blogmaticGenerateTypoCss: function( selector, value ) {
			const { preset, font_family, font_weight, text_transform, text_decoration, font_size, line_height, letter_spacing } = value
			var cssCode = ''
			cssCode += '.blogmatic_font_typography { \n'
			if( font_family ) cssCode += selector + '-family: ' + this.blogmaticGetTypographyFormat( preset, font_family.value, '-family' ) + ';\n'

			if( font_weight ) cssCode += selector + '-weight: ' + this.blogmaticGetTypographyFormat( preset, font_weight.value, '-weight' ) + '; \n' + selector + '-style: ' + this.blogmaticGetTypographyFormat( preset, font_weight.variant, '-style' ) + ';\n'
			
			if( text_transform ) cssCode += selector + '-texttransform: ' + this.blogmaticGetTypographyFormat( preset, text_transform, '-texttransform' ) + ';\n'

			if( text_decoration ) cssCode += selector + '-textdecoration: ' + this.blogmaticGetTypographyFormat( preset, text_decoration, '-textdecoration' ) + ';\n'

			if( font_size ) {
				if( font_size.desktop ) cssCode += selector + '-size: ' + this.blogmaticGetTypographyFormat( preset, font_size.desktop, '-size' ) + ';\n'
				if( font_size.tablet ) cssCode += selector + '-size-tab: ' + this.blogmaticGetTypographyFormat( preset, font_size.tablet, '-size-tab' ) + ';\n'
				if( font_size.smartphone ) cssCode += selector + '-size-mobile: ' + this.blogmaticGetTypographyFormat( preset, font_size.smartphone, '-size-mobile' ) + ';\n'
			}
			if( line_height ) {
				if( line_height.desktop ) cssCode += selector + '-lineheight: ' + this.blogmaticGetTypographyFormat( preset, line_height.desktop, '-lineheight' ) + ';\n'
				if( line_height.tablet ) cssCode += selector + '-lineheight-tab: ' + this.blogmaticGetTypographyFormat( preset, line_height.tablet, '-lineheight-tab' ) + ';\n'
				if( line_height.smartphone ) cssCode += selector + '-lineheight-mobile: ' + this.blogmaticGetTypographyFormat( preset, line_height.smartphone, '-lineheight-mobile' ) + ';\n'
			}
			if( letter_spacing ) {
				if( letter_spacing.desktop ) cssCode += selector + '-letterspacing: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.desktop, '-letterspacing' ) + ';\n'
				if( letter_spacing.tablet ) cssCode += selector + '-letterspacing-tab: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.tablet, '-letterspacing-tab' ) + ';\n'
				if( letter_spacing.smartphone ) cssCode += selector + '-letterspacing-mobile: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.smartphone, '-letterspacing-mobile' ) + ';\n'
			}
			cssCode += '}'
			return cssCode
		},
		blogmaticGenerateTypoCssWithSelector: function( selector, value ) {
			const { preset, font_family, font_weight, text_transform, text_decoration, font_size, line_height, letter_spacing } = value
			var cssCode = ''
			if( font_family ) cssCode += selector + ' { font-family: ' + this.blogmaticGetTypographyFormat( preset, font_family.value, '-family' ) + '; } \n'

			if( font_weight ) cssCode += selector + ' { font-weight: ' + this.blogmaticGetTypographyFormat( preset, font_weight.value, '-weight' ) + ';\n  font-style: ' + this.blogmaticGetTypographyFormat( preset, font_weight.variant, '-style' ) + '; } \n'

			if( text_transform ) cssCode += selector + ' { text-transform: ' + this.blogmaticGetTypographyFormat( preset, text_transform, '-texttransform' ) + '; } \n'
			
			if( text_decoration ) cssCode += selector + ' { text-decoration: ' + this.blogmaticGetTypographyFormat( preset, text_decoration, '-textdecoration' ) + '; } \n'

			if( font_size ) {
				if( font_size.desktop ) cssCode += selector + ' { font-size: ' + this.blogmaticGetTypographyFormat( preset, font_size.desktop, '-size' ) + '; } \n'
				if( font_size.tablet ) cssCode += '@media(max-width: 940px) { ' + selector + ' { font-size: ' + this.blogmaticGetTypographyFormat( preset, font_size.tablet, '-size-tab' ) + '; } } \n'
				if( font_size.smartphone ) cssCode += '@media(max-width: 610px) { ' + selector + ' { font-size: ' + this.blogmaticGetTypographyFormat( preset, font_size.smartphone, '-size-mobile' ) + '; } } \n'
			}
			if( line_height ) {
				if( line_height.desktop ) cssCode += selector + ' { line-height: ' + this.blogmaticGetTypographyFormat( preset, line_height.desktop, '-lineheight' ) + '; } \n'
				if( line_height.tablet ) cssCode += '@media(max-width: 940px) { ' + selector + ' { line-height: ' + this.blogmaticGetTypographyFormat( preset, line_height.tablet, '-lineheight-tab' ) + '; } } \n'
				if( line_height.smartphone ) cssCode += '@media(max-width: 610px) { ' + selector + ' { line-height: ' + this.blogmaticGetTypographyFormat( preset, line_height.smartphone, '-lineheight-mobile' ) + '; } } \n'
			}
			if( letter_spacing ) {
				if( letter_spacing.desktop ) cssCode += selector + ' { letter-spacing: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.desktop, '-letterspacing' ) + '; } \n'
				if( letter_spacing.tablet ) cssCode += '@media(max-width: 940px) { ' + selector + ' { letter-spacing: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.tablet, '-letterspacing-tab' ) + '; } } \n'
				if( letter_spacing.smartphone ) cssCode += '@media(max-width: 610px) { ' + selector + ' { letter-spacing: ' + this.blogmaticGetTypographyFormat( preset, letter_spacing.smartphone, '-letterspacing-mobile' ) + '; } } \n'
			}
			return cssCode
		},
		blogmaticGenerateStyleTag: function( code, id ) {
			if( code ) {
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id ).html( code )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + code + '</style>' )
				}
			} else {
				$( "head #" + id ).remove()
			}
		},
		blogmaticGetTypographyFormat: function( preset, value, suffix ) {
			if( preset === '-1' ) {
				let unitsArray = [ '-size', '-size-tab', '-size-mobile', '-lineheight', '-lineheight-tab', '-lineheight-mobile', '-letterspacing', '-letterspacing-tab', '-letterspacing-mobile' ]
				return ( unitsArray.includes( suffix ) ) ? value + 'px' : value;
			} else {
				let variable = 'var(--blogmatic-global-preset-typography-' + ( parseInt( preset ) + 1 ) + '-font' + suffix + ')';
				return variable
			}
		}
	}

	// typography preset
	wp.customize( 'typography_presets', function( value ) {
		value.bind( function(to) {
			const { typographies, labels } = to
			typographies.forEach(( typography, index ) => {
				ajaxFunctions.typoFontsEnqueue( typography )
				let variable = '--blogmatic-global-preset-typography-';
               	let count = index + 1;
               	variable += count + '-font';
				cssCode = themeCalls.blogmaticGenerateTypoCss( variable, typography )
				themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-typography-preset-' + count )
			})
		});
	});

	// background color
	wp.customize( 'background_image', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			if( to ) {
				cssCode += 'body:before{ display: none; }';
			} else {
				cssCode += 'body:before{ display: block; }';
			}
			themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-body-image-background' )
		});
	});

	// global button label
	wp.customize( 'global_button_label', function( value ) {
		value.bind( function(to) {
			if( $( "article .content-wrap .post-button" ).find('.button-text').length > 0 ) {
				$( "article .content-wrap .post-button" ).find('.button-text').text( to )
			} else {
				$( "article .content-wrap .post-button" ).prepend('<span class="button-text">'+ to +'</span>')
			}
		});
	});

	// theme color bind changes
	wp.customize( 'theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-color-style', '--blogmatic-global-preset-theme-color')
		});
	});

	// gradient theme color bind changes
	wp.customize( 'gradient_theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-1-style', '--blogmatic-global-preset-gradient-theme-color')
		});
	});

	// solid color presets
	wp.customize( 'solid_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'blogmatic-solid-presets', '--blogmatic-global-preset-color-' )
		});
	});

	// gradient color presets
	wp.customize( 'gradient_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'blogmatic-gradient-presets', '--blogmatic-global-preset-gradient-' )
		});
	});

	// preloader styles
	wp.customize( 'preloader_styles', function( value ) {
		value.bind( function(to) {
			var toRenderElement = $('.blogmatic_loading_box')
			toRenderElement.show()
			toRenderElement.removeClass('preloader-style--one preloader-style--two preloader-style--three preloader-style--four preloader-style--five')
			toRenderElement.addClass('preloader-style--' + to)
			setTimeout( function() {
				$( "body .blogmatic_loading_box" ).hide()
			}, 2000)
		});
	});

	// single post related articles title option
	wp.customize( 'single_post_related_posts_title', function( value ) {
		value.bind( function(to) {
			if( $( ".single-related-posts-section-wrap" ).find('.blogmatic-block-title span').length > 0 ) {
				$( ".single-related-posts-section-wrap" ).find('.blogmatic-block-title span').text( to )
			} else {
				$( ".single-related-posts-section-wrap .single-related-posts-section" ).prepend('<h2 class="blogmatic-block-title"><span>'+ to +'</span></h2>')
			}
		});
	});

	// single post related articles no of column
	wp.customize( 'related_posts_no_of_column', function( value ) {
		value.bind( function(to) {
			$('body.single .single-related-posts-section-wrap').removeClass( 'column--one column--two column--three' ).addClass( 'column--' + blogmatic_get_numeric_string( parseInt( to ) ) )
		});
	});

	// global sidebar sticky option
	wp.customize( 'sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$("body").addClass( "blogmatic-stickey-sidebar--enabled" ).removeClass( "blogmatic-stickey-sidebar--disabled" )
			} else {
				$("body").removeClass( "blogmatic-stickey-sidebar--enabled" ).addClass( "blogmatic-stickey-sidebar--disabled" )
			}
		});
	});

	// blog description
	wp.customize( 'blogdescription_option', function( value ) {
		value.bind(function(to) {
			if( to ) {
				$( '.site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		})
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			var cssCode = '.blogmatic-light-mode .site-header .site-title a { color: '+ to +' }'
			themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-site-title' )
		} );
	});

	// site title hover color
	wp.customize( 'site_title_hover_textcolor', function( value ) {
		value.bind( function( to ) {
			var cssCode = '.blogmatic-light-mode .site-header .site-title a:hover { color: '+ to +' }'
			themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-site-title-hover' )
		} );
	});

	// site description color
	wp.customize( 'site_description_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css( {
				color: to,
			});
		} );
	});

	// single post related articles title option
	wp.customize( 'stt_text', function( value ) {
		value.bind( function(to) {
			if( $( ".blogmatic-scroll-btn" ).find('.icon-text').length > 0 ) {
				$( ".blogmatic-scroll-btn" ).find('.icon-text').text( to )
			} else {
				$( ".blogmatic-scroll-btn" ).prepend('<span class="icon-text">'+ to +'</span>')
			}
		});
	});
	
	// scroll to top icon picker
	wp.customize( 'stt_icon', function( value ) {
		value.bind( function(to) {
			if( to.type == 'none' ) {
				$( '.blogmatic-scroll-btn .icon-holder' ).hide()
			} else {
				$( '.blogmatic-scroll-btn .icon-holder' ).show()
			}
		});
	});

	var parsedCats = blogmaticPreviewObject.totalCats
	if( parsedCats ) {
		parsedCats = Object.keys( parsedCats ).map(( key ) => { return parsedCats[key] })
		parsedCats.forEach(function(item) {
			wp.customize( 'category_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a, body.archive.category.category-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i { color : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
					}
					if( hover ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a:hover, body.archive.category.category-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i:hover { color : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
					}
					themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-category-' + item.term_id + '-style' )
				})
			})
			wp.customize( 'category_background_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a, body.archive.category.category-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i { background : " + blogmatic_get_color_format( initial[ hover.type ] ) + " } "
					}
					if( hover ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a:hover, body.archive.category.category-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i:hover { background : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
					}
					themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-category-background-' + item.term_id + '-style' )
				})
			})
		})
	}
	
	var parsedTags = blogmaticPreviewObject.totalTags
	if( parsedTags ) {
		parsedTags = Object.keys( parsedTags ).map(( key ) => { return parsedTags[key] })
		parsedTags.forEach(function(item) {
			wp.customize( 'tag_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + " span, body.archive.tag.tag-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i { color : " + blogmatic_get_color_format( initial[ hover.type ] ) + " } "
					}
					if( hover ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ":hover span, body.archive.tag.tag-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i:hover { color : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
					}
					themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-tag-' + item.term_id + '-style' )
				})
			})
			wp.customize( 'tag_background_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ", body.archive.tag.tag-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i { background : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
					}
					if( hover ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ":hover, body.archive.tag.tag-" + item.term_id + " #blogmatic-main-wrap .page-header .blogmatic-container i:hover { background : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
					}
					themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-tag-background-' + item.term_id + '-style' )
				})
			})
		})
	}

	// custom button label
	wp.customize( 'custom_button_label', function( value ) {
		value.bind( function( to ) {
			if( $( "#masthead .header-custom-button-wrapper" ).find('.custom-button-label').length > 0 ) {
				$( "#masthead .header-custom-button-wrapper" ).find('.custom-button-label').text( to )
			} else {
				$( "#masthead .header-custom-button-wrapper .header-custom-button" ).append('<span class="custom-button-label">'+ to +'</span>')
			}
		})
	})

	// custom button icon context
	wp.customize( 'custom_button_icon_prefix_suffix', function( value ) {
		value.bind( function( to ) {
			if( $( "#masthead .custom-button-icon" ).length > 0 ) {
				if( to == 'suffix' ) {
					$( "#masthead .custom-button-icon" ).appendTo( '#masthead .header-custom-button' ).removeClass( 'icon_before' ).addClass( 'icon_after' )
				} else {
					$( "#masthead .custom-button-icon" ).prependTo( '#masthead .header-custom-button' ).removeClass( 'icon_after' ).addClass( 'icon_before' )
				}
			}
		})
	})

	// custom button icon distance
	wp.customize( 'custom_button_icon_distance', function( value ) {
		value.bind( function( to ) {
			if( $( "body .site-header .header-custom-button .custom-button-icon" ).hasClass( "icon_after" ) ) {
				$( ".site-header .header-custom-button .custom-button-icon.icon_after" ).css( "padding-left", to + "px" )
			} else {
				$( "body .site-header .header-custom-button .custom-button-icon" ).css( "padding-right", to + "px" )
			}
		})
	})

	// archive posts column
	wp.customize( 'archive_post_column', function( value ) {
		value.bind( function( to ) {
			if( to.desktop ) {
				$("body").removeClass( "archive-desktop-column--one archive-desktop-column--two archive-desktop-column--three archive-desktop-column--four" )
				$("body").addClass( "archive-desktop-column--" + blogmatic_get_numeric_string( to.desktop ) )
			}
			if( to.tablet ) {
				$("body").removeClass( "archive-tablet-column--one archive-tablet-column--two archive-tablet-column--three archive-tablet-column--four" )
				$("body").addClass( "archive-tablet-column--" + blogmatic_get_numeric_string( to.tablet ) )
			}
			if( to.smartphone ) {
				$("body").removeClass( "archive-mobile-column--one archive-mobile-column--two archive-mobile-column--three archive-mobile-column--four" )
				$("body").addClass( "archive-mobile-column--" + blogmatic_get_numeric_string( to.smartphone ) )
			}
		})
	})

	// search form show hide
	wp.customize( 'search_page_form_show_hide', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$('body.search main#primary').find('.blogmatic_search_page').show()
			} else {
				$('body.search main#primary').find('.blogmatic_search_page').hide()
			}
		})
	})

	// search form button text
	wp.customize( 'search_page_button_text', function( value ) {
		value.bind( function( to ) {
			$('.search-form').find('input[type="submit"].search-submit').val(to)
		})
	})

	// 404 button show hide
	wp.customize( 'error_page_button_show_hide', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$('.error-404.not-found').find('.back_to_home_btn').show()
			} else {
				$('.error-404.not-found').find('.back_to_home_btn').hide()
			}
		})
	})

	// category info box title html tag
	wp.customize( 'archive_category_info_box_title_tag', function( value ) {
		value.bind( function(to) {
			var element = $('body.archive.category .site #blogmatic-main-wrap .page-header .blogmatic-container .page-title')
			var replacingElement = '<'+ to +' class="page-title">'+ element.text() +'</'+ to +'>'
			element.replaceWith( replacingElement )
		})
	})

	// tag info box title html tag
	wp.customize( 'archive_tag_info_box_title_tag', function( value ) {
		value.bind( function(to) {
			var element = $('body.archive.tag .site #blogmatic-main-wrap .page-header .blogmatic-container .page-title')
			var replacingElement = '<'+ to +' class="page-title">'+ element.text() +'</'+ to +'>'
			element.replaceWith( replacingElement )
		})
	})

	// author info box title html tag
	wp.customize( 'archive_author_info_box_title_tag', function( value ) {
		value.bind( function(to) {
			var element = $('body.archive.author .site #blogmatic-main-wrap .page-header .blogmatic-container .page-title')
			var replacingElement = '<'+ to +' class="page-title">'+ element.text() +'</'+ to +'>'
			element.replaceWith( replacingElement )
		})
	})

	// pagination ajax load more icon context
	wp.customize( 'archive_pagination_button_icon_context', function( value ) {
		value.bind( function( to ) {
			if( $( "body .pagination.pagination-type--ajax-load-more .pagination-icon" ).length > 0 ) {
				if( to == 'suffix' ) {
					$( "body .pagination.pagination-type--ajax-load-more .pagination-icon" ).removeClass('icon-context--before').addClass('icon-context--after').appendTo( 'body .pagination.pagination-type--ajax-load-more .ajax-load-more-wrap' )
				} else {
					$( "body .pagination.pagination-type--ajax-load-more .pagination-icon" ).removeClass('icon-context--after').addClass('icon-context--before').prependTo( 'body .pagination.pagination-type--ajax-load-more .ajax-load-more-wrap' )
				}
			}
		})
	})
	
	// error page icon context
	wp.customize( 'error_page_button_icon_context', function( value ) {
		value.bind( function( to ) {
			if( $( "body.error404 #blogmatic-main-wrap #primary .page-content .back_to_home_btn i" ).length > 0 ) {
				if( to == 'suffix' ) {
					$( "body.error404 #blogmatic-main-wrap #primary .page-content .back_to_home_btn i" ).appendTo( 'body.error404 #blogmatic-main-wrap #primary .page-content .back_to_home_btn a' )
				} else {
					$( "body.error404 #blogmatic-main-wrap #primary .page-content .back_to_home_btn i" ).prependTo( 'body.error404 #blogmatic-main-wrap #primary .page-content .back_to_home_btn a' )
				}
			}
		})
	})

	// social share icon color type
	wp.customize( 'social_share_icon_color_type', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$('body #blogmatic-main-wrap main#primary .blogmatic-inner-content-wrap .blogmatic-social-share').removeClass('color-inherit--custom').addClass('color-inherit--global')
				$('.blogmatic-social-share').each(function(){
					$(this).find('.social-share').each(function( _thisindex ){
						$(this).removeClass( 'social-item--' + ( _thisindex + 1 ) )
					})
				})
			} else {
				$('body #blogmatic-main-wrap main#primary .blogmatic-inner-content-wrap .blogmatic-social-share').removeClass('color-inherit--global').addClass('color-inherit--custom')
				$('.blogmatic-social-share').each(function(){
					$(this).find('.social-share').each(function( _thisindex ){
						$(this).addClass( 'social-item--' + ( _thisindex + 1 ) )
					})
				})
			}
		})
	})

	// instagram number of columns
	wp.customize( 'instagram_no_of_columns', function( value ) {
		value.bind( function( to ) {
			if( to.desktop ) {
				$(".blogmatic-instagram-section").removeClass( "column--one column--two column--three column--four column--five column--six column--seven column--eight column--nine column--ten" )
				$(".blogmatic-instagram-section").addClass( "column--" + blogmatic_get_numeric_string( to.desktop ) )
			}
			if( to.tablet ) {
				$(".blogmatic-instagram-section").removeClass( "tab-column--one tab-column--two tab-column--three tab-column--four tab-column--five tab-column--six tab-column--seven tab-column--eight tab-column--nine tab-column--ten" )
				$(".blogmatic-instagram-section").addClass( "tab-column--" + blogmatic_get_numeric_string( to.tablet ) )
			}
			if( to.smartphone ) {
				$(".blogmatic-instagram-section").removeClass( "mobile-column--one mobile-column--two mobile-column--three mobile-column--four mobile-column--five mobile-column--six mobile-column--seven mobile-column--eight mobile-column--nine mobile-column--ten" )
				$(".blogmatic-instagram-section").addClass( "mobile-column--" + blogmatic_get_numeric_string( to.smartphone ) )
			}
		})
	})

	// instagram show instagram button
	wp.customize( 'show_instagram_button', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$('.blogmatic-instagram-section .instagram-button').show()
			} else {
				$('.blogmatic-instagram-section .instagram-button').hide()
			}
		})
	})

	// instagram button text
	wp.customize( 'instagram_button_text', function( value ) {
		value.bind( function( to ) {
			if( $( ".blogmatic-instagram-section .instagram-button" ).find('.instagram-label').length > 0 ) {
				$( ".blogmatic-instagram-section .instagram-button" ).find('.instagram-label').text( to )
			} else {
				$( ".blogmatic-instagram-section .instagram-button a" ).append('<span class="instagram-label">'+ to +'</span>')
			}
		})
	})

	// category collection number of columns
	wp.customize( 'category_collection_number_of_columns', function( value ) {
		value.bind( function( to ) {
			if( to.desktop ) {
				$("#blogmatic-category-collection-section").removeClass( "column--one column--two column--three column--four column--five" )
				$("#blogmatic-category-collection-section").addClass( "column--" + blogmatic_get_numeric_string( to.desktop ) )
			}
			if( to.tablet ) {
				$("#blogmatic-category-collection-section").removeClass( "tab-column--one tab-column--two tab-column--three tab-column--four tab-column--five" )
				$("#blogmatic-category-collection-section").addClass( "tab-column--" + blogmatic_get_numeric_string( to.tablet ) )
			}
			if( to.smartphone ) {
				$("#blogmatic-category-collection-section").removeClass( "mobile-column--one mobile-column--two mobile-column--three mobile-column--four mobile-column--five" )
				$("#blogmatic-category-collection-section").addClass( "mobile-column--" + blogmatic_get_numeric_string( to.smartphone ) )
			}
		})
	})

	// toc list icon
	wp.customize( 'toc_list_icon', function( value ) {
		value.bind( function(to) {
			if( $('body.single .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).length > 0 ) {
				if( to.type == 'none' ) {
					$('body.single .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).hide()
				} else {
					$('body.single .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).show()
					$('body.single .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).removeClass().addClass( to.value )
				}
			} else {
				$('body.single .blogmatic-table-of-content .toc-list-item').prepend('<span class="toc-heading-icon"><i class="'+ to.value +'"></i></span>')
			}
		});
	});

	// toc title
	wp.customize( 'toc_heading_option', function( value ) {
		value.bind( function(to) {
			if( $( ".blogmatic-table-of-content" ).find('.table-of-content-title-wrap h2').length > 0 ) {
				$( ".blogmatic-table-of-content" ).find('.table-of-content-title-wrap h2').text( to )
			} else {
				$( ".blogmatic-table-of-content .table-of-content-title-wrap" ).prepend('<h2 class="toc-title">'+ to +'</h2>')
			}
		});
	});

	// page toc list icon
	wp.customize( 'page_toc_list_icon', function( value ) {
		value.bind( function(to) {
			if( $('body.page .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).length > 0 ) {
				if( to.type == 'none' ) {
					$('body.page .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).hide()
				} else {
					$('body.page .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).show()
					$('body.page .blogmatic-table-of-content .toc-list-item .toc-heading-icon').find( 'i' ).removeClass().addClass( to.value )
				}
			} else {
				$('body.page .blogmatic-table-of-content .toc-list-item').prepend('<span class="toc-heading-icon"><i class="'+ to.value +'"></i></span>')
			}
		});
	});

	// page toc title
	wp.customize( 'page_toc_heading_option', function( value ) {
		value.bind( function(to) {
			if( $( ".blogmatic-table-of-content" ).find('.table-of-content-title-wrap h2').length > 0 ) {
				$( ".blogmatic-table-of-content" ).find('.table-of-content-title-wrap h2').text( to )
			} else {
				$( ".blogmatic-table-of-content .table-of-content-title-wrap" ).prepend('<h2 class="toc-title">'+ to +'</h2>')
			}
		});
	});

	// cursor animation
	wp.customize( 'cursor_animation', function( value ) {
		value.bind( function(to) {
			if( to != 'none' ) {
				$('body .blogmatic-cursor').removeClass( 'type--one type--two' ).addClass( 'type--' + to )
			} else {
				$('body .blogmatic-cursor').removeClass( 'type--one type--two' )
			}
		});
	});

	// social share repeater
	wp.customize( 'social_share_repeater', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			$('.blogmatic-social-share').each(function(){
				// add item
				if( $(this).find( '.social-share' ).length < to.length && $(this).parents('body').hasClass( 'single' ) ) {
					let lastChild = $(this).find( '.social-share:last-child' )
					let addToList = lastChild.clone()
					let lastChildClassCount = lastChild.attr( 'class' ).split( ' ' )
					if( lastChildClassCount.length > 1 ) {
						addToList.addClass( 'social-item--' + to.length )
					}
					$(this).find( '.social-shares' ).append( addToList )
				}
				$(this).find( '.social-share' ).each(function( index ){
					var _this = $(this)
					if( to[index] == undefined ) {	// when icon is type none
						_this.remove()
						return;
					}
					if( ( index + 1 ) > to.length ) _this.remove()	// remove last element
					if( ( index + 1 ) <= to.length ) {
						// for icons
						const { icon, color, background } = to[index]
						_this.find( 'i' ).removeClass().addClass( icon )	// replace icon class
						if( _this.hasClass( 'social-item--' + ( index + 1 ) ) ) {
							// for colors
							if( 'initial' in color ) {
								const initial = color.initial
								const hover = color.hover
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" i { color : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" a:hover i { color : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
							} else {
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" i { color : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
							}

							// for backgrounds
							if( 'initial' in background ) {
								const initial = background.initial
								const hover = background.hover
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" a i { background : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" a:hover i { background : " + blogmatic_get_color_format( hover[ hover.type ] ) + " } "
							} else {
								cssCode += "body .blogmatic-social-share .social-share.social-item--"+ ( index + 1 ) +" a i { background : " + blogmatic_get_color_format( initial[ initial.type ] ) + " } "
							}
						}
					}
				})
			})
			themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-social-share-styles' )
		});
	});

	// you may have missed no of columns
	wp.customize( 'you_may_have_missed_no_of_columns', function( value ) {
		value.bind( function(to) {
			$('#blogmatic-you-may-have-missed-section').removeClass( 'no-of-columns--two no-of-columns--three no-of-columns--four' ).addClass( 'no-of-columns--' + blogmatic_get_numeric_string( parseInt(to) ) )
		});
	});

	// you may have missed section title option
	wp.customize( 'you_may_have_missed_title_option', function( value ) {
		value.bind( function(to) {
			if( $( "#blogmatic-you-may-have-missed-section" ).find('.section-title').length > 0 ) {
				if( to ){
					$('#blogmatic-you-may-have-missed-section .section-title').show()
				} else {
					$('#blogmatic-you-may-have-missed-section .section-title').hide()
				}
			} else {
				var sectionTitleControl = wp.customize.instance('you_may_have_missed_title').get();
				$( "#blogmatic-you-may-have-missed-section .blogmatic-you-may-missed-inner-wrap" ).prepend('<div class="blogmatic-block-title">'+ sectionTitleControl +'</div>')
			}
		});
	});

	// you may have missed section title
	wp.customize( 'you_may_have_missed_title', function( value ) {
		value.bind( function(to) {
			if( $( "#blogmatic-you-may-have-missed-section" ).find('.section-title').length > 0 ) {
				$( "#blogmatic-you-may-have-missed-section" ).find('.section-title').text( to )
			} else {
				$( "#blogmatic-you-may-have-missed-section .blogmatic-you-may-missed-inner-wrap" ).prepend('<div class="section-title">'+ to +'</div>')
			}
		});
	})

	// canvas menu position
	wp.customize( 'canvas_menu_position', function( value ) {
		value.bind( function( to ) {
			if( to == 'right' ) {
				$('body').removeClass('blogmatic-canvas-position--left').addClass('blogmatic-canvas-position--right')
			} else {
				$('body').removeClass('blogmatic-canvas-position--right').addClass('blogmatic-canvas-position--left')
			}
		})
	})

	// Set dark mode as default
	wp.customize( 'theme_mode_set_dark_mode_as_default', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$('body').removeClass('blogmatic-light-mode blogmatic-dark-mode').addClass('blogmatic-dark-mode')
			} else {
				$('body').removeClass('blogmatic-light-mode blogmatic-dark-mode').addClass('blogmatic-light-mode')
			}
		})
	})

	// video playlist slider icon size
	wp.customize( 'video_playlist_slider_icon_size', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			var imageSelector = 'body .blogmatic-video-playlist.layout--two .player-list-wrap .swiper-arrow img'
			var iconSelector = 'body .blogmatic-video-playlist.layout--two .player-list-wrap .swiper-arrow i'
			if( $( imageSelector ).length > 0 ) cssCode += imageSelector + "{ width : "+ to +"px } " 
			if( $( iconSelector ).length > 0 ) cssCode += iconSelector + "{ font-size : "+ to +"px } "
			themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-video-playlist-slider-icon-size' )	
		})
	})

	// post format
	var postFormatIds = { 
		'standard': 'standard_post_format_icon_picker',
		'audio': 'audio_post_format_icon_picker',
		'gallery': 'gallery_post_format_icon_picker',
		'image': 'image_post_format_icon_picker',
		'quote': 'quote_post_format_icon_picker',
		'video': 'video_post_format_icon_picker' 
	}
	Object.entries( postFormatIds ).map(( [ currentKey, currentValue ] ) => {
		wp.customize( currentValue, function( value ) {
			value.bind( function(to) {
				if( to.type == 'none' ) {
					$( 'article.format-'+ currentKey +' .post-format-ss-wrap .post-format-icon' ).hide()
				} else {
					$( 'article.format-'+ currentKey +' .post-format-ss-wrap .post-format-icon' ).show()
				}
			});
		});
	})

	// check if string is variable and formats 
	function blogmatic_get_color_format( color ) {
		if( color === null ) return color
		if( color.includes('--blogmatic-global-preset-') ) {
			return ( 'var('+ color +')' )
		} else {
			return color
		}
	}

	function blogmatic_get_background_style( control ) {
	   	if( control ) {
			var cssCode = '', mediaUrl = '', repeat = '', position = '', attachment = '', size = ''
			switch( control.type ) {
			case 'image' : 
			 		if( 'id' in control.image ) mediaUrl = 'background-image: url(' + control.image.url + ');'
					if( 'repeat' in control ) repeat = " background-repeat: "+ control.repeat + ';'
					if( 'position' in control ) position = " background-position: "+ control.position + ';'
					if( 'attachment' in control ) attachment = " background-attachment: "+ control.attachment + ';'
					if( 'size' in control ) size = " background-size: "+ control.size + ';'
					return cssCode.concat( mediaUrl, repeat, position, attachment, size )
				break;
			default: 
			if( 'type' in control ) return "background: " + blogmatic_get_color_format( control[control.type] )
		  }
		}
	}

	// converts integer to string for attibutes value 
	function blogmatic_get_numeric_string(int) {
		switch( int ) {
			case 2:
				return "two";
				break;
			case 3:
				return "three";
				break;
			case 4:
				return "four";
				break;
			case 5:
				return "five";
				break;
			case 6:
				return "six";
				break;
			case 7:
				return "seven";
				break;
			case 8:
				return "eight";
				break;
			case 9:
				return "nine";
				break;
			case 10:
				return "ten";
				break;
			default:
				return "one";
		}
	}

	// constants
	const ajaxFunctions = {
		typoFontsEnqueue: function( typography ) {
			const { font_family, font_weight } = typography
			let linkTag = document.getElementById('blogmatic-generated-typo-fonts')
			let googleFontsUrl = 'https://fonts.googleapis.com/css2?'
			let googleFontsUrlQuery
			let fontStyle = ( font_weight.variant === 'italic' ) ? 'ital,wght@' : 'wght@'
			if( linkTag !== null ) {
				let parser = new URL( linkTag.href )
				let query = parser.search
				let toAppend = parseTheFontsQuery( query, typography )
				linkTag.href = googleFontsUrl + toAppend
			} else {
				let newLinkTag = document.createElement('link')
				newLinkTag.rel = 'stylesheet'
				newLinkTag.id = 'blogmatic-generated-typo-fonts'
				googleFontsUrlQuery = 'family=' + font_family.value + ':' + fontStyle + font_weight.value
				newLinkTag.href = googleFontsUrl + googleFontsUrlQuery
				document.head.appendChild( newLinkTag );
			}
		}
	}

	/**
     * Append new font family 
     * 
     * @since 1.0.0
     */
    const parseTheFontsQuery = ( query, typography ) => {
        const { font_weight:WEIGHT, font_family:FAMILY } = typography
        let toParse = query
        let removeQuestionMark = toParse.replaceAll( '?', '' )
        let filteredQuery = removeQuestionMark.replaceAll( '&', '' )
        let fontFamilyQuery = filteredQuery.split( 'family=' )
        let fontStyleProperty = WEIGHT.variant === 'italic' ? 'ital' : 'wght'
        var fontFamily = [ FAMILY.value ], fontWeight = { [FAMILY.value]: [ WEIGHT.value ] }, fontStyle = { [FAMILY.value]: [ fontStyleProperty ]}
		let filteredFamily = fontFamily.map(( current ) => {
			return current.replaceAll( '%20', ' ' )
		})
        fontFamilyQuery.forEach(( current ) => {
            if( current !== '' ) {
                let splitFamily = current.split( ':' )
                let family = splitFamily[0]
                if ( ! filteredFamily.includes( family ) ) filteredFamily.push( family );
                let splitWeightAndStyle = splitFamily[1].split('@')
                let weight = splitWeightAndStyle[1].replaceAll( '0,', '' ).replaceAll( '1,', '' ).replaceAll( ',', '' )
                let style = splitWeightAndStyle[0]
                if ( ! fontWeight[family] ) fontWeight[family] = []
                if ( ! fontStyle[family] ) fontStyle[family] = []
                if ( ! fontStyle[family].includes( style ) ) fontStyle[family].push( ...style.split(',') );
				
                if ( ! fontWeight[family].includes( weight ) ) fontWeight[family].push( ...weight.split(';') );
            }
        })
        let toAppend = filteredFamily.map(( family ) => {
			let sortedWeights = fontWeight[family].sort(( first, second ) => { return first - second })
			let duplicateRemovedWeights =  [ ...new Set( sortedWeights ) ]	//weights
			let duplicateRemovedStyles =  [ ...new Set( fontStyle[family] ) ]	// styles
			var structuredFontStyles, temporaryStyles = []
			if( duplicateRemovedStyles.includes( 'ital' ) ) {
				duplicateRemovedWeights.forEach(( current ) => { 
					if( current !== undefined && current !== '' ) temporaryStyles.push( '0,' + current + ';' )
				})
				duplicateRemovedWeights.forEach(( current, index ) => { 
					if( current !== undefined && current !== '' ) temporaryStyles.push( '1,' + current + ( index + 1 === duplicateRemovedWeights.length ? '' : ';' ) )
				})
				structuredFontStyles = temporaryStyles.join('')
			} else {
				structuredFontStyles = duplicateRemovedWeights.join(';')
			}
            return 'family=' + family + ':' + duplicateRemovedStyles.sort() + '@' + structuredFontStyles
        }).join('&')
        return toAppend;
    }

	// constants
	const helperFunctions = {
		generateStyle: function(color, id, variable) {
			if(color) {
				if( id === 'theme-color-style' ) {
					var styleText = 'body { ' + variable + ': ' + color + '}';
				} else {
					var styleText = 'body { ' + variable + ': ' + blogmatic_get_color_format( color ) + '}';
				}
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		},
		bulkGenerateStyle: function( colors, id, variablePrefix ) {
			if( colors.length > 0 ) {
				let styleText = 'body {'
				colors.forEach(( color, index ) => {
					let count = index + 1
					styleText += variablePrefix + count + ': ' + color + ';'
				})
				styleText += '}'
				
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		}
	}

	class BlogmaticCustomize {

		/**
		 * Method that gets called when class is instantiated
		 * 
		 * @since 1.0.0
		 */
		constructor() {
			this.preview();
		}

		/**
		 * Set suffix in given id
		 * 
		 * @since 1.0.0
		 */
		setSuffix = ( id, suffix, property = '' ) => {
			if( property != '' ) {
				return id + '-' + suffix + '+' + property
			} else {
				return id + '-' + suffix
			}
		}

		/**
		 * checks if the given string is class or css variable
		 * 
		 * @since 1.0.0
		 */
		isVariale = ( selector ) => {
			let mainSelector = selector
			if( typeof selector == 'object' ) {
				mainSelector = selector['selector']
			}
			if( mainSelector.length < 12 ) return false;
			let prefix = mainSelector.slice( 0, 11 )
			if( prefix == '--blogmatic' ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Returns list of all typography controls id and selectors 
		 * 
		 * @since 1.0.0
		 */	
		_getTypography = () => {
			let suffix = 'typography'

			return {
				// variable
				[ this.setSuffix( 'global_button_typo' , suffix) ] : '--blogmatic-readmore-font',
				[ this.setSuffix( 'site_title_typo' , suffix) ] : '--blogmatic-site-title',
				[ this.setSuffix( 'site_description_typo' , suffix) ] : '--blogmatic-site-description',
				[ this.setSuffix( 'custom_button_text_typography' , suffix) ] : '--blogmatic-custom-button',
				[ this.setSuffix( 'main_menu_typo' , suffix) ] : '--blogmatic-menu',
				[ this.setSuffix( 'footer_menu_typography' , suffix) ] : '--blogmatic-footer-menu',
				[ this.setSuffix( 'date_time_typography' , suffix) ] : '--blogmatic-date-time',
				[ this.setSuffix( 'main_menu_sub_menu_typo' , suffix) ] : '--blogmatic-submenu',
				[ this.setSuffix( 'archive_title_typo' , suffix) ] : '--blogmatic-post-title-font',
				[ this.setSuffix( 'archive_excerpt_typo' , suffix) ] : '--blogmatic-post-content-font',
				[ this.setSuffix( 'archive_category_typo' , suffix) ] : '--blogmatic-category-font',
				[ this.setSuffix( 'archive_date_typo' , suffix) ] : '--blogmatic-date-font',
				[ this.setSuffix( 'archive_author_typo' , suffix) ] : '--blogmatic-author-font',
				[ this.setSuffix( 'archive_read_time_typo' , suffix) ] : '--blogmatic-readtime-font',
				[ this.setSuffix( 'archive_comment_typo' , suffix) ] : '--blogmatic-comment-font',
				[ this.setSuffix( 'category_collection_typo' , suffix) ] : '--blogmatic-category-collection-font',
				[ this.setSuffix( 'you_may_have_missed_design_section_title_typography' , suffix) ] : '--blogmatic-youmaymissed-block-title-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_title_typography' , suffix) ] : '--blogmatic-youmaymissed-title-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_categories_typography' , suffix) ] : '--blogmatic-youmaymissed-category-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_date_typography' , suffix) ] : '--blogmatic-youmaymissed-date-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_author_typography' , suffix) ] : '--blogmatic-youmaymissed-author-font',
				[ this.setSuffix( 'sidebar_block_title_typography' , suffix) ] : '--blogmatic-widget-block-font',
				[ this.setSuffix( 'sidebar_post_title_typography' , suffix) ] : '--blogmatic-widget-title-font',
				[ this.setSuffix( 'sidebar_category_typography' , suffix) ] : '--blogmatic-widget-category-font',
				[ this.setSuffix( 'sidebar_date_typography' , suffix) ] : '--blogmatic-widget-date-font',
				[ this.setSuffix( 'sidebar_date_typography' , suffix) ] : '--blogmatic-widget-date-font',
				[ this.setSuffix( 'footer_instagram_button_typo' , suffix) ] : '--blogmatic-footer-instagram-font',
				[ this.setSuffix( 'main_banner_design_post_title_typography' , suffix) ] : '--blogmatic-banner-title-font',
				[ this.setSuffix( 'main_banner_design_post_excerpt_typography' , suffix) ] : '--blogmatic-banner-excerpt-font',
				// classes
				[ this.setSuffix( 'breadcrumb_typo', suffix ) ] : 'body .blogmatic-breadcrumb-wrap ul li span[itemprop="name"]',
				[ this.setSuffix( 'archive_category_info_box_title_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.category .page-header .page-title, .archive.date .page-header .page-title',
				[ this.setSuffix( 'archive_category_info_box_description_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.category .page-header .archive-description',
				[ this.setSuffix( 'archive_tag_info_box_title_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.tag .page-header .page-title',
				[ this.setSuffix( 'archive_tag_info_box_description_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.tag .page-header .archive-description',
				[ this.setSuffix( 'archive_author_info_box_title_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.author .page-header .page-title',
				[ this.setSuffix( 'archive_author_info_box_description_typo', suffix ) ] : 'body.blogmatic_font_typography.archive.author .page-header .archive-description',
				[ this.setSuffix( 'single_title_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography .site-main article .entry-title, body.single-post.blogmatic_font_typography .single-header-content-wrap .entry-title',
				[ this.setSuffix( 'single_content_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography .site-main article .entry-content',
				[ this.setSuffix( 'single_category_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography #primary article .post-categories .cat-item a, body.single-post.blogmatic_font_typography .single-header-content-wrap .post-categories .cat-item a',
				[ this.setSuffix( 'single_date_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography .post-meta-wrap .post-date, body.single-post.blogmatic_font_typography .single-header-content-wrap.post-meta .post-date',
				[ this.setSuffix( 'single_author_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography .site-main article .post-meta-wrap .byline, body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta-wrap .byline',
				[ this.setSuffix( 'single_read_time_typo', suffix ) ] : 'body.single-post.blogmatic_font_typography #primary .blogmatic-inner-content-wrap .post-meta  .post-read-time, body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta  .post-read-time, body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta  .post-comments-num',
				[ this.setSuffix( 'page_title_typo', suffix ) ] : 'body.page.blogmatic_font_typography #blogmatic-main-wrap #primary article .entry-title',
				[ this.setSuffix( 'page_content_typo', suffix ) ] : 'body.page.blogmatic_font_typography article .entry-content',
				[ this.setSuffix( 'main_banner_design_post_categories_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-main-banner-section .post-categories .cat-item a',
				[ this.setSuffix( 'main_banner_design_post_date_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-main-banner-section .main-banner-wrap .post-elements .post-date',
				[ this.setSuffix( 'main_banner_design_post_author_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-main-banner-section .main-banner-wrap .byline',
				[ this.setSuffix( 'carousel_design_post_title_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-carousel-section .carousel-wrap .post-elements .post-title',
				[ this.setSuffix( 'carousel_design_post_categories_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-carousel-section .post-categories .cat-item a',
				[ this.setSuffix( 'carousel_design_post_date_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-carousel-section .carousel-wrap .post-elements .post-date',
				[ this.setSuffix( 'carousel_design_post_author_typography', suffix ) ] : '.blogmatic_font_typography .blogmatic-carousel-section .carousel-wrap .post-elements .byline a',
				[ this.setSuffix( 'carousel_design_post_excerpt_typography', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-carousel-section .carousel-wrap .post-elements .post-excerpt .excerpt-content',
				[ this.setSuffix( 'video_playlist_active_title_typo', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-video-playlist.layout--one .player-list-wrap .thumb-video-highlight-text .video-title, body .blogmatic-video-playlist.layout--two .active-player .video-title',
				[ this.setSuffix( 'video_playlist_title_typo', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-video-playlist.layout--one .video-item .title-wrap .video-title, body .blogmatic-video-playlist.layout--two .playlist-items-wrap .video-title',
				[ this.setSuffix( 'video_playlist_video_time_typo', suffix ) ] : 'body.blogmatic_font_typography .blogmatic-video-playlist.layout--one .player-list-wrap .video-duration, body .blogmatic-video-playlist.layout--two .video-duration',
				[ this.setSuffix( 'error_page_title_typo', suffix ) ] : 'body.blogmatic_font_typography #blogmatic-main-wrap #primary .not-found .page-title',
				[ this.setSuffix( 'error_page_content_typo', suffix ) ] : 'body.blogmatic_font_typography #blogmatic-main-wrap #primary .not-found .page-content p',
				[ this.setSuffix( 'error_page_button_text_typo', suffix ) ] : 'body.blogmatic_font_typography #blogmatic-main-wrap #primary .not-found .page-content .back_to_home_btn span',
				[ this.setSuffix( 'heading_one_typo', suffix ) ] : 'body article h1',
				[ this.setSuffix( 'heading_two_typo', suffix ) ] : 'body article h2',
				[ this.setSuffix( 'heading_three_typo', suffix ) ] : 'body article h3',
				[ this.setSuffix( 'heading_four_typo', suffix ) ] : 'body article h4',
				[ this.setSuffix( 'heading_five_typo', suffix ) ] : 'body article h5',
				[ this.setSuffix( 'heading_six_typo', suffix ) ] : 'body article h6',
				[ this.setSuffix( 'sidebar_heading_one_typography', suffix ) ] : 'body aside h1.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_two_typo', suffix ) ] : 'body aside h2.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_three_typo', suffix ) ] : 'body aside h3.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_four_typo', suffix ) ] : 'body aside h4.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_five_typo', suffix ) ] : 'body aside h5.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_six_typo', suffix ) ] : 'body aside h6.wp-block-heading',
				[ this.setSuffix( 'sidebar_pagination_button_typo', suffix ) ] : 'body .blogmatic-widget-loader .load-more',
				[ this.setSuffix( 'footer_title_typography', suffix ) ] : 'body footer .widget_block .wp-block-group__inner-container .wp-block-heading, body footer section.widget .widget-title, body footer .wp-block-heading',
				[ this.setSuffix( 'footer_text_typography', suffix ) ] : 'body footer ul.wp-block-latest-posts a, body footer ol.wp-block-latest-comments li footer, body footer ul.wp-block-archives a, body footer ul.wp-block-categories a, body footer ul.wp-block-page-list a, body footer .widget_blogmatic_post_grid_widget .post-grid-wrap .post-title, body footer .menu .menu-item a, body footer .widget_blogmatic_category_collection_widget .categories-wrap .category-item .category-name, body footer .widget_blogmatic_post_list_widget .post-list-wrap .post-title a',
				[ this.setSuffix( 'bottom_footer_text_typography', suffix ) ] : 'body footer .site-info',
				[ this.setSuffix( 'bottom_footer_link_typography', suffix ) ] : 'body footer .site-info a',
			}	
		};	// End of _getTypography method

		/**
		 * Returns a list of border control id and its releted selector
		 * 
		 * @since 1.0.0
		 */
		_getBorder = () => {
			let suffix = 'border'

			return {
				[ this.setSuffix( 'header_custom_button_border', suffix ) ]: 'body .site-header .header-custom-button',
				[ this.setSuffix( 'global_button_border', suffix ) ]: 'body article .content-wrap .post-button',
				[ this.setSuffix( 'date_time_border', suffix ) ]: 'body .top-date-time',
				[ this.setSuffix( 'main_banner_image_border', suffix ) ]: 'body .blogmatic-main-banner-section article.post-item .post-thumb',
				[ this.setSuffix( 'carousel_image_border', suffix ) ]: 'body .blogmatic-carousel-section article.post-item .post-thumb',
				[ this.setSuffix( 'archive_image_border', suffix ) ]: 'body #primary article .blogmatic-article-inner .post-thumbnail-wrapper',
				[ this.setSuffix( 'single_image_border', suffix ) ]: 'body.single-post #blogmatic-main-wrap .blogmatic-container .row .entry-header .post-thumbnail img, body.single-post.single-post--layout-three #blogmatic-main-wrap .blogmatic-container-fluid .post-thumbnail img',
				[ this.setSuffix( 'page_image_border', suffix ) ]: 'body.page-template-default #primary article .post-thumbnail img',
				[ this.setSuffix( 'canvas_menu_top_border', suffix ) ]: 'body.blogmatic-model-open .canvas-menu-sidebar',
				[ this.setSuffix( 'archive_border_bottom_color', suffix ) ]: 'body article .blogmatic-article-inner',
				[ this.setSuffix( 'widgets_secondary_border_bottom_color', suffix ) ]: '.widget ul.wp-block-latest-posts li, .widget ol.wp-block-latest-comments li, .widget ul.wp-block-archives li, .widget ul.wp-block-categories li, .widget ul.wp-block-page-list li, .widget .widget ul.menu li, aside .widget_blogmatic_post_grid_widget .post-grid-wrap .post-item, aside .widget_blogmatic_post_list_widget .post-list-wrap .post-item, .canvas-menu-sidebar .widget_blogmatic_post_list_widget .post-list-wrap .post-item, .canvas-menu-sidebar ul.wp-block-latest-posts li, .canvas-menu-sidebar ol.wp-block-latest-comments li, .canvas-menu-sidebar  ul.wp-block-archives li, .canvas-menu-sidebar  ul.wp-block-categories li, .canvas-menu-sidebar ul.wp-block-page-list li, .canvas-menu-sidebar .widget ul.menu li',
				[ this.setSuffix( 'you_may_have_missed_image_border', suffix ) ]: 'body .blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper',
				[ this.setSuffix( 'instagram_image_border', suffix ) ]: 'body .blogmatic-instagram-section .instagram-content .instagram-item a',
				[ this.setSuffix( 'header_builder_border', suffix ) ]: 'body .site-header',
				[ this.setSuffix( 'footer_builder_border', suffix ) ]: 'body .site-footer',
				/* Header Builder Row Border */
				[ this.setSuffix( 'header_first_row_border', suffix ) ]: 'body .site-header .row-one',
				[ this.setSuffix( 'header_second_row_border', suffix ) ]: 'body .site-header .row-two',
				[ this.setSuffix( 'header_third_row_border', suffix ) ]: 'body .site-header .row-three',
				/* Footer Builder Row Borders */
				[ this.setSuffix( 'footer_first_row_border', suffix ) ]: 'body footer.site-footer .row-one',
				[ this.setSuffix( 'footer_second_row_border', suffix ) ]: 'body footer.site-footer .row-two',
				[ this.setSuffix( 'footer_third_row_border', suffix ) ]: 'body footer.site-footer .row-three',
			}
		}

		/**
		 * Returns a list of color control ids and its related selector
		 * 
		 * @since 1.0.0
		 */
		_getColor = () => {
			let suffix = 'color'
			let property = 'background'

			return {
				[ this.setSuffix( 'animation_object_color', suffix ) ]: '--blogmatic-animation-object-color',
				[ this.setSuffix( 'header_active_menu_color', suffix ) ]: '--blogmatic-menu-color-active',
				[ this.setSuffix( 'you_may_have_missed_post_title_color', suffix ) ]: '--blogmatic-youmaymissed-color',
				[ this.setSuffix( 'date_color', suffix ) ]: '--blogmatic-date-color',
				[ this.setSuffix( 'time_color', suffix ) ]: '--blogmatic-time-color',
				[ this.setSuffix( 'video_playlist_active_title_color', suffix ) ]: '--blogmatic-active-video-title-color',
				[ this.setSuffix( 'video_playlist_video_time_color', suffix ) ]: '--blogmatic-video-time-color',
				[ this.setSuffix( 'breadcrumb_text_color', suffix ) ]: '--blogmatic-breadcrumb-color',
				[ this.setSuffix( 'footer_text_color', suffix ) ]: '--blogmatic-footer-white-text',
				[ this.setSuffix( 'bottom_footer_text_color', suffix ) ]: '--blogmatic-bottom-footer-text-color',
				[ this.setSuffix( 'you_may_have_missed_title_color', suffix ) ]: '--blogmatic-youmaymissed-block-title-color',
				[ this.setSuffix( 'date_time_background', suffix ) ]: '--blogmatic-date-time-bk-color',
				[ this.setSuffix( 'header_sub_menu_background_color', suffix ) ]: '--blogmatic-submenu-bk-color',
				[ this.setSuffix( 'video_playlist_content_background_color', suffix ) ]: '--blogmatic-video-content-bk-color',
				[ this.setSuffix( 'social_icon_color', suffix ) ]: '--blogmatic-header-social-color',
				[ this.setSuffix( 'footer_social_icon_color', suffix ) ]: '--blogmatic-footer-social-color',
				[ this.setSuffix( 'header_menu_color', suffix ) ]: '--blogmatic-menu-color',
				[ this.setSuffix( 'footer_menu_color', suffix ) ]: '--blogmatic-footer-menu-color',
				[ this.setSuffix( 'mobile_canvas_icon_color', suffix ) ]: '--blogmatic-mobile-canvas-icon-color',
				[ this.setSuffix( 'header_sub_menu_color', suffix ) ]: '--blogmatic-menu-color-submenu',
				[ this.setSuffix( 'search_icon_color', suffix ) ]: '--blogmatic-search-icon-color',
				[ this.setSuffix( 'search_view_all_button_text_color', suffix ) ]: '--blogmatic-search-viewall-color',
				[ this.setSuffix( 'search_view_all_button_background_color', suffix ) ]: '--blogmatic-search-viewall-bkcolor',
				[ this.setSuffix( 'custom_button_text_color', suffix ) ]: '--blogmatic-custom-button-color',
				[ this.setSuffix( 'custom_button_icon_color', suffix ) ]: '--blogmatic-custom-button-icon-color',
				[ this.setSuffix( 'theme_mode_dark_icon_color', suffix ) ]: '--blogmatic-theme-darkmode-color',
				[ this.setSuffix( 'theme_mode_light_icon_color', suffix ) ]: '--blogmatic-theme-mode-color',
				[ this.setSuffix( 'canvas_menu_icon_color', suffix ) ]: '--blogmatic-canvas-icon-color',
				[ this.setSuffix( 'video_playlist_title_color', suffix ) ]: '--blogmatic-video-title-list-color',	// --blogmatic-active-video-title-list-color
				[ this.setSuffix( 'video_playlist_play_pause_icon_color', suffix ) ]: '--blogmatic-video-play-pause-color',
				[ this.setSuffix( 'category_collection_text_color', suffix ) ]: '--blogmatic-cateegory-collection-color',
				[ this.setSuffix( 'global_button_color', suffix ) ]: '--blogmatic-readmore-font-color',
				[ this.setSuffix( 'breadcrumb_link_color', suffix ) ]: '--blogmatic-breadcrumb-link-color',
				[ this.setSuffix( 'stt_color_group', suffix ) ]: '--blogmatic-scroll-text-color',
				[ this.setSuffix( 'pagination_button_text_color', suffix ) ]: '--blogmatic-ajax-pagination-color',
				[ this.setSuffix( 'footer_title_color', suffix ) ]: '--blogmatic-footer-title-text',
				[ this.setSuffix( 'bottom_footer_link_color', suffix ) ]: '--blogmatic-bottom-footer-link-color',
				[ this.setSuffix( 'sidebar_pagination_button_color', suffix ) ]: '--blogmatic-widget-btn-color',
				[ this.setSuffix( 'header_custom_button_background_color_group', suffix ) ]: '--blogmatic-custom-button-bk-color',
				[ this.setSuffix( 'global_button_background_color', suffix ) ]: '--blogmatic-readmore-bk-color',
				[ this.setSuffix( 'stt_background_color_group', suffix ) ]: '--blogmatic-scroll-top-bk-color',
				[ this.setSuffix( 'pagination_button_background_color', suffix ) ]: '--blogmatic-ajax-pagination-bk-color',
				[ this.setSuffix( 'error_page_button_background_color', suffix ) ]: '--blogmatic-404-button-bkcolor',
				[ this.setSuffix( 'sidebar_pagination_button_background_color', suffix ) ]: '--blogmatic-widget-btn-bk-color',
				// all background
				[ this.setSuffix( 'search_modal_background_color', suffix, property ) ]: 'body .search-wrap.search-type--live-search .search-results-wrap',
				[ this.setSuffix( 'canvas_menu_background_color', suffix, property ) ]: 'body .canvas-menu-sidebar',
				[ this.setSuffix( 'main_banner_content_background', suffix, property ) ]: 'body .blogmatic-main-banner-section .main-banner-wrap .post-item .post-elements',
				[ this.setSuffix( 'carousel_content_background', suffix, property ) ]: 'body .blogmatic-carousel-section.carousel-layout--one article.post-item .post-elements, body .blogmatic-carousel-section.carousel-layout--two article.post-item',
				[ this.setSuffix( 'video_playlist_active_background_color', suffix, property ) ]: 'body .blogmatic-video-playlist.layout--one .thumb-video-highlight-text',
				[ this.setSuffix( 'category_collection_content_background', suffix, property ) ]: 'body .blogmatic-category-collection-section.layout--one .category-wrap .cat-meta .category-name .category-label',
				[ this.setSuffix( 'preloader_background_color', suffix, property ) ]: 'body #page .blogmatic_loading_box',
				[ this.setSuffix( 'website_layout_background_color', suffix, property ) ]: 'body.boxed--layout #page',
				[ this.setSuffix( 'breadcrumb_background_color', suffix, property ) ]: '.blogmatic-breadcrumb-element .blogmatic-breadcrumb-wrap',
				[ this.setSuffix( 'archive_inner_background_color', suffix, property ) ]: 'body #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inner, body.archive--block-layout #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inner, body.search-results.blogmatic_font_typography #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inne, body.search.search-results #blogmatic-main-wrap .blogmatic-container .page-header',
				[ this.setSuffix( 'single_page_background_color', suffix, property ) ]: 'body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .post-inner, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .comments-area, body.single-post #primary article .post-card .bmm-author-thumb-wrap, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .single-related-posts-section-wrap, .blogmatic-table-of-content.display--fixed .toc-wrapper',
				[ this.setSuffix( 'error_page_background_color', suffix, property ) ]: 'body.error404 #blogmatic-main-wrap #primary .not-found',
				[ this.setSuffix( 'widgets_inner_background_color', suffix, property ) ]: 'body aside .widget, body aside #widget_block',
				[ this.setSuffix( 'site_background_color', suffix, property ) ]: 'body.boxed--layout.blogmatic_font_typography:before, body.blogmatic_font_typography:before',
				[ this.setSuffix( 'archive_category_info_box_background', suffix, property ) ]: 'body.archive.category .site #blogmatic-main-wrap .page-header',
				[ this.setSuffix( 'archive_tag_info_box_background', suffix, property ) ]: 'body.archive.tag .site #blogmatic-main-wrap .page-header',
				[ this.setSuffix( 'archive_author_info_box_background', suffix, property ) ]: 'body.archive.author .site #blogmatic-main-wrap .page-header',
				[ this.setSuffix( 'page_background_color', suffix, property ) ]: 'body.page #blogmatic-main-wrap #primary article.page',
				[ this.setSuffix( 'header_builder_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-header',
				[ this.setSuffix( 'footer_builder_background', suffix, property ) ]: '.blogmatic-light-mode footer.site-footer, .blogmatic-light-mode footer .blogmatic-widget-loader .load-more',
				/* Header Builder Row Backgrounds */
				[ this.setSuffix( 'header_first_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-header .row-one',
				[ this.setSuffix( 'header_second_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-header .row-two',
				[ this.setSuffix( 'header_third_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-header .row-three',
				/* Footer Builder Row Backgrounds */
				[ this.setSuffix( 'footer_first_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-footer .row-one',
				[ this.setSuffix( 'footer_second_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-footer .row-two',
				[ this.setSuffix( 'footer_third_row_background', suffix, property ) ]: 'body.blogmatic-light-mode .site-footer .row-three',
				[ this.setSuffix( 'mobile_canvas_background', suffix, property ) ]: 'body .bb-bldr-row.mobile-canvas',
			}
		}

		/**
		 * Returns all checkbox controls id and selectors
		 * 
		 * @since 1.0.0
		 */
		_getCheckbox = () => {
			let suffix = 'checkbox'
			let property = 'hide-on-mobile'

			return {
				// front sections
				[ this.setSuffix( 'show_main_banner_excerpt_mobile_option', suffix, property ) ] : '#blogmatic-main-banner-section .post-excerpt',
				[ this.setSuffix( 'show_carousel_banner_excerpt_mobile_option', suffix, property ) ] : '#blogmatic-carousel-section .post-excerpt',
				[ this.setSuffix( 'show_video_playlist_in_mobile', suffix, property ) ] : 'body #blogmatic-video-playlist',
				// archive
				[ this.setSuffix( 'show_archive_excerpt_mobile_option', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-excerpt, body.archive .blogmatic-article-inner .post-excerpt, body.home .blogmatic-article-inner .post-excerpt, body.search .blogmatic-article-inner .post-excerpt',
				[ this.setSuffix( 'show_archive_category_in_mobile', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-categories, body.archive .blogmatic-article-inner .post-categories, body.home .blogmatic-article-inner .post-categories, body.search .blogmatic-article-inner .post-categories',
				[ this.setSuffix( 'show_archive_date_in_mobile', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-date, body.archive .blogmatic-article-inner .post-date, body.home .blogmatic-article-inner .post-date, body.search .blogmatic-article-inner .post-date',
				[ this.setSuffix( 'show_author_meta_text', suffix, property ) ] : '.byline .author.vcard',
				[ this.setSuffix( 'show_archive_author_mobile_option', suffix, property ) ] : 'body.blog .blogmatic-article-inner .byline, body.archive .blogmatic-article-inner .byline, body.home .blogmatic-article-inner .byline, body.search .blogmatic-article-inner .byline',
				[ this.setSuffix( 'show_readmore_text_mobile_option', suffix, property ) ] : 'body .blogmatic-article-inner .post-button .button-text',
				[ this.setSuffix( 'show_readmore_button_mobile_option', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-button, body.archive .blogmatic-article-inner .post-button, body.home .blogmatic-article-inner .post-button, body.search .blogmatic-article-inner .post-button',
				[ this.setSuffix( 'show_readtime_mobile_option', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-meta .post-read-time, body.archive .blogmatic-article-inner .post-meta .post-read-time, body.home .blogmatic-article-inner .post-meta .post-read-time, body.search .blogmatic-article-inner .post-meta .post-read-time',
				[ this.setSuffix( 'show_comment_number_mobile_option', suffix, property ) ] : 'body.blog .blogmatic-article-inner .post-meta .post-comments-num, body.archive .blogmatic-article-inner .post-meta .post-comments-num, body.home .blogmatic-article-inner .post-meta .post-comments-num, body.search .blogmatic-article-inner .post-meta .post-comments-num',
				// sidebar
				[ this.setSuffix( 'show_left_sidebar_mobile_option', suffix, property ) ] : 'body #secondary-aside',
				[ this.setSuffix( 'show_right_sidebar_mobile_option', suffix, property ) ] : 'body #secondary',
				// global
				[ this.setSuffix( 'show_background_animation_on_mobile', suffix, property ) ] : 'body .blogmatic-background-animation',
				[ this.setSuffix( 'social_share_mobile_option', suffix, property ) ] : 'body .blogmatic-social-share',
				[ this.setSuffix( 'show_table_of_content_label_on_mobile', suffix, property ) ] : 'body .blogmatic-table-of-content',
				[ this.setSuffix( 'social_icon_official_color_inherit', suffix, 'official-color--enabled' ) ]: 'body .blogmatic-social-icon',
				[ this.setSuffix( 'footer_social_icon_official_color_inherit', suffix, 'official-color--enabled' ) ]: 'body footer .blogmatic-social-icon',
				[ this.setSuffix( 'social_icons_hover_animation', suffix, 'blogmatic-show-hover-animation' ) ]: 'body header .social-icons-wrap',
				[ this.setSuffix( 'footer_social_icons_hover_animation', suffix, 'blogmatic-show-hover-animation' ) ]: 'body footer .social-icons-wrap',
				[ this.setSuffix( 'carousel_show_arrow_on_hover', suffix, 'arrow-on-hover--on' ) ]: '#blogmatic-carousel-section',
				[ this.setSuffix( 'main_banner_show_arrow_on_hover', suffix, 'arrow-on-hover--on' ) ]: '#blogmatic-main-banner-section',
				/* Header sticky */
				[ this.setSuffix( 'header_first_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-one',
				[ this.setSuffix( 'header_second_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-two',
				[ this.setSuffix( 'header_third_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-three'
			}
		}

		/**
		 * Returns all spacing controls with its id and selector
		 * 
		 * @since 1.0.0
		 */
		_getSpacing = () => {
			let suffix = 'spacing'
			let property = 'padding'
   
			return {
				//padding
				[ this.setSuffix( 'custom_button_padding', suffix, property ) ] : 'body .site-header .header-custom-button',
				[ this.setSuffix( 'global_button_padding', suffix, property ) ] : 'article .content-wrap .post-button',
				[ this.setSuffix( 'date_time_padding', suffix, property ) ] : '.top-date-time',
				[ this.setSuffix( 'instagram_padding', suffix, property ) ] : 'header .insta-slider--disabled .blogmatic-instagram-section .instagram-container',
				[ this.setSuffix( 'footer_instagram_padding', suffix, property ) ] : 'footer .insta-slider--disabled .blogmatic-instagram-section .instagram-container',
				[ this.setSuffix( 'mobile_canvas_padding', suffix, property ) ] : 'body .bb-bldr-row.mobile-canvas',
				[ this.setSuffix( 'sidebar_pagination_button_padding', suffix, property ) ] : 'body .blogmatic-widget-loader .load-more',
				// border-radius
				[ this.setSuffix( 'carousel_image_border_radius', suffix, 'border-radius' ) ] : '.blogmatic-carousel-section article.post-item .post-thumb',
				[ this.setSuffix( 'archive_image_border_radius', suffix, 'border-radius' ) ] : '.post-thumbnail-wrapper',
				[ this.setSuffix( 'you_may_have_missed_image_border_radius', suffix, 'border-radius' ) ] : '.blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper',
				[ this.setSuffix( 'header_builder_margin', suffix, 'margin' ) ]: 'body .site-header',
				[ this.setSuffix( 'footer_builder_margin', suffix, 'margin' ) ]: 'body .site-footer',
				/* Header Builder Row Spacings */
				[ this.setSuffix( 'header_first_row_padding', suffix, property ) ]: 'body .site-header .row-one',
				[ this.setSuffix( 'header_second_row_padding', suffix, property ) ]: 'body .site-header .row-two',
				[ this.setSuffix( 'header_third_row_padding', suffix, property ) ]: 'body .site-header .row-three',
				/* Footer Builder Row Spacings */
				[ this.setSuffix( 'footer_first_row_padding', suffix, property ) ]: 'body .site-footer .row-one',
				[ this.setSuffix( 'footer_second_row_padding', suffix, property ) ]: 'body .site-footer .row-two',
				[ this.setSuffix( 'footer_third_row_padding', suffix, property ) ]: 'body .site-footer .row-three',
			}
		}	// End of _getSpacing() Method

		/**
		 * Returns all responsive number controls with its id and its related selectors
		 * 
		 * @since 1.0.0
		 */
		_getResponsiveNumber = () => {
			let suffix = 'responsiveNumber'
			let property = 'width'

			return {
				[ this.setSuffix( 'site_logo_width', suffix, property ) ] : 'body .site-branding img, footer .footer-logo .custom-logo-link img',
				[ this.setSuffix( 'custom_button_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .site-header .header-custom-button .custom-button-icon img, body .site-header .header-custom-button .custom-button-icon i',
				[ this.setSuffix( 'theme_mode_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .site-header .mode-toggle img, body .site-header .mode-toggle i',
				[ this.setSuffix( 'canvas_menu_width', suffix, property ) ] : 'body .canvas-menu-sidebar',
				[ this.setSuffix( 'main_banner_design_post_date_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .blogmatic-main-banner-section .post-date img, body .blogmatic-main-banner-section .post-date i',
				[ this.setSuffix( 'main_banner_design_slider_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .blogmatic-main-banner-section .swiper-arrow img, body .blogmatic-main-banner-section .swiper-arrow i',
				[ this.setSuffix( 'carousel_design_post_date_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .blogmatic-carousel-section .post-date img, body .blogmatic-carousel-section .post-date i',
				[ this.setSuffix( 'video_playlist_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .blogmatic-video-playlist.layout--two .active-player .thumb-controller img, body .blogmatic-video-playlist.layout--one .thumb-controller img, body .blogmatic-video-playlist.layout--two .active-player .thumb-controller i, body .blogmatic-video-playlist.layout--one .thumb-controller i',
				[ this.setSuffix( 'carousel_design_slider_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .blogmatic-carousel-section .carousel-wrap .swiper-arrow i, body .blogmatic-carousel-section .carousel-wrap .swiper-arrow img',
				[ this.setSuffix( 'single_article_width', suffix, property ) ] : '.single #blogmatic-main-wrap .blogmatic-container',	// in percent
				[ this.setSuffix( 'main_banner_text_width', suffix, property ) ] : 'body .blogmatic-main-banner-section article.post-item .post-elements',	// in percent
				[ this.setSuffix( 'error_page_button_icon_size', suffix, [ property, 'font-size' ] ) ] : '.back_to_home_btn a img, .back_to_home_btn a i',
				[ this.setSuffix( 'bottom_footer_logo_width', suffix, property ) ] : 'body .footer-logo img',
				[ this.setSuffix( 'website_layout_horizontal_gap', suffix, [ 'margin-left', 'margin-right' ] ) ] : 'body.boxed--layout #page, body.boxed--layout #page',
				[ this.setSuffix( 'search_icon_size', suffix, 'font-size' ) ] : 'body .site-header .search-trigger i',
				[ this.setSuffix( 'social_icons_font_size', suffix, 'font-size' ) ] : 'body header .social-icons-wrap a',
				[ this.setSuffix( 'footer_social_icons_font_size', suffix, 'font-size' ) ] : 'body footer .social-icons-wrap a',
				[ this.setSuffix( 'global_button_font_size', suffix, 'font-size' ) ] : 'body article .content-wrap .post-button i',
				[ this.setSuffix( 'header_custom_button_border_radius', suffix, 'border-radius' ) ] : 'body .site-header .header-custom-button',
				[ this.setSuffix( 'category_collection_image_radius', suffix, 'border-radius' ) ] : 'body .blogmatic-category-collection-section .category-wrap a',
				[ this.setSuffix( 'instagram_image_radius', suffix, 'border-radius' ) ] : 'body .blogmatic-instagram-section .instagram-content .instagram-item a',
				[ this.setSuffix( 'website_layout_vertical_gap', suffix, [ 'margin-top', 'margin-bottom' ] ) ] : 'body.boxed--layout #page, body.boxed--layout #page',
				[ this.setSuffix( 'instagram_gap', suffix, [ 'gap' ] ) ] : 'body header .insta-slider--disabled .blogmatic-instagram-section .instagram-content',
				[ this.setSuffix( 'footer_instagram_gap', suffix, [ 'gap' ] ) ] : 'body footer .insta-slider--disabled .blogmatic-instagram-section .instagram-content',
				[ this.setSuffix( 'main_banner_responsive_image_ratio', suffix, 'image-ratio' ) ] : 'body .blogmatic-main-banner-section:not(.layout--three) article.post-item .post-thumb',
				[ this.setSuffix( 'carousel_responsive_image_ratio', suffix, 'image-ratio' ) ] : 'body .blogmatic-carousel-section article.post-item .post-thumb, body .blogmatic-carousel-section.carousel-layout--two article.post-item .post-thumb',
				[ this.setSuffix( 'category_collection_image_ratio', suffix, 'image-ratio' ) ] : 'body .blogmatic-category-collection-section .category-wrap:before',
				[ this.setSuffix( 'instagram_image_ratio', suffix, 'image-ratio' ) ] : 'body .blogmatic-instagram-section .instagram-container .instagram-content .instagram-item:before',
				[ this.setSuffix( 'archive_responsive_image_ratio', suffix, 'image-ratio' ) ] : '--blogmatic-archive-post-image-ratio',
				[ this.setSuffix( 'single_responsive_image_ratio', suffix, 'image-ratio' ) ] : '--blogmatic-single-post-image-ratio',
				[ this.setSuffix( 'page_responsive_image_ratio', suffix, 'image-ratio' ) ] : '--blogmatic-single-page-image-ratio',	
				[ this.setSuffix( 'you_may_have_missed_responsive_image_ratio', suffix, 'image-ratio' ) ] : '--blogmatic-youmaymissed-image-ratio',	
			}
		}	// End of _getResponsiveNumber() Method

		/**
		 * Returns list of box shadow controls with its and selectors
		 * 
		 * @since 1.0.0
		 */
		_getBoxShadow = () => {
			let suffix = 'boxShadow'
			
			return {
				[ this.setSuffix( 'header_sub_menu_box_shadow', suffix ) ] : {
					'selector': 'body .main-navigation ul.menu ul, body .main-navigation ul.nav-menu ul, body .main-header nav.toggled .blogmatic-primary-menu-container, body .main-header nav.toggled div.menu'
				},
				[ this.setSuffix( 'header_custom_button_box_shadow', suffix ) ] : {
					'selector' : 'body .site-header .header-custom-button'
				},
				[ this.setSuffix( 'carousel_box_shadow', suffix ) ] : {
					'selector' : 'body .blogmatic-carousel-section.carousel-layout--two article.post-item'
				},
				[ this.setSuffix( 'header_builder_box_shadow', suffix ) ] : {
					'selector' : 'body .site-header'
				},
				[ this.setSuffix( 'video_playlist_box_shadow', suffix ) ] : {
					'selector' : '.blogmatic-video-playlist .video-playlist-wrap'
				},
				[ this.setSuffix( 'category_collection_box_shadow', suffix ) ] : {
					'selector' : '.blogmatic-category-collection-section:not(.slider-enabled) .category-wrap .category-thumb a'
				},
				[ this.setSuffix( 'website_box_shadow', suffix ) ] : {
					'selector' : 'body.boxed--layout #page'
				},
				[ this.setSuffix( 'global_button_box_shadow_initial', suffix ) ] : {
					'selector' : 'article .content-wrap .post-button'
				},
				[ this.setSuffix( 'global_button_box_shadow_hover', suffix ) ] : {
					'selector' : 'article .content-wrap .post-button:hover'
				},
				[ this.setSuffix( 'breadcrumb_box_shadow', suffix ) ] : {
					'selector' : 'body .blogmatic-breadcrumb-element .blogmatic-breadcrumb-wrap'
				},
				[ this.setSuffix( 'archive_box_shadow', suffix ) ] : {
					'selector' : 'body #blogmatic-main-wrap > .blogmatic-container > .row #primary  article .blogmatic-article-inner, body.search-results #blogmatic-main-wrap > .blogmatic-container .row #primary  article .blogmatic-article-inner'
				},
				[ this.setSuffix( 'category_box_shadow', suffix ) ] : {
					'selector' : 'body.archive.category .site #blogmatic-main-wrap .page-header'
				},
				[ this.setSuffix( 'tag_box_shadow', suffix ) ] : {
					'selector' : 'body.archive.tag .site #blogmatic-main-wrap .page-header'
				},
				[ this.setSuffix( 'author_box_shadow', suffix ) ] : {
					'selector' : 'body.archive.author .site #blogmatic-main-wrap .page-header'
				},
				[ this.setSuffix( 'single_page_box_shadow', suffix ) ] : {
					'selector' : 'body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .post-inner, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .comments-area, body.single-post .single-related-posts-section-wrap, body.single-post #primary article .post-card .bmm-author-thumb-wrap, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation'
				},
				[ this.setSuffix( 'page_box_shadow', suffix ) ] : {
					'selector' : 'body.page #primary article.page, body.error404 #primary .error-404'
				},
				[ this.setSuffix( 'search_box_shadow', suffix ) ] : {
					'selector' : 'body.search.search-results #blogmatic-main-wrap .blogmatic-container .page-header'
				},
				[ this.setSuffix( 'widgets_box_shadow', suffix ) ] : {
					'selector' : 'body .widget, body #widget_block'
				},
				[ this.setSuffix( 'sidebar_pagination_button_box_shadow_initial', suffix ) ] : {
					'selector' : '.blogmatic-widget-loader .load-more'
				},
				[ this.setSuffix( 'sidebar_pagination_button_box_shadow_hover', suffix ) ] : {
					'selector' : '.blogmatic-widget-loader .load-more:hover'
				},
				[ this.setSuffix( 'archive_image_box_shadow', suffix ) ] : {
					'selector' : 'body #primary article .blogmatic-article-inner .post-thumbnail-wrapper'
				},
				[ this.setSuffix( 'carousel_image_box_shadow', suffix ) ] : {
					'selector' : 'body .blogmatic-carousel-section article.post-item .post-thumb'
				},
				[ this.setSuffix( 'single_image_box_shadow', suffix ) ] : {
					'selector' : 'body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .blogmatic-inner-content-wrap .post-thumbnail img, body.single-post--layout-three .post-thumbnail img, body.single-post--layout-four .post-thumbnail img, body.single-post--layout-five .post-thumbnail img, body.single-post--layout-two .blogmatic-single-header header'
				},
				[ this.setSuffix( 'page_image_box_shadow', suffix ) ] : {
					'selector' : 'body.page-template-default #primary article .post-thumbnail img'
				},
				[ this.setSuffix( 'you_may_have_missed_image_widgets_box_shadow', suffix ) ] : {
					'selector' : '.blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper'
				}
			}
		}	// End of _getBoxShadow() Method

		/**
		 * Returns all controls that just toggle classes
		 * 
		 * 
		 * @since 1.0.0
		 */
		_getToggleClassControls = () => {
			let suffix = 'toggleClass'

			return {
				[ this.setSuffix( 'header_builder_section_width', suffix ) ] : {
					'selector' : 'header.site-header',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				[ this.setSuffix( 'footer_builder_section_width', suffix ) ] : {
					'selector' : 'footer.site-footer',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				// Header Builder First row
				[ this.setSuffix( 'header_first_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-one',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Header Builder Second row
				[ this.setSuffix( 'header_second_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-two',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Header Builder Third row
				[ this.setSuffix( 'header_third_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-three',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder First row
				[ this.setSuffix( 'footer_first_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-one',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder Second row
				[ this.setSuffix( 'footer_second_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-two',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder Three row
				[ this.setSuffix( 'footer_three_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-three',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				[ this.setSuffix( 'site_background_animation', suffix, 'background-animation--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'background-animation--none background-animation--one background-animation--two background-animation--three'
				},
				[ this.setSuffix( 'post_title_hover_effects', suffix, 'title-hover--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'title-hover--none title-hover--one title-hover--two title-hover--three title-hover--four title-hover--five title-hover--six title-hover--seven'
				},
				[ this.setSuffix( 'site_image_hover_effects', suffix, 'image-hover--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'image-hover--none image-hover--one image-hover--two image-hover--three image-hover--four image-hover--five'
				},
				[ this.setSuffix( 'stt_alignment', suffix, 'align--' ) ] : {
					'selector' : '#blogmatic-scroll-to-top',
					'toggleClass' : 'align--left align--center align--right'
				},
				[ this.setSuffix( 'stt_display_type', suffix, 'display--' ) ] : {
					'selector' : '#blogmatic-scroll-to-top',
					'toggleClass' : 'display--fixed display--inline'
				},
				[ this.setSuffix( 'website_layout', suffix ) ] : {
					'selector' : 'body',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				[ this.setSuffix( 'block_title_layout', suffix, 'block-title--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'block-title--one block-title--two block-title--three block-title--four block-title--five'
				},
				[ this.setSuffix( 'related_posts_layouts', suffix, 'layout--' ) ] : {
					'selector' : 'body.single .single-related-posts-section-wrap',
					'toggleClass' : 'layout--one layout--two'
				},
				[ this.setSuffix( 'social_share_position', suffix, 'position--' ) ] : {
					'selector' : 'body.single .blogmatic-inner-content-wrap .post-format-ss-wrap',
					'toggleClass' : 'position--right position--left'
				},
				[ this.setSuffix( 'header_menu_hover_effect', suffix, 'hover-effect--' ) ] : {
					'selector' : '#site-navigation',
					'toggleClass' : 'hover-effect--none hover-effect--one hover-effect--two hover-effect--three hover-effect--four'
				},
				[ this.setSuffix( 'custom_button_animation_type', suffix, 'animation-type--' ) ] : {
					'selector' : '.header-custom-button-wrapper a.header-custom-button',
					'toggleClass' : 'animation-type--none animation-type--one animation-type--two animation-type--three animation-type--four animation-type--five'
				},
				[ this.setSuffix( 'main_banner_post_elements_alignment', suffix, 'banner-align--' ) ] : {
					'selector' : '.blogmatic-main-banner-section',
					'toggleClass' : 'banner-align--right banner-align--center banner-align--left'
				},
				[ this.setSuffix( 'carousel_layouts', suffix, 'carousel-layout--' ) ] : {
					'selector' : '#blogmatic-carousel-section',
					'toggleClass' : 'carousel-layout--one carousel-layout--two'
				},
				[ this.setSuffix( 'carousel_post_elements_alignment', suffix, 'carousel-align--' ) ] : {
					'selector' : '#blogmatic-carousel-section',
					'toggleClass' : 'carousel-align--center carousel-align--right carousel-align--left'
				},
				[ this.setSuffix( 'archive_post_elements_alignment', suffix, 'archive-align--' ) ] : {
					'selector' : 'body.archive .blogmatic-inner-content-wrap, body.blog .blogmatic-inner-content-wrap, body.home .blogmatic-inner-content-wrap, body.search .blogmatic-inner-content-wrap',
					'toggleClass' : 'archive-align--left archive-align--center archive-align--right'
				},
				[ this.setSuffix( 'main_banner_layouts', suffix, 'layout--' ) ] : {
					'selector' : '.blogmatic-main-banner-section',
					'toggleClass' : 'layout--one layout--two layout--three'
				},
				[ this.setSuffix( 'social_share_display_type', suffix, 'display--' ) ] : {
					'selector' : 'body #blogmatic-main-wrap main#primary .blogmatic-inner-content-wrap .post-format-ss-wrap',
					'toggleClass' : 'display--fixed display--inline'
				},
				[ this.setSuffix( 'social_share_position', suffix, 'position--' ) ] : {
					'selector' : 'body #blogmatic-main-wrap main#primary .blogmatic-inner-content-wrap .post-format-ss-wrap',
					'toggleClass' : 'position--left position--right'
				},
				[ this.setSuffix( 'single_post_content_alignment', suffix, 'content-alignment--' ) ] : {
					'selector' : 'body.single #primary .blogmatic-inner-content-wrap .entry-content',
					'toggleClass' : 'content-alignment--left content-alignment--center content-alignment--right'
				},
				[ this.setSuffix( 'instagram_layout', suffix, 'layout--' ) ] : {
					'selector' : '.blogmatic-instagram-section',
					'toggleClass' : 'layout--one layout--two'
				},
				[ this.setSuffix( 'instagram_hover_effects', suffix, 'hover-effect--' ) ] : {
					'selector' : '.blogmatic-instagram-section',
					'toggleClass' : 'hover-effect--one hover-effect--two hover-effect--three'
				},
				[ this.setSuffix( 'category_collection_layout', suffix, 'layout--' ) ] : {
					'selector' : '#blogmatic-category-collection-section',
					'toggleClass' : 'layout--one layout--two'
				},
				[ this.setSuffix( 'category_collection_hover_effects', suffix, 'hover-effect--' ) ] : {
					'selector' : '#blogmatic-category-collection-section',
					'toggleClass' : 'hover-effect--none hover-effect--one hover-effect--two hover-effect--three'
				},
				[ this.setSuffix( 'toc_display_type', suffix, 'display--' ) ] : {
					'selector' : 'body.single .blogmatic-table-of-content',
					'toggleClass' : 'display--inline display--fixed'
				},
				[ this.setSuffix( 'page_toc_display_type', suffix, 'display--' ) ] : {
					'selector' : 'body.page .blogmatic-table-of-content',
					'toggleClass' : 'display--inline display--fixed'
				},
				[ this.setSuffix( 'you_may_have_missed_post_elements_alignment', suffix, 'you-may-have-missed-align--' ) ] : {
					'selector' : '.blogmatic-you-may-have-missed-section',
					'toggleClass' : 'you-may-have-missed-align--center you-may-have-missed-align--left you-may-have-missed-align--right'
				},
				/* Footer row direction */
				[ this.setSuffix( 'footer_first_row_row_direction', suffix, 'is-' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-one',
					'toggleClass' : 'is-horizontal is-vertical'
				},
				[ this.setSuffix( 'footer_second_row_row_direction', suffix, 'is-' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-two',
					'toggleClass' : 'is-horizontal is-vertical'
				},
				[ this.setSuffix( 'footer_third_row_row_direction', suffix, 'is-' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-three',
					'toggleClass' : 'is-horizontal is-vertical'
				},
				/* Footer vertical alignment */
				[ this.setSuffix( 'footer_first_row_vertical_alignment', suffix, 'vertical-align--' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-one',
					'toggleClass' : 'vertical-align--top vertical-align--center vertical-align--bottom'
				},
				[ this.setSuffix( 'footer_second_row_vertical_alignment', suffix, 'vertical-align--' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-two',
					'toggleClass' : 'vertical-align--top vertical-align--center vertical-align--bottom'
				},
				[ this.setSuffix( 'footer_third_row_vertical_alignment', suffix, 'vertical-align--' ) ] : {
					'selector' : 'footer .bb-bldr--normal .bb-bldr-row.row-three',
					'toggleClass' : 'vertical-align--top vertical-align--center vertical-align--bottom'
				},
				[ this.setSuffix( 'mobile_canvas_alignment', suffix, 'alignment--' ) ] : {
					'selector' : 'header .bb-bldr--responsive .bb-bldr-row.mobile-canvas',
					'toggleClass' : 'alignment--left alignment--right alignment--center'
				}
			}
		}	// End of _getToggleClassControls() Method

		/**
		 * Returns all controls ids and selecters where text is dynamic
		 * 
		 * @since 1.0.0
		 */
		_getAddTextControls = () => {
			let suffix = 'addText'

			return {
				[ this.setSuffix( 'pagination_button_label', suffix )]  : '#blogmatic-main-wrap .pagination.pagination-type--ajax-load-more .button-label',
				[ this.setSuffix( 'blogname', suffix )]  : '.site-title a',
				[ this.setSuffix( 'blogdescription', suffix )]  : '.site-description',
				[ this.setSuffix( 'search_page_title', suffix )]  : 'body.search main#primary .page-title .search-page-title',
				[ this.setSuffix( 'search_nothing_found_title', suffix )]  : 'body.search main#primary .no-results.not-found .entry-title',
				[ this.setSuffix( 'search_nothing_found_content', suffix )]  : 'body.search main#primary .no-results.not-found .page-content p',
				[ this.setSuffix( 'error_page_title_text', suffix )]  : '.error-404.not-found .page-title',
				[ this.setSuffix( 'error_page_content_text', suffix )]  : '.error-404.not-found .page-content p',
				[ this.setSuffix( 'error_page_button_text', suffix )]  : '.error-404.not-found .back_to_home_btn .button-label',
				[ this.setSuffix( 'search_view_all_button_text', suffix )]  : '.search-wrap.search-type--live-search .search-form-wrap.results-loaded .search-results-wrap .view-all-search-button',
				[ this.setSuffix( 'search_no_result_found_text', suffix )]  : '.search-wrap.search-type--live-search .search-form-wrap.results-loaded .search-results-wrap.no-posts-found .no-posts-found-title',
				[ this.setSuffix( 'pagination_no_more_reults_text', suffix )]  : 'body #blogmatic-main-wrap .pagination.pagination-type--ajax-load-more.no-more-posts .no-more-posts',
			}
		}	// End _getAddTextControls() Method

		/**
		 * Returns all border radius controls
		 *
		 * @since 1.0.0
		 */
		_getBorderRadius = () => {
			let suffix = 'borderRadius'
			let property = 'border-radius'

			return {
				[ this.setSuffix( 'global_button_radius', suffix, property ) ]  : 'article .content-wrap .post-button',
				[ this.setSuffix( 'single_image_border_radius', suffix, property ) ]  : 'body.single-post .entry-header .post-thumbnail img, body.single-post .post-thumbnail.no-single-featured-image, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .blogmatic-inner-content-wrap article > div, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .single-related-posts-section-wrap.layout--list, body.single-post #primary article .post-card .bmm-author-thumb-wrap',
				[ this.setSuffix( 'main_banner_image_border_radius', suffix, property ) ]  : 'body .blogmatic-main-banner-section .swiper .swiper-wrapper .post-thumb, body .blogmatic-main-banner-section.layout--one .swiper .swiper-wrapper',
				[ this.setSuffix( 'carousel_section_border_radius', suffix, property ) ]  : 'body .blogmatic-carousel-section article.post-item',
				[ this.setSuffix( 'archive_section_border_radius', suffix, property ) ]  : 'body #blogmatic-main-wrap > .blogmatic-container > .row #primary .blogmatic-inner-content-wrap article.post .blogmatic-article-inner',
				[ this.setSuffix( 'video_playlist_border_radius', suffix, property ) ]  : 'body .blogmatic-video-playlist .blogmatic-container .video-playlist-wrap',
				[ this.setSuffix( 'sidebar_border_radius', suffix, property ) ]  : 'body .widget, body #widget_block',
				[ this.setSuffix( 'page_image_border_radius', suffix, property ) ]  : 'body.page-template-default.blogmatic_font_typography #primary article .post-thumbnail img',
				[ this.setSuffix( 'sidebar_pagination_button_radius', suffix, property ) ]  : '.blogmatic-widget-loader .load-more',
				[ this.setSuffix( 'toc_sticky_width', suffix, 'width' ) ]  : '.single .blogmatic-table-of-content.display--fixed .toc-wrapper',
				[ this.setSuffix( 'page_toc_sticky_width', suffix, 'width' ) ]  : '.page .blogmatic-table-of-content.display--fixed .toc-wrapper'
			}
		}

		/**
		 * Returns all responsive radio image
		 *
		 * @since 1.0.0
		 */
		_getResponsiveRadioImage = () => {
			let suffix = 'responsiveRadioImage'

			return {
				[ this.setSuffix( 'header_first_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one'
				},
				[ this.setSuffix( 'header_second_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two'
				},
				[ this.setSuffix( 'header_third_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three'
				},
				[ this.setSuffix( 'footer_first_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one'
				},
				[ this.setSuffix( 'footer_second_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two'
				},
				[ this.setSuffix( 'footer_third_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three'
				},
			}
		}

		/**
		 * Returns all responsive radio tab
		 *
		 * @since 1.0.0
		 */
		_getResponsiveRadioTab = () => {
			let suffix = 'responsiveRadioTab'

			return {

				/* Header Builder first row */
				[ this.setSuffix( 'header_first_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_first_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_first_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_first_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four'
				},
				/* Header Builder second row */
				[ this.setSuffix( 'header_second_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_second_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_second_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_second_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four'
				},
				/* Header Builder third row */
				[ this.setSuffix( 'header_third_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_third_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_third_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_third_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four'
				},
				/* Footer Builder first row */
				[ this.setSuffix( 'footer_first_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_first_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_first_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_first_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four'
				},
				/* Footer Builder second row */
				[ this.setSuffix( 'footer_second_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_second_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_second_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_second_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four'
				},
				/* Footer Builder third row */
				[ this.setSuffix( 'footer_third_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_third_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_third_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_third_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four'
				},
			}
		}

		/**
		 * Get all controls
		 * 
		 * @since 1.0.0
		 */
		_getControls = () => {
			let allControls = {}
			allControls = { ...allControls, ...this._getTypography() }
			allControls = { ...allControls, ...this._getBorder() }
			allControls = { ...allControls, ...this._getColor() }
			allControls = { ...allControls, ...this._getCheckbox() }
			allControls = { ...allControls, ...this._getSpacing() }
			allControls = { ...allControls, ...this._getResponsiveNumber() }
			allControls = { ...allControls, ...this._getBoxShadow() }
			allControls = { ...allControls, ...this._getToggleClassControls() }
			allControls = { ...allControls, ...this._getAddTextControls() }
			allControls = { ...allControls, ...this._getBorderRadius() }
			allControls = { ...allControls, ...this._getResponsiveRadioImage() }
			allControls = { ...allControls, ...this._getResponsiveRadioTab() }
			return allControls;
		}	// End of _getControls()  method

		/**
		 * change preview according to change
		 * 
		 * @since 1.0.0
		 */
		preview = () => {
			let controls = this._getControls()
			const THIS = this
			const TYPEARRAY = [ 'checkbox', 'toggleClass', 'addText', 'responsiveRadioImage', 'responsiveRadioTab' ]
			Object.entries( controls ).map(([ controlId, selector ]) => {
				const HYPEN = controlId.indexOf('-')
				const ID = controlId.slice( 0, HYPEN )
				const CONTROLTYPE = controlId.slice( HYPEN + 1 )
				const [ TYPE, PROPERTY ] = CONTROLTYPE.split('+')
				var styleTagId = ID.replaceAll( '_', '-' )
				wp.customize( ID, function( value ) {
					value.bind( function( to ) {
						if( ! TYPEARRAY.includes( TYPE ) ) {
							var cssCode = THIS.generateCssCode( CONTROLTYPE, selector, to, ID )
							if( cssCode ) {
								themeCalls.blogmaticGenerateStyleTag( cssCode, 'blogmatic-' + styleTagId )
							} else {
								themeCalls.blogmaticGenerateStyleTag( '', 'blogmatic-' + styleTagId )
							}
						} else {
							THIS.generateCssCode( CONTROLTYPE, selector, to, ID )
						}
					});
				});
			})
		}	// End of Preview() Method

		/**
		 * generate css code for preview
		 * 
		 * @since 1.0.0
		 */
		generateCssCode = ( controlType, selector, value, controlId ) => {
			const [ TYPE, PROPERTY ] = controlType.split('+')
			const ID = controlId
			if( TYPE ) {
				var cssCode = ''
				let isVariable = ( [ 'responsiveRadioImage', 'responsiveRadioTab' ].includes( controlType ) ) ? '' : this.isVariale( selector )
				switch( TYPE ) {
					case 'typography' :
							ajaxFunctions.typoFontsEnqueue( value )
							if( isVariable ) {
								cssCode = themeCalls.blogmaticGenerateTypoCss( selector, value )	// variable
							} else {
								cssCode = themeCalls.blogmaticGenerateTypoCssWithSelector( selector, value )	// class
							}
						break;
					case 'border' :
							cssCode += selector + " {\n"
							cssCode += "border-color: " + blogmatic_get_color_format( value.color ) + ';\n'
							cssCode += "border-style: " + value.type + ";\n"
							let { top, right, bottom, left } = value.width
							cssCode += "border-width: " + top + "px  "+ right + "px " + bottom + "px " + left + "px; \n } "
						break;
					case 'color' :
							if( isVariable ) {
								if( 'initial' in value ) {
									cssCode += 'body { '+ selector +' : ' + blogmatic_get_color_format( value.initial[ value.initial.type ] ) + ' }';
									cssCode += 'body { '+ selector +'-hover : ' + blogmatic_get_color_format( value.hover[ value.hover.type ] ) + ' }';
								} else {
									cssCode += 'body { '+ selector +': ' + blogmatic_get_color_format( value[ value.type ] ) + ' }';
								}
							} else {
								if( 'initial' in value ) {
									cssCode += selector + ' { '+ PROPERTY +': ' + blogmatic_get_color_format( value.initial[ value.initial.type ] ) + ' }';
									cssCode += selector + ' { '+ PROPERTY +': ' + blogmatic_get_color_format( value.hover[ value.hover.type ] ) + ' }';
								} else {
									cssCode += selector + ' { ' + blogmatic_get_background_style( value ) + ' }';
								}
							}
						break;
					case 'checkbox' :
							if( $( selector ).hasClass( PROPERTY ) ) {
								$( selector ).removeClass( PROPERTY )
							} else {
								$( selector ).addClass( PROPERTY )
							}
							return
						break;
					case 'spacing' :
							if( value.desktop ) {
								let desktop = value.desktop
								cssCode += selector + '{ '+ PROPERTY +': ' + desktop.top + 'px ' + desktop.right + 'px ' + desktop.bottom + 'px ' + desktop.left + 'px }';
							}
							if( value.tablet ) {
								let tablet = value.tablet
								cssCode += '@media(max-width: 940px) {'+ selector  +'{ '+ PROPERTY +': ' + tablet.top + 'px ' + tablet.right + 'px ' + tablet.bottom + 'px ' + tablet.left + 'px } }';
							}
							if( value.smartphone ) {
								let smartphone = value.smartphone
								cssCode += '@media(max-width: 610px) {'+ selector  +'{ '+ PROPERTY +': ' + smartphone.top + 'px ' + smartphone.right + 'px ' + smartphone.bottom + 'px ' + smartphone.left + 'px } }';
							}
						break;
					case 'responsiveNumber' :
							// desktop
							const percentControls = [ 'single_article_width', 'main_banner_text_width' ]
							let unit = percentControls.includes( ID ) ? '%' : 'px'
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return selector + '{ '+ current +': ' + value.desktop + unit + '}'
									} )
									cssCode += cssCodeArray.join('')
								} else {
									cssCode += selector + '{ '+ PROPERTY +': ' + value.desktop + unit + '}'
								}
							}  else {
								if( isVariable ) {
									cssCode += 'body{ '+ selector +': ' + value.desktop + '}'
								} else {
									cssCode += selector + '{ padding-bottom: calc(' + value.desktop +  ' * 100%) }'
								}
							}

							// tablet
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return '@media(max-width: 994px) { '+ selector + '{ '+ current +': ' + value.tablet + unit + '} }'
									} )
									cssCode += cssCodeArray.join('')
								} else {
									cssCode += '@media(max-width: 994px) { '+ selector + '{ '+ PROPERTY +': ' + value.tablet + unit + '} } '
								}
							}  else {
								if( isVariable ) {
									cssCode += '@media(max-width: 994px) { body {' + selector + '-tab :' + value.tablet + '} }'
								} else {
									cssCode += '@media(max-width: 994px) { ' + selector + ' { padding-bottom: calc(' + value.tablet +  ' * 100%) } }'
								}
							}

							// smartphone
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return '@media(max-width: 610px) { '+ selector + '{ '+ current +': ' + value.smartphone + unit + '} } '
									} )
									cssCode += cssCodeArray.join('')
								} else {
									cssCode += '@media(max-width: 610px) { '+ selector + '{ '+ PROPERTY +': ' + value.smartphone + unit + '} } '
								}
							}  else {
								if( isVariable ) {
									cssCode += '@media(max-width: 610px){ body {' + selector + '-mobile:' + value.smartphone + '} }'
								} else {
									cssCode += '@media(max-width: 610px){ ' + selector + '{ padding-bottom: calc(' + value.smartphone +  ' * 100%) } }'
								}
							}
						break;
					case 'boxShadow' :
							const { option, hoffset, voffset, blur, spread, type, color } = value
							if( option != undefined && option ) {
								if( type == 'outset' ) {
									cssCode += selector['selector'] + " { box-shadow: " + hoffset + "px " + voffset + "px " + blur + "px " + spread + "px " + blogmatic_get_color_format( color ) + " } "
								} else {
									cssCode += selector['selector'] + " { box-shadow: " + type + " " + hoffset + "px " + voffset + "px " + blur + "px " + spread + "px " + blogmatic_get_color_format( color ) + " } "
								}
							}
						break;
					case 'toggleClass' :
							let classToAdd = ( PROPERTY === undefined ) ? value : PROPERTY + value
							$( selector['selector'] ).removeClass( selector['toggleClass'] ).addClass( classToAdd )
						break;
					case 'addText' :
							$( selector ).text( value )
						break;
					case 'borderRadius' :
							cssCode += selector + " { " + PROPERTY + ": " + value + "px } "
						break;
					case 'responsiveRadioImage' :
							const { desktop: desktopVal, tablet: tabletVal, smartphone: smartphoneVal } = value
							const { desktop, tablet, smartphone } = selector

							$(desktop).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'layout-' + desktopVal )
							
							$(tablet).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/tablet-layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'tablet-layout-' + tabletVal )

							$(smartphone).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/smartphone-layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'smartphone-layout-' + smartphoneVal )
						break;
					case 'responsiveRadioTab' :
							const { desktop: desktopTab, tablet: tabletTab, smartphone: smartphoneTab } = value
							const { desktop: desktopSel, tablet: tabletSel, smartphone: smartphoneSel } = selector

							$( desktopSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'alignment-' + desktopTab )
							
							$( tabletSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/tablet-alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'tablet-alignment--' + tabletTab )

							$( smartphoneSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/smartphone-alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'smartphone-alignment--' + smartphoneTab )
						break;
					default:
						cssCode = TYPE + ' default'
				}
				return cssCode;
			}
		}	// End of generateCssCode() method
	}

	new BlogmaticCustomize();
}( jQuery ) );