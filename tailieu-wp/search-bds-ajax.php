
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="box-text-search order-lg-1">
		<input type="search" class="search-field"
		placeholder="<?php echo esc_attr_x( 'Từ khóa…', 'placeholder' ) ?>"
		value="<?php echo get_search_query() ?>" name="s"
		title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"
		autocomplete="off" />
	</div>
	<div class="box-loainha order-lg-3 glg15">
		<select name="loai_nha_dat">
			<?php 
			echo '<option value="all">Chọn loại nhà đất</option>';
			$terms = get_terms( array(
				'taxonomy' => 'loai_nha_dat',
				'hide_empty' => true,
				'parent' => 0
			) );	
			foreach ($terms  as $term ) {
				?>
				<option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
				<?php 
			}
			?>
		</select>
	</div>
	<div class="tinh_tp order-lg-4 glg15">
		<select name="tinh_tp">
			<?php 
			echo '<option value="all" data-idp="-1">Chọn Huyện/Thành Phố</option>';
			$terms = get_terms( array(
				'taxonomy' => 'dia_diem',
				'hide_empty' => true,
				'parent' => 0
			) );	
			foreach ($terms  as $term ) {
				?>
				<option data-idp="<?=$term->term_id?>" value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
				<?php 
			}
			?>
		</select>
	</div>
	<div class="box-xahuyen order-lg-5 glg15">
		<select name="xa_huyen">
			<?php 
			echo '<option value="all">Chọn xã phường</option>';

			?>
		</select>
	</div>
	<div class="box-kiem order-lg-6 glg15">
		<select name="huong_nha">
			<?php 
			echo '<option value="all">Chọn hướng nhà</option>';

			?>

			<?php
			$kiem ='';
			$field = get_field_object('kiem');
			$choices = $field['choices'];
			$field_key = "field_5bced3bd459f2";
			$field = get_field_object($field_key);
            //var_dump($field['choices']);
			if( $field )
			{
				foreach( $field['choices'] as $k => $v )
				{
					if (isset($_GET['huong_nha'])) {
						if ($k == $_GET['huong_nha'])
						{
							$kiem = 'selected';
						}
					}
					echo '<option value="' . $k . '"'.$kiem.' >' . $v . '</option>';
				}
			}			
			?>
		</select>
	</div>
	<div class="box-gia-thap order-lg-7 glg15">
		<select name="giathap">
			<option value="0">Giá thấp nhất</option>
			<option value="500000000">500 Triệu</option>
			<option value="1000000000">1 Tỷ</option>
			<option value="1500000000">1.5 Tỷ</option>
			<option value="2000000000">2 Tỷ</option>
			<option value="2500000000">2.5 Tỷ</option>
		</select>
	</div>
	<div class="box-gia-cao order-lg-8 glg15">
		<select name="giacao">
			<option value="0">Giá thấp nhất</option>
			<option value="500000000">500 Triệu</option>
			<option value="1000000000">1 Tỷ</option>
			<option value="1500000000">1.5 Tỷ</option>
			<option value="2000000000">2 Tỷ</option>
			<option value="2500000000">2.5 Tỷ</option>
			<option value="3000000000">3 Tỷ</option>
			<option value="3500000000">3.5 Tỷ</option>
			<option value="4000000000">4 Tỷ</option>
			<option value="4500000000">4.5 Tỷ</option>

		</select>
	</div>
	<div class="box-sub order-lg-2 ">
		<input type="submit" class="search-submit"
		value="<?php echo esc_attr_x( 'Tìm kiếm', 'submit button' ) ?>" />
	</div>
</form>


<?php 
function my_scripts_method() {
	wp_enqueue_script(
		'ajax_script',
		get_stylesheet_directory_uri() . '/vendor/ajax-script.js',
		array( 'jquery' )
	);
	wp_localize_script('ajax_script', 'WPURLS', array(
		'siteurl' => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


function ajax_danhmuc()
{
	ob_start();

	echo '<option value="all">Chọn xã phường</option>';

	if ($_POST['id'] == -1) {

	}
	else
	{
		$terms = get_terms( array(
			'taxonomy' => 'dia_diem',
      'hide_empty' => true, // có dữ liệu thì mới in ra
      'parent' => $_POST['id'] // id danh mục cha
      // 'exclude' => array($_POST['id']),
  ) );	
	}
	foreach ($terms  as $term ) {
		?>
		<option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>

		<?php 
	}
	$result = ob_get_clean();
	wp_send_json_success($result);
	die();
}
add_action('wp_ajax_ajax_danhmuc', 'ajax_danhmuc'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_danhmuc', 'ajax_danhmuc'); // wp_ajax_nopriv_{action}

?>

<script type="text/javascript">
	(function($) {

		$(document).ready(function() {


			$( "select[name='tinh_tp']" ).change(function() {
      console.log($(this).find(':selected').attr('data-idp')) ; // lấy data idp

      data = {
        'action': 'ajax_danhmuc', //tên action ajax
        'id' :$(this).find(':selected').attr('data-idp')
    };
    $.ajax({
    	url: WPURLS.siteurl, 
    	data: data,
    	dataType : "json",
    	type: 'POST',

    	beforeSend: function(xhr) {

    		console.log('ajax chay');

    	},
    	success: function(data) {
    		if (data) {
    			console.log(data);
          $('select[name="xa_huyen"]').html(data.data);//in dữ liệu vào select này
      }
  }
});
});

		})
	})(jQuery);
</script>

<style type="text/css">
	form.search-form {
		padding: 20px 0;
		display: flex;
		flex-wrap: wrap;
	}


	form.search-form input,form.search-form select {
		width: 100%;
	}

	@media screen and (min-width: 991px)
	{
		.box-text-search {
			width: 80%;
			margin-right: 10px;
			margin-bottom: 5px;
		}
		.box-sub {
			width: 15%;
		}

		.box-sub input {
			padding: 7px;
			background-color: #088f08;
			color: #fff;
			font-size: 16px;
		}
		.glg15 {
			width: 15%;
			margin-right: 13px;
		}

		.glg15 input, .glg15 select {
			padding: 5px;
			width: 100%;
		}

		.glg15:last-child {
			margin-right: 0;
		}

		.box-gia-cao {margin-right: 0;}
	}
</style>