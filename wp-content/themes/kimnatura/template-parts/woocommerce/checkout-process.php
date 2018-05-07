<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kimnaturaV1
 */

?>
sdsdasda
<article id="post-<?php the_ID(); ?>" <?php post_class('page__article'); ?>>
	<header class="page__title">
		<?php the_title( '<h1 class="page__title">', '</h1>' ); ?>
		<?php the_subtitle( '<p class="page__description">', '</p>' ); ?>
	</header><!-- .entry-header -->

	<div class="page__content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
