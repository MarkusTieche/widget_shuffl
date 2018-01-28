<?php

/*
Plugin Name: Mini Shuffl widget
Plugin URI: https://inkfood.com
Description: Mini Shuffl Game widget
Author: markusT/inkfood.com
Version: 1
Author URI: https://inkfood.com
*/

class example_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function example_widget() {
        parent::WP_Widget(false, $name = 'Mini Shuffl widget');	
          wp_enqueue_style( 'example_widget', plugins_url('/widget_shuffl/mini_shuffl/style.css' ));
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        $image = !empty( $instance['image'] ) ? $instance['image'] : '';
        $repeatBG = $instance[ 'repeatBG' ];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
    
    
            
                <?php 
                    
                if ( $repeatBG != "on" )
                {
                    $cssRepeat = "background-size:cover; background-position:center;";
                }; ?>
				
				<p style="text-align: center;"><?php echo $message; ?></p>

                <div id="shuffl" style="<?php echo $cssRepeat; ?> background-image:url('<?php echo esc_url($image); ?>')">

                     <div id="inset"> </div>

                     <div id="counterWrapper">
                        <div id="digit_3" class="digit">0</div>
                        <div id="digit_2" class="digit">0</div>
                        <div id="digit_1" class="digit">0</div>
                        <div id="digit_0" class="digit">0</div>
                     </div>

                </div>

            <p style="text-align: center; width:100%; font-weight:600;"><a href="http://www.inkfood.com/">inkfood.com</a></p>

              <?php
               wp_enqueue_script( 'example_widget', plugins_url('/widget_shuffl/mini_shuffl/script.js' ));
        echo $after_widget; ?>
        <?php
        
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance[ 'repeatBG' ] = $new_instance[ 'repeatBG' ];
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
        
         wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'example_widget', plugins_url('/widget_shuffl/mini_shuffl/media.js' ));
        wp_enqueue_media();
 
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input id="title" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Sub title'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>

   <p>
      <label for="<?php echo $this->get_field_id( 'image' ); ?>">Select background:</label>
      <input  id="testInput" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden" value="<?php echo esc_url( $image ); ?>" />
       <img width="100%" src="<?php echo esc_url( $image ); ?>"/>
      <button class="upload_image_button button button-primary">Select Image</button>
   </p>

    <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'repeatBG' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'repeatBG' ); ?>" name="<?php echo $this->get_field_name( 'repeatBG' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'repeatBG' ); ?>">Repeat background</label>
    </p>
        
        <?php 
    }
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("example_widget");'));