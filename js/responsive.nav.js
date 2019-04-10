/*!
 *
 *  Copyright (c) David Bushell | http://dbushell.com/
 *
 */
(function(window, document, undefined)
{

    window.App = (function()
    {

        var _init = false, app = { };

        app.init = function()
        {
            if (_init) {
                return;
            }
            _init = true;

            var nav_open = false,
                $inner = jQuery('#main-container');
                $nav = jQuery('nav#nav');


            jQuery('#nav-open-btn').on('click', function()
            {                                
                    jQuery(document.documentElement).addClass('js-nav');
            });

            jQuery('#nav-close-btn').on('click', function()
            {                                 
                    jQuery(document.documentElement).removeClass('js-nav');                                        
            });

            jQuery(document.documentElement).addClass('js-ready');
        };

        return app;

    })();

    jQuery(document).ready(function()
    {
        window.App.init();
    });

})(window, window.document);
