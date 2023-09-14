<?php 

/* Thêm Cờ nhíp */
add_action( 'add_meta_boxes', 'thim_add_clip_url_metaboxes' );
function thim_add_clip_url_metaboxes() {
	add_meta_box(
		'thim_clip_url',
		'Clip Url',
		'thim_clip_url',
		'product',
		'side',
		'default'
	);
}
function thim_clip_url() {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'clip_url_fields' );
	$clip_url = get_post_meta( $post->ID, 'clip_url', true );
	echo '<input type="text" name="clip_url" value="' . esc_textarea( $clip_url )  . '" class="widefat">';
}
function thim_save_clip_url_meta( $post_id, $post ) {
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	if ( ! isset( $_POST['clip_url'] ) || ! wp_verify_nonce( $_POST['clip_url_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	$events_meta['clip_url'] = esc_textarea( $_POST['clip_url'] );
	foreach ( $events_meta as $key => $value ) :
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'thim_save_clip_url_meta', 1, 2 );

// BOX
$clip_url = get_post_meta( get_the_ID(), 'clip_url', TRUE );
var_dump($clip_url );

// /themes/flatsome/woocommerce/single-product/

/**
* Single Product Image
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
if( !function_exists('thim_gallery_add_clip_html') ) {
	function thim_gallery_add_clip_html() {
		$clip_url = get_post_meta( get_the_ID(), 'clip_url', TRUE );
		return '<div data-thumb="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS10qxlyyyr7zEIaB3bshoOPSB9Obx9jQRHWY6WcY_j6goEKaRL" class="hdevvn_clip woocommerce-product-gallery__image '.$image_wrapper_class.'"><div class="clip_main"><a href="' . esc_url( $full_src[0] ) . '"><iframe width="100%" height="420"
		src="'.$clip_url.'">
		</iframe></a></div></div>';
	}
}
?>
<div class="product-gallery-default has-hover relative">
	<?php do_action('flatsome_sale_flash'); ?>
	<div class="image-tools absolute top show-on-hover right z-3">
		<?php do_action('flatsome_product_image_tools_top'); ?>
	</div>
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper">
			<?php
			if ( has_post_thumbnail() ) {
				$html  = flatsome_wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}
			$clip_url = get_post_meta( get_the_ID(), 'clip_url', TRUE );
			if($clip_url){
				$html_clip  = thim_gallery_add_clip_html() ;
			}
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
			do_action( 'woocommerce_product_thumbnails' );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',  $html_clip );
			?>
		</figure>
	</div>
</div>