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
	<header class="section__header">
		<?php the_title( '<h1 class="section__title">', '</h1>' ); ?>
		<?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
	</header><!-- .entry-header -->

	<div class="page__content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
