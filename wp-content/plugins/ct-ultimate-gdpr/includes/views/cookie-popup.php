<?php

/**
 * The template for displaying cookie popup on front
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr folder
 *
 * @version 1.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var array $options */

$distance = isset( $options['cookie_position_distance'] ) ? $options['cookie_position_distance'] : 0;

?>

<div id="ct-ultimate-gdpr-cookie-popup" class="
    <?php
if ( isset( $options['cookie_position'] ) ) :
	if ( $options['cookie_position'] == 'top_panel_' ) :
		echo esc_attr( 'ct-ultimate-gdpr-cookie-topPanel');
	endif;

	if ( $options['cookie_position'] == 'bottom_panel_' ) :
		echo esc_attr( 'ct-ultimate-gdpr-cookie-bottomPanel');
	endif;
endif;

if ( isset( $options['cookie_box_style'] ) ) :
	if ( $options['cookie_box_style'] == 'modern' ) :
		echo esc_attr( ' ct-ultimate-gdpr-cookie-popup-modern');
	endif;
endif;

if ( isset( $options['cookie_box_shape'] ) ) :
	if ( $options['cookie_box_shape'] == 'squared' ) :
		echo esc_attr( ' ct-ultimate-gdpr-cookie-popup-squared');
	endif;
endif;

if ( isset( $options['cookie_button_shape'] ) ) :
	if ( $options['cookie_button_shape'] == 'rounded' ) :
		echo esc_attr( ' ct-ultimate-gdpr-cookie-popup-button-rounded');
	endif;
endif;

if ( isset( $options['cookie_button_size'] ) ) :
	if ( $options['cookie_button_size'] == 'large' ) :
		echo esc_attr( ' ct-ultimate-gdpr-cookie-popup-button-large');
	endif;
endif;
?>"

     style="background-color: <?php echo esc_attr( $options['cookie_background_color'] ); ?>;
             color: <?php echo esc_attr( $options['cookie_text_color'] ); ?>;
     <?php

     if ( isset( $options['cookie_position'] ) ) :
	     if ( $options['cookie_position'] == 'top_panel_' ) :
		     echo esc_attr( "top: 0; width: 100%; border-radius: 0;" );
         elseif ( $options['cookie_position'] == 'bottom_panel_' ) :
		     echo esc_attr( "bottom: 0; width: 100%; border-radius: 0;" );
	     else :
		     echo str_replace( '_', ": " . (int) $distance . "px; ", esc_attr( $options['cookie_position'] ) );
	     endif;
     endif;

     ?>">

	<?php if ( isset( $options['cookie_position'] ) ) :
		if ( $options['cookie_position'] == 'top_panel_' ) :
			echo "<div class='ct-container ct-ultimate-gdpr-cookie-popup-topPanel'>";
		endif;

		if ( $options['cookie_position'] == 'bottom_panel_' ) :
			echo "<div class='ct-container ct-ultimate-gdpr-cookie-popup-bottomPanel'>";
		endif;
	endif; ?>

    <div id="ct-ultimate-gdpr-cookie-content">
		<?php echo wp_kses_post( $options['cookie_content'] ); ?>
    </div>

	<?php
	if ( isset( $options['cookie_box_style'] ) ) :
		if ( $options['cookie_box_style'] == 'modern' ) :
			echo "<div class='ct-ultimate-gdpr-cookie-buttons clearfix'>";
		endif;
	endif;
	?>

    <div id="ct-ultimate-gdpr-cookie-accept"
         style="border-color: <?php echo esc_attr( $options['cookie_button_border_color'] ); ?>;
                 background-color: <?php
	     if ( isset( $options['cookie_box_style'] ) ) :
		     if ( ( $options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'top_panel_' ) || ( $options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'bottom_panel_' ) ) :
			     echo esc_attr( $options['cookie_button_bg_color'] );
		     else :
			     echo esc_attr( $options['cookie_button_bg_color'] );
		     endif;
	     endif;
	     ?>;
                 color: <?php echo esc_attr( $options['cookie_button_text_color'] ); ?>;">
		<?php echo ct_ultimate_gdpr_get_value( 'cookie_popup_label_accept', $options, esc_html__( 'Accept', 'ct-ultimate-gdpr' ), false  ); ?>
    </div>

    <div id="ct-ultimate-gdpr-cookie-read-more"
         style="border-color: <?php echo esc_attr( $options['cookie_button_border_color'] ); ?>;
                 background-color: <?php
	     if ( isset( $options['cookie_box_style'] ) ) :
		     if ( ( $options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'top_panel_' ) || ( $options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'bottom_panel_' ) ) :
			     echo esc_attr( $options['cookie_button_bg_color'] );
		     else :
			     echo esc_attr( $options['cookie_button_bg_color'] );
		     endif;
	     endif;
	     ?>;
                 color: <?php echo esc_attr( $options['cookie_button_text_color'] ); ?>;">
		<?php echo ct_ultimate_gdpr_get_value( 'cookie_popup_label_read_more', $options, esc_html__( 'Read more', 'ct-ultimate-gdpr' ), false ); ?>
    </div>

	<?php
	if ( isset( $options['cookie_box_style'] ) ) :
		if ( $options['cookie_box_style'] == 'modern' ) :
			echo "</div>";
		endif;
	endif;
	?>

    <div class="clearfix"></div>

	<?php if ( isset( $options['cookie_position'] ) ) :
		if ( $options['cookie_position'] == 'top_panel_' || $options['cookie_position'] == 'bottom_panel_' ) :
			echo "</div>";
		endif;
	endif; ?>

</div>
