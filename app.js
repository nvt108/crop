var app = angular.module('landingPageBuilderApp', ['dndLists', 'ui.tinymce', 'ngSanitize']);

//BEGIN FILTERS
app.filter('variableName', function () {
    return function (input) {
        input = input
            .replace(/[^\w]/gi, '_')
            .toLowerCase()
        ;
        return input;
    }
});
app.filter('stripTags', function () {
    return function (input, allowed) {
        input = String(input);
        allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
        var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
            commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
        return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
            return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
        });
    };
});
app.filter('stripText', function () {
    return function (input) {
        input = String(input);
        return input.replace(/\w(?![^<]*>|[^<>]*<\/)/g, "")
    };
});
//END FILTERS

//BEGIN FILTERS
app.directive('outsideClick', ['$document', function ($document) {
    return {
        restrict: 'A',
        link: function ($scope, $element, $attrs) {
            var contains = function (parent, child) {
                var node = child;
                while ((node = node.parentNode) !== null && node !== parent) {
                }
                return node !== null;
            };
            var scopeExpression = $attrs.outsideClick;
            var onDocumentClick = function (event) {
                if ($element[0] !== event.target && !contains($element[0], event.target)) {
                    $scope.$apply(scopeExpression);
                }
            };
            $document.on('click', onDocumentClick);
            $element.on('$destroy', function () {
                $document.off('click', onDocumentClick);
            });
        }
    };
}]);

var wflpCustomDataDirective = function () {
    return {
        restrict: 'A',
        priority: 100,
        compile: function (tpl, tplAttr) {
            return function ngValueLink(scope, elm, attr) {
                scope.$watch(attr.wflpCustomData, function valueWatchAction(json) {
                    try {
                        var attributes = JSON.parse(json);
                    } catch (e) {
                        return;
                    }
                    for (attributeIndex in attributes) {
                        if (attributes.hasOwnProperty(attributeIndex)) {
                            var attribute = attributes[attributeIndex];
                            elm.attr(attributeIndex, attribute);
                        }
                    }
                });
            };
        }
    };
};

app.directive('wflpCustomData', wflpCustomDataDirective);
app.directive('autofocus', ['$timeout', function ($timeout) {
    return {
        restrict: 'A',
        link: function ($scope, $element) {
            $timeout(function () {
                $element[0].focus();
            });
        }
    }
}]);
app.directive('wflpOnEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.wflpOnEnter);
                });

                event.preventDefault();
            }
        });
    };
});
//END FILTERS


app.constant('AJAXURL', (function () {
    if (typeof ajaxurl == 'undefined')return '';
    return ajaxurl;
})());

jQuery();

app.value('defaultDropzonesJson', (function () {
    if (
        typeof parent != 'undefined' &&
        typeof parent.WFLandingpage != 'undefined' &&
        typeof parent.WFLandingpage.defaultDropzonesJson != 'undefined' && !jQuery.isEmptyObject(parent.WFLandingpage.defaultDropzonesJson) &&
        (parent.WFLandingpage.defaultDropzonesJson)
    ) {
        return (parent.WFLandingpage.defaultDropzonesJson);
    }
    return false;
})());

app
    .controller('landingPageBuilderMainController', function ($scope, $originObjects, $window, $http, AJAXURL, defaultDropzonesJson, $sce, $compile, $timeout, $interval) {
        var scope = $scope;
        scope.$originObjects = $originObjects;
        scope.prompt = function (valueRef, displayText, defaultValue, options) {
            var defaultOptions = {
                'keep_value_on_cancel': true
            };
            if (typeof options == 'object') {
                Object.assign(defaultOptions, options);
            }
            options = defaultOptions;

            var promptOptions= {
                title: jQuery('<div/>').text(displayText).html(),
                inputType: 'textarea',
                backdrop: true,
                className:'prompt-fixed-top',
                callback: function (result) {
                    if (options.keep_value_on_cancel && result == null) {
                        return defaultValue;
                    }
                    if (typeof options.key == 'undefined') {
                        console.log('valueRef must is Object referenced. And a key must be specified');
                    } else {
                        valueRef[options.key] = result;
                    }
                }
            };
            window.parent.bootbox.prompt(promptOptions);
        };

        //
        scope.originObjectsProvider = $originObjects;
        scope.dnd = {};
        scope.dnd.originObjects = $originObjects.getAll();

        //PREPARE FOR TOOLBAR
        //DEFAULT DROPZONE
        function fill_inline_toolbar_position_handler_to_dropzone(dropzone) {
            for (instanceObjectIndex in dropzone.instanceObjects) {
                var instanceObject = dropzone.instanceObjects[instanceObjectIndex];
                if (
                    typeof instanceObject != 'undefined' &&
                    typeof instanceObject.options.tinymceOptions != 'undefined' &&
                    typeof instanceObject.options.tinymceOptions.inline_toolbar_position_handler == 'undefined'
                ) {
                    instanceObject.options.tinymceOptions.inline_toolbar_position_handler = function (rects) {
                        var tinymceObjects = jQuery('.mce-tinymce');
                        if (tinymceObjects.hasClass('mce-arrow-down') || tinymceObjects.hasClass('mce-arrow-up')) {
                            //if(tinymce panel is placed at top or bottom)
                            return rects.panelRect;
                        }
                        //if(tinymce panel is no placed at top or bottom)
                        rects.panelRect.top = rects.panelRect.top - 50;
                        return rects.panelRect;
                    };
                }
                if (typeof instanceObject.options.dropzone == 'object') {
                    fill_inline_toolbar_position_handler_to_dropzone(instanceObject.options.dropzone);
                }
            }
        }

        if (defaultDropzonesJson != false) {
            scope.dnd.dropzones = angular.fromJson(defaultDropzonesJson);
        }
        else {
            $http.get(AJAXURL + '?action=admin_landingpages_getStructureDataJson').success(function (response) {
                scope.dnd.dropzones = angular.fromJson(response.data);

                for (dropzoneIndex in scope.dnd.dropzones) {
                    if (scope.dnd.dropzones.hasOwnProperty(dropzoneIndex)) {
                        fill_inline_toolbar_position_handler_to_dropzone(scope.dnd.dropzones[dropzoneIndex]);
                    }
                }
            });
        }
        //END DEFAULT DROPZONE

        scope.dnd.objectTypeDragging = '';
        scope.validateDroppableObject = function (event, index, item, external, type, dropzone) {
            return item;
            return;
            // temporary we can drop anything
            var alert = function () {
                $window.alert('You cannot drop it.');
            };
            if (typeof dropzone.allowedTypes == 'undefined') {
                alert();
                return;
            }
            if (angular.isArray(dropzone.allowedTypes)) {
                if (dropzone.allowedTypes.indexOf(item.type) < 0) {
                    alert();
                    return false;
                }
            } else {
                if (item.type == dropzone.allowedTypes) {
                    alert();
                    return false;
                }
            }
            return item;
        };

        scope.mergeObjectOptions = function (object, options) {
            if (typeof object == 'undefined')return object;
            var objectWithOptionsMerged = (object);
            for (optionKey in options) {
                if (options.hasOwnProperty(optionKey)) {
                    if (typeof objectWithOptionsMerged.options != 'undefined')objectWithOptionsMerged.options[optionKey] = options[optionKey];
                }
            }
            return objectWithOptionsMerged;
        };

        scope.trustAsHtml = function (string) {
            return $sce.trustAsHtml(string);
        };
        scope.$sce = $sce;

        scope.receiveUserMedia = function (defaultSrc, options) {
            jQuery('html').attr('id', 'wpwrap');
            var hidden_button = ($compile('<a single="true" mediatype="image" mediaid="wflpb_bg_image"' +
                ' role="button" class="wfmedia upload-tw-image button " wfmedia-load-remote="wf-media" wfmedia-remote-target="#wf-media-modal"><i></i>Upload Photo</a>')(scope));
            var hidden_result = ($compile('<input name="wflpb_bg_image" id="wflpb_bg_image" class="wf-ibuilding-image">')(scope));
            var modal = '<div id="wf-media-modal" class="wf-media-manager wf-media-modal media-manager-popup" style="position: absolute; top: 0; left: 0; display: none; width:100%;height:auto;"></div>';
            jQuery('body').append(hidden_button).append(hidden_result).append(modal).append('<div id="wpfooter"></div>');

            $timeout(function () {
                WFMedia.init();
                hidden_button.trigger('click');
                jQuery('body', window.parent.document).animate({
                    scrollTop: 0
                }, 700);
                jQuery('#wf-media-modal').on('hide.wfmedia', function () {

                    jQuery('html').attr('id', null);
                    hidden_button.remove();
                    hidden_result.remove();

                    scope.userMedia = {};
                    var result = hidden_result.val();
                    if (result.length < 1) {
                        if (typeof defaultSrc == 'undefined') {
                            scope.userMedia = '';
                            return '';
                        }
                        return defaultSrc;
                    }
                    scope.userMedia = result;
                    if (typeof options != 'undefined') {
                        options.objects_effected.map(function (object_effected) {
                            object_effected.options.src = result;
                        });
                    }
                });
                return hidden_result;
            }, 200);
        };

        //START: TWO WAY BINDING: BODY CLASS <-> USER DATA
        scope.$watch('dnd.dropzones.skin', function (newVal, oldVal) {
            if (typeof newVal == 'string')
                jQuery('body').attr('skin', newVal).addClass(newVal);
        });
        $interval(function () {
            var skin = jQuery('body').attr('skin');
            if (typeof scope.dnd.dropzones == 'object' && typeof skin == 'string')
                scope.dnd.dropzones.skin = skin;
        }, 100);
        //END: TWO WAY BINDING: BODY CLASS <-> USER DATA

        $interval(function () {
            var tinymceBlocks = jQuery('.mce-tinymce');
            tinymceBlocks.each(function (tinymceBlockIndex, tinymceBlock) {
                if (tinymceBlock.style.top == '0px') {
                    console.log('detected .mce-tinymce position wrong');
                    tinymceBlock.style.top = '';
                }
            });
        }, 200);
        scope.clickOutside = function () {
            $timeout(function () {
                jQuery('body').trigger('click');
            }, 200);
        };
        scope.settingInputFieldTypeOptions = [
            {label: 'E-Mail', key: 'email', type: 'email'},
            {label: 'Name', key: 'name', type: 'text'},
            {label: 'Telephone', key: 'telephone', type: 'text'},
            {label: 'Custom Text', key: '', type: 'text'}
        ];
    })
;
