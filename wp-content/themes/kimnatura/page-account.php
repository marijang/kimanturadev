<?php
/**
 * The template for displaying memeber pages
 * Template Name: Account
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package b4b
 */

get_header();
?>
		<?php
	    do_action('b4b_account_before'); 
		while ( have_posts() ) :
			the_post();
        ?>
        <section id="account-page" class="account section">
            <header class="account__header section__header section__header--content">
                <?php the_title( '<h1 class="section__title section__title--content">', '</h1>' ); ?>
                <?php if (!is_user_logged_in()): ?>
                <?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
                <?php endif ?>
            </header><!-- .entry-header -->
       
            <?php 
                do_action('b4b_account_content_before'); 
                the_content(); 
                do_action('b4b_account_content_after'); 
            ?>
        </section><!-- #post-<?php the_ID(); ?> -->
        <?php
		endwhile; // End of the loop.
		?>
<?php
do_action('b4b_account_after');
get_footer();
