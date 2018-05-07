<?php
/**
 * The template for displaying all pages
 * Template Name: Checkout Process
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kimnaturaV1
 */

get_header();
use Kimnatura\Admin\Woo as Woo;
$woo = new Woo();


get_template_part( 'template-parts/account/woocommerce-account' ); 
?>

<!-- Cart Navigation -->
		<?php
	
		while ( have_posts() ) :
			the_post();
			// Cart navigacija checkout
			
			echo $woo->multi_step();
			get_template_part( 'template-parts/woocommerce/checkout', '' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>


<?php
get_sidebar();
get_footer();
