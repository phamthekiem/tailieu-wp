<?php
if( ! function_exists( 'lbl_vc_portfolio' ) ) {
    function lbl_vc_portfolio( $attr, $content = null )
    {
        extract(shortcode_atts(array(
            'posts_per_page'                => '',
            'columns'                       => '',
            'pagenavi'                      => '',
            'portfolio-category'            => '',
            'tag_slug'                      => '',
            'authors_id'                    => '',
            'ids'                           => '',
            'sort'                          => '',
            'extraclassname'                => '',
        ), $attr));
        $html = '';
        $attr['posts_per_page'] = ( isset($attr['posts_per_page']) && !empty($attr['posts_per_page']) ) ? $attr['posts_per_page'] : 10;
        $attr['number_loadmore'] = ( isset($attr['number_loadmore']) && !empty($attr['number_loadmore']) ) ? $attr['number_loadmore'] : 3;
        $attr['dots_is_number'] = ( isset($attr['dots_is_number']) && !empty($attr['dots_is_number']) ) ? $attr['dots_is_number'] : false;
        $attr['style'] = ( isset($attr['style']) && !empty($attr['style']) ) ? $attr['style'] : 'basic-grid';
        $attr['columns'] = ( isset($attr['columns']) && !empty($attr['columns']) ) ? absint($attr['columns']) : 3;
        $attr['pagenavi'] = ( isset($attr['pagenavi']) && !empty($attr['pagenavi']) ) ? $attr['pagenavi'] : '';
        $attr['post_type'] = 'portfolio';
        $attr['portfolio-category'] = ( isset($attr['portfolio-category']) && !empty($attr['portfolio-category']) ) ? $attr['portfolio-category'] : '';
        $attr['categories_filter_style'] = ( isset($attr['categories_filter_style']) && !empty($attr['categories_filter_style']) ) ? $attr['categories_filter_style'] : '';
        $attr['tag_slug'] = ( isset($attr['tag_slug']) && !empty($attr['tag_slug']) ) ? $attr['tag_slug'] : '';
        $attr['authors_id'] = ( isset($attr['authors_id']) && !empty($attr['authors_id']) ) ? $attr['authors_id'] : '';
        $attr['hidden_categories_filter'] = ( isset($attr['hidden_categories_filter']) && !empty($attr['hidden_categories_filter']) ) ? $attr['hidden_categories_filter'] : false;
        $attr['hidden_categories'] = ( isset($attr['hidden_categories']) && !empty($attr['hidden_categories']) ) ? $attr['hidden_categories'] : false;
        $attr['hidden_title_post'] = ( isset($attr['hidden_title_post']) && !empty($attr['hidden_title_post']) ) ? $attr['hidden_title_post'] : false;
        $attr['ids'] = ( isset($attr['ids']) && !empty($attr['ids']) ) ? $attr['ids'] : '';
        $attr['columns_gap'] = ( isset($attr['columns_gap']) ) ? $attr['columns_gap'] : '30';
        $attr['sort'] = ( isset($attr['sort']) && !empty($attr['sort']) ) ? $attr['sort'] : '';
        $attr['animate'] = isset($attr['animate']) ? $attr['animate'] : '';
        $attr['css'] = ( isset($attr['css']) && !empty($attr['css']) ) ? $attr['css'] : '';
        $attr['extraclassname'] = ( isset($attr['extraclassname']) && !empty($attr['extraclassname']) ) ? $attr['extraclassname'] : '';
        global $post, $wp_query;
        
        $columns = $attr['columns'];
        $template = $attr['style'];
        
        
        $class = array();
        $class[] = 'portfolio-'. $template;
        if( $attr['categories_filter_style'] == '2' ) {
            $class[] = 'categories_filter_style_2';
        }
        if ( $attr['dots_is_number'] ) {
            $class[] = 'dots_is_number';
        }
        if ( $attr['columns'] == 1 ) {
            $class[] = 'portfolio_single_slide';
        }
        if( $attr['categories_filter_style'] == '3' ) {
            $class[] = 'categories_filter_style_3';
        }
        $css_class = vc_shortcode_custom_css_class( $attr['css'], ' ' );
        $class[] = $css_class;
        $class[] = $attr['extraclassname'];
        wp_reset_query();
        wp_reset_postdata();
        // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // $args = array(
        //     'post_type'      => 'post',
        //     'post_status' => 'publish',
        //     'cat' => 1,
        //     'posts_per_page' =>15,
        //     'paged'   => $paged

        // );
        // $the_query = new WP_Query( $args );
        // while ($the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="post-20333 page type-page status-publish hentry" id="post-20333">
                <div class="container">
                    <div class="section">
                      <div class="vc_row wpb_row vc_row-fluid vc_custom_1531448706317">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div id="post_grid_d60e42f2ea7f95df9348e91c1bb31fe3" class="grid_holder animated_items" style="position: relative; height: 473.031px;">
                                    <?php 
                                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                        $args = array(
                                            'post_type' => 'post',
                                            'post_status' => 'publish',
                                            'cat' => 1,
                                            'posts_per_page' =>3,
                                            'paged' => $paged
                                        );
                                     ?>
                                    <?php $getposts = new WP_query($args); ?>
                                    <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                                        <div class="col span_1_of_3 info_item isotope_element" style="position: absolute; left: 0px; top: 0px;">
                                            <div class="post_item_block boc_anim_hidden boc_left-to-right boxed boc_start_animation" style="transition-delay: 0ms;">
                                                <div class="pic ">
                                                    <a href="http://v2.dichvuquantri.com/imavietnam/cach-day-hoc-toan-hieu-qua/">
                                                        <img src="http://v2.dichvuquantri.com/imavietnam/wp-content/uploads/2018/06/18156953_781502568692562_1994041483665504555_n-600x380.jpg">
                                                        <div class="img_overlay">
                                                            <span class="hover_icon icon_plus"></span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="post_item_desc dark_links">
                                                    <h4>
                                                        <a href="http://v2.dichvuquantri.com/imavietnam/cach-day-hoc-toan-hieu-qua/">Cách dạy học toán hiệu quả</a>
                                                    </h4>
                                                    <div class="small_post_date">
                                                        <span class="icon icon-calendar2"></span> &nbsp; Tháng Một 20, 2020
                                                    </div>
                                                    <p>Để đảm bảo chất lượng học tập cho con, việc chú trọng vào những&nbsp;cách dạy ...</p>
                                                    <a href="http://v2.dichvuquantri.com/imavietnam/cach-day-hoc-toan-hieu-qua/" class="more-link2">Xem Thêm</a>     
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                    </div>
                                </div>
                                <div class="h10 clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post :: END -->      

<div style="text-align: center; margin-top: 50px;">
    <?php
    $big = 999999999;
    $rs_paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $the_query->max_num_pages,
        'prev_text'    => __('« Trang trước &nbsp; ','yup'),
        'next_text'    => __(' &nbsp; Trang tiếp » ','yup') 
    ) );
    if($rs_paginate_links) : 
        ?>
        <div class='clearfix'></div>
        <div class="pagination">
            <?php echo $rs_paginate_links ?>
        </div>
    <?php endif; ?>
    </div> <?php
//
}

}

add_shortcode( 'lbl_portfolio', 'lbl_vc_portfolio' );
vc_map( array (
    'base'          => 'lbl_portfolio',
    'name'          => __('BlogNew', 'carina'),
    'category'      => __('Content', 'carina'),
    'icon'          => 'cm_icon_shortcode',
    'params'        => array (
        array (
            'param_name'    => 'posts_per_page',
            'type'          => 'textfield',
            'heading'       => __('Limit post number', 'carina'),
            'admin_label'   => true,
            'value'         => '10'
        ),
        array (
            'param_name'    => 'style',
            'type'          => 'dropdown',
            'heading'       => __('Style', 'carina'),
            'admin_label'   => true,
            'value'         => array(
                'Basic Grid'        => 'basic-grid',
                'Basic Grid 2'      => 'basic-grid-2',
                'Basic Masonry'     => 'basic-masonry',
                'Basic Slider'      => 'basic-slider',
                'Masonry Multisize' => 'masonry-multisize',
                'Masonry Multisize 2'   => 'masonry-multisize-2',
                'Creative 01'       => 'creative-1',
                'Creative 02'       => 'creative-2',
                'Creative 03'       => 'creative-3',
                'Creative 04'       => 'creative-4',
                'Creative 05'       => 'creative-5',
                'Creative 06'       => 'creative-6'
            )
        ),
        array (
            'param_name'    => 'dots_is_number',
            'type'          => 'checkbox',
            'heading'       => __('Dots is Number', 'carina'),
            'admin_label'   => true,
            "dependency" => array(
                "element" => "style",
                "value" => array('basic-slider')
            )
        ),
        array (
            'param_name'    => 'columns',
            'type'          => 'dropdown',
            'heading'       => __('Columns', 'carina'),
            'admin_label'   => true,
            'value'         => array(
                "5 Columns"     => "5",
                "4 Columns"     => "4",
                "3 Columns"     => "3",
                "2 Columns"     => "2",
                "1 Column"      => "1",
            ),
            'std'   => 3,
            "dependency" => array(
                "element" => "style",
                "value" => array('basic-grid', 'basic-grid-2', 'basic-masonry','basic-slider')
            )
        ),
        array (
            'param_name'    => 'columns_gap',
            'type'          => 'dropdown',
            'heading'       => __('Columns Gap', 'carina'),
            'admin_label'   => true,
            'value'         => array(
                "40px"  => "40",
                "30px"  => "30",
                "15px"  => "15",
                "0"     => "0",
            ),
            'std'   => 3,
            "dependency" => array(
                "element" => "style",
                "value" => array('basic-slider')
            )
        ),
        
        array (
            'param_name'    => 'pagenavi',
            'type'          => 'dropdown',
            'heading'       => __('Show Navi', 'carina'),
            'value'         => array(
                'Hidden' => '0',
                'Number' => 'number',
                'Loadmore' => 'loadmore',
            ),
            'admin_label'   => true,
            "dependency" => array(
                "element" => "style",
                "value_not_equal_to" => array('basic-slider','creative-5')
            )
        ),
        array (
            'param_name'    => 'number_loadmore',
            'type'          => 'textfield',
            'heading'       => __('Number Posts Loadmore', 'carina'),
            'value'         => '3',
            'admin_label'   => true,
            "dependency" => array(
                "element" => "pagenavi",
                "value" => array('loadmore')
            )
        ),
        array (
            'param_name'    => 'hidden_categories_filter',
            'type'          => 'checkbox',
            'heading'       => __('Disable Categories Filter', 'mfn-opts'),
            'admin_label'   => true,
            "dependency" => array(
                "element" => "style",
                "value_not_equal_to" => array('basic-slider','creative-5')
            )
        ),
        array (
            'param_name'    => 'categories_filter_style',
            'type'          => 'dropdown',
            'heading'       => __('Categories Filter Style', 'carina'),
            'admin_label'   => true,
            'value'         => array(
                "Button has background"     => "",
                "Button active is white"    => "2",
                "Button active is pool"     => "3",
            )
        ),
        array (
            'param_name'    => 'hidden_categories',
            'type'          => 'checkbox',
            'heading'       => __('Disable Categories Portfolio', 'mfn-opts'),
            'admin_label'   => true,
        ),
        array (
            'param_name'    => 'hidden_title_post',
            'type'          => 'checkbox',
            'heading'       => __('Disable Title Portfolio', 'mfn-opts'),
            'admin_label'   => true,
        ),
        // Query Filter
        array (
            'param_name'    => 'portfolio-category',
            'type'          => 'terms',
            'taxonomies'    => 'portfolio-category',
            'heading'       => __('Category filter:', 'carina'),
            'admin_label'   => true,
            'description'   => 'Multiple category filter.',
            'group'         => 'Filters'
        ),
        array (
            'param_name'    => 'authors_id',
            'type'          => 'textfield',
            'heading'       => __('Multiple authors filter:', 'carina'),
            'admin_label'   => true,
            'description'   => 'Filter multiple authors by ID. Enter here the author IDs sepcarinated by commas (ex: 13,23,18).',
            'group'         => 'Filters'
        ),
        array (
            'param_name'    => 'ids',
            'type'          => 'autocomplete',
            'heading'       => __('Include Posts:', 'carina'),
            'settings' => array(
                'multiple' => true,
                'sortable' => true,
                'unique_values' => true,
            ),
            'admin_label'   => true,
            'description'   => 'Input product ID or product title to see suggestions',
            'group'         => 'Filters'
        ),
        array (
            'param_name'    => 'sort',
            'type'          => 'dropdown',
            'heading'       => __('Sort order:', 'carina'),
            'admin_label'   => true,
            "value"         => array(
                "- Latest -"            => "",
                "Title"                 => "title",
                "Random"                => "random_posts"
            ),
            'group'         => 'Filters'
        ),
        array(
            "type" => "animate",
            "heading" => __( "Animate"),
            "param_name" => "animate",
            "description" => __( "Visit <a target='_blank' href='https://daneden.github.io/animate.css/'>Website Animate.css</a> view animate", "my-text-domain" ),
            'admin_label'   => true
        ),
        array (
            'param_name'    => 'extraclassname',
            'type'          => 'textfield',
            'heading'       => __('Extra Class Name', 'carina'),
            'admin_label'   => true,
            'description'   => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',                                                     
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' )
        )
    )
));
//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_lbl_portfolio_ids_callback', 'portfolioIdAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_lbl_portfolio_ids_render','portfolioIdAutocompleteRender', 10, 1 ); // Render exact team. Must return an array (label,value)