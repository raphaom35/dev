jQuery(document).ready(function() {
    var Matrix_aboutpage = matrixLiteWelcomeScreenCustomizerObject.aboutpage;
    var Matrix_nr_actions_required = matrixLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof Matrix_aboutpage !== 'undefined') && (typeof Matrix_nr_actions_required !== 'undefined') && (Matrix_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + Matrix_aboutpage + '"><span class="matrix-lite-actions-count">' + Matrix_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".matrix-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section matrix-upsells">');
    }
    if (typeof Matrix_aboutpage !== 'undefined') {
        jQuery('.matrix-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + Matrix_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', matrixLiteWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".matrix-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});