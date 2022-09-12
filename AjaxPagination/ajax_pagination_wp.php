<?php
function gco_corenavi_ajax($custom_query = null, $paged = 1) {
    global $wp_query, $wp_rewrite;
    if($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
    if($total > 1) echo '<div class="paginate_links">';
    echo paginate_links( array(
        'base'        => trailingslashit( home_url() ) . "{$wp_rewrite->pagination_base}/%#%/",
        'format'   => '?paged=%#%',
        'current'  => max( 1, $paged ),
        'total'    => $total,
        'mid_size' => '5',
        'prev_text'    => __('&#10094;','gco'),
        'next_text'    => __('&#10095;','gco'),
    ) );
    if($total > 1) echo '</div>';
}

//Ajax load post
add_action( 'wp_ajax_ajax_load_post', 'ajax_load_post_func' );
add_action( 'wp_ajax_nopriv_ajax_load_post', 'ajax_load_post_func' );
function ajax_load_post_func() {
    $paged = isset($_POST['ajax_paged'])?intval($_POST['ajax_paged']):'';
    if($paged <= 0 || !$paged || !is_numeric($paged)) wp_send_json_error('Paged?');
    $recruit = new WP_Query(array(
        'post_type'         =>  'tuyen-dung',
        'posts_per_page'    =>  7,
        'post_status' => 'publish',
        'paged'             =>  $paged
    ));
    if($recruit->have_posts()) :
        ob_start();
        $max_post_count = $recruit->post_count;
        $i = 1;
    ?>
        
    <div class="list__job home_news_wrap">
        <?php $stt = 1; while ($recruit->have_posts()):$recruit->the_post(); ?>
        
        <div class="list__job-item">
            <div class="job__item-box">
                <div class="job__item-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a> 
                    <?php if ( $i <= 5 ) {   ?>
                        <span class="tag">
                            new
                        </span>
                    <?php } $i++; ?>
                </div>
                
                <div class="jinfo">
                    <div class="jinfo-item has-icon ic-time">
                        <div class="ic-inner">
                            <time>
                                <?php the_time('d/m/Y'); ?>
                            </time>
                        </div>
                    </div>
                    <div class="jinfo-item has-icon ic-add">
                        <div class="ic-inner">
                        <?php 
                            $args = array( 
                                'hide_empty' => 0,
                                'post_type' => 'tuyen-dung',
                                'taxonomy' => 'noi-lam-viec',
                            ); 
                            $cates = get_categories( $args ); 
                            foreach ( $cates as $cate ) {  
                        ?>
                           
                                <?php echo $cate->name; ?>
                            
                        <?php } ?>
                        </div>
                    </div>
                    <?php if ( get_field('work-time') ) { ?>
                        <div class="jinfo-item">
                          
                                <?php the_field('work-time'); ?>
                           
                        </div>
                    <?php } ?>
                    <?php if ( get_field('wage') ) { ?>
                    <div class="jinfo-item">
                            Lương:
                            <b>
                                <?php the_field('wage'); ?>
                            </b>
                        
                    </div>
                    <?php } ?>
                </div>
                
            </div>
            <a href="<?php the_permalink(); ?>" class="btn btn__view">
                Chi tiết
            </a>
        </div>
        
        <?php if($stt == 1 || $stt == $max_post_count):?><?php endif; ?>
        <?php $stt++; endwhile; wp_reset_query();?>
    </div>
        
    <?php gco_corenavi_ajax( $recruit, $paged ); ?>
    <?php $content = ob_get_clean(); ?>
    <?php else: ?>
        <?php wp_send_json_error('No post?'); ?>
    <?php endif; //End news
    wp_send_json_success($content);
    die();
}

/**
 * Pagination Tab
 */


/**
 * Load JS
 */
add_action( 'wp_enqueue_scripts', 'gco_enqueue_UseAjaxInWp' );
function gco_enqueue_UseAjaxInWp(){
    wp_enqueue_script( 'gco-ajaxload', esc_url( trailingslashit( get_template_directory_uri() ) . 'inc/AjaxPagination/ajax_pagination.js' ), array( 'jquery' ), '1.0', true );
    $php_array = array(
        'admin_ajax'      => admin_url( 'admin-ajax.php'),
        'load_post_nonce'   =>  wp_create_nonce('ajax_load_post_nonce'),
    );
    wp_localize_script( 'gco-ajaxload', 'gco_array', $php_array );
}
