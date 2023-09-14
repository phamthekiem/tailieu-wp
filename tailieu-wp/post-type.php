<?php
/**
 * SH Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SH_Theme
 */
if ( ! function_exists( 'shtheme_setup' ) ) :
	function shtheme_setup() {
		load_theme_textdomain( 'shtheme', get_template_directory() . '/languages' );
		// Load Theme Options
		require get_template_directory() . '/inc/options.php';
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			Redux::init('sh_option');
		}
		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shtheme' ),
			'menu-2' => esc_html__( 'Footer', 'shtheme' ),
		) );
		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption',) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shtheme_custom_background_args', array('default-color' => 'ffffff','default-image' => '',) ) );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'shtheme_setup' );
function sh_constants() {
	define( 'PARENT_DIR', get_template_directory() );
	define( 'SH_DIR',  get_template_directory_uri() );
	define( 'SH_FUNCTIONS_DIR', PARENT_DIR . '/inc/functions' );
}
add_action( 'init', 'sh_constants' );
function sh_load_framework() {
	// Load Functions.
	require_once( PARENT_DIR . '/inc/options-function.php' );
	require_once( SH_FUNCTIONS_DIR . '/init.php' );
	require_once( SH_FUNCTIONS_DIR . '/sidebar.php' );
	require_once( SH_FUNCTIONS_DIR . '/formatting.php' );
	require_once( SH_FUNCTIONS_DIR . '/breadcrumbs.php' );
	require_once( SH_FUNCTIONS_DIR . '/dashboard.php' );
	require_once( SH_FUNCTIONS_DIR . '/mobilemenu.php' );
	
	require_once( PARENT_DIR . '/inc/slider.php' );
}
add_action( 'init','sh_load_framework' );
/**
 * Register Widget Area
 *
 */
function shtheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Tin tức', 'shtheme' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shtheme_widgets_init' );
/**
 * Add Widget Top Header
 */
function sh_register_top_header_widget_areas() {
	global $sh_option;
	if( $sh_option['display-topheader-widget'] == '1' ) {
		register_sidebar( array(
			'name'          => __( 'Top Header', 'shtheme' ),
			'id'            => 'top-header',
			'description'   => __( 'Top Header widget area', 'shtheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init','sh_register_top_header_widget_areas', 1 );
/**
 * Add Widget Footer
 */
function sh_register_footer_widget_areas() {
	global $sh_option;
	$footer_widgets = $sh_option['opt-number-footer'];
	$footer_widgets_number = intval($footer_widgets);
	$counter = 1;
	while ( $counter <= $footer_widgets_number ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer %d', 'shtheme' ), $counter ),
			'id'            => sprintf( 'footer-%d', $counter ),
			'description'   => sprintf( __( 'Footer %d widget area', 'shtheme' ), $counter ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		$counter++;
	}
}
add_action( 'widgets_init','sh_register_footer_widget_areas' );
/**
 * Load File
 *
 */
// Load Plugin Activation File.
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
// Load Shortcode
require get_template_directory() . '/inc/shortcode/shortcode-blog.php';
require get_template_directory() . '/inc/shortcode/shortcode-project.php';
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/shortcode/shortcode-product.php';
}
// Load Function Woocomerce
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/function-woo.php';
}
// Load Widget
require get_template_directory() . '/inc/widgets/wg-post-list.php';
require get_template_directory() . '/inc/widgets/wg-support.php';
require get_template_directory() . '/inc/widgets/wg-fblikebox.php';
require get_template_directory() . '/inc/widgets/wg-page.php';
require get_template_directory() . '/inc/widgets/wg-view-post-list.php';
require get_template_directory() . '/inc/widgets/wg-information.php';
require get_template_directory() . '/inc/widgets/wg-social.php';
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/widgets/wg-product-slider.php';
}
function shtheme_lib_scripts(){
	// Bootstrap
	wp_enqueue_script( 'popper-js', SH_DIR . '/lib/js/popper.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'bootstrap-js', SH_DIR . '/lib/js/bootstrap.min.js', array('jquery'), '1.0', true );
	wp_enqueue_style( 'bootstrap-style', SH_DIR .'/lib/css/bootstrap.min.css' );
	// Main js
	wp_enqueue_script( 'main-js', SH_DIR . '/lib/js/main.js', array(), '1.0', true );
	wp_localize_script(	'main-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );
	// Slick Slider
	wp_register_script( 'slick-js', SH_DIR . '/lib/js/slick.min.js', array('jquery'), '1.0', true );
	wp_register_style( 'slick-style', SH_DIR .'/lib/css/slick/slick.css' );
	wp_register_style( 'slick-theme-style', SH_DIR .'/lib/css/slick/slick-theme.css' );
	// Font Awesome
	wp_enqueue_style( 'fontawesome-style', SH_DIR .'/lib/css/font-awesome-all.css' );
	// Ring Phone
	wp_register_style( 'phonering-style', SH_DIR .'/lib/css/phone-ring.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Fancybox
	wp_register_script( 'fancybox-js', SH_DIR . '/lib/js/jquery.fancybox.min.js', array('jquery'), '1.0', true );
	wp_register_style( 'fancybox-style', SH_DIR .'/lib/css/jquery.fancybox.min.css' );
}
add_action( 'wp_enqueue_scripts', 'shtheme_lib_scripts' , 1 );
/*=======================================================================*/
function register_post_type_project() {
	$labels = array(
		'name'                  => _x( 'Dự án', 'Tên loại bài đăng', 'shtheme' ),
		'singular_name'         => _x( 'Dự án', 'Tên loại bài đăng', 'shtheme' ),
		'menu_name'             => __( 'Dự án', 'shtheme' ),
		'name_admin_bar'        => __( 'Dự án', 'shtheme' ),
		'archives'              => __( 'Dự án', 'shtheme' ),
		'attributes'            => __( 'Thuộc tính bài viết', 'shtheme' ),
		'parent_item_colon'     => __( 'Bài viết gốc:', 'shtheme' ),
		'all_items'             => __( 'Tất cả bài viết', 'shtheme' ),
		'add_new_item'          => __( 'Viết bài mới', 'shtheme' ),
		'add_new'               => __( 'Viết bài mới', 'shtheme' ),
		'new_item'              => __( 'Viết bài mới', 'shtheme' ),
		'edit_item'             => __( 'Chỉnh sửa bài viết', 'shtheme' ),
		'update_item'           => __( 'Cập nhật bài viết', 'shtheme' ),
		'view_item'             => __( 'Xem bài viết', 'shtheme' ),
		'view_items'            => __( 'Xem bài viết', 'shtheme' ),
		'search_items'          => __( 'Tìm kiếm bài viết', 'shtheme' ),
		'not_found'             => __( 'Không có bài viết', 'shtheme' ),
		'not_found_in_trash'    => __( 'Không có bài viết trong thùng rác', 'shtheme' ),
		'featured_image'        => __( 'Ảnh đại diện', 'shtheme' ),
		'set_featured_image'    => __( 'Chọn ảnh đại diện', 'shtheme' ),
		'remove_featured_image' => __( 'Xóa ảnh đại diện', 'shtheme' ),
		'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'shtheme' ),
		'insert_into_item'      => __( 'Thêm tới mục', 'shtheme' ),
		'uploaded_to_this_item' => __( 'Tải tới mục', 'shtheme' ),
		'items_list'            => __( 'Danh sách bài viết', 'shtheme' ),
		'items_list_navigation' => __( 'Điều hướng danh sách mục', 'shtheme' ),
		'filter_items_list'     => __( 'Lọc danh sách các mục', 'shtheme' ),
	);
	$rewrite = array(
		'slug'                  => 'du-an',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Dự án', 'shtheme' ),
		// 'description'           => __( 'Mô tả', 'shtheme' ),
		'labels'                => $labels,
		// 'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'map_meta_cap' 			=> true,
		'rewrite'               => $rewrite,
		'query_var' 			=> true,
		'supports' 				=> array('title','thumbnail','editor'),
		// 'menu_icon'				=> 'dashicons-video-alt3',
		// View more https://developer.wordpress.org/resource/dashicons/
	);
	register_post_type( 'project', $args );
}
add_action( 'init', 'register_post_type_project', 0 );
// Register Custom Taxonomy
function register_taxonomy_project_type() {
	$labels = array(
		'name'                       => _x( 'Loại dự án', 'Taxonomy General Name', 'shtheme' ),
		'singular_name'              => _x( 'Loại dự án', 'Taxonomy Singular Name', 'shtheme' ),
		'menu_name'                  => __( 'Loại dự án', 'shtheme' ),
		'all_items'                  => __( 'Tất cả danh mục', 'shtheme' ),
		'parent_item'                => __( 'Danh mục mẹ', 'shtheme' ),
		'parent_item_colon'          => __( 'Danh mục mẹ:', 'shtheme' ),
		'new_item_name'              => __( 'Tên danh mục mới', 'shtheme' ),
		'add_new_item'               => __( 'Thêm danh mục mới', 'shtheme' ),
		'edit_item'                  => __( 'Chỉnh sửa danh mục', 'shtheme' ),
		'update_item'                => __( 'Cập nhật danh mục', 'shtheme' ),
		'view_item'                  => __( 'Thêm danh mục', 'shtheme' ),
		'separate_items_with_commas' => __( 'Phân tách các mục bằng dấu phẩy', 'shtheme' ),
		'add_or_remove_items'        => __( 'Thêm hoặc xóa danh mục', 'shtheme' ),
		'choose_from_most_used'      => __( 'Chọn từ được sử dụng nhiều nhất', 'shtheme' ),
		'popular_items'              => __( 'Các mục phổ biến', 'shtheme' ),
		'search_items'               => __( 'Tìm danh mục', 'shtheme' ),
		'not_found'                  => __( 'Không tìm thấy', 'shtheme' ),
		'no_terms'                   => __( 'Không có danh mục', 'shtheme' ),
		'items_list'                 => __( 'Danh sách danh mục', 'shtheme' ),
		'items_list_navigation'      => __( 'Điều hướng danh sách mục', 'shtheme' ),
	);
	$rewrite = array(
		'slug'                       => 'loai-du-an',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'hierarchical' 				=> true,
		'label'			 			=> 'Loại dự án',
		'show_ui' 					=> true,
		'query_var' 				=> true,
		'show_admin_column' 		=> true,
		'rewrite'                   => $rewrite,
	);
	register_taxonomy( 
		'project_type', array( 0 => 'project' ), $args
	);
}
add_action( 'init', 'register_taxonomy_project_type', 0 );
/*=======================================================================*/
function register_post_type_hinhanh() {
	$labels = array(
		'name'                  => _x( 'Hình ảnh', 'Post Type General Name', 'sh_theme' ),
		'singular_name'         => _x( 'Hình ảnh', 'Post Type Singular Name', 'sh_theme' ),
		'menu_name'             => __( 'Hình ảnh', 'sh_theme' ),
		'name_admin_bar'        => __( 'Hình ảnh', 'sh_theme' ),
		'archives'              => __( 'Hình ảnh', 'sh_theme' ),
		'attributes'            => __( 'Thuộc tính bài viết', 'shtheme' ),
		'parent_item_colon'     => __( 'Bài viết gốc:', 'shtheme' ),
		'all_items'             => __( 'Tất cả bài viết', 'shtheme' ),
		'add_new_item'          => __( 'Viết bài mới', 'shtheme' ),
		'add_new'               => __( 'Viết bài mới', 'shtheme' ),
		'new_item'              => __( 'Viết bài mới', 'shtheme' ),
		'edit_item'             => __( 'Chỉnh sửa bài viết', 'shtheme' ),
		'update_item'           => __( 'Cập nhật bài viết', 'shtheme' ),
		'view_item'             => __( 'Xem bài viết', 'shtheme' ),
		'view_items'            => __( 'Xem bài viết', 'shtheme' ),
		'search_items'          => __( 'Tìm kiếm bài viết', 'shtheme' ),
		'not_found'             => __( 'Không có bài viết', 'shtheme' ),
		'not_found_in_trash'    => __( 'Không có bài viết trong thùng rác', 'shtheme' ),
		'featured_image'        => __( 'Ảnh đại diện', 'shtheme' ),
		'set_featured_image'    => __( 'Chọn ảnh đại diện', 'shtheme' ),
		'remove_featured_image' => __( 'Xóa ảnh đại diện', 'shtheme' ),
		'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'shtheme' ),
		'insert_into_item'      => __( 'Thêm tới mục', 'shtheme' ),
		'uploaded_to_this_item' => __( 'Tải tới mục', 'shtheme' ),
		'items_list'            => __( 'Danh sách bài viết', 'shtheme' ),
		'items_list_navigation' => __( 'Điều hướng danh sách mục', 'shtheme' ),
		'filter_items_list'     => __( 'Lọc danh sách các mục', 'shtheme' ),
	);
	$rewrite = array(
		'slug'                  => 'thu-vien-anh',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Hình ảnh', 'sh_theme' ),
		'description'           => __( 'Post Type Description', 'sh_theme' ),
		'labels'                => $labels,
		// 'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		// 'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'map_meta_cap' 			=> true,
		'rewrite'               => $rewrite,
		'query_var' 			=> true,
		'supports' 				=> array('title','editor','thumbnail'),
		'menu_icon'				=> 'dashicons-format-image',
	);
	register_post_type( 'gallery', $args );
}
add_action( 'init', 'register_post_type_hinhanh', 0 );
function register_taxonomy_type_gallery() {
	$labels = array(
		'name'                       => _x( 'Danh mục hình ảnh', 'Taxonomy General Name', 'shtheme' ),
		'singular_name'              => _x( 'Danh mục hình ảnh', 'Taxonomy Singular Name', 'shtheme' ),
		'menu_name'                  => __( 'Danh mục hình ảnh', 'shtheme' ),
		'all_items'                  => __( 'Tất cả danh mục', 'shtheme' ),
		'parent_item'                => __( 'Danh mục mẹ', 'shtheme' ),
		'parent_item_colon'          => __( 'Danh mục mẹ:', 'shtheme' ),
		'new_item_name'              => __( 'Tên danh mục mới', 'shtheme' ),
		'add_new_item'               => __( 'Thêm danh mục mới', 'shtheme' ),
		'edit_item'                  => __( 'Chỉnh sửa danh mục', 'shtheme' ),
		'update_item'                => __( 'Cập nhật danh mục', 'shtheme' ),
		'view_item'                  => __( 'Thêm danh mục', 'shtheme' ),
		'separate_items_with_commas' => __( 'Phân tách các mục bằng dấu phẩy', 'shtheme' ),
		'add_or_remove_items'        => __( 'Thêm hoặc xóa danh mục', 'shtheme' ),
		'choose_from_most_used'      => __( 'Chọn từ được sử dụng nhiều nhất', 'shtheme' ),
		'popular_items'              => __( 'Các mục phổ biến', 'shtheme' ),
		'search_items'               => __( 'Tìm danh mục', 'shtheme' ),
		'not_found'                  => __( 'Không tìm thấy', 'shtheme' ),
		'no_terms'                   => __( 'Không có danh mục', 'shtheme' ),
		'items_list'                 => __( 'Danh sách danh mục', 'shtheme' ),
		'items_list_navigation'      => __( 'Điều hướng danh sách mục', 'shtheme' ),
	);
	$rewrite = array(
		'slug'                       => 'danh-muc-hinh-anh',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'hierarchical' 				=> true,
		'label'			 			=> 'Danh mục hình ảnh',
		'show_ui' 					=> true,
		'query_var' 				=> true,
		'show_admin_column' 		=> true,
		'rewrite'                   => $rewrite,
	);
	register_taxonomy( 'type_gallery', array( 0 => 'gallery' ), $args );
}
add_action( 'init', 'register_taxonomy_type_gallery', 0 );
function create_shortcode_gallery() {
	global $sh_option;
	// wp_enqueue_script( 'fancybox-js' );
	// wp_enqueue_style( 'fancybox-style' );
    ob_start();
    ?>
    <div class="gallery_project">
		<div class="lists-pl">
			<ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
				<?php
				$i = 0;
				$list_cat_gallery = $sh_option['list_cat_gallery'];
				if( $list_cat_gallery ) {
					foreach ($list_cat_gallery as $key => $idpost) {
						$obj = get_term_by('id', $idpost, 'type_gallery');
						$icon 		= get_field( 'icon','type_gallery_'.$idpost );
						$hover_icon = get_field( 'hover_icon','type_gallery_'.$idpost );
					    $class = ( $i == 0 ) ? 'active' : '';
					    ?>
					    <li class="nav-item">
					    	<a class="nav-link <?php echo $class;?>" id="pills-<?php echo $idpost;?>-tab" data-toggle="pill" href="#pills-<?php echo $idpost;?>" role="tab" aria-controls="pills-<?php echo $idpost;?>" aria-selected="true">
								<?php
								if( $icon ) : echo '<img class="icon_cm" src="'. $icon['url'] .'">';endif;
								if( $hover_icon ) : echo '<img class="iconhover_cm" src="'. $hover_icon['url'] .'">';endif;
								echo get_dm_name( $idpost, 'type_gallery' );
								?>
					    	</a>
					    </li>
					    <?php
					    $i++;
					}
				}
				?>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<?php 
				$i = 0;
				$list_cat_gallery = $sh_option['list_cat_gallery'];
				if( ! empty( $list_cat_gallery ) ) {
					foreach ($list_cat_gallery as $key => $idpost) {
						$obj = get_term_by('id', $idpost, 'type_gallery');
					    $class = ( $i == 0 ) ? 'show active' : '';
					    ?>
					    <div class="tab-pane fade <?php echo $class;?>" id="pills-<?php echo $idpost;?>" role="tabpanel" aria-labelledby="pills-<?php echo $idpost;?>-tab">
					    	<div class="row">
						    	<?php
								$args = array(
									'post_type' => 'gallery',
			                        'tax_query' => array(
			                            array(
			                                'taxonomy' 	=> 'type_gallery',
			                                'field' 	=> 'id',
			                                'terms' 	=> $idpost,
			                            )
			                        ),
			                        'posts_per_page'    => 9,
		                        );
		                        $the_query = new WP_Query($args);
		                        while($the_query -> have_posts()) :
		                    	$the_query -> the_post();
	                   	 		get_template_part( 'template-parts/loop/loop-gallery' );
								endwhile;
								wp_reset_postdata();
								?>
							</div>
					    </div>
					    <?php
					    $i++;
					}
				}
				?>
			</div>
		</div>
	</div>
    <?php
    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;
}
add_shortcode('thuvienanh', 'create_shortcode_gallery');
function wpb_list_child_pages() { 
	global $post; 
	if ( is_page() && $post->post_parent )
	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
	    $string = '<ul class="menu">' . $childpages . '</ul>';
	}
	return $string;
}
/**
 * Add Thumb Size
**/
add_image_size( 'sh_thumb350x350', 350, 350, array( 'center', 'center' ) );
add_image_size( 'sh_thumb350x270', 350, 270, array( 'center', 'center' ) );
add_image_size( 'sh_thumb300x200', 300, 200, array( 'center', 'center' ) );
add_image_size( 'sh_thumb205x150', 205, 150, array( 'center', 'center' ) );
add_filter('use_block_editor_for_post', '__return_false');
