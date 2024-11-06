<?php
/**
 * Handles the functionality required for the theme
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if ( ! function_exists( 'blogmatic_post_format_string' ) ) :
	/**
	 * Adds two typography parameter
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_post_format_string( $post_format ) {
        return $post_format ? $post_format: 'standard';
	}
	add_filter( 'blogmatic_post_format_string_filter', 'blogmatic_post_format_string' );
endif;

if ( ! function_exists( 'blogmatic_get_title_tags_array' ) ) :
	/**
	 * Generates possible array option for title tags
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_get_title_tags_array( $post_format ) {
        return [
			'h1'  =>  esc_html__( 'H1', 'blogmatic-pro' ),
			'h2'  =>  esc_html__( 'H2', 'blogmatic-pro' ),
			'h3'  =>  esc_html__( 'H3', 'blogmatic-pro' ),
			'h4'  =>  esc_html__( 'H4', 'blogmatic-pro' ),
			'h5'  =>  esc_html__( 'H5', 'blogmatic-pro' ),
			'h6'  =>  esc_html__( 'H6', 'blogmatic-pro' )
		];
	}
	add_filter( 'blogmatic_get_title_tags_array_filter', 'blogmatic_get_title_tags_array' );
endif;

if ( ! function_exists( 'blogmatic_schema_body_attributes' ) ) :
	/**
	 * Adds schema tags to the body tag.
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_schema_body_attributes() {
		$site_schema_ready = BMC\blogmatic_get_customizer_option( 'site_schema_ready' );
		if( ! $site_schema_ready ) return;
		$is_blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() );
		$itemtype = 'WebPage'; // default itemtype
		$itemtype = ( $is_blog ) ? 'Blog' : $itemtype; // itemtype for blog page
		$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype; // itemtype for earch results page
		$itemtype_final = apply_filters( 'blogmatic_schema_body_attributes_itemtype', $itemtype ); // itemtype
		echo apply_filters( 'blogmatic_schema_body_attributes', "itemtype='https://schema.org/" . esc_attr( $itemtype_final ) . "' itemscope='itemscope'" ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'blogmatic_schema_article_attributes' ) ) :
	/**
	 * Adds schema tags to the article tag.
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_schema_article_attributes() {
		$site_schema_ready = BMC\blogmatic_get_customizer_option( 'site_schema_ready' );
		if( ! $site_schema_ready ) return;
		$itemtype = 'Article'; // default itemtype.
		$itemtype_final = apply_filters( 'blogmatic_schema_article_attributes_itemtype', $itemtype ); // itemtype
		echo apply_filters( 'blogmatic_schema_article_attributes', "itemtype='https://schema.org/" . esc_attr( $itemtype_final ) . "' itemscope='itemscope'" ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'blogmatic_schema_article_name_attributes' ) ) :
	/**
	 * Adds schema tags to the article name tag.
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_schema_article_name_attributes() {
		$site_schema_ready = BMC\blogmatic_get_customizer_option( 'site_schema_ready' );
		if( ! $site_schema_ready ) return;
		$itemprop = 'name'; // default itemprop.
		$itemprop_final = apply_filters( 'blogmatic_schema_article_name_attributes_itemprop', $itemprop ); // itemprop
		return apply_filters( 'blogmatic_schema_article_name_attributes', "itemprop='" . esc_attr( $itemprop_final ) . "'" ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'blogmatic_schema_article_body_attributes' ) ) :
	/**
	 * Adds schema tags to the article body tag.
	 *
	 * 
	 * @echo html markup attributes
	 */
	function blogmatic_schema_article_body_attributes() {
		$site_schema_ready = BMC\blogmatic_get_customizer_option( 'site_schema_ready' );
		if( ! $site_schema_ready ) return;
		$itemprop = 'articleBody'; // default itemprop.
		$itemprop_final = apply_filters( 'blogmatic_schema_article_body_attributes_itemprop', $itemprop ); // itemprop
		echo apply_filters( 'blogmatic_schema_article_body_attributes', "itemprop='" . esc_attr( $itemprop_final ) . "'" ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'blogmatic_typography_value' ) ) :
	/**
	 * Adds two typography parameter
	 *
	 * @echo html markup attributes
	 */
	function blogmatic_typography_value( $id, $value = [] ) {
		if( empty( $value ) ) :
			$typo = BMC\blogmatic_get_customizer_option( $id );
		else:
			$typo = $value;
		endif;
		$font_family = $typo['font_family']['value'];
		$font_weight = $typo['font_weight']['value'];
		$variant = ( $typo['font_weight']['variant'] === 'italic' ) ? 'ital' : 'wght';
		$typo_value = [
			'font_family'	=> $font_family,
			'font_weight'	=> $font_weight,
			'variant'	=> $typo['font_weight']['variant']
		];
		return apply_filters( 'blogmatic_combined_typo', $typo_value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	add_filter( 'blogmatic_typo_combine_filter', 'blogmatic_typography_value', 10, 2 );
endif;

if( ! function_exists( 'blogmatic_compare_wand' ) ) :
	/**
	 * Compares parameter valaues
	 * 
	 * @package Blogmatic Pro
	 * @since 1.0.0
	 */
	function blogmatic_compare_wand( $params ) {
		$returnval = true;
		foreach( $params as $val ) :
			if( ! $val ) :
				$returnval = false;
				break;
			endif;
		endforeach;
		return $returnval;
	}
endif;

if( ! function_exists( 'blogmatic_function_exists' ) ) :
	/**
	 * Checks exists
	 * 
	 * @package Blogmatic Pro
	 * @since 1.0.0
	 */
	function blogmatic_function_exists( $function ) {
		if( function_exists( $function ) ) return true;
		return;
	}
endif;