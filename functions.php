<?php
// Custom functions go here

add_action( 'wp_enqueue_scripts', 'el_kampagne_enqueue_styles' );
function el_kampagne_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );
  wp_enqueue_style( 'zerif-child-style', get_stylesheet_uri(), array('zerif_style'), 'v1' );
}

/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function el_kampagne_setup() {
    load_child_theme_textdomain( 'el-kampagne', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'el_kampagne_setup' );

/**
 * Customizing Customizer
 *
 * Add extra fields to theme customizer.
 * Adjust widgets.
 */
function el_kampagne_customizer( $wp_customize ) {
  $wp_customize->add_setting( 'el_kampagne_socials_website', array('sanitize_callback' => 'esc_url_raw','default' => '#'));
  
  $wp_customize->add_control(
    'el_kampagne_socials_website',
    array(
      'label' => __( 'Website link', 'el-kampagne' ),
      'section' => 'zerif_general_section',
      'settings' => 'el_kampagne_socials_website',
      'priority' => 8,
      'type' => 'text'
    )
  );

}
add_action( 'customize_register', 'el_kampagne_customizer' );

add_action('widgets_init', 'el_kampagne_register_widgets');

function el_kampagne_register_widgets() {
    unregister_widget('zerif_team_widget');
    register_widget('el_kampagne_team_widget');
}

/****************************/

/****** team member widget **/

/***************************/


class el_kampagne_team_widget extends WP_Widget
{


    function el_kampagne_team_widget()
    {

        $widget_ops = array('classname' => 'zerif_team');

        $this->WP_Widget('el_kampagne_team-widget', 'EL kampagne - Team member widget', $widget_ops);

    }


    function widget($args, $instance)
    {

        extract($args);


        echo $before_widget;

        ?>



        <div class="col-lg-3 col-sm-3 team-box">


            <div class="team-member">

        <?php if( !empty($instance['image_uri']) ): ?>
        
          <figure class="profile-pic">


            <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="">


          </figure>
        
        <?php endif; ?>


                <div class="member-details">

          <?php if( !empty($instance['name']) ): ?>
          
            <h5 class="dark-text red-border-bottom"><?php echo apply_filters('widget_title', $instance['name']); ?></h5>
            
          <?php endif; ?> 

          <?php if( !empty($instance['position']) ): ?>
          
            <div class="position"><?php echo apply_filters('widget_title', $instance['position']); ?></div>
        
          <?php endif; ?>

                </div>


                <div class="social-icons">


                    <ul>


                        <?php if ( !empty($instance['fb_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['fb_link']); ?>"><i
                                        class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>

                        <?php if ( !empty($instance['tw_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['tw_link']); ?>"><i
                                        class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>

                        <?php if ( !empty($instance['bh_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['bh_link']); ?>"><i
                                        class="fa fa-behance"></i></a></li>
                        <?php endif; ?>

                        <?php if ( !empty($instance['db_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['db_link']); ?>"><i
                                        class="fa fa-dribbble"></i></a></li>
                        <?php endif; ?>
            
                        <?php if ( !empty($instance['ln_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['ln_link']); ?>"><i
                                        class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?>
            
                        <?php if ( !empty($instance['ws_link']) ): ?>
                            <li><a href="<?php echo apply_filters('widget_title', $instance['ws_link']); ?>"><i
                                        class="fa fa-globe"></i></a></li>
                        <?php endif; ?>


                    </ul>


                </div>


        <?php if( !empty($instance['description']) ): ?>
                <div class="details">


                    <?php echo apply_filters('widget_title', $instance['description']); ?>


                </div>
        <?php endif; ?>


            </div>


        </div>



        <?php

        echo $after_widget;


    }


    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['name'] = strip_tags($new_instance['name']);

        $instance['position'] = strip_tags($new_instance['position']);

        $instance['description'] = strip_tags($new_instance['description']);

        $instance['fb_link'] = strip_tags($new_instance['fb_link']);

        $instance['tw_link'] = strip_tags($new_instance['tw_link']);

        $instance['bh_link'] = strip_tags($new_instance['bh_link']);

        $instance['db_link'] = strip_tags($new_instance['db_link']);
    
        $instance['ln_link'] = strip_tags($new_instance['ln_link']);

        $instance['ws_link'] = strip_tags($new_instance['ws_link']);

        $instance['image_uri'] = strip_tags($new_instance['image_uri']);

        return $instance;

    }


    function form($instance)
    {

        ?>



        <p>

            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('name'); ?>"
                   id="<?php echo $this->get_field_id('name'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>"
                   class="widefat"/>

        </p>



        <p>

            <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('position'); ?>"
                   id="<?php echo $this->get_field_id('position'); ?>" value="<?php if( !empty($instance['position']) ): echo $instance['position']; endif; ?>"
                   class="widefat"/>

        </p>



        <p>

            <label
                for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('description'); ?>"
                   id="<?php echo $this->get_field_id('description'); ?>"
                   value="<?php if( !empty($instance['description']) ): echo $instance['description']; endif; ?>" class="widefat"/>

        </p>



        <p>

            <label
                for="<?php echo $this->get_field_id('fb_link'); ?>"><?php _e('Facebook link', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('fb_link'); ?>"
                   id="<?php echo $this->get_field_id('fb_link'); ?>" value="<?php if( !empty($instance['fb_link']) ): echo $instance['fb_link']; endif; ?>"
                   class="widefat"/>

        </p>



        <p>

            <label
                for="<?php echo $this->get_field_id('tw_link'); ?>"><?php _e('Twitter link', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('tw_link'); ?>"
                   id="<?php echo $this->get_field_id('tw_link'); ?>" value="<?php if( !empty($instance['tw_link']) ): echo $instance['tw_link']; endif; ?>"
                   class="widefat"/>

        </p>



        <p>

            <label
                for="<?php echo $this->get_field_id('bh_link'); ?>"><?php _e('Behance link', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('bh_link'); ?>"
                   id="<?php echo $this->get_field_id('bh_link'); ?>" value="<?php if( !empty($instance['bh_link']) ): echo $instance['bh_link']; endif; ?>"
                   class="widefat"/>

        </p>



        <p>

            <label
                for="<?php echo $this->get_field_id('db_link'); ?>"><?php _e('Dribble link', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('db_link'); ?>"
                   id="<?php echo $this->get_field_id('db_link'); ?>" value="<?php if( !empty($instance['db_link']) ): echo $instance['db_link']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>

            <label
                for="<?php echo $this->get_field_id('ln_link'); ?>"><?php _e('Linkedin link', 'zerif-lite'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('ln_link'); ?>"
                   id="<?php echo $this->get_field_id('ln_link'); ?>" value="<?php if( !empty($instance['ln_link']) ): echo $instance['ln_link']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>

            <label
                for="<?php echo $this->get_field_id('ws_link'); ?>"><?php _e('Website link', 'el-kampagne'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('ws_link'); ?>"
                   id="<?php echo $this->get_field_id('ws_link'); ?>" value="<?php if( !empty($instance['ws_link']) ): echo $instance['ws_link']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>

            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image', 'zerif-lite'); ?></label><br/>



            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

            ?>



            <input type="text" class="widefat custom_media_url_team"
                   name="<?php echo $this->get_field_name('image_uri'); ?>"
                   id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>"
                   style="margin-top:5px;">


            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_clients"
                   name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image','zerif-lite'); ?>"
                   style="margin-top:5px;"/>

        </p>



    <?php

    }

}


