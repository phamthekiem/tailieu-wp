
<?php
$vnkings = new WP_Query(array(
'post_type'=>'post',
'post_status'=>'publish',
'cat' => id_của_category,
//thay id_của_category 
'orderby' => 'ID',
'order' => 'DESC',
'posts_per_page'=> 5));
?>
<?php $i=1; while ($vnkings->have_posts()) : $vnkings->the_post(); ?>
<?php if($i==1){ ?>
<div class="bai_dau_tien">
<a href="<?php the_permalink() ;?>" class="anh_bai_viet">
<?php the_post_thumbnail("thumbnail",array( "title" => get_the_title(),"alt" => get_the_title() ));?>
</a>
<a href="<?php the_permalink() ;?>" class="tieu_de_bai_viet"><?php the_title() ;?></a>
<p class="trich_dan">
<?php the_excerpt() ;?>
</p>
</div>
<?php } else { ?>
<div class="cac_bai_con_lai"><a href="<?php the_permalink() ;?>"><?php the_title() ;?></a> </div>
<?php } ?>
<?php $i++; endwhile ; wp_reset_query() ;?>

<!-- Get page -->

<?php
$nd_page = new WP_Query(array(
'post_type'=>'page',
'page_id'=> 1));
?>
<?php while ($nd_page->have_posts()) : $nd_page->the_post(); ?>
// nội dung bạn cần lấy : tiêu đề, nội dung, thông tin mô tả
<?php endwhile ; wp_reset_query() ;?>

<!-- --------------Hướng dẫn Woocommerce--------------- -->

w1. Hướng dẫn hiển thị sản phẩm trong giỏ hàng WooCommerce

<div class="top-cart-content pc">
	<?php global $woocommerce; ?>
	<?php $items = $woocommerce->cart->get_cart();?>
	<?php if(count($items) >= 1) { ?>
		<ul class="mini-products-list" id="cart-sidebar">
          <?php foreach ($items as $key => $value) { ?>
            <?php $cart_item_remove_url = wc_get_cart_remove_url($key); ?>
            <li class="item">
              <div class="item-inner">
                <a class="product-image" title="<?php echo get_the_title($value['product_id']); ?>" href="<?php echo get_permalink($value['product_id']); ?>">
                  <img alt="<?php echo get_the_title($value['product_id']); ?>" src="<?php echo hk_get_thumb($value['product_id'], 80, 80); ?>">
                </a>
                <div class="product-details">
                  <div class="access">
                    <a class="jtv-btn-remove" title="Remove This Item" href="<?php echo $cart_item_remove_url; ?>"><i class="fa fa-times"></i></a>
                    <a class="btn-edit" title="Edit item" href="<?php bloginfo('url'); ?>/gio-hang">
                      <i class="icon-pencil"></i><span class="hidden">Edit item</span></a>
                  </div>
                  <p class="product-name">
                    <a href="<?php echo get_permalink($value['product_id']); ?>">
                      <?php echo get_the_title($value['product_id']); ?>
                    </a>
                  </p>
                  <strong><?php echo $value['quantity']; ?></strong> x <span class="price"><?php echo number_format($value['line_total']/$value['quantity'],0,",","."); ?> đ</span>
                </div>
                <div class="clear"></div>
              </div>
            </li>
          <?php } ?>
        </ul>
        <div class="actions">
        	<div class="totel">
        		<div class="tong">
        			Tổng cộng:
        		</div>
        		<div class="tien"><?php echo WC()->cart->get_cart_total(); ?></div>
        		<div class="clear"></div>
        	</div>
        	<div class="riw">
        		<a href="<?php bloginfo('url'); ?>/thanh-toan"><span>Thanh Toán</span></a>
        		<a href="<?php bloginfo('url'); ?>/gio-hang"><span>Giỏ hàng</span></a>
        		<div class="clear"></div>
        	</div>    
        </div>
	<?php } else { ?>			
	<ul id="cart-sidebar" class="mini-products-list count_li">
		<div class="no-item"><p>Không có sản phẩm nào trong giỏ hàng.</p></div>
	</ul>
	<?php } ?>
</div>

<!--  -->

w2. Hiển thị sản phẩm mua nhiều trong WooCommerce

<?php
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 10,
		'meta_key' => 'total_sales',
		'orderby' => 'meta_value_num'
	);
?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<div class="item-product">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="price-product"><?php echo $product->get_price_html(); ?></div>
		<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata(); ?>

<!--  -->

w3. Search sản phẩm theo danh mục trong WooCommerce

<form action="/" method="GET" role="form">
	<div class="form-group">
		<select name="" id="product_cat" class="form-control" required="required">
			<option value="">Tất cả</option>
			<option value="slug1">Danh mục 1</option>
			<option value="slug2">Danh mục 2</option>
			<option value="slug3">Danh mục 3</option>
		</select>
	</div>
	<div class="form-group">
		<input type="text" name="s" id="s" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>
----
<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<input type="hidden" name="post_type" value="product">
	<div class="form-group">
		<?php $args = array(
			'show_option_all'    => '',
			'show_option_none' 	 => __( 'Danh mục' ),
			'option_none_value'  => '',
			'orderby'            => 'ID',
			'order'              => 'ASC',
			'show_count'         => 0,
			'hide_empty'         => 0,
			'child_of'           => 0,
			'include'            => '',
			'echo'               => 1,
			'selected'           => 0,
			'hierarchical'       => 1,
			'name'               => 'product_cat',
			'id'                 => 'product_cat',
			'class'              => 'form-control',
			'depth'              => 0,
			'tab_index'          => 0,
			'taxonomy'           => 'product_cat',
			'hide_if_empty'      => false,
			'value_field'	     => 'slug',
		); ?>
		<?php wp_dropdown_categories( $args ); ?> 
	</div>
	<div class="form-group">
		<input type="text" name="s" id="s" class="form-control" placeholder="Từ khóa">
	</div>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

<!--  -->

.W4. Hiển thị sản phẩm theo danh mục dạng tabs trong woocommerce

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">...</div>
  <div class="tab-pane container fade" id="menu1">...</div>
  <div class="tab-pane container fade" id="menu2">...</div>
</div>

---

<ul class="nav nav-tabs">
  	<li class="nav-item">
    	<a class="nav-link active" data-toggle="tab" href="#home">Tất cả</a>
  	</li>
  	<?php $args = array( 
	    'hide_empty' => 0,
	    'taxonomy' => 'product_cat',
	    'parent' => 0
	    ); 
	    $cates = get_categories( $args ); 
	    foreach ( $cates as $cate ) {  ?>
			<li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#<?php echo $cate->slug; ?>"><?php echo $cate->name; ?></a>
			</li>
	<?php } ?>
</ul>
<div class="tab-content">
	<div class="tab-pane container active" id="home">
		<?php
			$args = array( 
				'post_type' => 'product',
				'posts_per_page' => 8 
			); 
		?>
		<?php $getposts = new WP_query( $args);?>
		<?php global $wp_query; $wp_query->in_the_loop = true; ?>
		<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
		<?php global $product; ?>
			<div class="item-product">
				<a href="<?php the_permalink(); ?>">
					<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
				</a>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="price-product"><?php echo $product->get_price_html(); ?></div>
				<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
			</div>
		<?php endwhile; wp_reset_postdata();?>
	</div>
  	<?php $args = array( 
	    'hide_empty' => 0,
	    'taxonomy' => 'product_cat',
	    'parent' => 0
	    ); 
	    $cates = get_categories( $args ); 
	    foreach ( $cates as $cate ) {  ?>
			<div class="tab-pane container fade" id="<?php echo $cate->slug; ?>">
				<?php
					$args = array( 
						'post_type' => 'product',
						'posts_per_page' => 8,
						'product_cat' => $cate->slug
					); 
				?>
				<?php $getposts = new WP_query( $args);?>
				<?php global $wp_query; $wp_query->in_the_loop = true; ?>
				<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
				<?php global $product; ?>
					<div class="item-product">
						<a href="<?php the_permalink(); ?>">
							<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
						</a>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="price-product"><?php echo $product->get_price_html(); ?></div>
						<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
					</div>
				<?php endwhile; wp_reset_postdata();?>
			</div>
	<?php } ?>
  	
</div>

<!--  -->
<?php
$args = array(
    'type'      => 'post',
    'child_of'  => 0,
    'parent'    => ''
);
$categories = get_categories( $args );
foreach ( $categories as $category ) { ?>
     <?php echo $category->name ; ?>
<?php } ?>


<?php 
 
$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 
 
); 
 
?>

Trong đó: 

‘type’ là kiểu bài viết khi cài wordpress ban đầu thi sẽ có 2 kiểu đó là ‘post’ và ‘page’. Mặt nếu ko sử dụng điều kiện này thì nó sẽ nhận giá trị là ‘post’.
‘child_of’ sẽ nhận 2 giá trị là 1 hoặc 0, Nếu nhận giá trị là 1 thì nó chỉ lấy các danh mục có danh mục con. Nếu nó nhận giá trị là 0 thì nó sẽ lấy tất cả danh mục. Mặt định nó nhận giá trị là 0.
‘parent’ Sẽ nhận giá trị là id cha, Khi điền id cha vô đây nó sẽ list hết danh sách các chuyên mục con của parent.
‘orderby’ Giá trị này nó nghĩ là sắp xếp theo, giá trị nhận có thể là : id, name, slug, count, term_group. Mặc định nó sẽ nhận giá trị là name.
‘order’ Sẽ nhận 2 giá trị là: ASC hoặc DESC có nghĩ là sắp sếp theo giảm dân hoặc tăng dần. Mặt định nó là ASC.
‘hide_empty’  Sẽ nhận 2 giá trị là 1 hoặc 0, Nếu nhận giá trị 1 là nó sẽ không hiển thị các danh mục mà chưa có bài viết.
‘hierarchical‘ Có hiện thị danh mục theo dạng cây hay ko. Nếu có điền giá trị 1, nếu không thì giá trị 0
‘exclude’ Giá trị nhận ở đây là 1 mảng các id không muốn hiện thị trong chuyên mục.
‘include’ Giá trị nhận là 1 mảng id sẽ xuất hiện trong chuyên mục
‘number’ Số lượng danh mục muốn hiển thị.
 ‘pad_counts’

 $category->term_id
$category->name
$category->slug
$category->term_group
$category->term_taxonomy_id
$category->taxonomy
$category->description
$category->parent
$category->count
$category->cat_ID
$category->category_count
$category->category_description
$category->cat_name
$category->category_nicename
$category->category_parent

<!--  -->

<section class="company-product">
	<div class="container">
		<h2 class="heading">
			<?php _e('Sản phẩm của chúng tôi') ?>
		</h2>
		<div class="row">
			<?php $args = array( 
			    'hide_empty' => 0,
			    'taxonomy' => 'products_type',
			    'orderby' => 'id',
			    'parent' => 0
			    // 'child_of' => 0
			    ); 
			    $cates = get_categories( $args ); 
			    //$cates = get_terms( 'products_type' );
			    if ( ! empty( $cates ) && ! is_wp_error( $cates ) ) {
			    foreach ( $cates as $cate ) {  ?>
					<div class="col-md-2 col-6 cat-product-content">
						<a href="<?php echo get_term_link($cate->slug, 'products_type'); ?>">
							<?php 
								$image = get_field('field-image', $cate->taxonomy . '_' . $cate->term_id);
									echo '<img src="'.$image['url'].'" alt="image" />';
							 ?>
							<p>
								<?php echo $cate->name; ?>
								(<?php echo $cate->count; ?>)	
							</p>
						</a>
					</div>
			<?php } } ?>
			<a class="view-cate-product" href="http://mayraitham.com/san-pham/">Xem thêm &raquo; </a>
		</div>
	</div>
</section>


<!--  -->

W5. Hiển thị sản phẩm được đánh giá cao trong WooCommerce

<?php $args = array(
	'posts_per_page' => 10,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'meta_key'       => '_wc_average_rating',
	'orderby'        => 'meta_value_num',
	'order'          => 'DESC',
);?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
<?php 
  $rating_count = $product->get_rating_count();
  $review_count = $product->get_review_count();
  $average      = $product->get_average_rating();
?>
	<div class="item-product">
	  	<a href="<?php the_permalink(); ?>">
	   		<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
	  	</a>
	  	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	  	<div class="price-product"><?php echo $product->get_price_html(); ?></div>
	  	<?php if ( $rating_count > 0 ) : ?>
          <?php echo wc_get_rating_html( $average, $rating_count ); ?>
        <?php else: ?>
          <div class="star-rating">
            <span style="width:0%"><strong class="rating">0</strong> trên 5 dựa trên <span class="rating">0</span> đánh giá</span>
          </div>
        <?php endif; ?>
	  	<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata();?>

<!--  -->

w6. Hiển thị sản phẩm theo danh mục woocommerce và danh mục sản phẩm

- Lấy danh mục sản phẩm trong woocommerce

<ul>
<?php $args = array( 
    'hide_empty' => 0,
    'taxonomy' => 'product_cat',
    'orderby' => 'id',
    'parent' => 0
    ); 
    $cates = get_categories( $args ); 
    foreach ( $cates as $cate ) {  ?>
		<li>
			<a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><?php echo $cate->name; ?></a>
		</li>
<?php } ?>
</ul>

- Get danh mục sản phẩm có hình đại diện danh mục:

<ul>
<?php $args = array( 
    'hide_empty' => 0,
    'taxonomy' => 'product_cat',
    'orderby' => 'id',
    'parent' => 0
    ); 
    $cates = get_categories( $args ); 
    foreach ( $cates as $cate ) {  ?>
    	<?php 
    		$thumbnail_id = get_woocommerce_term_meta($cate->term_id, 'thumbnail_id', true );
		    $image = wp_get_attachment_url( $thumbnail_id );
    	?>
		<li>
			<img src="<?php echo $image; ?>" alt="<?php echo $cate->name; ?>">
			<a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><?php echo $cate->name; ?></a>
		</li>
<?php } ?>
</ul>

-- Hiển thị sản phẩm theo danh mục woocommerce

<?php
	$cat = 'danh-muc';
	$args = array( 
		'post_type' => 'product',
		'posts_per_page' => 10, 
		'product_cat' => $cat
	); 
?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<div class="item-product">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="price-product"><?php echo $product->get_price_html(); ?></div>
		<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata();?>

<!--  -->

w7. Hiển thị sản phẩm giảm giá WooCommerce (Sale products)

<?php $args = array( 
	'post_type' => 'product',
	'posts_per_page' => 10, 
	'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        )
    )
); ?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<div class="item-product">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="price-product"><?php echo $product->get_price_html(); ?></div>
		<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata();?>

--- Nếu trong trường hợp sản phẩm biến thể chúng ta sử dụng doạn code sau:

<?php $args = array( 
	'post_type' => 'product',
	'posts_per_page' => 10, 
	'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        ),
        array(
	        'key'           => '_min_variation_sale_price',
	        'value'         => 0,
	        'compare'       => '>',
	        'type'          => 'numeric'
	    )
    )
); ?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<div class="item-product">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="price-product"><?php echo $product->get_price_html(); ?></div>
		<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata();?>

<!--  -->

w8. Hiển thị sản phẩm nổi bật trong WooCommerce (featured products)

<?php
	$tax_query[] = array(
	    'taxonomy' => 'product_visibility',
	    'field'    => 'name',
	    'terms'    => 'featured',
	    'operator' => 'IN',
	);
?>
<?php $args = array( 'post_type' => 'product','posts_per_page' => 10,'ignore_sticky_posts' => 1, 'tax_query' => $tax_query); ?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<div class="item-product">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="price-product"><?php echo $product->get_price_html(); ?></div>
		<a href="<?php bloginfo('url'); ?>?add-to-cart=<?php the_ID(); ?>">Thêm vào giỏ</a>
	</div>
<?php endwhile; wp_reset_postdata(); ?>

<!--  -->

Code chuyển 0đ thành chữ “Liên hệ”

<?php 
	function devvn_wc_custom_get_price_html( $price, $product ) {
    if ( $product->get_price() == 0 ) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );
 
            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '<span class="amount">' . __( 'Liên hệ', 'woocommerce' ) . '</span>';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2 );

 ?>

<!--  -->

Chuyển giá thành “Liên hệ” khi hết hàng

<?php 
	function devvn_oft_custom_get_price_html( $price, $product ) {
    if ( !is_admin() && !$product->is_in_stock()) {
       $price = '<span class="amount">' . __( 'Liên hệ', 'woocommerce' ) . '</span>';
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_oft_custom_get_price_html', 99, 2 );
 ?>



<!-- ---------------Những đoạn code hay dùng trong lập trình theme woocommecre wordpress----------------------- -->


1. Code hiển thị 10 sản phẩm mới nhất.

<?php $args = array( 'post_type' => 'product','posts_per_page' =>10,); ?>
    <?php $getposts = new WP_query( $args);?>
    <?php global $wp_query; $wp_query->in_the_loop = true; ?>
    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
    <?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
	</li>
<?php endwhile;  wp_reset_postdata(); ?>

<!--  -->

2. Code hiển thị 10 sản phẩm theo danh mục sản phẩm

<?php $args = array( 'post_type' => 'product','posts_per_page' =>10, 'product_cat' => 'dien-thoai'); ?>
    <?php $getposts = new WP_query( $args);?>
    <?php global $wp_query; $wp_query->in_the_loop = true; ?>
    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
    <?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
	</li>
<?php endwhile;  wp_reset_postdata(); ?>

<!--  -->

3. Code hiển thị 10 sản phẩm nổi bật.

<?php $args = array( 'post_type' => 'product','posts_per_page' =>10, 'meta_key' => '_featured','meta_value' => 'yes',); ?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
	</li>
<?php endwhile;  wp_reset_postdata(); ?>

<!--  -->

4. Code hiển thị 10 sản phẩm giảm giá.

<?php $args = array( 
		'post_type' => 'product',
		'posts_per_page' => 10, 
		'meta_query'     => array(
        'relation' => 'OR',
            array(
                'key'           => '_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
            )
        )
    ); ?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
	</li>
<?php endwhile; wp_reset_postdata();?>

<!--  -->

5. Code hiển thị 10 sản phẩm xếp hạng đánh giá từ cao đến thấp

<?php $args = array(
		'posts_per_page' => 10,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'meta_key'       => '_wc_average_rating',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
	);?>
<?php $getposts = new WP_query( $args);?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
<?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
	</li>
<?php endwhile; wp_reset_postdata();?>

<!--  -->

6. Code hiển thị danh mục sản phẩm.

<?php $args = array( 
    'hide_empty' => 0,
    'taxonomy' => 'product_cat',
    'orderby' => id,
    'parent' => 0
    ); 
    $cates = get_categories( $args ); 
    foreach ( $cates as $cate ) {  ?>
		<li>
			<a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><?php echo $cate->name ?></a>
		</li>
<?php } ?>

<!--  -->

7. Code thêm sản phẩm vào giỏ hàng và hiện thị số lượng sản phầm đang có trong giỏ hàng.

// Code thêm sản phẩm vào giỏ hàng
<form action="" method="post">
	<input type="hidden" name="add-to-cart" value="<?php the_id(); ?>">
	<button class="addc"><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</button>
</form>
// Code hiển thị số lượng sản phẩm đang có trong giỏ hàng
<p>Giỏ hàng: <?php echo sprintf (_n( '%d Sản phẩm', '%d Sản phẩm', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></p>

Lưu ý: <?php the_id(); ?> là ID của sản phẩm cần thêm vào giỏ.

<!--  -->

8. Code tạo form tìm kiếm sản phẩm

<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<input type="hidden" name="post_type" value="product">
	<input type="text" class="form-control" id="name" name="s" placeholder="Nhập tên sản phẩm...">
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

Tìm kiếm sản phẩn với từ khóa và danh mục sản phẩm.

<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<input type="hidden" name="post_type" value="product">
	<input type="text" class="form-control" id="name" name="s" placeholder="Nhập tên sản phẩm...">
	<select name="product_cat" id="inputProduct_cat" class="form-control" required="required">
		<option value="">Chọn danh mục</option>
		<?php $args = array( 
		    'hide_empty' => 0,
		    'taxonomy' => 'product_cat',
		    'orderby' => id,
		    ); 
		    $cates = get_categories( $args ); 
		    foreach ( $cates as $cate ) {  ?>
				<option value="<?php echo $cate->slug; ?>"><?php echo $cate->name; ?></option>
		<?php } ?>
	</select>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

<!--  -->
9. Code lấy tất cả hình ảnh gallery của sản phẩm.

<?php
 	global $product;
 	$attachment_ids = $product->get_gallery_attachment_ids();
	foreach( $attachment_ids as $attachment_id ) {
  		echo $image_link = wp_get_attachment_url( $attachment_id );
	}
?>

<!--  -->

10. Code lấy phần trăm giảm giá của sản phẩm.

<?php if($product->is_on_sale() && $product->product_type == 'simple') : ?>
  <span class="label right label-info">
    <?php  $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
           echo $price . sprintf( __('%s', 'woocommerce' ), $percentage . '%' ); ?>
  </span>
<?php endif; ?>

<!--  -->
Thay đổi ký tự tiền tệ Đồng Việt Nam

<?php 
	add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
	function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch( $currency ) {
		case 'VND': $currency_symbol = 'VNĐ'; break;
		 	}
		return $currency_symbol;
	}
 ?>

<!--  -->

11. Code lấy nội dung mô tả ngắn, category, từ khóa của sản phẩm.

<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
// Lấy mô tả ngắn sản phẩm
<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Chuyên mục:', 'Chuyên mục:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</span>' ); ?>
// lấy chuyên mục sản phẩm
<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Từ khóa:', 'Từ khóa:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
// Lấy từ khóa sản phẩm

Nhưng đoạn code này chèn ở file single-product.php nhé!

<!--  -->

12. Code lấy 10 sản phẩm liên quan.

<?
global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 10,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related block-product">

		<h3 class="title-related"><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php global $product; ?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
					</a>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<?php echo $product->get_price_html(); ?>
				</li>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata(); ?>

// Chèn code này vào phần dưới của file single-product.php

<!-- //  -->

13. Code chèn share và like facebook, google cho chi tiết sản phẩm.

function woo_share_and_ontact_hk(){ ?>
	<div class="social-product">
		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
  		<g:plusone size="medium"></g:plusone>
	</div>
<?php }
add_action('woocommerce_single_product_summary', 'woo_share_and_ontact_hk', 60);
?>
<!-- Chèn vào file functions.php nhé -->

<!--  -->

14. Code chèn 5 sao cho sản phẩm hiện thị ở chi tiết sản phẩm.
<?
function woo_star_hk(){ ?>
	<p class="ster">
		<span><i class="fa fa-star"></i></span>
		<span><i class="fa fa-star"></i></span>
		<span><i class="fa fa-star"></i></span>
		<span><i class="fa fa-star"></i></span>
		<span><i class="fa fa-star"></i></span>
	</p>
<?php }
add_action('woocommerce_single_product_summary', 'woo_star_hk', 7);?>

<!--  -->

15. Lập trình theme woocommecre đang cập nhật…

<!--  -->

<!-- ----------------Lập trình THEME---------------------- -->

1.Code lấy bài viết mặt định.

<!-- Get post mặt định -->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php endwhile; else : ?>
<p>Không có</p>
<?php endif; ?>
<!-- Get post mặt định -->

<!--  -->

2.Code lấy 10 bài viết mới nhất theo category.

<!-- Get post News Query -->
<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=10&post_type=post&cat=1'); ?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
	
<?php endwhile; wp_reset_postdata(); ?>
<!-- Get post News Query -->

<!--  -->

3.Code lấy danh sách chuyên mục
<!-- Get category -->
<?php $args = array( 
    'hide_empty' => 0,
    'taxonomy' => 'category',
    'orderby' => id,
    ); 
    $cates = get_categories( $args ); 
    foreach ( $cates as $cate ) {  ?>
		<li>
			<a href="<?php echo get_term_link($cate->slug, 'category'); ?>"><?php echo $cate->name ?></a>
		</li>
<?php } ?>
<!-- Get category -->

<?php echo category_description( get_category_by_slug( 'du-an-tieu-bieu' )->term_id ); ?>

<!--  -->

4.Code tạo menu
<?
add_action( 'init', 'register_my_menus' );
function register_my_menus(){
	register_nav_menus(
	array(
		'main_nav' => 'Menu chính',
		'link_nav' => 'Liên kết',
		'info_nav' => 'Thông tin',
		)
	);
}?>

<!--  -->

5.Code get menu

<?php wp_nav_menu( 
  	array( 
      	'theme_location' => 'main_nav', 
      	'container' => 'false', 
      	'menu_id' => 'header-menu', 
      	'menu_class' => 'menu-main'
   	) 
); ?>

<!--  -->

6.Code tạo sidebar
<?
if (function_exists('register_sidebar')){
	register_sidebar(array(
	'name'=> 'Cột bên',
	'id' => 'sidebar',
	));
}?>

<!--  -->

7.Code get sidebar
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) : ?><?php endif; ?>

<!--  -->

8.Code phân trang.

<?php if(paginate_links()!='') {?>
<div class="quatrang">
	<?php
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
		) );
    ?>
</div>
<?php } ?>

<!--  -->

9.Code crop ảnh úp lên media
<?
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
     add_image_size( 'slider-thumb', 750, 375, true); 
     add_image_size( 'post-thumb', 300, 200, true);
     add_image_size( 'tour-thumb', 270, 200, true);
     add_image_size( 'video-thumb', 215, 130, true);
}?>

<!--  -->

10.Code lấy ảnh thumbnail

<!-- Get thumbnail -->
<?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' =>'thumnail') ); ?>
<!-- Get thumbnail -->

<!--  -->

11.Code bài viết liên quan

<!-- Hiển thị bài viết theo Tag -->
<div id="relatedposttags">    
    <?php
        $tags = wp_get_post_tags($post->ID);
        if ($tags) 
        {
            $tag_ids = array();
            foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
// lấy danh sách các tag liên quan
            $args=array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID), // Loại trừ bài viết hiện tại
            'showposts'=>5, // Số bài viết bạn muốn hiển thị.
            'caller_get_posts'=>1
            );
            $my_query = new wp_query($args);
            if( $my_query->have_posts() ) 
            {
                echo '<h3>Bài viết liên quan</h3><ul>';
                while ($my_query->have_posts()) 
                {
                    $my_query->the_post();
                    ?>
                    <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php
                }
                echo '</ul>';
            }
        }
    ?>
</div>

Hiển thị vài viết liên quan theo category

<?php
    $categories = get_the_category($post->ID);
    if ($categories) 
    {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
        $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>5, // Số bài viết bạn muốn hiển thị.
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) 
        {
            echo '<h3>Bài viết liên quan</h3><ul class="list-news">';
            while ($my_query->have_posts())
            {
                $my_query->the_post();
                ?>
                <li>
                	<div class="new-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(85, 75)); ?></a></div>
                	<div class="item-list">
                		<h4><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                		<?php the_excerpt(); ?>
                	</div>
                </li>
                <?php
            }
            echo '</ul>';
        }
    }
?>

2 đoạn code này thường được đặt dưới nội dung bài viết, tức phần dưới của file single.php

<!--  -->

12.Code tính lượt view cho bài viết
<?
function setpostview($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getpostviews($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}?>
<!-- Đây là code tính lượt view cho bài viết. Code này được đặt trong file functions.php -->

Sử dụng: 

Chèn code này vào trong file single.php
<?php
   setpostview(get_the_id());
?>

Hiển thị lượt view:
<?php
   echo getpostviews(get_the_id());
?>

<!--  -->

13.Code lấy nội dung bài viết rút gọn.
<?
function teaser($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'[...]';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt.'...';
}?>

Đây là code lấy nội dung bài viết được chỉ định số từ nhất định. Cách dùng <?php echo teaser(30); ?>, Với được code trên mình sẽ lấy 30 từ đầu tiên trong bài viết!

<!--  -->

14.Code lấy tất cả hình ảnh trong nội dung bài viết.
<?
function get_link_img_post(){
	global $post;
	preg_match_all('/src="(.*)"/Us',get_the_content(),$matches);
	$link_img_post = $matches[1];
	return $link_img_post;
}?>

<!--  -->

15.Code lấy custom filed

<?php 
	get_post_meta( $post_id, $key, $single );	
?>

<!--  -->

16.Code like box facebook

<div class="fb-page" data-href="https://facebook.com/huykiradotnet" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!--  -->

17.Code share bài viết liên mạng xã hội

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<span class="like">
	<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
  	<g:plusone size="medium"></g:plusone>
</span>
<span class="social-s">
	<a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
	<a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
</span>

<!--  -->

18.Code query bài viết theo custom filed

Query 1 custom filed.

<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'event',
	'meta_key'		=> 'location',
	'meta_value'	=> 'Melbourne'
);


// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	<ul>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('event_thumbnail'); ?>" />
				<?php the_title(); ?>
			</a>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

Query nhiều filed

<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'event',
	'meta_query'	=> array(
		'relation'		=> 'AND',
		array(
			'key'		=> 'location',
			'value'		=> 'Melbourne',
			'compare'	=> '='
		),
		array(
			'key'		=> 'attendees',
			'value'		=> 100,
			'type'		=> 'NUMERIC',
			'compare'	=> '>'
		)
	)
);


// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	<ul>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('event_thumbnail'); ?>" />
				<?php the_title(); ?>
			</a>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<!--  -->

19.Code lấy bài viết ngẫu nhiên.

<?php 
	$postquery = new WP_Query(array('posts_per_page' => 35, 'orderby' => 'rand'));
	if ($postquery->have_posts()) {
	while ($postquery->have_posts()) : $postquery->the_post();
	$do_not_duplicate = $post->ID;
?>
<li>
	<a href="<?php the_permalink();?>"><?php the_title();?></a>
</li>
<?php endwhile; }  wp_reset_postdata(); ?>

<!--  -->
19. lấy danh mục

<?php
$args = array(
    'type'      => 'post',
    'child_of'  => 0,
    'parent'    => ''
);
$categories = get_categories( $args );
foreach ( $categories as $category ) { ?>
     <?php ehco $category->name ; ?>
<?php } ?>


<?php 
 
$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 
 
); 
 
?>

<!--  -->

19.1 Code lấy bài viết theo danh mục

	<?php 
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'showposts' => 12, 
		'cat' => 1,
	);
?>
<?php $getposts = new WP_query($args); ?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
	<?php //các thành phần cần lấy  ?>
<?php endwhile; wp_reset_postdata(); ?>

<!--  -->

<?php 
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'landing',
		// 'showposts' => 1, 
		 'tax_query' => array(
		 	array(
		 	"taxonomy"=>'servicecat',
            'field'    => 'term_id',
            'terms'    => 106,	
            ))
	);
?>
<?php $query = new WP_query($args); ?>
<?php while ($query->have_posts()) : $query->the_post(); ?>
	<div class="khoi-nghiep-gd-left">
		<div><?php the_title(); ?></div>
		<?php the_content(); ?>
	</div>
<?php endwhile; wp_reset_postdata(); ?>

<!--  -->

<?php
$query = array(
 	'cat' => 1,
 	'post_status' => 'publish',
	'post_type' => 'post',
 )
 $the_query = new WP_Query($query);
  
 if($the_query->have_posts()):
 while ( $the_query->have_posts() ) : $the_query->the_post();

 the_title();

endwhile; endif;
wp_reset_postdata();
?>

<!--  -->

19.4 4: lấy nội dung của bài viết giới thiệu trong post_type page (Giả sử bài viết giới thiệu có id là 2)

<?php 
	$args = array(
		'post_status' => 'publish', // Chỉ lấy những bài viết được publish
		'post_type' => 'page', // số lượng bài viết
                'p' => 2,
	);
?>
<?php $getposts = new WP_query($args); ?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
	<?php //các thành phần cần lấy  ?>
<?php endwhile; wp_reset_postdata(); ?>

<?php 
	$args = array(
		'post_status' => 'publish', // Chỉ lấy những bài viết được publish
		'post_type' => 'page', // số lượng bài viết
                'p' => 2,
	);
?>
<?php $getposts = new WP_query($args); ?>
<?php global $wp_query; $wp_query->in_the_loop = true; ?>
<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
	<?php //các thành phần cần lấy  ?>
<?php endwhile; wp_reset_postdata(); ?>

<!--  -->

19.99 Code lấy bài viết trong post type

<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=15&post_type=thue_xe'); ?>
		<?php global $wp_query; $wp_query->in_the_loop = true; ?>
		<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
			<?php   ?>
			
<?php endwhile; wp_reset_postdata(); ?>


<!--  -->
20.Code lấy 10 comment mới nhất.

<?php
	$cmt = get_comments(array( 
		'status' => 'approve',
		'number'=> 10,
	));
?>
<div class="content-w content-news">
	<ul>
		<?php foreach ($cmt as $value) { ?>
		<li>
			<a href="<?php the_permalink($value->comment_post_ID);?>#comment-<?php echo $value->comment_ID; ?>"><?php echo get_avatar($value->comment_author_email, 150 ); ?></a> 
			<a href="<?php the_permalink($value->comment_post_ID); ?>#comment-<?php echo $value->comment_ID; ?>"><?php echo $value->comment_author; ?></a> - <span style="color: #cd8a35;font-size: 12px;"><?php echo $value->comment_date; ?></span>
			<p style="font-size: 13px;"><?php echo cuttitle($value->comment_content); ?></p>
			<div class="clear"></div>
		</li>
		<?php } ?>
	</ul>
</div>

<!--  -->

21.Code comment bằng facebook cho wordpress 

<div class="cmt">
	<div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="3"></div>
</div>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=750688268378229";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!--  -->

22. Code tạo 1 sortcode đơn giản trong wordpress
<?
function create_shortcode_randompost() {
 
        $random_query = new WP_Query(array(
                'posts_per_page' => 10,
                'orderby' => 'rand'
        ));
 
        ob_start();
        if ( $random_query->have_posts() ) :
                "<ol>";
                while ( $random_query->have_posts() ) :
                        $random_query->the_post();?>
 
                                <li><a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a></li>
 
                <?php endwhile;
                "</ol>";
        endif;
        $list_post = ob_get_contents(); //Lấy toàn bộ nội dung phía trên bỏ vào biến $list_post để return
 
        ob_end_clean();
 
        return $list_post;
}
add_shortcode('random_post', 'create_shortcode_randompost');?>

Đây là sortcode list ra 10 vài viết ngẫu nhiên. Cách dùng là:
<?php 
	echo do_shortcode('[random_post]');
?>

<!--  -->

23. Code tự động lưu ảnh về host khi copy bài từ nguồn khác.
<?
class Auto_Save_Images{
 
    function __construct(){     
        
        add_filter( 'content_save_pre',array($this,'post_save_images') ); 
    }
    
    function post_save_images( $content ){
        if( ($_POST['save'] || $_POST['publish'] )){
            set_time_limit(240);
            global $post;
            $post_id=$post->ID;
            $preg=preg_match_all('/<img.*?src="(.*?)"/',stripslashes($content),$matches);
            if($preg){
                foreach($matches[1] as $image_url){
                    if(empty($image_url)) continue;
                    $pos=strpos($image_url,$_SERVER['HTTP_HOST']);
                    if($pos===false){
                        $res=$this->save_images($image_url,$post_id);
                        $replace=$res['url'];
                        $content=str_replace($image_url,$replace,$content);
                    }
                }
            }
        }
        remove_filter( 'content_save_pre', array( $this, 'post_save_images' ) );
        return $content;
    }
    
    function save_images($image_url,$post_id){
        $file=file_get_contents($image_url);
        $post = get_post($post_id);
        $posttitle = $post->post_title;
        $postname = sanitize_title($posttitle);
        $im_name = "$postname-$post_id.jpg";
        $res=wp_upload_bits($im_name,'',$file);
        $this->insert_attachment($res['file'],$post_id);
        return $res;
    }
    
    function insert_attachment($file,$id){
        $dirs=wp_upload_dir();
        $filetype=wp_check_filetype($file);
        $attachment=array(
            'guid'=>$dirs['baseurl'].'/'._wp_relative_upload_path($file),
            'post_mime_type'=>$filetype['type'],
            'post_title'=>preg_replace('/\.[^.]+$/','',basename($file)),
            'post_content'=>'',
            'post_status'=>'inherit'
        );
        $attach_id=wp_insert_attachment($attachment,$file,$id);
        $attach_data=wp_generate_attachment_metadata($attach_id,$file);
        wp_update_attachment_metadata($attach_id,$attach_data);
        return $attach_id;
    }
}
new Auto_Save_Images();?>

<!--  -->

24. Code lấy ảnh đầu tiên trong bài viết làm ảnh đại diện
<?
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
 
  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg"; //Duong dan anh mac dinh khi khong tim duoc anh dai dien
  }
  return $first_img;
}?>

Cách sử dùng: Chèn đoạn code nào vào khu vực muốn hiển thị hình đại diện.
<img src="<?php echo catch_that_image() ?>" />

<!--  -->

25. Một số form tìm kiếm đơn giản.

Tìm kiếm theo từ khóa.
<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<div class="form-group">
		<input type="text" name="s" class="form-control" id="" placeholder="Từ khóa">
	</div>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

Tìm kiếm theo 1 post_type nhất định với từ khóa.
<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<input type="hidden" name="post_type" value="page">
	<div class="form-group">
		<input type="text" name="s" class="form-control" id="" placeholder="Từ khóa">
	</div>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

Tìm kiếm theo từ khóa kết hợp với category.
<form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
	<div class="form-group">
		<input type="text" name="s" class="form-control" id="" placeholder="Từ khóa">
	</div>
	<div class="form-group">
		<select name="cat" id="input" class="form-control" required="required">
			<option value="">Chọn chuyên mục</option>
			<?php $args = array( 
			    'hide_empty' => 0,
			    'taxonomy' => 'category',
			    'orderby' => id,
			    'parent' => 0
			    ); 
			    $cates = get_categories( $args ); 
			    foreach ( $cates as $cate ) {  ?>
					<option value="<?php echo $cate->term_id ?>"><?php echo $cate->name; ?></option>
			<?php } ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>

<!--  -->

25. Code lấy 8 bài viết xem nhiều:

<div class="widget">
	<h3>
		Bài viết xem nhiều
	</h3>
	<div class="content-w">
		<ul>
			<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=8&post_type=post&meta_key=views&orderby=meta_value_num'); ?>
			<?php global $wp_query; $wp_query->in_the_loop = true; ?>
			<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
				<li>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				</li>
			<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
</div>


<!-- -------------------------------------- -->

Những hàm cơ bản trong wordpress