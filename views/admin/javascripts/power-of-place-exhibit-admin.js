jQuery(document).ready(function($){

    /**
     * Hiding form elements in ExhibitBuilder. Doing it this way because
     * there are no hooks to hide with CSS alone, and want to avoid
     * editing Exhibit Builder plugin directly.
     * 
     * Hides the following fields on the exhibit metadata form:
     * - Slug
     * - Credits
     * - Featured
     * - Theme
     */
    $('#exhibit-metadata-form .field').each(function(i){
        switch(i) {
            case 1:
            case 2:
            case 5:
            case 7:
                $(this).hide();
            break;
        }
    });
});