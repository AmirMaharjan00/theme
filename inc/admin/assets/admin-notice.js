jQuery(document).ready(function( $ ){
    var ajaxUrl = blogmaticNoticeOject.ajaxUrl, _wpnonce = blogmaticNoticeOject._wpnonce
    var welcomeOption = blogmaticNoticeOject.welcomeOption

    var noticeContainer = $('.blogmatic-admin-notice')
    if( noticeContainer.length > 0 ) {
        // dismiss notice
        noticeContainer.on('click', '.alert-dismiss, .action-button.review-never, .action-button.already-reviewed', function(){
            var _this = $(this), notice
            if( _this.parents('.blogmatic-admin-notice').hasClass( 'blogmatic-welcome-notice' ) ) notice = welcomeOption
            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: {
                    "action": 'blogmatic_admin_notice_ajax_call',
                    "_wpnonce": _wpnonce,
                    "dismiss_option": notice
                },
                beforeSend: function(){
                    _this.text( 'Dismissing...' )
                },
                success: function( result ) {
                    var parsedResult = JSON.parse( result )
                    if( parsedResult.status ) _this.parents( '.blogmatic-admin-notice' ).fadeOut()
                },
                complete: function() {
                    _this.text( 'Dismissed' )
                }
            })
        })
    }
})