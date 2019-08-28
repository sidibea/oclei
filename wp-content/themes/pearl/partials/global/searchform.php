<form role="search"
      method="get"
      class="search-form"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search"
           class="form-control"
           placeholder="<?php _e( 'Search...', 'pearl' ); ?>"
           value="<?php echo get_search_query(); ?>"
           name="s" />
    <button type="submit"><i class="fa fa-search"></i></button>
</form>