<?php

/**
 * Hook Woocommerce
 */
add_theme_support('woocommerce');
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );

remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_related_products',20 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_sharing',50 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );
remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10 );

remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
add_action( 'woocommerce_after_shop_loop_item_rating','woocommerce_template_loop_rating',5 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );

add_action( 'woocommerce_single_product_summary_meta','woocommerce_template_single_meta',15 );

//add_action( 'woocommerce_after_shop_loop1','woocommerce_pagination',10 );

//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12' ), 20 );

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
    $cols = 18;
    return $cols;
}


//Custom Product Fields
add_action( 'woocommerce_product_options_general_product_data', 'thim_product_custom_fields' );
function thim_product_custom_fields() {
    global $woocommerce, $post;
    echo '<div class="product_custom_field options_group">';
        // Custom Product Color Title
        woocommerce_wp_text_input(
            array(
                'id'          => '_custom_product_link_demo',
                'placeholder' => '',
                'label'       => esc_html__( 'Demo link', 'thimpress' ),
            )
        );

        woocommerce_wp_text_input(
            array(
                'id'          => '_custom_product_join_club',
                'placeholder' => '',
                'label'       => esc_html__( 'Download now', 'thimpress' ),
            )
        );

        woocommerce_wp_select(
            array(
                'id'          => '_custom_product_level_vip',
                'placeholder' => '',
                'label'       => esc_html__( 'Level by Product', 'thimpress' ),
//                 'selected' => true,
//                 'value'    => '5',
                'options'   => array(
                    '1'     => __( 'Vip 5', 'thimpress' ),
                    '2'     => __( 'Vip 4', 'thimpress' ),
                    '3'     => __( 'Vip 3', 'thimpress' ),
                    '4'     => __( 'Vip 2', 'thimpress' ),
                    '5'     => __( 'Vip 1', 'thimpress' ),
                )
            )
        );
    
    echo '</div>';
}
// Save Fields
add_action( 'woocommerce_process_product_meta', 'thim_product_custom_fields_save' );
function thim_product_custom_fields_save( $post_id ) {
    global $woocommerce, $post;

    $woocommerce_custom_product_link_demo = $_POST['_custom_product_link_demo'];
    update_post_meta( $post_id, '_custom_product_link_demo', $woocommerce_custom_product_link_demo );

    $woocommerce_custom_product_join_cub = $_POST['_custom_product_join_club'];
    update_post_meta( $post_id, '_custom_product_join_club', $woocommerce_custom_product_join_cub );

    $woocommerce_custom_product_level = $_POST['_custom_product_level_vip'];
    if( !empty( $woocommerce_custom_product_level ) )
        update_post_meta( $post_id, '_custom_product_level_vip', esc_attr( $woocommerce_custom_product_level ) );
    else {
        update_post_meta( $post_id, '_custom_product_level_vip',  '1' );
    }
}

// 

function thim_list_custom() {
    global $post;
    $product_link_demo = get_post_meta( $post->ID, '_custom_product_link_demo', true );
    // $product_download = get_post_meta( $post->ID, '_custom_product_download', true );
    $product_join_club = get_post_meta( $post->ID, '_custom_product_join_club', true );
    ?>
        <?php if ($product_link_demo) { ?>
            <div class="demo-link">
                <a href="<?php echo $product_link_demo ?>" target=_blank><?php _e('DEMO LINK', 'eduma') ?></a> 
            </div>
        <?php } ?>
        <?php if ($product_join_club) { ?>
            <div class="join-club">
                <a href="<?php echo $product_join_club ?>" target=_blank><?php _e('BUY NOW', 'eduma') ?></a> 
            </div>
        <?php } ?>

        
        <?php do_action( 'woocommerce_single_product_summary_meta' ); ?>
        

        <div class="social-share">
           <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57e482b2e67c850b"></script>
            <div class="addthis_inline_share_toolbox_4524"></div>
        </div>

    <?php
}
add_action( 'woocommerce_single_product_summary_sidebar', 'thim_list_custom', 10 );


// ADD Price
function insert_price_product() {
    global $product;
    if ( $product->is_type( 'simple' ) ) {
        $regular_price  = get_post_meta( get_the_ID(), '_regular_price', true);
        $sale_price     = get_post_meta( get_the_ID(), '_sale_price', true);
        if ( empty( $regular_price ) ) {
            echo '<p class="price">'.__( 'Contact', 'shtheme' ).'</p>';
        } elseif ( ! empty( $regular_price ) && empty( $sale_price ) ) {
            echo '<p class="price">'. wc_price( $regular_price) . '</p>';
        } elseif ( ! empty( $regular_price ) && ! empty( $sale_price ) ) {
            echo '<p class="price"><ins>'. wc_price( $sale_price) .'</ins><del>'. wc_price( $regular_price) .'</del></p>'; 
        }
    } 
}
add_action( 'woocommerce_after_shop_loop_item_title','insert_price_product',10 );


function insert_price_product_single() {
    global $product;
    if ( $product->is_type( 'simple' ) ) {
        $regular_price  = get_post_meta( get_the_ID(), '_regular_price', true);
        $sale_price     = get_post_meta( get_the_ID(), '_sale_price', true);
        if ( empty( $regular_price ) ) {
            echo '<p class="price">'.__( 'Contact', 'shtheme' ).'</p>';
        } elseif ( ! empty( $regular_price ) && empty( $sale_price ) ) {
            echo '<p class="price">'. wc_price( $regular_price) . '</p>';
        } elseif ( ! empty( $regular_price ) && ! empty( $sale_price ) ) {
            echo '<p class="price"><ins>'. wc_price( $sale_price) .'</ins><del>'. wc_price( $regular_price) .'</del></p>'; 
        }
    } 
}
add_action( 'woocommerce_single_product_summary','insert_price_product_single',15 );


function insert_buy_now_product_single() {
    global $post;
    $product_join_club = get_post_meta( $post->ID, '_custom_product_join_club', true );
    if ($product_join_club) { ?>
            <div class="join-club">
                <a href="<?php echo $product_join_club ?>" target=_blank><?php _e('BUY NOW', 'eduma') ?></a> 
            </div>
    <?php }
}
add_action( 'woocommerce_after_shop_loop_item_title','insert_buy_now_product_single',15 );



function insert_title_product_single() {
    ?>
        <div class="product-list-title">
            <h2 class="woocommerce-loop-product__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        </div>
    <?php  
}
add_action( 'woocommerce_shop_loop_item_title_custom','insert_title_product_single',10 ); 

//
//Return layout product

function thim_sort_product_level( $query ) {
    if ( $query->is_main_query() && ! is_admin() && $query->get( 'post_type' ) == 'product' ) {
        // $query->query_vars['order'] = 'DESC';
        $query->query_vars['orderby']    = [
            'level_vip' => 'DESC',
            'level_vip_not_exit' => 'DESC',
            'meta_value_num' => 'DESC',
        ];
        $query->query_vars['meta_query'] = [
            'relation'    => 'OR',
            'level_vip' => array(
                'key'     => '_custom_product_level_vip',
                'compare' => 'EXISTS' 
            ),
            'level_vip_not_exit' => array(
                'key'     => '_custom_product_level_vip',
                'compare' => 'NOT EXISTS',
            )
        ];

        return $query;
    }
}

add_action( 'pre_get_posts', 'thim_sort_product_level', 99, 2 );
