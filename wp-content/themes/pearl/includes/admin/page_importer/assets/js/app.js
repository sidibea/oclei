(function($){

    $(document).ready(function(){

        $('.pearl-pli-layout select').on('change', function () {
            var val = $(this).val();
            $('.pearl-pli-layout-page').removeClass('active');

            $('.pearl-pli-layout-page#' + val).addClass('active');
        });

        $('.pearl_add_pli__button').on('click', function(){
            $('.pearl_add_pli__pages').toggleClass('active');
            $('.pearl_add_pli__pages_overlay').toggleClass('active');
            $('body').toggleClass('locked');
        });

        $('.pearl_add_pli__pages_overlay').on('click', function(){
            $('.pearl_add_pli__pages, .pearl_add_pli__pages_overlay').removeClass('active');
            $('body').removeClass('locked');
        });

        $('.pearl-pli-select_page').on('click', function(){
            var layout = $(this).data('layout');
            var page = $(this).data('page');

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'page': page,
                    'layout': layout,
                    'action': 'pearl_pli'
                },
                beforeSend: function beforeSend() {
                    $('.pearl_add_pli__pages').addClass('loading');
                },
                complete: function complete(data) {
                    $('.pearl_add_pli__pages').removeClass('loading');

                    var data = data.responseJSON;

                    var content = data.content;

                    if(tinymce.activeEditor) {
                        tinymce.activeEditor.setContent(content);
                    } else {
                        $('textarea#content').val(content);
                    }

                    if($('.composer-switch').hasClass('vc_backend-status')) {
                        $('.wpb_switch-to-composer').click();
                    };

                    setTimeout(function(){
                        $('.wpb_switch-to-composer').click();
                    }, 300);

                    $('.pearl_add_pli__pages').removeClass('active');
                    $('.pearl_add_pli__pages_overlay').removeClass('active');
                    $('body').removeClass('locked');

                    /*Page options*/
                    var meta = data.meta;

                    if(!meta.stm_sidebar) {
                        $('select[name="butterbean_stm_default_fields_setting_stm_sidebar"]').val('');
                    }

                    for(var name in meta) {
                        if (!meta.hasOwnProperty(name)) continue;

                        var value = meta[name];
                        var input_name = '[name="butterbean_stm_default_fields_setting_' + name + '"]';
                        if($(input_name).length) {

                            var $option = $(input_name);

                            if($option.attr('name') === 'butterbean_stm_default_fields_setting_stm_sidebar') {
                                $option.append($("<option></option>")
                                    .attr("value",value)
                                    .text(value));
                            }

                            $(input_name).val(value);


                        }
                    }

                    $('select[name="butterbean_stm_default_fields_setting_header_transparent"]').val('true');
                    $('input[name="butterbean_stm_default_fields_setting_page_title_box"]').attr('checked', false);

                }
            });

        });

    });

})(jQuery);