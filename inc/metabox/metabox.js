jQuery(document).ready(function( $ ) {
    function blogmaticMetaboxIsActiveClassToggle( $selector ) {
        var layoutSectionContainer = $( $selector )
        if( layoutSectionContainer.length > 0 ) {
            layoutSectionContainer.on('click', '.layout-item', function(){
                var _this = $(this)
                _this.addClass('isactive').siblings().removeClass('isactive')
            })
        }
    }

    blogmaticMetaboxIsActiveClassToggle( '.sidebar-section' );   // sidebar layouts ( posts and page )
    blogmaticMetaboxIsActiveClassToggle( '.single-layouts-section' );    // single posts layouts ( posts )
    blogmaticMetaboxIsActiveClassToggle( '.taxonomy-sidebar-layouts-wrap' ); // sidebar layouts ( categories & tags )
    blogmaticMetaboxIsActiveClassToggle( '.taxonomy-archive-layouts-wrap' ); // archive layouts ( categories & tags )
})