/*--------------------------------*/

1.Hướng dẫn ajax trong wordpress

Phía front end:
– Hiển thị button để click
<div class="content-widget">
    <button class="call-ajax">Bài viết ngẫu nhiên</button>
    <div class="display-post"></div>
</div>

– Gởi dữ liệu cho server và nhận giá trị trả về!
<?php
$(document).ready(function(){
    $('.call-ajax').click(function(){ // Khi click vào button thì sẽ gọi hàm ajax
        $.ajax({ // Hàm ajax
           type : "post", //Phương thức truyền post hoặc get
           dataType : "html", //Dạng dữ liệu trả về xml, json, script, or html
           url : "<?php echo admin_url('admin-ajax.php'); ?>", // Nơi xử lý dữ liệu
           data : {
                action: "random", //Tên action, dữ liệu gởi lên cho server
           },
           beforeSend: function(){
                // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
           },
           success: function(response) {
                //Làm gì đó khi dữ liệu đã được xử lý
                $('.display-post').html(response); // Đổ dữ liệu trả về vào thẻ &lt;div class="display-post"&gt;&lt;/div&gt;
           },
           error: function( jqXHR, textStatus, errorThrown ){
                //Làm gì đó khi có lỗi xảy ra
                console.log( 'The following error occured: ' + textStatus, errorThrown );
           }
       });
    });
});
?>

Phía back end:
<?php 
 add_action('wp_ajax_random', 'random_function');
 add_action('wp_ajax_nopriv_random', 'random_function');
 function random_function() {
    echo '<ul>';
       $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=5&orderby=rand');
       global $wp_query; $wp_query->in_the_loop = true;
       while ($getposts->have_posts()) : $getposts->the_post();
          echo '<li>';
          echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
          echo '</li>';
       endwhile; wp_reset_postdata();
    echo '</ul>';
die(); }
?>

2.Load bài viết ngẫu nhiên sử dụng ajax trong wordpress

Code chức năng ở phía front end:
<div class="content-widget">
   <button class="call-ajax">Bài viết ngẫu nhiên</button>
   <input type="number" class="number_post" placeholder="Nhập số lượng bài viết">
   <div class="display-post"></div>
</div>

<?php 
	$(document).ready(function(){
   $('.call-ajax').click(function(){ // Khi click vào button thì sẽ gọi hàm ajax
     var number = $('.number_post').val(); // lấy số bài viết trong thẻ input
     $.ajax({ // Hàm ajax
       type : "post", //Phương thức truyền post hoặc get
       dataType : "html", //Dạng dữ liệu trả về xml, json, script, or html
       url : "<?php echo admin_url('admin-ajax.php'); ?>", // Nơi xử lý dữ liệu
       data : {
         action: "random", //Tên action, dữ liệu gởi lên cho server
         number: number, // Gởi số lượng bài viết cần lấy lên server
       },
       beforeSend: function(){
          // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
       },
       success: function(response) {
         //Làm gì đó khi dữ liệu đã được xử lý
         $('.display-post').html(response); // Đổ dữ liệu trả về vào thẻ <div class="display-post"></div>
      },
      error: function( jqXHR, textStatus, errorThrown ){
         //Làm gì đó khi có lỗi xảy ra
         console.log( 'The following error occured: ' + textStatus, errorThrown );
      }
    });
  });
});
 ?>

Code chức năng ở phía server:

<?php 
	add_action('wp_ajax_random', 'random_function');
	add_action('wp_ajax_nopriv_random', 'random_function');
	function random_function() {
	   $number = isset($_POST['number']) ? (int)$_POST['number'] : 0;
	   echo '<ul>';
	      $getposts = new WP_query(); $getposts->query('post_status=publish&showposts='.$number.'&orderby=rand');
	      global $wp_query; $wp_query->in_the_loop = true;
	      while ($getposts->have_posts()) : $getposts->the_post();
	         echo '<li>';
	         echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
	         echo '</li>';
	      endwhile; wp_reset_postdata();
	   echo '</ul>';
	   die(); 
	}
 ?>

3.Get bài viết theo chuyên mục sử dụng ajax trong wordpress

Xử lý code bên phía front end:
Code list tất cả danh mục bài viết:
<ul>
	<?php $args = array( 
	 	'hide_empty' => 0,
	 	'taxonomy' => 'category',
	 	'orderby' => 'id',
	); 
	$cates = get_categories( $args ); 
	foreach ( $cates as $cate ) { ?>
	    <li class="list-cat" data-id="<?php echo $cate->term_id; ?>">
	        <?php echo $cate->name ?>
	    </li>
	<?php } ?>
	</ul>
<div class="display-post"></div>

Để lấy bài viết theo chuyên mục thì chúng ta phải gởi cho server 2 thành phần đó là action và id của chuyên mục đó.
<?php 
	$(document).ready(function(){
   $('.list-cat').click(function(){ // Khi click vào category bất kỳ
   var cat_id = $(this).data('id'); // lấy id của category đó thông qua data-id
   $.ajax({ // Hàm ajax
      type : "post", //Phương thức truyền post hoặc get
      dataType : "html", //Dạng dữ liệu trả về xml, json, script, or html
      url : '<?php echo admin_url("admin-ajax.php");?>', // Nơi xử lý dữ liệu
      data : {
         action: "getpost", //Tên action, dữ liệu gởi lên cho server
         cat_id: cat_id, //Gởi id chuyên mục cho server
      },
      beforeSend: function(){
        // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
      },
      success: function(response) {
         $('.display-post-cat').html(response); // Đổ dữ liệu trả về vào thẻ <div class="display-post"></div>
      },
      error: function( jqXHR, textStatus, errorThrown ){
         //Làm gì đó khi có lỗi xảy ra
         console.log( 'The following error occured: ' + textStatus, errorThrown );
      }
   });
   });
});
 ?>

Xử lý code bên phía backend (server):
<?php 
	add_action('wp_ajax_getpost', 'get_post_by_catid');
	add_action('wp_ajax_nopriv_getpost', 'get_post_by_catid');
	function get_post_by_catid() {
	    $cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;
	    echo '<ul>';
	       $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=-1&cat='.$cat_id);
	       global $wp_query; $wp_query->in_the_loop = true;
	       while ($getposts->have_posts()) : $getposts->the_post();
	          echo '<li>';
	          echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
	          echo '</li>';
	       endwhile; wp_reset_postdata();
	    echo '</ul>';
	    die(); 
	}

 ?>


4.Xây dựng chức năng load more content trong wordpress sử dụng ajax

Code chức năng load more content trong wordpress:

<ul class="list-new">
	<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=10'); ?>
	<?php global $wp_query; $wp_query->in_the_loop = true; ?>
	<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
<button class="load-more">Xem thêm</button>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function(){
		var offset = 10; // khái báo số lượng bài viết đã hiển thị
	    $('.load-more').click(function(event) {
	    	$.ajax({ // Hàm ajax
	            type : "post", //Phương thức truyền post hoặc get
	            dataType : "html", //Dạng dữ liệu trả về xml, json, script, or html
	            async: false,
	            url : '<?php echo admin_url('admin-ajax.php');?>', // Nơi xử lý dữ liệu
	            data : {
	                action: "loadmore", //Tên action, dữ liệu gởi lên cho server
	                offset: offset, // gởi số lượng bài viết đã hiển thị cho server
	            },
	            beforeSend: function(){
	                // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
	            },
	            success: function(response) {
	                $('.list-new').append(response);
	                offset = offset + 5; // tăng bài viết đã hiển thị
	            },
	            error: function( jqXHR, textStatus, errorThrown ){
	                //Làm gì đó khi có lỗi xảy ra
	                console.log( 'The following error occured: ' + textStatus, errorThrown );
	            }
	       });
	    });
	});
</script>

Đoạn code xử lý dữ liệu phía server

<?php 
	add_action('wp_ajax_loadmore', 'get_post_loadmore');
	add_action('wp_ajax_nopriv_loadmore', 'get_post_loadmore');
	function get_post_loadmore() {
	    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0; // lấy dữ liệu phái client gởi
	    $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=5&offset='.$offset);
	    global $wp_query; $wp_query->in_the_loop = true; 
	    while ($getposts->have_posts()) : $getposts->the_post(); ?>
	    	<li>
	    		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	    	</li>
	    <?php endwhile; wp_reset_postdata();
		die(); 
	}
 ?>