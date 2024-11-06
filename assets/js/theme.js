jQuery(document).ready(function($) {
    // var ajaxUrl = blogmaticObject.ajaxUrl, wpnonce = blogmaticObject._wpnonce
    const { ajaxUrl, themeColor, _wpnonce: wpnonce } = blogmaticObject
    AOS.init();

    $(window).on("resize", function() {
        let selector = $('body')
        if( $(window).width() <= 426 ) {
            selector.removeClass( 'is-desktop is-tablet' ).addClass( 'is-smartphone' )
        } else if( $(window).width() <= 769 ) {
            selector.removeClass( 'is-desktop is-smartphone' ).addClass( 'is-tablet' )
        } else {
            selector.removeClass( 'is-smartphone is-tablet' ).addClass( 'is-desktop' )
        }
    })

    // top date time
    var timeElement = $( ".top-date-time .time" )
    if( timeElement.length > 0 ) {
        setInterval(function() {
            timeElement.html(new Date().toLocaleTimeString())
        },1000);
    }
    
    // handle preloader
    function blogmaticPreloader( timeOut = 3000 ) {
        setTimeout(function() {
            $('body .blogmatic_loading_box').hide();
        }, timeOut);
    }

    if( blogmaticObject.preloaderDisplayCondition == 'first-time' ) {
        if( ! $.cookie('showPreloader') ){
            $.cookie( 'showPreloader', true, { path: '/' } )
            blogmaticPreloader()
        }
    } else {
        $.cookie( 'showPreloader', false, { path: '/' } )
        blogmaticPreloader()
    }

    $(window).on('unload', function(){
        $.removeCookie('showPreloader', { path: '/' })
    })

    // breadcrumb separator
    var breadcrumbSeparatorContainer = $('.blogmatic-breadcrumb-element')
    if( breadcrumbSeparatorContainer.length > 0 ) {
        var separatorIconObject = blogmaticObject.breadcrumbSeparatorIcon
        var separatorIcon = ( separatorIconObject.type == 'icon' ) ? '<i class="'+ separatorIconObject.value +'"></i>' : '<img src="'+  separatorIconObject.url +'">'
        var listElement = breadcrumbSeparatorContainer.find('li.trail-item')
        var elementToAppend = '<span class="item-separator">'+ separatorIcon +'</span>'
        listElement.append(elementToAppend)
    }

    // header - normal search
    var searchSectionContainer = $('.search-wrap')
    if( searchSectionContainer.length > 0 ) {
        searchSectionContainer.on( 'click', '.search-trigger', function(){
            var _this = $(this)
            _this.siblings().show()
            _this.parent().addClass('toggled')
            _this.siblings().find('.search-field').focus()
        })

        // live search
        if( searchSectionContainer.hasClass('search-type--live-search') ) {
            var searchFieldElement = searchSectionContainer.find('.search-field')
            searchFieldElement.on('change, keyup', function(){
                var _this = $(this), currentValue = _this.val(), renderElement = _this.parents('.search-form')
                if( _this.val() != '' ) {
                    $.ajax({
                        method: 'post',
                        url: ajaxUrl,
                        data: {
                            action: 'blogmatic_live_search_ajax_call',
                            _wpnonce: wpnonce,
                            no_of_post: parseInt( blogmaticObject.liveSearchNoOfPostToDisplay ),
                            search_item: currentValue,
                            no_results_found_text: blogmaticObject.liveSearchNoResultsFound,
                            show_post_image: blogmaticObject.liveSearchShowPostImage,
                            show_post_date: blogmaticObject.liveSearchShowPostDate,
                            view_all_button_text: blogmaticObject.liveSearchViewAllButtonText
                        },
                        beforeSend: function() {
                            renderElement.parent().addClass('retrieving-posts')
                            renderElement.parent().removeClass('results-loaded')
                        },
                        success: function( result ) {
                            if( renderElement.parent().find('.search-results-wrap').length > 0 ) renderElement.parent().find('.search-results-wrap').remove()
                            renderElement.after(result)
                            renderElement.parent().removeClass('retrieving-posts').addClass('results-loaded')
                        },
                        complete: function() {
                            if( _this.val().trim() == '' ) {
                                renderElement.parent().removeClass( 'retrieving-posts' )
                                renderElement.siblings('.search-results-wrap').remove()
                            }
                        }
                    })
                } else {
                    renderElement.parents().removeClass( 'retrieving-posts results-loaded' )
                    renderElement.siblings('.search-results-wrap').remove()
                }
            })
        }

        // close search popup
        var closeButton = searchSectionContainer.find('.search-form-wrap')
        if( closeButton.length > 0 ) {
            closeButton.on('click', '.search-form-close', function(){
                var _thisButton = $(this), parentElement = _thisButton.parents('.search-wrap')
                parentElement.removeClass('toggled')
                _thisButton.parent().hide()
            })
        }

        // on ESC button click
        $(document).on('keydown', function( event ){
            if( event.keyCode == 27 ) {
                closeButton.hide()
                closeButton.parent().removeClass('toggled')
            }
        })
    }
    
    // header - theme mode
    var themeModeContainer = $('.mode-toggle-wrap')
    if( themeModeContainer.length > 0 ) {
        themeModeContainer.on( 'click', '.mode-toggle', function(){
            var _this = $(this), bodyElement = _this.parents('body')
            if( bodyElement.hasClass('blogmatic-dark-mode') ) {
                $.cookie( 'themeMode', 'light', { path: '/' } )
                bodyElement.removeClass('blogmatic-dark-mode').addClass('blogmatic-light-mode')
            } else {
                $.cookie( 'themeMode', 'dark', { path: '/' } )
                bodyElement.removeClass('blogmatic-light-mode').addClass('blogmatic-dark-mode')
            }
        })
    }

    // header - canvas menu
    var canvasMenuContainer = $('.blogmatic-canvas-menu')
    if( canvasMenuContainer.length > 0 ) {
        canvasMenuContainer.on( 'click', '.canvas-menu-icon', function() {
            var _this = $(this), bodyElement = _this.parents('body')
            bodyElement.toggleClass('blogmatic-model-open');
            onElementOutsideClick( _this.siblings(), function(){
                bodyElement.removeClass( 'blogmatic-model-open' )
            })
        })
    }

    // on element outside click function
    function onElementOutsideClick( currentElement, callback ) {
        $(document).mouseup(function( e ) {
            var container = $(currentElement);
            if ( !container.is(e.target) && container.has(e.target).length === 0) callback();
        })
    }

    // back to top script
    if( $( "#blogmatic-scroll-to-top" ).length ) {
        var scrollContainer = $( "#blogmatic-scroll-to-top" );
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 500 ) {
                scrollContainer.addClass('show');
            } else {
                scrollContainer.removeClass('show');
            }
        });
        scrollContainer.find( '.scroll-to-top-wrapper' ).click(function(event) {
            event.preventDefault();
            // Animate the scrolling motion.
            $("html, body").animate({scrollTop:0},"slow");
        });
    }

    // post format - gallery
    var gallery = $('.wp-block-gallery')
    if( gallery.length > 0 ) {
        if( blogmaticObject.singleGalleryLightbox != 1 ) return
        gallery.each(function(){
            var _this = $(this)
            var findImageSrc = _this.find('.wp-block-image img')
            var srcArgs = []
            findImageSrc.each(function(){
                srcArgs.push({
                    src: $(this).attr('src'),
                    type: 'image'
                })
            })
            _this.magnificPopup({
                items: srcArgs,
                gallery: {
                    enabled: true
                },
                type: 'image'
            })
        })
    }

    // main header sticky
    if( blogmaticObject.headerSticky ) {
        $(window).on('scroll', function(){
            var scroll = $(window).scrollTop()
            var mainHeaderContainer = $('header.site-header')
            if( scroll >= 200 ) {
                mainHeaderContainer.addClass('header-sticky--enabled').removeClass('header-sticky--disabled')
            } else {
                mainHeaderContainer.addClass('header-sticky--disabled').removeClass('header-sticky--enabled')
            }
        })
    }

    // pagination ajax load more
    var paginationContainer = $('#blogmatic-main-wrap')
    if( paginationContainer.length > 0 ) {
        var paged = 1
        paginationContainer.on('click', '.pagination.pagination-type--ajax-load-more', function() {
            var _this = $(this), toRenderElement = _this.siblings('.blogmatic-inner-content-wrap'), bodyElement = _this.parents('body')
            var adsRenderedCount = toRenderElement.children('.blogmatic-advertisement-block').length
            if( _this.hasClass('no-more-posts') ) return
            paged++
            $.ajax({
                method: 'post',
                url: ajaxUrl,
                data: {
                    action: 'blogmatic_pagination_load_more_ajax_call',
                    _wpnonce: wpnonce,
                    no_results_text: blogmaticObject.paginationNoResultsText,
                    paged: paged,
                    ads_rendered_count: parseInt( adsRenderedCount )
                },
                beforeSend: function() {
                    _this.addClass('retrieving-posts').removeClass('results-loaded')
                    const gallerySwiper = blogmaticInitializeSwiper({ swiperClass: 'body #primary article.format-gallery .post-thumbnail-wrapper .swiper' })
                    gallerySwiper.forEach(( current ) => {
                        current.destroy()
                    })
                },
                success: function( result ) {
                    var parsedResult = JSON.parse( result )
                    var $result_obj = $( parsedResult.posts ).filter('article, div.blogmatic-advertisement-block')
                    if( bodyElement.hasClass('archive--masonry-layout') ) {
                        toRenderElement.append( $( $result_obj ) ).masonry( 'appended', $( $result_obj ) )
                    } else {
                        toRenderElement.append( parsedResult.posts )
                    }
                    if( ! parsedResult.continue ) {
                        var htmlToAdd = '<span class="no-more-posts">'+ blogmaticObject.paginationNoResultsText +'</span>';
                        _this.find('.ajax-load-more-wrap').remove()
                        _this.append( htmlToAdd )
                        _this.addClass('no-more-posts')
                    }
                    _this.removeClass('retrieving-posts').addClass('results-loaded')
                },
                complete: function() {
                    const gallerySwiper = blogmaticInitializeSwiper({ swiperClass: 'body #primary article.format-gallery .post-thumbnail-wrapper .swiper' })
                    gallerySwiper.forEach(( current ) => {
                        current.init( 'body #primary article.format-gallery .post-thumbnail-wrapper' )
                    })
                }
            })
        })
    }

    // var blogmaticArchiveElement = $(document).find("body.archive--masonry-layout #primary .blogmatic-inner-content-wrap")
    // blogmaticArchiveElement.on('layoutComplete', function(){
    //     $(this).masonry()
    // })


    // ajax call for post grid and list widget
    function blogmaticWidgetAjaxCall( $selecter, $action, $toRender ) {
        var postGridContainer = $( $selecter )
        if( postGridContainer.length > 0 ) {
            var paged = 1
            postGridContainer.on('click', '.blogmatic-widget-loader .load-more', function() {
                var _this = $(this), _thisInstanceData = _this.data('instance')
                paged++
                $.ajax({
                    method: 'post',
                    url: ajaxUrl,
                    data: {
                        action: $action,
                        _wpnonce: wpnonce,
                        option: _thisInstanceData,
                        paged: paged
                    },
                    beforeSend: function() {
                        _this.parent().removeClass('results-loaded').addClass('retrieving-posts')
                    },
                    success: function( result ) {
                        var parsedResult = JSON.parse( result )
                        _this.parent().siblings($toRender).append(parsedResult.posts)
                        _this.parent().removeClass('retrieving-posts').addClass('results-loaded')
                        if( ! parsedResult.continue ) {
                            _this.parent().remove()
                        }
                    }
                })
            })
        }
    }

    // for post grid widget
    var gridWidgetContainer = $('.widget_blogmatic_post_grid_widget')
    if( gridWidgetContainer.length > 0 ){
        var postGridWrapElement = gridWidgetContainer.find('.post-grid-wrap')
        if( postGridWrapElement.hasClass('load-more--active') ) {
            blogmaticWidgetAjaxCall( '.widget_blogmatic_post_grid_widget', 'blogmatic_post_grid_widget_ajax_call', '.post-grid-wrap' );
        }
    }

    // for post list widget
    var gridWidgetContainer = $('.widget_blogmatic_post_list_widget')
    if( gridWidgetContainer.length > 0 ){
        var postGridWrapElement = gridWidgetContainer.find('.post-list-wrap')
        if( postGridWrapElement.hasClass('load-more--active') ) {
            blogmaticWidgetAjaxCall( '.widget_blogmatic_post_list_widget', 'blogmatic_post_list_widget_ajax_call', '.post-list-wrap' );
        }
    }

    // for post grid two column widget
    var gridWidgetContainer = $('.widget_blogmatic_posts_grid_two_column_widget')
    if( gridWidgetContainer.length > 0 ){
        var postGridWrapElement = gridWidgetContainer.find('.posts-wrap.posts-grid-two-column-wrap')
        if( postGridWrapElement.hasClass('load-more--active') ) {
            blogmaticWidgetAjaxCall( '.widget_blogmatic_posts_grid_two_column_widget', 'blogmatic_posts_grid_two_column_widget_ajax_call', '.posts-wrap.posts-grid-two-column-wrap' );
        }
    }

    // handle table of content widget
    if( blogmaticObject.isSingle == '1' || blogmaticObject.isPage == '1' ) {
        var TocSectionContainer = $("body.single .blogmatic-table-of-content, body.page .blogmatic-table-of-content")
        if( TocSectionContainer.length > 0 ) {
            $.fn.isInViewport = function() {
                var elementTop = $(this).offset();
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                return elementBottom > viewportTop && elementTop < viewportBottom;
            }

            TocSectionContainer.each(function() {
                const _this = $(this)
                const containerToRender = $(this).find(".table-of-content-list-wrap")
                const tocHandler = {
                    init: function() {
                        this.headingTags = []
                        this.listItemPointer = 0
                        if( blogmaticObject.isSingle == '1' ) {
                            this.headingsToLook = blogmaticObject.tocFieldForHeading.map(( current ) => {
                                return current.value;
                            }) // anchor
                            this.headingsMarker = blogmaticObject.tocListType   // marker
                            this.headingsView = blogmaticObject.tocHierarchical // table view
                            this.closeIcon = blogmaticObject.tocCloseIcon   // open icon
                            this.openIcon = blogmaticObject.tocOpenIcon     // close icon
                            this.displayType = blogmaticObject.tocDisplayType     // fixed or inline
                            this.listIcon = ( this.headingsMarker == 'icon' ) ? blogmaticObject.tocListIcon : ''     // list icon
                            if( this.displayType == 'fixed' ) {
                                this.handleStickyToc( 'body.single' )
                            }
                        }
                        if( blogmaticObject.isPage == '1' ) {
                            this.headingsToLook = blogmaticObject.pageTocFieldForHeading.map(( current ) => {
                                return current.value;
                            }) // anchor
                            this.headingsMarker = blogmaticObject.pageTocListType   // marker
                            this.headingsView = blogmaticObject.pageTocHierarchical // table view
                            this.closeIcon = blogmaticObject.pageTocCloseIcon   // open icon
                            this.openIcon = blogmaticObject.pageTocOpenIcon     // close icon
                            this.displayType = blogmaticObject.pageTocDisplayType     // fixed or inline
                            this.listIcon = ( this.headingsMarker == 'icon' ) ? blogmaticObject.pageTocListIcon : ''     // list icon
                            if( this.displayType == 'fixed' ) {
                                this.handleStickyToc( 'body.page' )
                            }
                        }
                        var contentContainer = containerToRender.parents('.blogmatic-table-of-content').siblings( '.entry-content' )
                        this.headingNodes = contentContainer.find( ( this.headingsToLook ).toString() )
                        this.handleContentToggle()
                        this.handleToggle()
                        if( this.headingNodes.length > 0 ) {
                            this.getAllHeadingNodes()
                            this.createHeadingTreeView()
                            this.onAnchorRedirect()
                            this.highlightAnchor()
                        }
                    },
                    highlightAnchor() {
                        $(window).scroll(function() {
                            let tocHeadings = $(document).find(".blogmatic-table-of-content .toc-list-item")
                            for( let i = 0 ; i < tocHeadings.length; i++) {
                                if( $(tocHandler.headingNodes[i]).isInViewport() ) {
                                    $(tocHeadings[i]).addClass("active").siblings().removeClass("active")
                                }
                            }
                        });
                    },
                    onAnchorRedirect: function() {
                        $(document).on( "click", ".blogmatic-table-of-content .toc-heading-title a", function(e) {
                            var hashLink = $(this).attr("href").replace("#","")
                            $("html, body").animate({
                                scrollTop: $("#" + hashLink ).offset().top - 50
                            }, "slow")
                            e.preventDefault()
                        })
                    },
                    getAllHeadingNodes: function() {
                        this.headingNodes.each(( index, element ) => {
                            // add anchor point for each heading
                            $(element).before('<span id="toc-heading-anchor--' + index + '" class="toc-menu-anchor"></span>');
                            let anchorLink = 'toc-heading-anchor--' + index
                            // generate the stack of heading tags
                            this.headingTags.push({
                                tag: +element.nodeName.slice(1),
                                text: element.textContent,
                                anchorLink
                            });
                        })
                    },
                    createHeadingTreeView: function() {
                        this.headingTags.forEach(( heading, index ) => {
                            heading.level = 0;
                            for ( let i = index - 1; i >= 0; i-- ) {
                                const currentOrderedItem = this.headingTags[i];
                                if ( currentOrderedItem.tag <= heading.tag ) {
                                    heading.level = currentOrderedItem.level;
                                    if ( currentOrderedItem.tag < heading.tag ) {
                                        heading.level++;
                                    }
                                    break;
                                }
                            }
                        });
                        if( this.headingsView == 'tree' ) {
                            containerToRender.html( this.getTreeHtml( 0 ) );
                        } else {
                            containerToRender.html( this.getFlatHtml() );
                        }
                        if( this.headingsMarker == 'number' ) {
                            var tocContent = containerToRender.find(" > .toc-list-item-wrap")
                            this.giveNumbering( tocContent )
                        }
                    },
                    giveNumbering: function( tocContent, numberingString = '' ) {
                        var tocList = tocContent.find( " > .toc-list-item" )
                        if( tocList.length > 0 ) {
                            tocList.each(function( index ) {
                                var _this = $(this), newNumberingString = '<span class="numbering-prefix">' + numberingString + ( index + 1 ).toString() + '.</span>'
                                _this.find(" > .toc-heading-title a").prepend( newNumberingString )
                                var tocInnerContent = _this.find(" > .toc-list-item-wrap")
                                if( tocInnerContent.length > 0) tocHandler.giveNumbering( tocInnerContent,newNumberingString )
                            })
                        }
                    },
                    getTreeHtml: function( level ) {
                        // generate list wrap
                        let html = `<ul class="toc-list-item-wrap">`;
                        // For each list item, build its markup.
                        var levelCount = 1;
                        while (this.listItemPointer < this.headingTags.length) {
                            const currentItem = this.headingTags[this.listItemPointer];
                            if (level > currentItem.level) {
                                break;
                            }
                            if (level === currentItem.level) {
                                html += `<li class="toc-list-item">`;
                                if( this.listIcon.type == 'icon' ) {
                                    html += `<span class="toc-heading-icon"><i class="`+ this.listIcon.value +`"></i></span>`;
                                }
                                html += `<span class="toc-heading-title"><a href="#${currentItem.anchorLink}">`;
                                let liContent = `${currentItem.text}`;
                                html += liContent;
                                html += '</a></span>';
                                this.listItemPointer++;
                                const nextItem = this.headingTags[this.listItemPointer];
                                if (nextItem && level < nextItem.level) {
                                    html += this.getTreeHtml(nextItem.level);
                                }
                                html += '</li>';
                            }
                            levelCount++;
                        }
                        html += `</ul>`;
                        return html;
                    },
                    getFlatHtml: function() {
                        // generate list wrap
                        let html = `<ul class="toc-list-item-wrap">`;
                        // For each list item, build its markup.
                        var levelCount = 0;
                        while (levelCount < this.headingTags.length) {
                            const currentItem = this.headingTags[levelCount];
                            html += `<li class="toc-list-item">`;
                            if( this.listIcon.type == 'icon' ) {
                                html += `<span class="toc-heading-icon"><i class="`+ this.listIcon.value +`"></i></span>`;
                            }
                            html += `<span class="toc-heading-title"><a href="#${currentItem.anchorLink}">`;
                            let liContent = `${currentItem.text}`;
                            html += liContent;
                            html += '</a></span>';
                            html += '</li>';
                            levelCount++;
                        }
                        html += `</ul>`;
                        return html;
                    },
                    handleContentToggle: function() {
                        var minimizedIcon = ( ( this.closeIcon.type == 'icon' ) ? this.closeIcon.value : '' )
                        var maximizedIcon = ( ( this.openIcon.type == 'icon' ) ? this.openIcon.value : '' )
                        _this.on( "click", ".toc-icon", function() {
                            var contentToggleButton = $(this)
                            contentToggleButton.toggleClass( 'open close' )
                            containerToRender.slideToggle(400, function() {
                                contentToggleButton.find("i").toggleClass( minimizedIcon + ' ' + maximizedIcon )
                            })
                        })
                    },
                    handleToggle: function() {
                        var minimizedIcon = ( ( this.closeIcon.type == 'icon' ) ? this.closeIcon.value : '' )
                        var maximizedIcon = ( ( this.openIcon.type == 'icon' ) ? this.openIcon.value : '' )
                        _this.on( "click", ".toc-toggle-button", function() {
                            var contentToggleButton = $(this)
                            _this.find(".table-of-content-wrap").slideToggle(400, function() {
                                contentToggleButton.find("i").toggleClass( minimizedIcon + ' ' + maximizedIcon )
                            })
                        })
                    },
                    handleStickyToc: function( selector ){
                        var stickyIconContainer = $( selector )
                        if( stickyIconContainer.length > 0 ) {
                            stickyIconContainer.on( 'click', '.toc-fixed-icon', function(){
                                var _this = $(this)
                                _this.siblings('.toc-wrapper').toggleClass( 'active' )
                                _this.find('i').toggleClass( 'fa-solid fa-x' + ' ' + 'fa-solid fa-list-check' )
                                onElementOutsideClick( _this.siblings(), function(){
                                    if( _this.siblings().hasClass( 'active' ) ) {
                                        _this.find('i').removeClass().addClass( 'fa-solid fa-list-check' )
                                        _this.siblings().removeClass( 'active' )
                                    }
                                });
                            })
                        }
                    }
                }
                tocHandler.init()
            })
        }
    }

    // cursor animation
    var cursorContainer = $('.blogmatic-cursor')
    if( cursorContainer.length > 0 ) {
        $(document).on( 'mousemove', function( event ){
            cursorContainer[0].style.top = 'calc('+ event.pageY +'px - 15px)'
            cursorContainer[0].style.left = 'calc('+ event.pageX +'px - 15px)'
        })
        var selector = 'a, button, input[type="submit"], #blogmatic-scroll-to-top .icon-text, #blogmatic-scroll-to-top .icon-holder, .video-playlist-wrap .playlist-items-wrap .video-item, .thumb-video-highlight-text .thumb-controller, .pagination.pagination-type--ajax-load-more, .blogmatic-widget-loader .load-more, .mode-toggle-wrap .mode-toggle, .blogmatic-canvas-menu .canvas-menu-icon, .blogmatic-table-of-content .toc-fixed-icon, .blogmatic-social-share.show-on-click'
        $( selector ).on( 'mouseover', function(){
            $( cursorContainer ).addClass( 'isActive' )
        })
        $( selector ).on( 'mouseout', function(){
            $( cursorContainer ).removeClass( 'isActive' )
        })
    }

    // social share
    var socialShareContainer = $( '.blogmatic-social-share' )
    if( socialShareContainer.length > 0 ) {
        // for print
        var printButton = socialShareContainer.find( '.print' )
        printButton.each(function(){
            $(this).on( 'click', function(){ 
                $(this).find( 'a' ).removeAttr( 'href' )
                window.print()
            })
        })
        // for copy link
        var copyLinkButton = socialShareContainer.find( '.copy_link' )
        copyLinkButton.each(function(){
            $(this).on( 'click', function( event ) { 
                event.preventDefault()
                var copyLinkButtonAnchor = $(this).find( 'a' )
                var linkToCopy = copyLinkButtonAnchor.attr( 'href' )
                navigator.clipboard.writeText( linkToCopy )
            })
        })

        // share icon
        if( socialShareContainer.hasClass( 'show-on-click' ) ) {
            socialShareContainer.on('click', '.share-icon', function(){
                $(this).toggleClass('active')
            })
        }
    }

    /**
     * convert string true or false to bool true or false
     * 
     * @since 1.0.0
     */
    const blogmaticConverToBoolean = ( value ) => {
        return ( value === 'true' ) ? true : false
    }

    /**
     * Initialize swiper js
     * 
     * @since 1.0.0
     */
    const blogmaticInitializeSwiper = ( props ) => {
        const { arrows, fade, loop, speed, autoplay, autoplaySpeed, slidesPerView, slidesPerGroup, breakpoints, swiperClass, autoHeight, direction, spaceBetween, navigation } = props
        let swiperObject = {
            arrows: blogmaticConverToBoolean( arrows ) || true,
            loop: blogmaticConverToBoolean( loop ),
            speed: parseInt( speed ) || 500,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
        }
        if( navigation ) swiperObject = { ...swiperObject, navigation: navigation }
        if( autoHeight !== undefined ) swiperObject = { ...swiperObject, autoHeight: autoHeight }
        if( spaceBetween !== undefined ) swiperObject = { ...swiperObject, spaceBetween: spaceBetween }
        if( direction !== undefined ) swiperObject = { ...swiperObject, direction: direction }
        if( slidesPerView !== undefined ) swiperObject = { ...swiperObject, slidesPerView: parseInt( slidesPerView ) }
        if( slidesPerGroup !== undefined ) swiperObject = { ...swiperObject, slidesPerGroup: parseInt( slidesPerGroup ) }
        if( breakpoints !== undefined ) swiperObject = { ...swiperObject, breakpoints: { ...breakpoints } }
        if( ( fade !== undefined ) || true ) swiperObject = { 
            ...swiperObject,
            effect: blogmaticConverToBoolean( fade ) ? 'fade' : 'slide',
            fadeEffect: {
                crossFade: true
            }
        }
        if( blogmaticConverToBoolean( autoplay ) || false ) swiperObject = { 
            ...swiperObject,
            autoplay: { 
                delay: parseInt( autoplaySpeed ) || 3000,
                stopOnLastSlide: true
            }
        }
        return new Swiper( swiperClass, swiperObject );
    }

    /**
     * Main Banner JS
     * 
     * @since 1.0.0
     */
    var fullWidthBannerContainer = $('#blogmatic-main-banner-section')
    if( fullWidthBannerContainer.length > 0 ) {
        const { arrows, fade, infiniteLoop, speed, autoplay, autoplaySpeed } = blogmaticObject
        const isLayoutOne = fullWidthBannerContainer.hasClass( 'layout--one' )
        const isLayoutTwo = fullWidthBannerContainer.hasClass( 'layout--two' )
        const isLayoutThree = fullWidthBannerContainer.hasClass( 'layout--three' )
        var mainBannerTopObject = {
            arrows: arrows,
            fade: fade,
            loop: infiniteLoop,
            speed: speed,
            autoplay: autoplay,
            autoplaySpeed: autoplaySpeed,
            navigation: false,
            swiperClass: '.main-banner-wrap.swiper'
        }

        if( isLayoutOne || isLayoutTwo ) {
            mainBannerTopObject = { 
                ...mainBannerTopObject,
                navigation: {
                    nextEl: '.custom-button-next',
                    prevEl: '.custom-button-prev'
                }
            }
        }

        if( isLayoutThree || isLayoutOne ) {
            let thumbsObject = {
                spaceBetween: 15,
                slidesPerView: 4,
                loop: true,
                freeMode: true,
                watchSlidesProgress: true,
            }
            if( isLayoutThree ) {
                thumbsObject = { 
                    ...thumbsObject,
                    navigation: {
                        nextEl: '.custom-button-next',
                        prevEl: '.custom-button-prev'
                    },
                    breakpoints : {
                        50: { slidesPerView: 2 },
                        500: { slidesPerView: 4 }
                    }
                }
            }
            if( isLayoutOne ) {
                thumbsObject = { 
                    ...thumbsObject,
                    breakpoints : {
                        50: { slidesPerView: 2 },
                        610: { slidesPerView: 3 },
                        768: { slidesPerView: 4 },
                    }
                }
            }
            let mainBannerThumbs = new Swiper( '.swiper.main-banner-swiper-thumbs', thumbsObject );
            let mainBannerTop = new Swiper('.swiper.main-banner-wrap', { 
                ...mainBannerTopObject,
                effect: blogmaticConverToBoolean( fade ) ? 'fade' : 'slide',
                fadeEffect: {
                    crossFade: true
                },
                thumbs: { 
                    swiper: mainBannerThumbs 
                } 
            })

            if( isLayoutThree ) {
                mainBannerThumbs.on("navigationNext navigationPrev", function(){
                    const activeIndex = mainBannerThumbs.realIndex;  // Get the real index of the current slide
                    mainBannerTop.slideToLoop( activeIndex );
                })
            }
        } else {
            blogmaticInitializeSwiper( mainBannerTopObject )
        }
    }

    /**
     * Carousel JS
     * 
     * @since 1.0.0
     */
    var carouselContainer = $('.blogmatic-carousel-section')
    if( carouselContainer.length > 0 ) {
        let _this = carouselContainer
        const { carouselArrows, carouselInfiniteLoop, carouselSpeed, carouselAutoplay, carouselAutoplaySpeed, carouselSlideToShow, slidesToScroll } = blogmaticObject
        blogmaticInitializeSwiper({
            arrows: carouselArrows,
            loop: carouselInfiniteLoop,
            speed: carouselSpeed,
            autoplay: carouselAutoplay,
            autoplaySpeed: carouselAutoplaySpeed,
            slidesPerView: carouselSlideToShow,
            slidesPerGroup: slidesToScroll,
            spaceBetween: _this.hasClass( 'carousel-layout--two' ) ? 15 : 24,
            navigation: { nextEl: '.custom-button-next', prevEl: '.custom-button-prev' },
            breakpoints: {
                50: { slidesPerView: 1 },
                610: { slidesPerView: 2 },
                769: { slidesPerView: carouselSlideToShow },
            },
            swiperClass: '#blogmatic-carousel-section .swiper'
        })
    }

    /**
     * Category Collection js
     * 
     * @since 1.0.0
     */
    var categoryCollectionContainer = $('#blogmatic-category-collection-section.slider-enabled')
    if( categoryCollectionContainer.length > 0 ) {
        const { catCollSliderArrow, catCollSliderInfinite, catCollSliderSpeed, catCollAutoplayOption, catCollAutoplaySpeed, catCollSlidesToShow, catCollSlidesToScroll } = blogmaticObject
        let swiperObject = {
            arrows: catCollSliderArrow,
            loop: catCollSliderInfinite,
            speed: catCollSliderSpeed,
            autoplay: catCollAutoplayOption,
            autoplaySpeed: catCollAutoplaySpeed,
            slidesPerView: catCollSlidesToShow,
            slidesPerGroup: catCollSlidesToScroll,
            spaceBetween: 15,
            navigation: { nextEl: '.custom-button-next', prevEl: '.custom-button-prev' },
            breakpoints: {
                700: { slidesPerView: 1 },
                940: { slidesPerView: 2 },
                1200: { slidesPerView: parseInt( catCollSlidesToShow ) }
            },
            swiperClass: '.blogmatic-category-collection-section .swiper'
        }
        blogmaticInitializeSwiper( swiperObject )
    }

    /**
     * Carousel Posts JS
     * 
     * @since 1.0.0
     */
    var cpWidgets = $( ".blogmatic-widget-carousel-posts" )
    cpWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_blogmatic_carousel_widget" ).attr( "id" ), parentWidgetContainer
        if( typeof parentWidgetContainerId != 'undefined' ) {
            parentWidgetContainer = $( "#" + parentWidgetContainerId )
            var ppWidget = parentWidgetContainer.find( ".carousel-posts-wrap" );
        } else {
            var ppWidget = _this;
        }
        if( ppWidget.length > 0 ) {
            let ppWidgetAuto = ppWidget.data( "auto" )
            let ppWidgetArrows = ppWidget.data( "arrows" )
            let ppWidgetLoop = ppWidget.data( "loop" )
            let ppWidgetVertical = ppWidget.data( "vertical" )
            let swiperObject = {
                arrows: ppWidgetArrows,
                loop: ppWidgetLoop,
                autoplay: ppWidgetAuto,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoHeight: true,
                direction: 'horizontal',
                navigation: { nextEl: '.custom-button-next', prevEl: '.custom-button-prev' },
            }
            if( ppWidgetVertical == 'vertical' ) swiperObject.direction = 'vertical'
            new Swiper( _this.find( '.swiper' )[0], swiperObject )
        }
    })

    /**
     * Gallery Post Format JS
     * 
     * @since 1.0.0
     */
    if( blogmaticObject.isArchive ) {
        // archive masonry layout 
        var masonryContainer = $("body.archive--masonry-layout #primary .blogmatic-inner-content-wrap")
        masonryContainer.masonry({
            // options
            // itemSelector: 'article, div.blogmatic-advertisement-block',
            gutter: 30,
        })

        // handle the post gallery post format
        var postGalleryElems = $("body #primary article.format-gallery .post-thumbnail-wrapper")
        if( postGalleryElems.length > 0 ) {
            postGalleryElems.each(function() {
                let swiperObject = {
                    navigation: {
                        nextEl: $(this).find( '.custom-button-next' )[0],
                        prevEl: $(this).find( '.custom-button-prev' )[0]
                    }
                }
                new Swiper( $(this).find('.swiper')[0], swiperObject )
            })
        }
    }

    /**
     * Video Playlist JS
     * 
     * @since 1.0.0
     */
    function blogmaticVideoPlaylist( $selector ) {
        var vpSectionContainer = $($selector)
        if( vpSectionContainer.length > 0 ) {
            const { videoPlaylistPlayIcon, videoPlaylistPauseIcon } = blogmaticObject
            var playIconObject = JSON.parse( videoPlaylistPlayIcon ), pauseIconObject = JSON.parse( videoPlaylistPauseIcon )
            var playIcon = ( playIconObject.type === 'icon' ) ? '<i class="'+ playIconObject.value +'"></i>' : '<img src="'+  playIconObject.url +'">'
            var pauseIcon = ( pauseIconObject.type === 'icon' ) ? '<i class="'+ pauseIconObject.value +'"></i>' : '<img src="'+ pauseIconObject.url +'">'
            // on video item click
            $(document).on( "click", ".video-playlist-wrap .playlist-items-wrap .video-item", function() {
                var _thisItem = $(this)
                if( _thisItem.hasClass("onWait") ) {
                    var highlightedVideoElm = _thisItem.parents(".video-playlist-wrap").find(".thumb-video-highlight-text"), activePlayer = _thisItem.parents(".video-playlist-wrap").find(".active-player"), newVideoId = _thisItem.data("id"), toHighlightTitle = _thisItem.find(".video-title").text(), toHighlightDuration = _thisItem.find(".video-duration").text()
                    _thisItem.addClass("activePlayer").removeClass("onWait").parent().siblings().find('.video-item').removeClass("activePlayer").addClass("onWait")
                    highlightedVideoElm.find(".video-title").text(toHighlightTitle)
                    highlightedVideoElm.find(".video-duration").text(toHighlightDuration)
                    activePlayer.find("iframe").attr("src","https://www.youtube.com/embed/" + newVideoId + "?enablejsapi=1&autoplay=1&mute=1")
                    highlightedVideoElm.find(".thumb-controller").removeClass("isPaused").addClass("onRoll").find("i").removeClass("fa-play").addClass("fa-pause")
                    highlightedVideoElm.find(".thumb-controller").children().remove()
                    if( highlightedVideoElm.find(".thumb-controller").hasClass('onRoll') ) {
                        highlightedVideoElm.find(".thumb-controller").append( pauseIcon )
                    } else {
                        highlightedVideoElm.find(".thumb-controller").append( playIcon )
                    }
                }
            })
            vpSectionContainer.each(function() {
                var _this = $(this)
                if( _this.hasClass( "layout--one" ) || _this.hasClass( "layout--two" )  ) {
                    var activePlayer = _this.find(".active-player"), highlightedVideoElm = _this.find(".thumb-video-highlight-text"), firstVideoItem = _this.find('.player-list-wrap .playlist-items-wrap .video-item.activePlayer').first()
                    // render highlight and active player 
                    if( firstVideoItem.length > 0 ) {
                        var toHighlightId = firstVideoItem.data("id"), toHighlightTitle = firstVideoItem.find(".video-title").text(), toHighlightDuration = firstVideoItem.find(".video-duration").text()
                        highlightedVideoElm.find(".video-title").text(toHighlightTitle)
                        highlightedVideoElm.find(".video-duration").text(toHighlightDuration)
                        activePlayer.find("iframe").attr("src","https://www.youtube.com/embed/" + toHighlightId + "?enablejsapi=1&mute=1")
                    }

                    // layout two carousel handler
                    if( _this.hasClass( "layout--two" ) ) {
                        const isWidget = _this.hasClass('blogmatic-widget')
                        const { videoPlaylistSliderarrow, videoPlaylistSliderSlidesToShow, videoPlaylistSliderInfiniteLoop, videoPlaylistSliderAutoplay } = blogmaticObject
                        let swiperObject = {
                            arrows: videoPlaylistSliderarrow,
                            slidesPerView: isWidget ? 1 : videoPlaylistSliderSlidesToShow,
                            loop: videoPlaylistSliderInfiniteLoop,
                            autoplay: videoPlaylistSliderAutoplay,
                            swiperClass: $selector + ' .player-list-wrap .swiper',
                            navigation: { nextEl: '.custom-button-next', prevEl: '.custom-button-prev' },
                            spaceBetween: 15,
                            breakpoints: {
                                640 : { slidesPerView: 1 },
                                769 : { slidesPerView: isWidget ? 1 : 3 },
                                1200: { slidesPerView: isWidget ? 1 : videoPlaylistSliderSlidesToShow }
                            }
                        }
                        blogmaticInitializeSwiper( swiperObject )
                    }
                }
            })
            // on button trigger
            vpSectionContainer.on( "click", ".thumb-video-highlight-text .thumb-controller", function() {
                var _this = $(this)
                _this.children().remove()
                if( _this.hasClass('onRoll') ) {
                    _this.append( playIcon )
                } else {
                    _this.append( pauseIcon )
                }
                if( _this.hasClass('isPaused') ) {
                    _this.removeClass('isPaused').addClass('onRoll')
                    vpSectionContainer.find( ".active-player iframe" )[0].contentWindow.postMessage( '{"event":"command", "func":"playVideo", "args":""}', '*')
                } else {
                    _this.removeClass('onRoll').addClass('isPaused')
                    vpSectionContainer.find( ".active-player iframe" )[0].contentWindow.postMessage( '{"event":"command", "func":"pauseVideo", "args":""}', '*');
                }
            });
        }
    }

    blogmaticVideoPlaylist('#blogmatic-video-playlist')   // video playlist section
    blogmaticVideoPlaylist('.widget_blogmatic_video_playlist_widget .video-playlist-wrap')    // video playlist widget

    var instaContainer = $('.blogmatic-instagram-section, .widget.widget_blogmatic_instagram_widget .instagram-container' )
    instaContainer.each(function(){
        var _thisContainer = $(this)
        if( _thisContainer.length > 0 ) {
            var instaContainerClass = _thisContainer.find('.instagram-content')
            _thisContainer.on( 'click', '.insta-image a', function( event ){
                if( instaContainerClass.hasClass( 'url-disabled' ) ) event.preventDefault()
            })
    
            if( instaContainerClass.hasClass( 'url-disabled' ) && instaContainerClass.hasClass( 'lightbox-enabled' ) ) {
                instaContainerClass.each(function(){
                    var _this = $(this), findImageSrc
                    if( _this.hasClass( 'swiper-initialized' ) ) {
                        var instaItem = _this.find('.instagram-item.swiper-slide')
                        findImageSrc = instaItem.find('.insta-image img')
                    } else {
                        findImageSrc = _this.find('.insta-image img')
                    }
                    var srcArgs = []
                    findImageSrc.each(function(){
                        srcArgs.push({
                            src: $(this).attr('src'),
                            type: 'image'
                        })
                    })
                    _this.find('.instagram-item').magnificPopup({
                        items: srcArgs,
                        gallery: {
                            enabled: true
                        },
                        type: 'image'
                    })
                })
            }
        }
    })

    /**
     * Instagram Section JS
     * 
     * @since 1.0.0
     */
    var instagramContainer = $('.blogmatic-instagram-section.slider-enabled, .widget.widget_blogmatic_instagram_widget .instagram-container.slider-enabled')
    instagramContainer.each(function(){
        var _this = $(this)
        const isFooter = _this.hasClass( 'insta-footer' )
        if( _this.length > 0 ) {
            const isInstaSection = _this.is( '.blogmatic-instagram-section' )
            const instaSectionSelector = isFooter ? '.blogmatic-instagram-section.insta-footer .swiper' : '.blogmatic-instagram-section.insta-header .swiper'
            let enableArrow, slidesToShow, infinite, autoplay, autoplaySpeed, speed, slidesToScroll
            if( isFooter ) {
                const { footerInstagramSliderArrow, footerInstagramSlidesToShow , footerInstagramSliderInfinite, footerInstagramAutoplayOption, footerInstagramAutoplaySpeed, footerInstagramSliderSpeed, footerInstagramSlidesToScroll } = blogmaticObject
                enableArrow = footerInstagramSliderArrow
                slidesToShow = footerInstagramSlidesToShow
                infinite = footerInstagramSliderInfinite
                autoplay = footerInstagramAutoplayOption
                autoplaySpeed = footerInstagramAutoplaySpeed
                speed = footerInstagramSliderSpeed
                slidesToScroll = footerInstagramSlidesToScroll
            } else {
                const { instagramSliderArrow, instagramSlidesToShow , instagramSliderInfinite, instagramAutoplayOption, instagramAutoplaySpeed, instagramSliderSpeed, instagramSlidesToScroll } = blogmaticObject
                enableArrow = instagramSliderArrow
                slidesToShow = instagramSlidesToShow
                infinite = instagramSliderInfinite
                autoplay = instagramAutoplayOption
                autoplaySpeed = instagramAutoplaySpeed
                speed = instagramSliderSpeed
                slidesToScroll = instagramSlidesToScroll
            }
            let swiperObject = {
                arrows: enableArrow,
                slidesPerView: isInstaSection ? slidesToShow : 1,
                loop: infinite,
                autoplay: autoplay,
                autoplaySpeed: autoplaySpeed,
                speed: speed,
                slidesPerGroup: slidesToScroll,
                spaceBetween: 15,
                navigation: { nextEl: _this.find( '.custom-button-next' )[0], prevEl: _this.find( '.custom-button-prev' )[0] },
                swiperClass: isInstaSection ? instaSectionSelector : '.instagram-widget .swiper',
                breakpoints: {
                    700 : { slidesPerView: 1 },
                    940 : { slidesPerView: 2 },
                    1200: { slidesPerView: isInstaSection ? slidesToShow : 1 }
                }
            }
            blogmaticInitializeSwiper( swiperObject )
        }
    })

    /**
     * Responsive header builder toggle button
     * 
     * @since 1.0.0
     */
    var responsiveHeaderBuilderWrapper = $('.bb-bldr--responsive')
    if( responsiveHeaderBuilderWrapper.length > 0 ) {
        let toggleButton = responsiveHeaderBuilderWrapper.find( '.toggle-button-wrapper' )
        toggleButton.on("click", function() {
            let _this = $(this)
            _this.parents( '.bb-bldr-row' ).siblings( '.bb-bldr-row.mobile-canvas' ).toggleClass( 'open' )
        })
    }

    const progressBar = {
        init: function() {
            this.scrollEvent()
        },
        selectors: {
            'scroll-to-top': {
                'selector': '#blogmatic-scroll-to-top .scroll-to-top-wrapper',
                'property': 'background',
                'usesBackground': true
            },
            'single-progress': {
                'selector': 'body.page header.site-header .single-progress, body.single header.site-header .single-progress',
                'property': 'width',
                'usesBackground': false
            }
        },
        totalScrollableArea: $('body')[0].clientHeight,
        sizeOfScrollBar: window.innerHeight,
        scrollEvent: function() {
            let self = this
            $(window).on("scroll", function(){
                let scrollBarPosition = window.scrollY
                let width = self.getWidth( scrollBarPosition )
                let background = 'conic-gradient('+ themeColor +' '+ width +'%, transparent '+ width +'%)'
                Object.entries( self.selectors ).forEach(( current ) => {
                    const [ ID, selectorValues ] = current
                    const { selector, property, usesBackground } = selectorValues
                    if( usesBackground ) {
                        $( selector ).attr( 'style', property + ': ' + background )
                    } else {
                        $( selector ).css( property, width + '%' )
                    }
                })
            })
        },
        getWidth: function( scrollBarPosition ) {
            let width = ( ( ( scrollBarPosition + this.sizeOfScrollBar ) / this.totalScrollableArea ) * 100 )
            return Math.round( width );
        }
    }
    progressBar.init()

    // header sticky
    const { headerStickyScrollUp, headerStickyScrollDown } = blogmaticObject
    if( headerStickyScrollUp || headerStickyScrollDown ) {
        let lastScroll = 0
        $( window ).on('scroll',function() {
            var scroll = $( this ).scrollTop();
            let selector = $('body header.site-header')
            if( scroll > 50 ) {
                if( headerStickyScrollUp && headerStickyScrollDown ) {
                    selector.removeClass( 'fixed--off' ).addClass( 'fixed--on' )
                } else {
                    if ( scroll > lastScroll ) {
                        /* Scrolling Down */
                        if( headerStickyScrollDown ) selector.addClass( 'fixed--on' ).removeClass( 'fixed--off' )
                        if( headerStickyScrollUp ) selector.removeClass( 'fixed--on' ).addClass( 'fixed--off' )
                    } else {
                        /* Scrolling UP */
                        if( headerStickyScrollUp ) selector.addClass( 'fixed--on' ).removeClass( 'fixed--off' )
                        if( headerStickyScrollDown ) selector.removeClass( 'fixed--on' ).addClass( 'fixed--off' )
                    }
                    lastScroll = scroll
                }
            } else {
                $( selector ).addClass("header-sticky--disabled fixed--off").removeClass( 'fixed--on' );
            }
        });
    }
})