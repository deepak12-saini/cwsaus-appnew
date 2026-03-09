<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$infinity_title_style      = Kirki::get_option( 'infinity', 'page_style_heading_style' );
$infinity_heading_bg_image = Kirki::get_option( 'infinity', 'page_heading_bg_image' );
$infinity_heading_bg_color = Kirki::get_option( 'infinity', 'page_heading_bg_color' );
$infinity_heading_color    = Kirki::get_option( 'infinity', 'page_style_heading_font_color' );
$infinity_disable_parallax = ! Kirki::get_option( 'infinity', 'page_style_disable_parallax' );

$layout = Kirki::get_option( 'infinity', 'woo_layout_category' );

get_header(); ?>
<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
	<?php if ( 'bg_color' != $infinity_title_style ) { //If enable heading image ?>
		<div class="big-title image-bg <?php if ( 'big-image' == $infinity_title_style ) {
			echo 'image-bg--big';
		} ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
			<?php if ( ( "on" != $infinity_disable_parallax || ! Kirki::get_option( 'infinity', 'page_style_disable_parallax' ) ) && ! $infinity_disable_parallax ) { ?>
				data-stellar-background-ratio="0.5"
			<?php } ?>>
			<div class="container">
				<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
			</div>
		</div>
	<?php } else { // single color heading ?>
		<div class="big-title color-bg" style="background-color: <?php echo esc_attr( $infinity_heading_bg_color ); ?>">
			<div class="container">
				<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
			</div>
		</div>
	<?php } ?>
<?php } ?>
<?php if ( function_exists( 'tm_bread_crumb' ) && Kirki::get_option( 'infinity', 'site_general_breadcrumb_enable' ) == 1 ) { ?>
	<div class="breadcrumb">
		<div class="container">
			<?php echo tm_bread_crumb( array( 'home_label' => Kirki::get_option( 'infinity', 'site_general_breadcrumb_home_text' ) ) ); ?>
		</div>
	</div>
<?php } ?>
<div class="container">
	<div class="row">
		<?php $class = ( $layout != 'full-width' ) ? 'col-sm-8 col-md-9' : 'col-sm-12'; ?>
		<div class="<?php echo esc_attr( $class ); ?>">
			<?php do_action( 'woocommerce_before_main_content' ); ?>

			<?php if ( have_posts() ) : ?>

				<div class="row middle"><?php do_action( 'woocommerce_before_shop_loop' ); ?></div>

				<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

			<?php elseif ( ! woocommerce_product_subcategories( array(
				                                                    'before' => woocommerce_product_loop_start( false ),
				                                                    'after'  => woocommerce_product_loop_end( false ),
			                                                    ) )
			) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_main_content' ); ?>
		</div>
		<?php do_action( 'woocommerce_sidebar' ); ?>
	</div>
</div>

<?php get_footer( 'shop' ); ?>
