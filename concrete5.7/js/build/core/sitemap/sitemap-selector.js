!function(global, $) {
    'use strict';

    function ConcretePageSitemapSelector($element, options) {
        'use strict';
        var my = this,
            options = $.extend({
                'mode': 'single',
                'inputName': 'cID',
                'selected': 0,
                'startingPoint': 1,
                'token': '',
                filters: {}
            }, options);

        my.$element = $('<div />', {'class': 'ccm-page-sitemap-selector-inner'});
        my.$element.appendTo($element);
        my.options = options;

        my.$element.concreteSitemap({
            selectMode: my.options.mode,
            minExpandLevel: 0,
            dataSource: CCM_DISPATCHER_FILENAME + '/ccm/system/page/select_sitemap',
            ajaxData: {
                'startingPoint': my.options.startingPoint,
                'ccm_token': my.options.token,
                'selected': my.options.selected,
                'filters': my.options.filters
            },
            onPostInit: function() {
                if (options.selected) {
                    if (options.mode == 'multiple') {
                        $.each(options.selected, function(i, cID) {
                            var node = my.$element.dynatree('getTree').getNodeByKey(String(cID));
                            if (node) {
                                node.select(true);
                            }
                        });
                    } else {
                        var tree = my.$element.dynatree('getTree');
                        var node = tree.getNodeByKey(String(options.selected));
                        if (node) {
                            node.select(true);
                        }
                    }
                }
            },
            onSelectNode: function(node, flag) {
                if (!node.data.hideCheckbox) {
                    if (flag) {
                        if (my.options.mode == 'single') {
                            my.deselectAll();
                        }
                        my.select(node);
                    } else {
                        my.deselect(node);
                    }
                } else {
                    return false;
                }
            }
        });

    }

    ConcretePageSitemapSelector.prototype = {

        deselectAll: function() {
            var my = this;
            var $inputs = my.$element.find('input[data-sitemap-selector-page-id]');
            $inputs.remove();
        },

        deselect: function(node) {
            var my = this;
            var $input = my.$element.find('input[data-sitemap-selector-page-id=' + node.data.cID + ']');
            $input.remove();
        },

        select: function(node) {
            var my = this,
                name = my.options.inputName;

            if (my.options.mode == 'multiple') {
                name += '[]';
            }

            var $input = $('<input />', {
                'data-sitemap-selector-page-id': node.data.cID,
                'type': 'hidden', 'name': name
            });
            $input.val(node.data.cID)
            $input.appendTo(my.$element);
        }
    }

    // jQuery Plugin
    $.fn.concretePageSitemapSelector = function(options) {
        return $.each($(this), function(i, obj) {
            new ConcretePageSitemapSelector($(this), options);
        });
    }

    global.ConcretePageSitemapSelector = ConcretePageSitemapSelector;

}(this, $);
