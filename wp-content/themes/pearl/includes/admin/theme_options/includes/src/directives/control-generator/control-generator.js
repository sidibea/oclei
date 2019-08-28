export function controlGenerator($compile, $sce, $rootScope, PreviewGenerator) {
    return {
        scope: {
            type: '=',
            data: '=',
            tab : '=',
            subtab : '=',
            themeOption : '='
        },
        link: function (scope, element, attrs) {
            let generatedTemplate = `<${scope.type}-control model="model_name" data="data"></${scope.type}-control>`;
            element.prepend($compile(generatedTemplate)(scope));

            let preview = '';
            scope.customStyles = customStyledElements;
            scope.colorsStyles = scope.customStyles['colors'];
            scope.bgStyles = scope.customStyles['bg_colors'];
            scope.borderStyles = scope.customStyles['border_colors'];

            scope.loadJs = (url) => {
                let type = 'text/javascript'
                if (url) {
                    var script = document.querySelector("script[src*='"+url+"']");
                    if (!script) {
                        var heads = document.getElementsByTagName("head");
                        if (heads && heads.length) {
                            var head = heads[0];
                            if (head) {
                                script = document.createElement('script');
                                script.setAttribute('src', url);
                                script.setAttribute('type', type);
                                head.appendChild(script);
                            }
                        }
                    }
                    return script;
                }

            };

            if (angular.isDefined(scope.data.preview)) {
                scope.preview = scope.data.preview;
                if (angular.isDefined(scope.preview.js)) {
                    scope.loadJs(scope.preview.js);
                }
            }



            if (angular.isUndefined(scope.preview)) {
                scope.preview = {};
            }


        },
        templateUrl: ngAppPath + 'directives/control-generator/control-generator.directive.html'
    }
}