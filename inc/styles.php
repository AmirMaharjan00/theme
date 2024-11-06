<?php
/**
 * Includes the inline css
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if( ! function_exists( 'blogmatic_assign_preset_var' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_assign_preset_var( $selector, $control) {
         $decoded_control =  BMC\blogmatic_get_customizer_option( $control );
         if( ! $decoded_control ) return;
         echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Value change single
if( ! function_exists( 'blogmatic_value_change' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_value_change ( $selector, $control, $property ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      echo $selector . "{ ".esc_html( $property ) ." : ".esc_html($decoded_control) .  "px; }";
   }
endif;

// Value change with responsive
if( ! function_exists( 'blogmatic_value_change_responsive' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_value_change_responsive ( $selector, $control, $property, $unit = 'px' ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      // if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
            echo $selector . "{ " . esc_html( $property ). ": ".esc_html( $desktop . $unit ) . "; }";
         endif;
         if( isset( $decoded_control['tablet'] ) ) :
            $tablet = $decoded_control['tablet'];
            echo "@media(max-width: 940px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $tablet . $unit ).  "; } }\n";
         endif;
         if( isset( $decoded_control['smartphone'] ) ) :
            $smartphone = $decoded_control['smartphone'];
            echo "@media(max-width: 610px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $smartphone . $unit ).  "; } }\n";
      endif;
   }
endif;

// Value change with responsive percentage
if( ! function_exists( 'blogmatic_value_change_responsive_percentage' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_value_change_responsive_percentage ( $selector, $control, $property ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ " . esc_html( $property ). ": ".esc_html( $desktop ).  "%; }";
      endif;
      if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $tablet ).  "%; } }\n";
      endif;
      if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html($smartphone).  "%; } }\n";
      endif;
   }
endif;

// Variable change with responsive
if( ! function_exists( 'blogmatic_assign_preset_var_responsive' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_assign_preset_var_responsive( $selector, $control) {
         $decoded_control =  BMC\blogmatic_get_customizer_option( $control );
         if( ! $decoded_control ) return;
         echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Typography
if( ! function_exists( 'blogmatic_get_typo_style' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_get_typo_style( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $value = blogmatic_get_typography_format( $decoded_control );
      blogmatic_generate_typography_css_variable( $value, $selector );
   }
endif;

// Typography Value
if( ! function_exists( 'blogmatic_get_typo_style_value' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_get_typo_style_value( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $value = blogmatic_get_typography_format( $decoded_control );
      if( isset( $value['font_family'] ) ) :
         echo ".blogmatic_font_typography ".$selector. "{ font-family : " .esc_html( $value['font_family']['value'] ).  "; }\n";
      endif;

      if( isset( $value['font_weight'] ) ) :
         echo ".blogmatic_font_typography ".$selector."{ font-weight : " .esc_html( $value['font_weight']['value'] ).  "; font-style : ". esc_html( $value['font_weight']['variant'] ) ." }\n";
      endif;

      if( isset( $value['text_transform'] ) ) :
         echo ".blogmatic_font_typography ".$selector."{ text-transform : " .esc_html( $value['text_transform'] ).  "; }\n";
      endif;

      if( isset( $value['text_decoration'] ) ) :
         echo ".blogmatic_font_typography ".$selector."{ text-decoration : " .esc_html( $value['text_decoration'] ).  "; }\n";
      endif;

      if( isset( $value['font_size'] ) ) :
         if( isset( $value['font_size']['desktop'] ) ) echo ".blogmatic_font_typography ".$selector." { font-size : " .absint( $value['font_size']['desktop'] ).  "px; }\n";
         if( isset( $value['font_size']['tablet'] ) ) echo "@media(max-width: 940px) { .blogmatic_font_typography " .$selector . "{ font-size : " .absint( $value['font_size']['tablet'] ).  "px; } }\n";
         if( isset( $value['font_size']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogmatic_font_typography " .$selector . "{ font-size : " .absint( $value['font_size']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $value['line_height'] ) ) :
         if( isset( $value['line_height']['desktop'] ) ) echo ".blogmatic_font_typography ".$selector." { line-height : " .absint( $value['line_height']['desktop'] ).  "px; }\n";
         if( isset( $value['line_height']['tablet'] ) ) echo "@media(max-width: 940px) { .blogmatic_font_typography " .$selector . "{ line-height : " .absint( $value['line_height']['tablet'] ).  "px; } }\n";
         if( isset( $value['line_height']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogmatic_font_typography " .$selector . "{ line-height : " .absint( $value['line_height']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $value['letter_spacing'] ) ) :
         if( isset( $value['letter_spacing']['desktop'] ) ) echo ".blogmatic_font_typography ".$selector." { letter-spacing : " .$value['letter_spacing']['desktop'] .  "px; }\n";
         if( isset( $value['letter_spacing']['tablet'] ) ) echo "@media(max-width: 940px) { .blogmatic_font_typography " .$selector . "{ letter-spacing : " . $value['letter_spacing']['tablet'] .  "px; } }\n";
         if( isset( $value['letter_spacing']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogmatic_font_typography " .$selector . "{ letter-spacing : " . $value['letter_spacing']['smartphone'] .  "px; } }\n";
      endif;
   }
endif;

// Typography Value Body
if( ! function_exists( 'blogmatic_get_typo_style_body_value' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_get_typo_style_body_value( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $value = blogmatic_get_typography_format( $decoded_control );
      if( isset( $value['font_family'] ) ) :
         echo $selector. "{ font-family : " .esc_html( $value['font_family']['value'] ).  "; }\n";
      endif;

      if( isset( $value['font_weight'] ) ) :
         echo $selector."{ font-weight : " .esc_html( $value['font_weight']['value'] ).  "; font-style : ". esc_html( $value['font_weight']['variant'] ) ."}\n";
      endif;

      if( isset( $value['text_transform'] ) ) :
         echo $selector."{ text-transform : " .esc_html( $value['text_transform'] ).  "; }\n";
      endif;

      if( isset( $value['text_decoration'] ) ) :
         echo $selector."{ text-decoration : " .esc_html( $value['text_decoration'] ).  "; }\n";
      endif;

      if( isset( $value['font_size'] ) ) :
         if( isset( $value['font_size']['desktop'] ) ) echo $selector." { font-size : " .absint( $value['font_size']['desktop'] ).  "px; }\n";
         if( isset( $value['font_size']['tablet'] ) ) echo "@media(max-width: 940px) { ".$selector . "{ font-size : " .absint( $value['font_size']['tablet'] ).  "px; } }\n";
         if( isset( $value['font_size']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogmatic_font_typography " .$selector . "{ font-size : " .absint( $value['font_size']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $value['line_height'] ) ) :
         if( isset( $value['line_height']['desktop'] ) ) echo $selector." { line-height : " .absint( $value['line_height']['desktop'] ).  "px; }\n";
         if( isset( $value['line_height']['tablet'] ) ) echo "@media(max-width: 940px) { " .$selector . "{ line-height : " .absint( $value['line_height']['tablet'] ).  "px; } }\n";
         if( isset( $value['line_height']['smartphone'] ) ) echo "@media(max-width: 610px) { " .$selector . "{ line-height : " .absint( $value['line_height']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $value['letter_spacing'] ) ) :
         if( isset( $value['letter_spacing']['desktop'] ) ) echo $selector." { letter-spacing : " . $value['letter_spacing']['desktop'].  "px; }\n";
         if( isset( $value['letter_spacing']['tablet'] ) ) echo "@media(max-width: 940px) { " .$selector . "{ letter-spacing : " . $value['letter_spacing']['tablet'] .  "px; } }\n";
         if( isset( $value['letter_spacing']['smartphone'] ) ) echo "@media(max-width: 610px) { " .$selector . "{ letter-spacing : " . $value['letter_spacing']['smartphone'] .  "px; } }\n";
      endif;
   }
endif;

// Assign Variable
if( ! function_exists( 'blogmatic_assign_var' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_assign_var( $selector, $control) {
      $decoded_control =  BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Text Color ( Variable Change Single )
if( ! function_exists( 'blogmatic_variable_color_single' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_variable_color_single( $selector, $control) {
      $decoded_control =  BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $type = $decoded_control['type'];
      echo "body  { " . $selector . ": ".blogmatic_get_color_format( $decoded_control[ $type ]).  ";}";
   }
endif;

// Text Color ( Variable Change )
if( ! function_exists( 'blogmatic_variable_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_variable_color( $selector, $control) {
      $decoded_control =  BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['initial'] ) ) :
         $initial = $decoded_control['initial'];
         echo "body  { " . $selector . ": ".blogmatic_get_color_format( $initial[ $initial['type'] ] ).  ";}";
      endif;
      if( isset( $decoded_control['hover'] ) ) :
         $hover = $decoded_control['hover'];
         echo "body  { " . $selector . "-hover : ".blogmatic_get_color_format( $hover[ $hover['type'] ] ).  "; }";
      endif;
   }
endif;

// Color Group ( Variable Change )
if( ! function_exists( 'blogmatic_variable_bk_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_variable_bk_color( $selector, $control, $var = '' ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if(isset($decoded_control['initial'] )):
         if( isset( $decoded_control['initial']['type'] ) ) :
            $type = $decoded_control['initial']['type'];
            if( isset( $decoded_control['initial'][$type] ) ) echo "body { ".$selector.": " .blogmatic_get_color_format( $decoded_control['initial'][$type] ). "}\n";
         endif;
      endif;

      if(isset($decoded_control['hover'])):
         if( isset( $decoded_control['hover']['type'] ) ) :
            $type = $decoded_control['hover']['type'];
            if( isset( $decoded_control['hover'][$type] ) ) echo "body { ".$selector."-hover: " .blogmatic_get_color_format( $decoded_control['hover'][$type] ). "}\n";
         endif;
      endif;
   }
endif;

// Category colors
if( ! function_exists( 'blogmatic_category_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
    * MARK: Category
   *
   * @package Blogmatic Pro
   * @since 1.0.0
   */
   function blogmatic_category_bk_colors_styles() {
      $totalCats = get_categories();
      if( $totalCats ) :
         foreach( $totalCats as $singleCat ) :
            $category_color = BMC\blogmatic_get_customizer_option( 'category_' .absint($singleCat->term_id). '_color' );

            if(isset($category_color['initial'] )):
               if( isset( $category_color['initial']['type'] ) ) :
                  $type = $category_color['initial']['type'];
                  if( isset( $category_color['initial'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a{ color : " .blogmatic_get_color_format( $category_color['initial'][$type] ). "} \n";
                     echo "body.archive.category.category-" . absint($singleCat->term_id) . " { color : " .blogmatic_get_color_format( $category_color['initial'][$type] ). "} \n";
                  }
               endif;
            endif;

            if(isset($category_color['hover'] )):
               if( isset( $category_color['hover']['type'] ) ) :
                  $type = $category_color['hover']['type'];
                  if( isset( $category_color['hover'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a:hover { color : " .blogmatic_get_color_format( $category_color['hover'][$type] ). "} \n";
                     echo "body.archive.category.category-" . absint($singleCat->term_id) . ":hover { color : " .blogmatic_get_color_format( $category_color['hover'][$type] ). "} \n";
                  }
               endif;
            endif;

            $category_color_bk = BMC\blogmatic_get_customizer_option( 'category_background_' .absint($singleCat->term_id). '_color' );
            if(isset($category_color_bk['initial'] )):
               if( isset( $category_color_bk['initial']['type'] ) ) :
                  $type = $category_color_bk['initial']['type'];
                  if( isset( $category_color_bk['initial'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a{ background : " .blogmatic_get_color_format( $category_color_bk['initial'][$type]   ). "} \n";
                     echo "body.archive.category.category-". absint($singleCat->term_id) . " .archive-title i { color : " .blogmatic_get_color_format( $category_color_bk['initial'][$type]   ). "}\n";
                  }
               endif;
            endif;

            if(isset($category_color_bk['hover'] )) :
               if( isset( $category_color_bk['hover']['type'] ) ) :
                  $type = $category_color_bk['hover']['type'];
                  if( isset( $category_color_bk['hover'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a:hover{ background : " .blogmatic_get_color_format( $category_color_bk['hover'][$type] ). "} \n";
                  }
               endif;
            endif;
         endforeach;
      endif;
   }
endif;

// tags colors
if( ! function_exists( 'blogmatic_tags_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blogmatic Pro
   * @since 1.0.0
   */
   function blogmatic_tags_bk_colors_styles() {
      $totalTags = get_tags();
      if( $totalTags ) :
         foreach( $totalTags as $singleTag ) :
            $tag_color = BMC\blogmatic_get_customizer_option( 'tag_' .absint($singleTag->term_id). '_color' );

            if(isset($tag_color['initial'] )):
               if( isset( $tag_color['initial']['type'] ) ) :
                  $type = $tag_color['initial']['type'];
                  if( isset( $tag_color['initial'][$type] ) ) {
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . " span{ color : " .blogmatic_get_color_format( $tag_color['initial'][$type] ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " { color : " .blogmatic_get_color_format( $tag_color['initial'][$type] ). "} \n";
                  }
               endif;
            endif;

            if(isset($tag_color['hover'] )):
               if( isset( $tag_color['hover']['type'] ) ) :
                  $type = $tag_color['hover']['type'];
                  if( isset( $tag_color['hover'][$type] ) ) {
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . ":hover span { color : " .blogmatic_get_color_format( $tag_color['hover'][$type] ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . ":hover { color : " .blogmatic_get_color_format( $tag_color['hover'][$type] ). "} \n";
                  }
               endif;
            endif;

            $tag_color_bk = BMC\blogmatic_get_customizer_option( 'tag_background_' .absint($singleTag->term_id). '_color' );
            if(isset($tag_color_bk['initial'] )) :
               if( isset( $tag_color_bk['initial']['type'] ) ) :
                  $type = $tag_color_bk['initial']['type'];
                  if( isset( $tag_color_bk['initial'][$type] ) ){
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . "{ background : " .blogmatic_get_color_format( $tag_color_bk['initial'][$type]   ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " { background : " .blogmatic_get_color_format( $tag_color_bk['initial'][$type]   ). "} \n";
                  }
               endif;
            endif;

            if(isset($tag_color_bk['hover'] )) :
               if( isset( $tag_color_bk['hover']['type'] ) ) :
                  $type = $tag_color_bk['hover']['type'];
                  if( isset( $tag_color_bk['hover'][$type] ) ) {
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . ":hover { background : " .blogmatic_get_color_format( $tag_color_bk['hover'][$type] ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . "{ background : " .blogmatic_get_color_format( $tag_color_bk['hover'][$type]   ). "} \n";
                  }
               endif;
            endif;
         endforeach;
      endif;
   }
endif;


// Social Share colors
if( ! function_exists( 'blogmatic_social_share_styles' ) ) :
   /**
    * Generates css code for font size
    * MARK: Social Shares
   *
   * @package Blogmatic Pro
   * @since 1.0.0
   */
   function blogmatic_social_share_styles() {
      $social_share_repeater = BMC\blogmatic_get_customizer_option( 'social_share_repeater' );
      if( is_array( $social_share_repeater ) && ! empty( $social_share_repeater ) ) :
         foreach( $social_share_repeater as $index => $social_share ) :
            if( array_key_exists( 'color', $social_share ) && array_key_exists( 'background', $social_share ) ) :
               $color = $social_share['color'];
               $background = $social_share['background'];
               /* COLOR */
               if( array_key_exists( 'initial', $color ) ):
                  extract( $color );
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' i { color: '. blogmatic_get_color_format( $initial[ $initial['type'] ] ) .' }';
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' a:hover i { color: '. blogmatic_get_color_format( $hover[ $hover['type'] ] ) .' }';
               else:
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' i { color: '. blogmatic_get_color_format( $color[ $color['type'] ] ) .' }';
               endif;
               /* BACKGROUND */
               if( array_key_exists( 'initial', $background ) ) :
                  extract( $background );
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' a i { background: '. blogmatic_get_color_format( $initial[ $initial['type'] ] ) .' }';
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' a:hover i { background: '. blogmatic_get_color_format( $hover[ $hover['type'] ] ) .' }';
               else:
                  echo 'body .blogmatic-social-share .social-share.social-item--' . absint( $index + 1 ) . ' a i { background: '. blogmatic_get_color_format( $background[ $background['type'] ] ) .' }';
               endif;
            endif;
         endforeach;
      endif;
   }
endif;

// Border Options
if( ! function_exists( 'blogmatic_border_option' ) ) :
   /**
   * Generate css code for Top header Text Color
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_border_option( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['type'] ) || isset( $decoded_control['width'] ) || isset( $decoded_control['color'] ) ) :
         $css = $selector . "{\n";
         $css .= "border-color: ". blogmatic_get_color_format($decoded_control['color']) . ";\n";
         $css .= "border-style: ". $decoded_control['type'] .";\n";
         $width = $decoded_control['width'];
         $css .= "border-width: ". $width['top'] . 'px ' . $width['right'] . 'px '. $width['bottom'] . 'px '. $width['left'] . 'px;'. "}";
         echo $css;
      endif;
   }
endif;

// Box Shadow
if( ! function_exists( 'blogmatic_box_shadow_styles' ) ) :
   /**
    * Generates css code for block box shadow size
    *
    * @package Blogmatic Pro
    * @since 1.0.0
    */
   function blogmatic_box_shadow_styles( $selector, $value ) {
      $blogmatic_box_shadow = BMC\blogmatic_get_customizer_option( $value );
      if( $blogmatic_box_shadow['option'] == '' ) :
         echo $selector."{ box-shadow: 0px 0px 0px 0px; }\n";
      else:
         if( $blogmatic_box_shadow['type'] == 'outset') $blogmatic_box_shadow['type'] = '';
         echo $selector."{ box-shadow : ".esc_html( $blogmatic_box_shadow['type'] ) ." ".esc_html( $blogmatic_box_shadow['hoffset'] ).  "px ". esc_html( $blogmatic_box_shadow['voffset'] ). "px ".esc_html( $blogmatic_box_shadow['blur'] ).  "px ".esc_html( $blogmatic_box_shadow['spread'] ).  "px ".blogmatic_get_color_format( $blogmatic_box_shadow['color'] ).  ";
         }\n";
      endif;
   }
endif;

// Image ratio change
if( ! function_exists( 'blogmatic_image_ratio' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_image_ratio( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      $value = ( $control == 'category_collection_image_ratio' ) ? '500px' : '100%';
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ padding-bottom : calc(".esc_html( $desktop ).  " * ". esc_html( $value ) ."); }";
      endif;
      if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ padding-bottom : calc(".esc_html( $tablet ).  "* ". esc_html( $value ) ."); } }\n";
      endif;
      if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ padding-bottom : calc(".esc_html($smartphone).  " * ". esc_html( $value ) ."); } }\n";
      endif;
   }
endif;

// Image ratio Variable change
if( ! function_exists( 'blogmatic_image_ratio_variable' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_image_ratio_variable( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $css = "body {\n";
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         $desktop = $decoded_control['desktop'];
         $css .= $selector ." : ". $desktop ."; \n";
      endif;
      if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         $tablet = $decoded_control['tablet'];
         $css .= $selector ."-tab : ". $tablet ."; \n";
         endif;
      if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         $smartphone = $decoded_control['smartphone'];
         $css .= $selector ."-mobile : ". $smartphone .";\n";
      endif;
      $css .= '}';
      echo $css;
   }
endif;

// Background Color (Initial)
if( ! function_exists( 'blogmatic_initial_bk_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_initial_bk_color( $selector, $control) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $value = $decoded_control[$decoded_control['type']];
      if( isset( $value ) ) :
         if( $decoded_control['type'] === 'image' ) {
            echo $selector. " { background-image: url(". blogmatic_get_color_format( $value['url'] ) .")}\n";
         } else {
            echo $selector. " { background: " .blogmatic_get_color_format( $value ). "}\n";
         }
      endif;
   }
endif;

// Background Color (Initial Variable)
if( ! function_exists( 'blogmatic_initial_bk_color_variable' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogmatic Pro
   * @since 1.0.0 
   */
   function blogmatic_initial_bk_color_variable( $selector, $control ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( array_key_exists( 'type', $decoded_control ) && isset( $decoded_control[ $decoded_control['type'] ] ) )  echo "body { " . $selector. " : " .blogmatic_get_color_format( $decoded_control[ $decoded_control['type'] ] ). "}\n";
   }
endif;

// Site Background Color
if( ! function_exists( 'blogmatic_get_background_style' ) ) :
   /**
    * Generate css code for background control.
    *
    * @package Blogmatic Pro
    * @since 1.0.0 
    */
   function blogmatic_get_background_style( $selector, $control, $var = '' ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['type'] ) ) :
         $type = $decoded_control['type'];
         switch( $type ) {
            case 'image' : 
                  $css = $selector . " { \n";
                  if( isset( $decoded_control[$type]['url'] ) ) $css .= "background-image: url(" .esc_url( $decoded_control[$type]['url'] ). "); \n";
                  if( isset( $decoded_control['repeat'] ) ) $css .= "background-repeat: " .esc_html( $decoded_control['repeat'] ). "; \n";
                  if( isset( $decoded_control['position'] ) ) $css .= "background-position:" .esc_html( $decoded_control['position'] ). "; \n";
                  if( isset( $decoded_control['attachment'] ) ) $css .= "background-attachment: " .esc_html( $decoded_control['attachment'] ). "; \n";
                  if( isset( $decoded_control['size'] ) ) $css .= "background-size: " .esc_html( $decoded_control['size'] ). "; \n";
                  $css .= '}';
               break;
            default: if( isset( $decoded_control[$type] ) ) echo $selector . "{ background: " .blogmatic_get_color_format( $decoded_control[$type] ). "}";
         }
      endif;
   }
endif;

// spacing control
if( ! function_exists( 'blogmatic_spacing_control' ) ) :
   /**
    * Generate css code for variable change with responsive for spacing controls
    *
    * @package Blogmatic Pro
    * @since 1.0.0
    */
    function blogmatic_spacing_control( $selector, $control, $property ) {
      $decoded_control = BMC\blogmatic_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . '{ '. esc_html( $property ) .' : '. esc_html( $desktop['top'] ) .'px '. esc_html( $desktop['right'] ) .'px '. esc_html( $desktop['bottom'] ) .'px '. esc_html( $desktop['left'] ) .'px }';
      endif;
      if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo '@media(max-width: 940px) {' .$selector . '{ '. esc_html( $property ) .' : '. esc_html( $tablet['top'] ) .'px '. esc_html( $tablet['right'] ) .'px '. esc_html( $tablet['bottom'] ) .'px '. esc_html( $tablet['left'] ) .'px } }';
      endif;
      if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo '@media(max-width: 610px) { ' . $selector . '{ '. esc_html( $property ) .' : '. esc_html( $smartphone['top'] ) .'px '. esc_html( $smartphone['right'] ) .'px '. esc_html( $smartphone['bottom'] ) .'px '. esc_html( $smartphone['left'] ) .'px } }';
      endif;
    }
endif;

// MARK:: PRESET COLORS
if( ! function_exists( 'blogmatic_preset_color_control' ) ) :
   /**
    * Generate css variable
    * 
    * @since 1.0.0
    */
    function blogmatic_preset_color_control( $control, $variable ) {
      $decoded_control = BMC\blogmatic_get_customizer_default( $control );
      if( empty( $decoded_control ) || ! is_array( $decoded_control ) ) return;
      if( array_key_exists( 'color_palettes', $decoded_control ) && array_key_exists( 'active_palette', $decoded_control ) ) :
         extract( $decoded_control );
         $colors = $color_palettes[ $active_palette ];
         if( ! empty( $colors ) && is_array( $colors ) ) :
            echo "body {\n";
            foreach( $colors as $index => $color ) :
               $count = $index + 1;
               echo $variable . $count . ": ".esc_html( $color ) . ";\n";
            endforeach;
            echo "}\n";
         endif;
      endif;
    }
endif;

// MARK:: Typography preset
if( ! function_exists( 'blogmatic_typography_preset' ) ) :
   /**
    * Generate css variable
    * 
    * @since 1.0.0
    */
    function blogmatic_typography_preset() {
      $decoded_control = BMC\blogmatic_get_customizer_option( 'typography_presets' );
      if( count( $decoded_control ) > 0 ) :
         $typographies = $decoded_control['typographies'];
         $labels = $decoded_control['labels'];
         if( count( $typographies ) > 0 ) :
            foreach( $typographies as $index => $typography ) :
               $variable = '--blogmatic-global-preset-typography-';
               $count = $index + 1;
               $variable .= $count . '-font';
               blogmatic_generate_typography_css_variable( $typography, $variable );
            endforeach;
         endif;
      endif;
    }
endif;


if( ! function_exists( 'blogmatic_generate_typography_css_variable' ) ) :
   /**
    * Generate css variable for typography with values provided
    *
    * @since 1.0.0
    */
    function blogmatic_generate_typography_css_variable( $value, $selector ) {
      if( ! $value ) return;
      echo ".blogmatic_font_typography {\n";
         if( isset( $value['font_family'] ) ) echo $selector."-family : " .esc_html( $value['font_family']['value'] ).  "; \n";

         if( isset( $value['font_weight'] ) ) echo $selector."-weight : " .esc_html( $value['font_weight']['value'] ).  "; ".$selector."-style : ". esc_html( $value['font_weight']['variant'] ) .";\n";

         if( isset( $value['text_transform'] ) ) echo $selector."-texttransform : " .esc_html( $value['text_transform'] ).  "; \n";

         if( isset( $value['text_decoration'] ) ) echo $selector."-textdecoration : " .esc_html( $value['text_decoration'] ).  "; \n";

         if( isset( $value['font_size'] ) ) :
            if( isset( $value['font_size']['desktop'] ) ) echo $selector."-size : " .absint( $value['font_size']['desktop'] ).  "px; \n";
            if( isset( $value['font_size']['tablet'] ) ) echo $selector."-size-tab : " .absint( $value['font_size']['tablet'] ).  "px; \n";
            if( isset( $value['font_size']['smartphone'] ) ) echo $selector."-size-mobile : " .absint( $value['font_size']['smartphone'] ).  "px; \n";
         endif;
         if( isset( $value['line_height'] ) ) :
            if( isset( $value['line_height']['desktop'] ) ) echo $selector."-lineheight : " .absint( $value['line_height']['desktop'] ).  "px; \n";
            if( isset( $value['line_height']['tablet'] ) ) echo $selector."-lineheight-tab : " .absint( $value['line_height']['tablet'] ).  "px; \n";
            if( isset( $value['line_height']['smartphone'] ) ) echo $selector."-lineheight-mobile : " .absint( $value['line_height']['smartphone'] ).  "px; \n";
         endif;
         if( isset( $value['letter_spacing'] ) ) :
            if( isset( $value['letter_spacing']['desktop'] ) ) echo $selector."-letterspacing : " . $value['letter_spacing']['desktop'] .  "px; \n";
            if( isset( $value['letter_spacing']['tablet'] ) ) echo $selector."-letterspacing-tab : " . $value['letter_spacing']['tablet'] .  "px; \n";
            if( isset( $value['letter_spacing']['smartphone'] ) ) echo $selector."-letterspacing-mobile : " . $value['letter_spacing']['smartphone'] .  "px; \n";
         endif;
      echo "}\n";
    }
endif;

if( ! function_exists( 'blogmatic_get_typography_format' ) ) :
   /**
    * 
    */
    function blogmatic_get_typography_format( $value ) {
      
      if( $value['preset'] === '-1' ) :
         return $value;
      else:
         $typography_presets = BMC\blogmatic_get_customizer_option( 'typography_presets' );
         if( count( $typography_presets ) > 0 && array_key_exists( 'typographies', $typography_presets ) ) :
            $typographies = $typography_presets['typographies'];
            $filtered_typography = $typographies[ $value['preset'] ];
            $filtered_typography['preset'] = $value['preset'];
            return $filtered_typography;
         endif;
      endif;
    }
endif;