<?php
/**
 * Blogmatic Customizer
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogmatic_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = '2f338d';
	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'blogmatic-pro' );
	$wp_customize->get_section( 'header_image' )->panel = 'blogmatic_theme_header_panel';
	$wp_customize->get_section( 'background_image' )->priority = 90;
    $wp_customize->remove_control( 'background_color' );

	$wp_customize->register_control_type( 'Blogmatic_WP_Editor_Control' );

	require get_template_directory() . '/inc/customizer/custom-controls/editor-control/editor-control.php'; // editor-control
	require get_template_directory() . '/inc/customizer/custom-controls/repeater/repeater.php'; // repeater
	require get_template_directory() . '/inc/customizer/custom-controls/redirect-control/redirect-control.php'; // redirect-control
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading/section-heading.php'; // section-heading
	require get_template_directory() . '/inc/customizer/base.php'; // base
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading-toggle/section-heading-toggle.php'; // section-heading-toggle
	require get_template_directory() . '/inc/customizer/custom-controls/icon-picker/icon-picker.php'; // icon picker
	require get_template_directory() . '/inc/customizer/custom-controls/builder/builder.php'; // builder
	require get_template_directory() . '/inc/customizer/custom-controls/responsive-builder/responsive-builder.php'; // responsive-builder

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => 'header .site-title a',
				'render_callback' => 'blogmatic_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogmatic_customize_partial_blogdescription',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription_option',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogmatic_customize_partial_blogdescription',
			)
		);
	}

	//section tab control = renders section tab control
	class Blogmatic_WP_Section_Tab_Control extends Blogmatic_WP_Base_Control {
		//control type
		public $type = 'section-tab';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['choices'] = $this->choices;
		}
	}

	// tab group control
	class Blogmatic_WP_Default_Color_Control extends WP_Customize_Color_Control {
		/**
		 * Additional variable
		 */
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) :
				$this->json['tab'] = $this->tab;
			endif;
		}
	}

	// Typography Control
	class Blogmatic_WP_Typography_Control extends Blogmatic_WP_Base_Control {
		//control type
		public $type = 'typography';
		public $fields;

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json(){
			parent::to_json();
			$this->json['fields'] = $this->fields;
		}
	}

	// Toggle Control
	class Blogmatic_WP_Toggle_Control extends Blogmatic_WP_Base_Control {
		//conrol type
		public $type = 'toggle-button';
	}

	 // simple toggle control 
	 class Blogmatic_WP_Simple_Toggle_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'simple-toggle';
    }

	class Blogmatic_WP_Spacing_Control extends Blogmatic_WP_Base_Control {
		/**
		 * List of controls for this theme
		* 
		* @since 1.0.0
		*/
		protected $type_array = [];
		public $type = 'spacing';
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template.
		* 
		* @since 1.0.0
		* @access public
		* @return void
		*/
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) $this->json['tab'] = $this->tab;
			if( $this->input_attrs ) $this->json['input_attrs'] = $this->input_attrs;
		}
	}

	// Radio Tab Control
	class Blogmatic_WP_Radio_Tab_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'radio-tab';
		public $double_line = false;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['double_line'] = $this->double_line;
        }
	}

	// Responsive Radio Tab Control
	class Blogmatic_WP_Responsive_Radio_Tab_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'responsive-radio-tab';
		public $double_line = false;
		public $responsive = true;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['double_line'] = $this->double_line;
            $this->json['responsive'] = $this->responsive;
        }
	}

	// info box control
    class Blogmatic_WP_Info_Box_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'info-box';
        
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	// Border Control
	class Blogmatic_WP_Border_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'border';

		public $input_attrs = [
			'max'	=>	100,
			'min'	=>	0,
			'step'	=>	1,
			'reset'	=>	true
		];

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['input_attrs'] = $this->input_attrs;
        }
	}

	// Box Shadow Control
	class Blogmatic_WP_Box_Shadow_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'box-shadow';
	}

    // item sortable control 
    class Blogmatic_WP_Item_Sortable_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'item-sortable';
        public $fields;

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['fields'] = $this->fields;
        }
    }

    // number control
    class Blogmatic_WP_Number_Range_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'number-range';
        public $fields;
        public $responsive = false;
		public $tab = 'general';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['fields'] = $this->fields;
            $this->json['responsive'] = $this->responsive;
            $this->json['input_attrs'] = $this->input_attrs;
        }
    }

    // social share control
    class Blogmatic_WP_Social_Share_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'social-share';
        public $fields;
		public $tab = 'general';
		public $library;
		public $color_genre = [ 'solid' ];
		public $background_genre = [ 'solid', 'gradient' ];
		public $to_include = [ 'icon_picker', 'color', 'background' ];
		public $icon_picker_genre = [ 'none', 'picker' ];
		public $color_hover = false;
		public $background_hover = false;

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['fields'] = $this->fields;
			if( $this->library ) $this->json['library'] = $this->library;
			if( $this->color_genre ) $this->json['color_genre'] = $this->color_genre;
			if( $this->background_genre ) $this->json['background_genre'] = $this->background_genre;
			if( $this->to_include ) $this->json['to_include'] = $this->to_include;
			if( $this->icon_picker_genre ) $this->json['icon_picker_genre'] = $this->icon_picker_genre;
			if( $this->color_hover ) $this->json['color_hover'] = $this->color_hover;
			if( $this->background_hover ) $this->json['background_hover'] = $this->background_hover;
        }
    }

    // color preset Control
	class Blogmatic_WP_Preset_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'preset';

		/**
		 * choose between solid or gradient
		 * 
		 * @since 1.0.0
		 * @package Blogmatic Pro
		 * @uses solid || gardient
		 */
		public $blend = 'solid';

		
		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['blend'] = $this->blend;
        }
	}

    // color Control
	class Blogmatic_WP_Color_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'color-field';
		public $involve = [ 'solid' ];
		public $hover = false;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['involve'] = $this->involve;
            $this->json['hover'] = $this->hover;
        }
	}

    // multiselect control
    class Blogmatic_WP_Post_Multiselect_Control extends Blogmatic_WP_Base_control {
        // control type
        public $type = 'async-multiselect';
        public $endpoint = 'extend/get_posts';
        public $purpose = 'posts';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['endpoint'] = $this->endpoint;
            $this->json['purpose'] = $this->purpose;
        }
    }

    // multiselect control
    class Blogmatic_WP_Multiselect_Control extends Blogmatic_WP_Base_control {
        // control type
        public $type = 'multiselect-normal';
        public $choices = [];

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	// typography preset Control
	class Blogmatic_WP_Typography_Preset_Control extends Blogmatic_WP_Base_Control {
		// control type
		public $type = 'typography-preset';
	}

	// preset color picker control
    class Blogmatic_WP_Theme_Color_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'theme-color';
        public $variable;
		public $involve = 'solid';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->variable ) {
                $this->json['variable'] = $this->variable;
                $this->json['involve'] = $this->involve;
            }
        }
    }

	// Divider Control
	class Blogmatic_WP_Divider_Control extends Blogmatic_WP_Base_Control {
		// control type
        public $type = 'divider';
		private static $count = 0;
		public function __construct( $manager, $id, $params ) {
			parent::__construct( $manager, $id, $params );
			self::$count++;
			if( $this->id === '' ) $this->id = 'spacing_' . self::$count;
		}

		/**
		 * Main content to render
		 * 
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
				<div class="<?php echo esc_attr( $this->identifier_id() ); ?>" data-setting="<?php if( isset( $this->setting->id ) ) echo esc_attr( $this->setting->id ); ?>">
					<div class="field-main"></div>
				</div>
			<?php
		}
	}

	// Radio Image
	class Blogmatic_WP_Radio_Image_Control extends Blogmatic_WP_Base_Control {
		// control type
        public $type = 'radio-image';
		public $tab = 'general';
		public $choices = [];
		public $custom_callback = [];

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
            if( $this->tab ) {
                $this->json['tab'] = $this->tab;
            }
            $this->json['custom_callback'] = $this->custom_callback;
        }
	}

	// Builder Reflector
	class Blogmatic_WP_Builder_Reflector_Control extends Blogmatic_WP_Base_Control {
		// control type
        public $type = 'builder-reflector';
        public $placement = 'header';
        public $row = 1;
        public $builder;
        public $responsive;
        public $responsive_builder_id;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['placement'] = $this->placement;
            $this->json['row'] = $this->row;
            $this->json['builder'] = $this->builder;
            $this->json['responsive'] = $this->responsive;
            $this->json['responsive'] = $this->responsive;
            $this->json['responsive_builder_id'] = $this->responsive_builder_id;
        }
	}

	// Responsive Radio Image
	class Blogmatic_WP_Responsive_Radio_Image extends Blogmatic_WP_Base_Control {
		// control type
        public $type = 'responsive-radio-image';
		public $choices = [];
		public $has_callback = true;
		public $row = 1;
		public $builder = 'header';

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
			$this->json['choices'] = $this->choices;
			$this->json['has_callback'] = $this->has_callback;
			$this->json['row'] = $this->row;
			$this->json['builder'] = $this->builder;
        }
	}
}
add_action( 'customize_register', 'blogmatic_customize_register' );

add_filter( BLOGMATIC_PREFIX . 'unique_identifier', function($identifier) {
    $bc_delimeter = '-';
    $bc_prefix = 'customize';
    $bc_sufix = 'control';
    $identifier_id = [$bc_prefix,$identifier,$bc_sufix];
    return implode($bc_delimeter,$identifier_id);
});

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogmatic_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogmatic_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogmatic_customize_preview_js() {
	wp_enqueue_script( 'blogmatic-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), BLOGMATIC_VERSION, true );
}
add_action( 'customize_preview_init', 'blogmatic_customize_preview_js' );

// Get list of image sizes
function blogmatic_get_image_sizes_option_array_for_customizer() {
	$sizes_lists = [];
	$images_sizes = get_intermediate_image_sizes();
	if( $images_sizes ) {
		foreach( $images_sizes as $size ) {
			$sizes_lists[$size] = $size;
		}
	}
	return $sizes_lists;
}

require get_template_directory() . '/inc/customizer/handlers.php';
require get_template_directory() . '/inc/customizer/helpers.php';
require get_template_directory() . '/inc/customizer/render.php';
require get_template_directory() . '/inc/customizer/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/selective-refresh.php';