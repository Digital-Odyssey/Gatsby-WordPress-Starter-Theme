<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');

		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_attr__('Global Options', 'gatsby-starter' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'archivePageHeroImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'archivePageHeroImage', 
			array(
				'label'    => esc_attr__('Archive Template Hero Banner', 'gatsby-starter' ),
				'section'  => 'global_options',
				'settings' => 'archivePageHeroImage',
				'description' => esc_attr__('Upload a custom image for the archive template hero.', 'gatsby-starter' ),
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'tagPageHeroImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'tagPageHeroImage', 
			array(
				'label'    => esc_attr__('Tag Template Hero Banner', 'gatsby-starter' ),
				'section'  => 'global_options',
				'settings' => 'tagPageHeroImage',
				'description' => esc_attr__('Upload a custom image for the tag template hero.', 'gatsby-starter' ),
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'blogPageHeroImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'blogPageHeroImage', 
			array(
				'label'    => esc_attr__('Blog Template Hero Banner', 'gatsby-starter' ),
				'section'  => 'global_options',
				'settings' => 'blogPageHeroImage',
				'description' => esc_attr__('Upload a custom image for the blog template hero.', 'gatsby-starter' ),
				'priority' => 1,
				) 
			) 
        );
		
		
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_attr__('Footer Options', 'gatsby-starter' ),
			'priority' => 70,
		));
			
		//Images
		$wp_customize->add_setting( 'footerLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerLogo', 
			array(
				'label'    => esc_attr__('Footer Logo', 'gatsby-starter' ),
				'section'  => 'footer_options',
				'settings' => 'footerLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_attr__('Fat Footer Background Image', 'gatsby-starter' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 2,
				) 
			) 
		);

			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => esc_attr__('Fat Footer', 'gatsby-starter'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'gatsby-starter' ),
				'off'  => esc_attr__('OFF', 'gatsby-starter' ),
			),
		));
		
		$wp_customize->add_setting('displayFooterLogo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayFooterLogo', array(
			'label'      => esc_attr__('Display Footer Logo?', 'gatsby-starter'),
			'section'    => 'footer_options',
			'settings'   => 'displayFooterLogo',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'gatsby-starter' ),
				'off'  => esc_attr__('OFF', 'gatsby-starter' ),
			),
		));
		
		$wp_customize->add_setting('displayCopyright', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayCopyright', array(
			'label'      => esc_attr__('Display Copyright?', 'gatsby-starter'),
			'section'    => 'footer_options',
			'settings'   => 'displayCopyright',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		//Textfields
		$wp_customize->add_setting(
			'copyrightInfo', array(
				'default' => 'Gatsby WP Starter by Pulsar Media.',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'copyrightInfo', array(
			'label'   => esc_attr__('Copyright info', 'gatsby-starter' ),
			'section' => 'footer_options',
			'settings' => 'copyrightInfo',
			'type'    => 'text',
			'priority' => 8,
		) );

		
		$FooterColors = array();

		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#191B27',
			'label' => esc_attr__('Fat Footer Background Color', 'gatsby-starter')
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Footer Background Color', 'gatsby-starter')
		);

		
		foreach( $FooterColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'footer_options',
					'settings' => $color['slug'])
				)
			);
			
			
		}//end of foreach
		
		
		
        
   }//end of function
     
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
                
                <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                    <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
                <?php } ?>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>