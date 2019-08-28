export const materialForm = () => {

    const scope = {
      formStyle: '='
    };

    const link = (scope, elem, attrs) => {
        let forms = [
            'style_3',
        ];
        let $ = jQuery;

        let inputs = $('control-generator input, control-generator textarea')
            .not(':input[type=button], ' +
                ':input[type=submit], ' +
                ':input[type=reset], ' +
                ':input[type=checkbox], ' +
                ':input[type=radio], ' +
                '.default-form, ' +
                ':input[type=search][name="s"], ' +
                '#coupon_code, ' +
                ':input[type=hidden]');

        let wrapper = 'stm_material_form';



        scope.$watch('formStyle', function (val, oldVal) {
            if (val !== oldVal) {
                if (forms.includes(val)) {

                    $(inputs).each(function() {

                        if($('body').hasClass('woocommerce-page')) return;

                        var label = $(this).attr('placeholder');


                        if (!$(this).parent().hasClass(wrapper)) {
                            $(this).parent().addClass(wrapper);
                        }
                        $(this).siblings('.label').show();

                        $(this).attr('placeholder', '');



                        checkValue($(this));

                    });

                    $(inputs).on('focusout change', function(e){
                        checkValue($(this));
                    });

                    $(inputs).on('focus', function(e){
                        $(this).closest('.stm_material_form').addClass('stm_has-value');
                    });

                    changeTextarea();

                    $('select').on('change', function(){
                        if ($(this).children('option:first-child').is(':selected')) {
                            $(this).closest('.stm_select').removeClass('stm_has-value');
                        } else {
                            $(this).closest('.stm_select').addClass('stm_has-value');
                        }
                    })
                } else {
                    $(inputs).each(function () {
                        let label = $(this).siblings('.label');

                        $(this).parents('.' + wrapper).removeClass(wrapper);
                        label.hide();
                        $(this).attr('placeholder', label.text())
                    })
                }
            }
        });

        function checkValue($el) {
            var val = $el.val();

            if(val == '') {
                if($el.hasClass('hasDatepicker') || $el.hasClass('stm_timepicker')) {
                    clearTimeout(timer);
                    timer = setTimeout(function(){
                        if(!$el.is(':focus') && val !== '') {
                            $el.closest('.stm_material_form').removeClass('stm_has-value');
                            checkValue($el);
                        }
                    }, 300);
                } else {
                    $el.closest('.stm_material_form').removeClass('stm_has-value');
                }
            } else {
                $el.closest('.stm_material_form').addClass('stm_has-value');
            }
        }

        function changeTextarea() {
            if($('textarea').length) {
                $('textarea').each(function () {
                    $(this).attr('rows', 1);
                });
                var ta = document.querySelector('textarea');
                ta.addEventListener('focus', function () {
                    autosize(ta);
                });
            }
        }
    };

    return {
        scope: scope,
        link: link,
        restrict: 'A'
    }
};