<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('.btn_post_list_load').on('click', function () {
                var vars = $(this).attr('data-vars');
                var num = $(this).attr('data-num');
                vars = JSON.parse(vars);
                vars['action'] = 'pearl_load_posts_list';
                var total = $(this).attr('data-total');
                var offset = 0;

                var selector = $(this).attr('data-container');
                $.ajax({
                    url: stm_ajaxurl,
                    dataType: 'json',
                    context: this,
                    data: vars,
                    beforeSend: function () {
                        $(this).addClass('loading');
                    },
                    complete: function (data) {
                        var dt = data.responseJSON;

                        if(typeof dt.content !== 'undefined') {
                            $(selector).append(dt.content);
                        }

                        if(typeof dt.offset !== 'undefined') {
                            offset = parseInt(dt.offset) + parseInt(num);
                            $(this).attr('data-offset', offset);
                            vars.offset = offset;
                            $(this).attr('data-vars', JSON.stringify(vars));
                        }

                        if(total <= offset) {
                            $(this).remove();
                        }

                        $(this).removeClass('loading');
                    }
                });
            })
        });
    })(jQuery)
</script>