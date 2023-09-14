<?php 
/* Template Name: Đăng Nhập */ 

get_header(); ?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php if(is_user_logged_in()) { $user_id = get_current_user_id();$current_user = wp_get_current_user();$profile_url = get_author_posts_url($user_id);$edit_profile_url  = get_edit_profile_url($user_id); ?>
			    <div class="regted">
			    Bạn đã đăng nhập với tên tài khoản <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Bạn có muốn <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Thoát</a> không ?
			    </div>
			<?php } else { ?>
			<div class="formdangnhap">
			    <?php wp_login_form(); ?>
			</div>
			<?php } ?>

		</main><!-- #main -->
		
		<?php do_action( 'sh_after_content' );?>

	</div><!-- #primary -->

<?php
get_footer();