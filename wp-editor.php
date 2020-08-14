define('DISALLOW_FILE_EDIT',true);

define('DISALLOW_FILE_MODS',true);

NotificationX

wpfomo


@font-face {
 font-family:font_strong;
 src:url('../fonts/Captureit.ttf') format('truetype'),
 url('../fonts/Captureit.eot#iefix') format('embedded-opentype'),
 url('../fonts/Captureit.woff') format('woff');
 font-weight:normal;
 font-style:normal;
}

[wow class="lightSpeedIn" duration="4"]Nội dung cần chuyển động[/wow]


//* Do NOT include this comment or the opening php tag above
//* Insert SPAN tag into widgettitle
add_filter( 'dynamic_sidebar_params', 'b3m_wrap_widget_titles', 20 );
function b3m_wrap_widget_titles( array $params ) {
        
        // $params will ordinarily be an array of 2 elements, we're only interested in the first element
        $widget =& $params[0];
        $widget['before_title'] = '<b class="widgettitle"><span class="sidebar-title">';
        $widget['after_title'] = '</span></b>';
        
        return $params;
        
}

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3433885844865!2d105.7863357149324!3d21.018941886003628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aba3c3aa3c97%3A0xc7ed60d62bbb599d!2zQ8O0bmcgdHkgTHXhuq10IEFsYWRpbg!5e0!3m2!1svi!2skr!4v1586430600911!5m2!1svi!2skr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

Redux::setSection( $opt_name, array(
    'title'            => __( 'Thư viện ảnh', 'shtheme' ),
    'id'               => 'slider-4',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'    =>'link-1',
            'type'  => 'text',
            'title' => __('Link ảnh', 'shtheme'),
        ),
    )
) );

array(
    'id'       => 'opt_image4',
    'type'     => 'media',
    'url'      => true,
    'title'    => __( 'Ship', 'shtheme' ),
    'compiler' => 'true',
),

<img src="<?php echo $sh_option['opt_image4']['url'] ?>" alt="<?php echo $sh_option['opt_image4']['url'] ?>">

<div class="slick-carousel list-products" 
	data-item="6" 
	data-item_md="6" 
	data-item_sm="4" 
	data-item_mb="2" 
	data-row="1" 
	data-dots="false" 
	data-arrows="true" 
	data-vertical="false">
		<?php global $sh_option; ?>
                <?php $i = 0; ?>
                <?php foreach( $sh_option['home-3'] as $slide ) : ?>
                <div class="item"> 
                <div class="image1"><img src="<?php echo $sh_option['home-3'][$i]['image']; ?>" alt=""/></div>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
	</div>


<?php if (qtranxf_getLanguage() == 'ngôn ngữ tưng ứng') {
    // do stuff
  }  ?>
<?php _e('[:vi]Việt[:en]Anh[:]') ?>


<h2 class="heading">
    <a>
        <?php if(pll_current_language() == 'vi') {
          echo 'Danh mục sản phẩm';
        } else {
            echo 'Product category';
        } ?>
            
    </a>
</h2>


echo '<h2 class="heading"><a title="'. get_dm_name( $idpost,'product_cat' ) .'" href="'. get_dm_link( $idpost,'product_cat' ) .'">'. get_dm_name( $idpost,'product_cat' ) .'</a><a class="xemtatca" title="'. get_dm_name( $idpost,'product_cat' ) .'" href="'. get_dm_link( $idpost,'product_cat' ) .'">Xem thêm <i class="fas fa-arrow-circle-right"></i></a></h2>';




function woo_rename_tabs( $tabs ) {
	$tabs['thongso']['title'] 		= __( 'Thông tin chi tiết', 'shtheme' );
	$tabs['thongso']['priority']		= 10;
	$tabs['thongso']['callback']		= 'content_tab_thongso';
	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );

function content_tab_thongso() {
	$thongsokythuat 	= get_field('thong_so_ky_thuat');
	if( $thongsokythuat ) {
		echo $thongsokythuat;
	} else {
		_e('Nội dung đang cập nhật...','shtheme');
	}

}


add_action( 'phpmailer_init', function( $phpmailer ) {
    if ( !is_object( $phpmailer ) )
    $phpmailer = (object) $phpmailer;
    $phpmailer->Mailer     = 'smtp';
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = 1;
    $phpmailer->Port       = 587;
    $phpmailer->Username   = 'trunggian06.web3b@gmail.com';
    $phpmailer->Password   = 'dikasolehngidckr';
    $phpmailer->SMTPSecure = 'TLS';
    $phpmailer->From       = 'trunggian06.web3b@gmail.com';
    $phpmailer->FromName   = 'Thiết kế web 3B - thietkeweb3b.com';
});



remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );


//MENU

<ul id="nav">
    <li>Home</li>
    <li class="parent">About
        <ul class="sub-nav">
            <li>Johnny</li>
            <li>Julie</li>
            <li>Jamie</li>
        </ul>
    </li>
    <li>Contact</li>
</ul>

<style type="">
    #nav ul.sub-nav {
        display: none;
    }

    #nav ul.visible {
        display: block;
    }
</style>
<script type="">
    $(document).ready(function() {
        $('.parent').click(function() {
            $('.sub-nav').toggleClass('visible');
        });
    });
</script>

<!--  -->

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
<style type="text/css">
    .sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 102px;
}
</style>



<?php 
	add_filter('use_block_editor_for_post', '__return_false');

	require get_template_directory() . '/template-page/custom-new.php';
 ?>

 <?php echo do_shortcode('[rev_slider alias="slider-1"]'); ?>

 <p><?php echo wp_trim_words( get_the_content(), 25, '.' ); ?></p>

 <?php dynamic_sidebar( 'siderbar-product' ); ?>

<?php echo mysql2date( 'F j, Y');  ?>

<?
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme options', 
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'theme-settings', 
		'capability'	=> 'edit_posts',
		'redirect'	=> false
	));
}



$(function() {
        $('a[href*=#]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 1000, 'linear');
        });
});




function test(){
	//echo "string";
	echo get_field("mua_sp","option");
}
add_action( 'woocommerce_single_product_summary', 'test', 32 );


//Khởi tạo function cho shortcode
function create_shortcode() {
    echo "Hello World!";
}
//Tạo shortcode tên là [test_shortcode] và sẽ thực thi code từ function create_shortcode
add_shortcode( 'test_shortcode', 'create_shortcode' );



function bbit() { if (!current_user_can('edit_themes') || !is_user_logged_in()) { wp_die(''); } } add_action('get_header', 'bbit');

<link rel="author" href="https://plus.google.com/u/0/111412027640655042572"/>
<a ></a>


<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/custom.css">

<script src="<?php bloginfo('template_directory'); ?>/assets/js/custom.js"></script>

$("video").click(function() {
  //console.log(this); 
  if (this.paused) {
    this.play();
  } else {
    this.pause();
  }
});

<!-- like FB -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=826865041012924&autoLogAppEvents=1"></script>
<div  class="fb-like text-right"  data-share="true"  data-width="500"  data-show-faces="true"></div>


// Thay doi logo admin wordpress
function login_css() {
wp_enqueue_style( 'login_css', get_template_directory_uri() . '/login.css' ); // duong dan den file css moi
}
add_action('login_head', 'login_css');

#login h1 a {
background: url("<a href="http://quocmarketing.com/wp-content/themes/henry/images/logo.png">images/logo.png</a>") no-repeat !important;
}

body.login {background:#008800}
.login #nav a, .login #backtoblog a {color:#fff!important;text-shadow:none;text-decoration:none}
.login #nav a:hover, .login #backtoblog a:hover {color:#ccc!important;


// Hook in
add_filter( 'woocommerce_checkout_fields' , 'my_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function my_override_checkout_fields( $fields ) {
     unset($fields['billing']['billing_phone']);
     return $fields;
}

	<!--  -->


/* Register Custom Post Type
Author: kiem
*/

function tao_custom_post_type()
{

    $label = array(
        'name' => 'Giới thiệu', 
        'singular_name' => 'Giới thiệu' 
    );
 
    $args = array(
        'labels' => $label, 
        'description' => 'Post type giới thiệu', 
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array( 'gioi_thieu', 'post_tag' ), 
        'hierarchical' => false, 
        'public' => true, 
        'show_ui' => true, 
        'show_in_menu' => true,
        'show_in_nav_menus' => true, 
        'show_in_admin_bar' => true, 
        'menu_position' => 5, 
        'menu_icon' => '', 
        'can_export' => true, 
        'has_archive' => true,
        'exclude_from_search' => false, 
        'publicly_queryable' => true, 
        'capability_type' => 'post' 
    );
 
    register_post_type('gioithieu', $args);
 
}

add_action('init', 'tao_custom_post_type');

add_filter('pre_get_posts','lay_custom_post_type');
function lay_custom_post_type($query) {
    if (is_home() && $query->is_main_query ())
        $query->set ('post_type', array ('post','gioithieu'));
    return $query;
}

function thue_xe_func() {
    $labels = array(
        'name'                  => _x( 'Sản phẩm', 'Post Type General Name', 'redsand' ),
        'singular_name'         => _x( 'Sản phẩm', 'Post Type Singular Name', 'redsand' ),
        'menu_name'             => __( 'Sản phẩm', 'redsand' ),
        'name_admin_bar'        => __( 'Sản phẩm', 'redsand' ),
        'archives'              => __( 'Item Archives', 'redsand' ),
        'attributes'            => __( 'Item Attributes', 'redsand' ),
        'parent_item_colon'     => __( 'Parent Item:', 'redsand' ),
        'all_items'             => __( 'All Items', 'redsand' ),
        'add_new_item'          => __( 'Add New Item', 'redsand' ),
        'add_new'               => __( 'Add New', 'redsand' ),
        'new_item'              => __( 'New Item', 'redsand' ),
        'edit_item'             => __( 'Edit Item', 'redsand' ),
        'update_item'           => __( 'Update Item', 'redsand' ),
        'view_item'             => __( 'View Item', 'redsand' ),
        'view_items'            => __( 'View Items', 'redsand' ),
        'search_items'          => __( 'Search Item', 'redsand' ),
        'not_found'             => __( 'Not found', 'redsand' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'redsand' ),
        'featured_image'        => __( 'Featured Image', 'redsand' ),
        'set_featured_image'    => __( 'Set featured image', 'redsand' ),
        'remove_featured_image' => __( 'Remove featured image', 'redsand' ),
        'use_featured_image'    => __( 'Use as featured image', 'redsand' ),
        'insert_into_item'      => __( 'Insert into item', 'redsand' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'redsand' ),
        'items_list'            => __( 'Items list', 'redsand' ),
        'items_list_navigation' => __( 'Items list navigation', 'redsand' ),
        'filter_items_list'     => __( 'Filter items list', 'redsand' ),
    );
    $rewrite = array(
        'slug'                  => _x('san-pham/%danhmuc_sanpham%','slug', 'redsand'), //Slug của trang chi tiết Sản phẩm
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Sản phẩm', 'redsand' ),
        'description'           => __( 'Post Type Description', 'redsand' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', ),
        'taxonomies'            => array( 'danhmuc_sanpham' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-cart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'san-pham', //Đường dẫn của archive
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'san_pham', $args );
}
add_action( 'init', 'thue_xe_func', 0 );
// Register Custom Taxonomy
function danhmuc_sanpham_func() {
    $labels = array(
        'name'                       => _x( 'Danh mục', 'Taxonomy General Name', 'redsand' ),
        'singular_name'              => _x( 'Danh mục', 'Taxonomy Singular Name', 'redsand' ),
        'menu_name'                  => __( 'Danh mục', 'redsand' ),
        'all_items'                  => __( 'All Items', 'redsand' ),
        'parent_item'                => __( 'Parent Item', 'redsand' ),
        'parent_item_colon'          => __( 'Parent Item:', 'redsand' ),
        'new_item_name'              => __( 'New Item Name', 'redsand' ),
        'add_new_item'               => __( 'Add New Item', 'redsand' ),
        'edit_item'                  => __( 'Edit Item', 'redsand' ),
        'update_item'                => __( 'Update Item', 'redsand' ),
        'view_item'                  => __( 'View Item', 'redsand' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'redsand' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'redsand' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'redsand' ),
        'popular_items'              => __( 'Popular Items', 'redsand' ),
        'search_items'               => __( 'Search Items', 'redsand' ),
        'not_found'                  => __( 'Not Found', 'redsand' ),
        'no_terms'                   => __( 'No items', 'redsand' ),
        'items_list'                 => __( 'Items list', 'redsand' ),
        'items_list_navigation'      => __( 'Items list navigation', 'redsand' ),
    );
    $rewrite = array(
        'slug'                       => _x('san-pham','slug', 'redsand'),
        'with_front'                 => true,
        'hierarchical'               => true,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'danhmuc_sanpham', array( 'san_pham' ), $args );
}
add_action( 'init', 'danhmuc_sanpham_func', 0 );



<script>
	jQuery(document).ready(function($) {
	// disable copy content
	 $("html").on("contextmenu",function(e){
      return false;
 	});
 	$('html').bind('cut copy', function (event) {
     event.preventDefault();
  	});
 });
</script>


@supports (-webkit-overflow-scrolling: touch) {
  .logo {
    margin-top: -40px;
}
}

@supports not (-webkit-overflow-scrolling: touch) {
  .logo {
    margin-top: 0;
} 
}

	
-webkit-line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
display: -webkit-box;


display: -webkit-box;
-webkit-line-clamp: 2;
overflow: hidden;
text-overflow: ellipsis;
-webkit-box-orient: vertical;

text-align: justify;

<!--  -->

overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
width: 200px;



white-space: nowrap;
text-overflow: ellipsis;
overflow: hidden;

// Enable WP_DEBUG mode
define( 'WP_DEBUG', true );
// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );
// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );
// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );


/home/9014-cmswebna/applications/cms/views/site/kopo/default
/home/9014-cmswebna/applications/cms/static/site/kopo/template/default/css


<a href="https://www.facebook.com/sharer/sharer.php?u=#url" target="_blank">Share</a>

# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]


</IfModule>

# END WordPress

# Wordfence WAF
<Files ".user.ini">
<IfModule mod_authz_core.c>
	Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
	Order deny,allow
	Deny from all
</IfModule>
</Files>

# END Wordfence WAF



<!-- SEARCH -->
<script type="text/javascript">
	// Search
    $('#toggle-search').click(function() {
        $('#search-form, #toggle-search').toggleClass('open');
        return false;
    });
    $('#search-form input[type=submit]').click(function() {
        $('#search-form, #toggle-search').toggleClass('open');
        return true;
    });
    $(document).click(function(event) {
        var target = $(event.target);
  
        if (!target.is('#toggle-search') && !target.closest('#search-form').size()) {
            $('#search-form, #toggle-search').removeClass('open');
        }
    });
</script>

<div class="header-icon">
	<div class="menu-search-header">
		<button id="toggle-search" class="header-button">
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/search.png">
		</button>
		<form id="search-form" action="<?php bloginfo('url'); ?>/" method="GET" role="form">
			<fieldset>
				<input type="text" name="s" placeholder="Tìm kiếm . . . " />
			</fieldset>
			<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
	</div>
	<?php do_action( 'sh_after_menu' );?>
</div>

<div class="row search-form-mobile">
	<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
		<div class="form-group">
			<input type="text" name="s" class="form-control" id="" placeholder="Tìm kiếm ...">
		</div>
		<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
	</form>
</div>

<style type="text/css">
	/*Search*/

#search-form {
	-moz-transition: max-height, 0.5s;
	-o-transition: max-height, 0.5s;
	-webkit-transition: max-height, 0.5s;
	transition: max-height, 0.5s;
	position: absolute;
	top: 60px;
	left: 0;
	width: 100%;
	max-height: 0;
	overflow: hidden;
}

#search-form.open {
	max-height: 35px;
	z-index: 1;
	background: no-repeat;

}

#search-form fieldset {
	position: relative;
	margin: 0 180px 0 0;
	padding: 0;
	border: none;
	float: right;

}

#search-form input {
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	display: block;
	height: 60px;
}

#search-form input[type="text"] {
	width: 100%;
	padding: 0 15px;
  	background: #fff;
  	border: 1px solid #ddd;
  	height: 35px;
}

#search-form button {
	position: absolute;
	bottom: 0;
	right: 0;
	width: 50px;
	margin: 0;
	padding: 0;
	font-weight: 700;
	text-transform: uppercase;
	color: #fff;
  	background: #0f2a51;
	border: none;
	cursor: pointer;
	height: 35px;
	margin-right: 130px;
}

.menu-search-header {

}

#toggle-search {
  	float: right;
  	border: none;
  	background: no-repeat;
}

.search-form-mobile {
  	display: none;
}

.header-icon {
	display: flex;

}

.header-user {
    float: right;
}

/*---- Responsive -----*/
@media (max-width: 767px) {
	/*Search*/
	.menu-search-header {
   	display: none;
}

 .header-icon {
  	position: absolute;
  	margin-top: 55px;
  	padding-left: 13px;
}

.search-form-mobile {
  	display: block !important;
  	float: right;
  	padding-right: 13px;
 	margin-top: 20px;
}

.search-form-mobile form {
  	display: flex;
  	margin-left: 15px;
}

.search-form-mobile .btn-primary {
  	height: 35px;
  	background: #0f2a51;

}
</style>


// Search

<body>
<nav>
    <ul>
        <li><a href="#link">Home</a></li>
        <li><a href="#link">News</a></li>
        <li><a href="#link">About</a></li>
        <li class="search">
            Search
            <div class="search-bar">
                <form>
                    <input type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </li>
    </ul>
</nav>
</body>

<style>
nav{
    background-color:#1abc9c;
}
nav ul{
    margin:0;
    padding:0;
    list-style-type:none;
}
nav li{
    display:inline-block;
}
nav li a{
    display:inline-block;
    text-decoration:none;
    color:white;
    padding:14px 16px;
}
.search{
    position:relative;
    display:inline-block;
    color:white;
    padding:14px 16px;
    float:right;
}
.search-bar{
    position:absolute;
    display:none;
    right:0;
    top:45px;
}
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 1px solid black;
    border-radius: 4px;
    font-size: 16px;
    outline:none;
    padding: 12px 14px;
    transition: width 0.4s ease-in-out;
}
nav li:hover{
    background-color:orange;
}
.search:hover{
    background-color:lightpink;
    color:black;
}
.search:hover .search-bar{
    display:block;
}
form input[type="text"]:focus{
    width:500px;
    background-color:lightpink;
}


// Camera
.BorderCorner::before {
    width: calc(100% + 50px + 4px - 120px);
    height: calc(100% + 4px);
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}

.BorderCorner::after {
    height: calc(100% + 50px + 4px - 120px);
    width: calc(100% + 4px);
    left: -2px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}