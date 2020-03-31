<?php

class Video_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'video-widget',
            'Video Widget',
            array(
                'description' => __('Display a Vimeo or Youtube video.'),
                'mime-type' => 'video'
            )
        );
    
        add_action('widgets_init', function() {
            register_widget('Video_Widget');
        });

    }

    public $args = array(
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget' => '</div></div>'
    );

    //This is where our widget gets rendered on the front end
    public function widget($args, $instance) {

        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if( ! empty( $instance['video_type'] ) ) {

            switch($instance['video_type']) {

                case "Youtube" :
                    echo '<div class="pm-video-wrapper"><iframe width="100%" height="'. esc_attr($instance['video_height']) .'" src="https://www.youtube-nocookie.com/embed/'. esc_attr($instance['video_id']) .'?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen SameSite=None Secure></iframe></div>';

                break;
    
                case "Vimeo" :
                    echo '<div class="pm-video-wrapper"><iframe src="http://player.vimeo.com/video/'. esc_attr($instance['video_id']) .'?title=0" width="100%" height="400"></iframe></div>';
                break;
    
            }

        }

        echo $args['after_widget'];
   
    }

    //This is where our widget form gets rendered in the WordPress admin area
    public function form($instance) {

        $title = !empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $video_type = !empty( $instance['video_type'] ) ? $instance['video_type'] : esc_html__( '', 'text_domain' );
        $video_id = !empty( $instance['video_id'] ) ? $instance['video_id'] : esc_html__( '', 'text_domain' );
        $video_height = !empty( $instance['video_height'] ) ? $instance['video_height'] : esc_html__( '', 'text_domain' );

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')) ?>"><?php echo esc_html__('Title', 'text-domain'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr__( $this->get_field_id('title') ) ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </label>
        <p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('video_type')) ?>"><?php echo esc_html__('Video Type', 'text-domain'); ?>
               <select name="<?php echo esc_attr( $this->get_field_name('video_type') ); ?>" class="widefat">
                    <option <?php selected( $video_type, 'Youtube' ) ?>>Youtube</option>
                    <option <?php selected( $video_type, 'Vimeo' ) ?>>Vimeo</option>
               </select>
            </label>
        <p>
             <label for="<?php echo esc_attr($this->get_field_id('video_id')) ?>"><?php echo esc_html__('Video ID', 'text-domain'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('video_id')); ?>" id="<?php echo esc_attr__( $this->get_field_id('video_id') ) ?>" type="text" value="<?php echo esc_attr($video_id); ?>"/>
            </label>
        <p>

        <p>
             <label for="<?php echo esc_attr($this->get_field_id('video_height')) ?>"><?php echo esc_html__('Video Height', 'text-domain'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('video_height')); ?>" id="<?php echo esc_attr__( $this->get_field_id('video_height') ) ?>" type="text" value="<?php echo esc_attr($video_height); ?>"/>
            </label>
        <p>

        </p>

        <?php

    }

    //This is where the old data gets overwritten with the new data
    public function update($new_instance, $old_instance) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['video_type'] = ( !empty( $new_instance['video_type'] ) ) ? strip_tags( $new_instance['video_type'] ) : '';
        $instance['video_id'] = ( !empty( $new_instance['video_id'] ) ) ? strip_tags( $new_instance['video_id'] ) : '';
        $instance['video_height'] = ( !empty( $new_instance['video_height'] ) ) ? strip_tags( $new_instance['video_height'] ) : '';

        return $instance;

    }

}

$video_widget = new Video_Widget();

?>