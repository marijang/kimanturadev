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
        get_template_part( 'template-parts/account/woocommerce-account' ); 
	    do_action('b4b_account_before'); 
		while ( have_posts() ) :
			the_post();
        ?>
        <?php if(is_user_logged_in()):  ?>
        <section class="account-menu">      
            <article class="account-menu__content">
                <div class="account-menu__left-part">
                <?php if (is_wc_endpoint_url( 'edit-account' )):  ?>
                    <a class="account-menu__disabled"> Postavke računa </a>
                <?php else:  ?>
                    <a href="/my-account/edit-account"> Postavke računa </a>
                <?php endif  ?>
                <?php if (is_wc_endpoint_url( 'edit-address' )):  ?>
                    <a class="account-menu__disabled"> Spremljene adrese </a>
                <?php else:  ?>
                    <a href="/my-account/edit-address"> Spremljene adrese </a>
                <?php endif  ?>
                <?php if (is_wc_endpoint_url( 'orders' )):  ?>
                    <a class="account-menu__disabled"> Povijest kupnje </a>
                <?php else:  ?>
                    <a href="/my-account/orders"> Povijest kupnje </a>
                <?php endif  ?>
                </div>
                <div class="account-menu__right-part">
	            <?php	printf(
		            __( '%1$s <div><a href="%2$s">Log out</a></div>', 'woocommerce' ),
		            '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		            esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
                );?>
                </div>
            </article>
        </section>
        <?php endif  ?>
        <section id="account-page" class="account section  section__spacing-top--default section--first section__spacing-bottom--medium">
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
