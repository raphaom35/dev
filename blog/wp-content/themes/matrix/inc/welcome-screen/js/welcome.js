jQuery(document).ready(function() {
	
	/* If there are required actions, add an icon with the number of required actions in the About matrix page -> Actions required tab */
    var Matrix_nr_actions_required = matrixLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof Matrix_nr_actions_required !== 'undefined') && (Matrix_nr_actions_required != '0') ) {
        jQuery('li.matrix-lite-w-red-tab a').append('<span class="matrix-lite-actions-count">' + Matrix_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".matrix-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'Matrix_lite_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : matrixLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.matrix-lite-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + matrixLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var Matrix_lite_actions_count = jQuery('.matrix-lite-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof Matrix_lite_actions_count !== 'undefined' ) {
                    if( Matrix_lite_actions_count == '1' ) {
                        jQuery('.matrix-lite-actions-count').remove();
                        jQuery('.matrix-lite-tab-pane#actions_required').append('<p>' + matrixLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.matrix-lite-actions-count').text(parseInt(Matrix_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
	
	/* Tabs in welcome page */
	function Matrix_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".matrix-lite-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}
	
	var Matrix_actions_anchor = location.hash;
	
	if( (typeof Matrix_actions_anchor !== 'undefined') && (Matrix_actions_anchor != '') ) {
		Matrix_welcome_page_tabs('a[href="'+ Matrix_actions_anchor +'"]');
	}
	
    jQuery(".matrix-lite-nav-tabs a").click(function(event) {
        event.preventDefault();
		Matrix_welcome_page_tabs(this);
    });

});