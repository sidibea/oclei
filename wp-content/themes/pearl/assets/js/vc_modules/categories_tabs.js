'use strict';

(function ($) {
    var timeout = void 0;
    var module = $('.stm_categories_tabs');
    if (module.length < 1) return;
    var tabsList = module.find('ul.nav-tabs');
    var tabsListWidth = tabsList.width();
    var dd = module.find('.stm_categories_tabs__dropdown');
    var ddMenu = dd.find('ul');
    var title = module.find('.stm_categories_tabs__title');
    var lastTabWidth = 0;

    var moveTabs = function moveTabs() {

        var heading = module.find('.stm_categories_tabs__heading');
        var maxWidth = heading.outerWidth() - title.outerWidth() - 80;

        if (tabsList.outerWidth() > maxWidth) {
            dd.show();
            while (tabsList.outerWidth() > maxWidth) {
                var lastTab = tabsList.find('li').last();
                lastTabWidth = lastTab.outerWidth();
                var clonedLastTab = lastTab.clone(true);
                lastTab.remove();
                clonedLastTab.appendTo(ddMenu);
            }
        } else {
            if (ddMenu.find('li').length !== 0) {
                while (tabsList.outerWidth() + lastTabWidth < maxWidth) {
                    var _lastTab = ddMenu.find('li').last();

                    var _clonedLastTab = _lastTab.clone(true);
                    _lastTab.remove();
                    _clonedLastTab.appendTo(tabsList);
                    if (_lastTab.length === 0) {
                        dd.hide();
                        break;
                    };
                }
            }
        }
        if (ddMenu.find('li').length === 0) {
            dd.hide();
        }
    };
    var tabClickHandler = function tabClickHandler() {
        "use strict";

        var listElements = $('.stm_categories_tabs__dropdown > ul > li, .stm_categories_tabs ul.nav-tabs li');
        var tabs = $('.stm_categories_tabs .tab-content .tab-pane');
        listElements.click(function () {
            var el = $(this);
            var tab = $(el.find('a').attr('href'));
            listElements.not($(this)).each(function () {
                $(this).removeClass('active');
            });
            tabs.each(function () {
                $(this).removeClass('active in');
            });
            tab.addClass('active');
            setTimeout(function () {
                return tab.addClass('in');
            }, 50);
            el.not('.active').addClass('active');
        });
    };

    $(document).ready(function () {
        moveTabs();
        tabClickHandler();
    });
    $(window).resize(function () {
        clearTimeout(timeout);

        timeout = setTimeout(function () {
            return moveTabs();
        }, 500);
    });
})(jQuery);