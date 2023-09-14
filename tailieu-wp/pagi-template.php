<?php 

/* Template Name: Blog*/
    get_header();

 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="rst-main-content rst-content-page">
        <?php get_template_part('template-parts/banner'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12 rst-content-left">
                    <?php 

                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type' => 'post',
                            'cat' => 29,
                            'post_status' => 'publish',
                            'posts_per_page' => 5,
                            'paged' => $paged
                        );
                        $the_query = new WP_Query($args);
                        while ($the_query->have_posts()) : $the_query->the_post();

                     ?>

                    <div class="rst-tour-item rst-blog-item ">
                        <div class="rst-inner-blog-item clearfix">
                            <div class="v_thumbnail">
                                <?php 

                                if (has_post_thumbnail()) {

                                    printf('<a href="%s" title="%s" class="rst-thumb-post">%s</a>',get_permalink(  ),get_the_title(),get_the_post_thumbnail());

                                 } ?>
                            </div>
                            <div class="v_content">
                                <h2>
                                    <a title="<?php the_title()?>" href="<?php the_permalink()?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="rst-meta-post">
                                    <!-- <span><i class="fa fa-calendar" aria-hidden="true"></i><i><?php //the_date( ); ?></i></span> -->

                                    <!-- <span><i class="fa fa-user" aria-hidden="true"></i><i><?php //the_author( ); ?></i></span>  -->

                                    <!-- <span><i class="fa fa-comments-o" aria-hidden="true"></i><i><?php //echo $post->comment_count ?> Comments</i></span> -->
                                </div>
                                <div class="rst-inner-des-shot">
                                    <?php echo wp_trim_words( get_the_content(), 30, '(...)' ); ?>
                                </div>

                                <a class="v_readmore" href="<?php the_permalink()?>">(see more)</a>

                            </div>

                        </div>
                    </div>

                    <?php endwhile; wp_reset_postdata(); ?>

                    <div class="pagination-post">
                        <?php
                            $big = 999999999;
                            $rs_paginate_links = paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $the_query->max_num_pages,
                                'prev_text'    => __('« Prev &nbsp; ','yup'),
                                'next_text'    => __(' &nbsp; Next » ','yup') 
                              ) );
                            if($rs_paginate_links) : 
                        ?>
                            <div class='clearfix'></div>
                            <div class="pagination">
                                <?php echo $rs_paginate_links ?>
                            </div>
                            <?php endif; ?>
                    </div>
                    <!-- End pagination -->

                </div>
                <!-- End Left -->

                <div class="col-md-3 col-xs-12 rst-content-right">
                    <?php dynamic_sidebar( 'Tour-Sidebar' ); ?>
                    <div class="clear"></div>
                </div>
                <!-- End Right -->
            </div>
        </div>

    </div>
    <?php get_template_part( 'template-parts/edit','page'); ?>
</article>

<?php get_footer(); ?>