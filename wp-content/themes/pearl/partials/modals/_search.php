<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form method="get" id="searchform" action="<?php echo( home_url( '/' ) ); ?>">
                        <div class="search-wrapper">
                            <input placeholder="<?php esc_html_e('Start typing here...', 'pearl'); ?>" type="text" class="form-control search-input" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                            <button type="submit" class="search-submit" ><i class="fa fa-search mtc"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>