<?php
/** no direct access **/
defined('MECEXEC') or die();

$settings = $this->main->get_settings();

$modern_type = '';
if ( isset( $settings['search_bar_modern_type'] ) && $settings['search_bar_modern_type'] == '1' )
{
    $modern_type = 'mec-modern-search-bar ';
}

$output = '<div class="'.$modern_type.'mec-wrap mec-search-bar-wrap"><form class="mec-search-form mec-totalcal-box" role="search" method="get" id="searchform" action="'.get_bloginfo('url').'">';
if($settings['search_bar_category'] == '1' || $settings['search_bar_location'] == '1' || $settings['search_bar_organizer'] == '1' || $settings['search_bar_speaker'] == '1' || $settings['search_bar_tag'] == '1' || $settings['search_bar_label'] == '1')
{
    $output .= '<div class="mec-dropdown-wrap">';
    if($settings['search_bar_category'] == '1' ) $output .= $this->show_taxonomy('mec_category' , 'folder');
    if($settings['search_bar_location'] == '1' ) $output .= $this->show_taxonomy('mec_location' , 'location-pin');
    if($settings['search_bar_organizer'] == '1' ) $output .= $this->show_taxonomy('mec_organizer' , 'user');
    if($settings['search_bar_speaker'] == '1' ) $output .= $this->show_taxonomy('mec_speaker' , 'microphone');
    if($settings['search_bar_tag'] == '1' ) $output .= $this->show_taxonomy('post_tag' , 'tag');
    if($settings['search_bar_label'] == '1' ) $output .= $this->show_taxonomy('mec_label' , 'pin');
    $output .= '</div>';
}


if ( isset( $settings['search_bar_ajax_mode'] ) && $settings['search_bar_ajax_mode'] == '1' ) : 
    $output .= '
    <div class="mec-ajax-search-result">
        <div class="mec-text-input-search">
            <i class="mec-sl-magnifier"></i>
            <input type="text" placeholder="'.__('Please enter at least 3 characters' , 'modern-events-calendar-lite').'" value="" id="keyword" name="keyword" />
        </div>
        <div id="mec-ajax-search-result-wrap"><div class="mec-ajax-search-result-events">'.__('Search results will show here' ,'modern-events-calendar-lite').'</div></div>
    </div>';
else: 
    if($settings['search_bar_text_field'] == '1' )
    {
        $output .= '
        <div class="mec-text-input-search">
            <i class="mec-sl-magnifier"></i>
            <input type="search" value="" id="s" name="s" />
        </div>';
    }
    $output .= '<input class="mec-search-bar-input" id="mec-search-bar-input" type="submit" alt="'.esc_html__('Search', 'modern-events-calendar-lite').'" value="'.esc_html__('Search', 'modern-events-calendar-lite').'" /><input type="hidden" name="post_type" value="mec-events">';
endif;

$output .= '</form></div>';



echo $output;
?>
<script type="text/javascript">
jQuery("#keyword").typeWatch(
    {
        wait: 400,
        callback: function (value)
        {
            if (!value || value == "")
            {
                jQuery('#mec-ajax-search-result-wrap').css({opacity: '0', visibility: 'hidden' });
            }
            else
            {
                var keyword = jQuery('#keyword').val(),
                    minLength = 3,
                    searchWrap = jQuery('.mec-search-bar-wrap');
                
                var category = '',
                    location = '',
                    organizer = '',
                    speaker = '',
                    tag = '',
                    label = '';

                if ( keyword.length >= minLength ) keyword = jQuery('#keyword').val();
                if ( keyword.length == 0 ) keyword = 'empty';

                if ( jQuery('#category').length > 0 )
                {
                    if ( searchWrap.find('#category').val().length !== 0 ) category = searchWrap.find('#category').val();
                }
                if ( jQuery('#location').length > 0 )
                {
                    if ( searchWrap.find('#location').val().length !== 0 ) location = searchWrap.find('#location').val();
                }
                if ( jQuery('#organizer').length > 0 )
                {
                    if ( searchWrap.find('#organizer').val().length !== 0 ) organizer = searchWrap.find('#organizer').val();
                }
                if ( jQuery('#speaker').length > 0 )
                {
                    if ( searchWrap.find('#speaker').val().length !== 0 ) speaker = searchWrap.find('#speaker').val();
                }
                if ( jQuery('#Tag').length > 0 )
                {
                    if ( searchWrap.find('#Tag').val().length !== 0 ) tag = searchWrap.find('#Tag').val();
                }
                if ( jQuery('#label').length > 0 )
                {
                    if ( searchWrap.find('#label').val().length !== 0 ) label = searchWrap.find('#label').val();
                }
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {
                        action: 'mec_get_ajax_search_data',
                        keyword: keyword,
                        length : keyword.length,
                        category: category,
                        location: location,
                        organizer: organizer,
                        speaker: speaker,
                        tag: tag,
                        label: label
                    },
                    success: function(data) {
                        jQuery('#mec-ajax-search-result-wrap').css({
                            opacity: '1',
                            visibility: 'visible'
                        });
                        if ( keyword != 'empty' )  jQuery('.mec-ajax-search-result-events').html( data );
                    }
                });
            }
        }
    });
</script>