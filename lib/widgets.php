<?php

/**
 * Custom widgets
 */


/**
 * "About" widget
 */

add_action( 'widgets_init', create_function('', 'return register_widget("About");') );

class About extends WP_Widget {

    function __construct() {
            $widget_ops = array('classname' => 'about', 'description' => __('About Widget'));
            parent::__construct('About', __('About'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $welcome_text = $instance['welcome_text'];
        $show_image = isset( $instance['show_image'] ) ? $instance['show_image'] : false;
        $show_social = isset( $instance['show_social'] ) ? $instance['show_social'] : false;
        $show_subscribe = isset( $instance['show_subscribe'] ) ? $instance['show_subscribe'] : false;

        echo '<div class="about-widget widget">';
        if ( !empty( $welcome_text ) || isset($show_image) ) { 
            if ( $show_image ) { 
                echo '<div class="profile-image"><a href="'. get_bloginfo('url').'/about/"><img src="'.get_stylesheet_directory_uri().'/assets/images/sarah-profile.jpg?v=2" height="230" width="230" alt="Sarah Trop" nopin="nopin"></a></div>';
            };
            echo '<div class="welcome-text">';
            if ( !empty( $title ) ) { 
                echo '<h3 class="widget-title">'.$title.'</h3>';
            };
            echo $welcome_text;
            echo '</div>';
        }
        if ( $show_social ) { ?>

            <div class="social-links">
                <ul>
                    <li class="social-facebook"><a href="https://www.facebook.com/funcycled" title="FunCycled on Facebook" class="fa fa-facebook fa-lg"><span>FunCycled on Facebook</span></a></li>
                    <li class="social-pinterest"><a href="http://pinterest.com/funcycled/" title="FunCycled on Pinterest" class="fa fa-pinterest fa-lg"><span>FunCycled on Pinterest</span></a></li>
                    <li class="social-ig"><a href="https://instagram.com/funcycled/" title="FunCycled on Instagram" class="fa fa-instagram fa-lg"><span>FunCycled on Instagram</span></a></li>
                </ul>
            </div>

        <?php }

        if ( $show_subscribe ) { ?>

            <div class="email-subscribe">
                <p>Get some fun in your inbox! 🎉</p>
                <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=FunCycled', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" class="form-subscribe">
                    <div class="field-holder"><input type="text" name="email" value="Enter your email for updates." name="s" id="s" onblur="if (this.value == '')   {this.value = 'Enter your email for updates.';}" onfocus="if (this.value == 'Enter your email for updates.'){this.value = '';}"/></div>
                    <input type="hidden" value="FunCycled" name="uri"/>
                    <input type="hidden" name="loc" value="en_US"/>
                    <input type="submit" value="Subscribe" style="display:none"/>
                </form>
            </div>

        <?php }
        echo '</div>';
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['welcome_text'] = $new_instance['welcome_text'];
        $instance['show_image'] = $new_instance['show_image'];
        $instance['show_social'] = $new_instance['show_social'];
        $instance['show_subscribe'] = $new_instance['show_subscribe'];
        return $instance;
    }

    function form( $instance ) {

        $defaults = array( 'title' => __('Welcome', 'example'), 'welcome_text' => __('Welcome text.', 'example'), 'show_image' => true, 'show_social' => true );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <!-- Welcome Text: Text Area -->
        <p>
            <label for="<?php echo $this->get_field_id( 'welcome_text' ); ?>"><?php _e('Welcome Text:', 'example'); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('welcome_text'); ?>" name="<?php echo $this->get_field_name('welcome_text'); ?>"><?php echo $instance['welcome_text']; ?></textarea>
        </p>

        <!-- Show Image? Checkbox -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_image'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e('Display bio image?', 'example'); ?></label>
        </p>

        <!-- Show Social? Checkbox -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_social'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_social' ); ?>" name="<?php echo $this->get_field_name( 'show_social' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'show_social' ); ?>"><?php _e('Display social links?', 'example'); ?></label>
        </p>

        <!-- Show Newsletter? Checkbox -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_subscribe'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_subscribe' ); ?>" name="<?php echo $this->get_field_name( 'show_subscribe' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'show_subscribe' ); ?>"><?php _e('Display newsletter signup?', 'example'); ?></label>
        </p>

    <?php
    }
}




?>