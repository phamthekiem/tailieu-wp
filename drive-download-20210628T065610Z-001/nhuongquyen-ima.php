<?php
/* Template Name: Nhượng quyền */
get_header();
the_post();
?>


<?php if(get_post_meta($post->ID, 'boc_sidebarimg',true)){ ?>
<div class="banner" style="background-image:url('<?php echo get_post_meta($post->ID, 'boc_sidebarimg',true); ?>');">
<?php } else{ ?>
<div class="banner" style="background-image:url('http://v2.dichvuquantri.com/imavietnam/wp-content/uploads/2020/01/35-_DSC0564-3.jpg');">
<?php } ?>
<div class="overlay"></div>
	<div class="container">
		<?php if (is_singular('post')) { ?>
		<h2>Liên hệ</h2>
		<?php } else{ ?>
		<h1><?php the_title(); ?></h1>
		<?php } ?>
	</div>
</div>
<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
	<div class="container">
		<div class="section">
          
          <!-- FB -->
          <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=826865041012924&autoLogAppEvents=1"></script>
          <div  class="fb-like text-right"  data-share="true"  data-width="450"  data-show-faces="true"></div>
          <br>
			<?php the_content(); ?>
              
              <div class="comment">
                <br/>
                <br/>
                    <h3>Bình Luận</h3>
                    <div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="5"></div>
            </div>
                    
	</div>
</div>
<!-- Post :: END -->	  

	



<?php
get_footer();
?>
