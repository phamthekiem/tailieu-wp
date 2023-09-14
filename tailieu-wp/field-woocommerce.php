<?php 

// Add field in to the admin page produc
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_add_fields');
function woocommerce_product_add_fields() {
   global $woocommerce;
   echo '<div class="options_group show_if_simple show_if_external show_if_variable">';
   // Custom Product Text Field
    woocommerce_wp_select(
        array(
            'id'          => '_enable',
            'type'          => 'select',
            'label'       => __( 'Thông Tin Sản Phẩm :', 'woocommerce' ),
            'description'   => __( 'Chọn để bật hoặc tắt', 'woocommerce' ),
            'options'     => array(
                '1'  => __( 'Tắt Thông Tin Sản Phẩm', 'woocommerce' ),
                '2' => __( 'Bật Thông Tin Sản Phẩm', 'woocommerce' ),
            ),
            'desc_tip'    => 'true',
            'description' => 'Chọn để bật hoặc tắt'
        )
    );
    woocommerce_wp_select(
        array(
            'id'          => '_hang_san_xuat',
            'type'          => 'select',
            'label'       => __( 'Hãng sản xuất:', 'woocommerce' ),
            'options'     => array(
                '1' => __( 'Chọn Hãng Sản Xuất', 'woocommerce' ),
                'An Cường' => __( 'An Cường', 'woocommerce' ),
                'Wilson'  => __( 'Wilson', 'woocommerce' ),
                'Hornitex' => __( 'Hornitex', 'woocommerce' ),
                'Morser'  => __( 'Morser', 'woocommerce' ),
                'Thaixin' => __( 'Thaixin', 'woocommerce' ),
                'Thaistar'  => __( 'Thaistar', 'woocommerce' ),
                'Smartchoice' => __( 'Smartchoice', 'woocommerce' ),
                'Smartwood'  => __( 'Smartwood', 'woocommerce' ),
                'Pergo' => __( 'Pergo', 'woocommerce' ),
                'LeoWood'  => __( 'LeoWood', 'woocommerce' ),
                'Indofloor' => __( 'Indofloor', 'woocommerce' ),
                'AlsaFloor'  => __( 'AlsaFloor', 'woocommerce' ),
                'Dongwha'  => __( 'Dongwha', 'woocommerce' ),
                'Kronospan' => __( 'Kronospan', 'woocommerce' ),
            ),
            'desc_tip'    => 'true',
            'description' => 'Không chọn lấy mặc định'
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_xuat_xu',
            'label' => __('Xuất xứ:', 'woocommerce'),
            'placeholder' => __('Việt Nam', 'woocommerce')
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_ma_sp',
            'label' => __('Mã sản phẩm:', 'woocommerce'),
            'placeholder' => __('AC 888', 'woocommerce')
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_kich_thuoc',
            'label' => __('Kích thước:', 'woocommerce'),
            'placeholder' => __('1200 x 190mm', 'woocommerce')
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_do_day',
            'label' => __('Độ dày:', 'woocommerce'),
            'placeholder' => __('8mm, 10mm, 12mm', 'woocommerce')
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_hesomaimonbemat',
            'label' => __('Hệ số mài mòn bề mặt:', 'woocommerce'),
            'placeholder' => __('AC4', 'woocommerce')
        )
    );
    woocommerce_wp_select(
        array(
            'id'          => '_bao_hanh',
            'type'          => 'select',
            'label'       => __( 'Bảo Hành:', 'woocommerce' ),
            'options'     => array(
                '1'  => __( 'Chọn Năm Bảo Hành', 'woocommerce' ),
                '5 Năm'  => __( '5 Năm', 'woocommerce' ),
                '10 Năm' => __( '10 Năm', 'woocommerce' ),
                '15 Năm'  => __( '15 Năm', 'woocommerce' ),
                '20 Năm'  => __( '20 Năm', 'woocommerce' ),
            ),
            'desc_tip'    => 'true',
            'description' => 'Không chọn lấy mặc định'
        )
    );
   echo '</div>';
}

// Save field
add_action('woocommerce_process_product_meta', 'woocommerce_product_fields_save');
function woocommerce_product_fields_save($post_id) {
    // Save field
    $woocommerce_product_field_enable = $_POST['_enable'];
    if (!empty($woocommerce_product_field_enable))
        update_post_meta($post_id, '_enable', esc_attr($woocommerce_product_field_enable));
    // Save field
    $woocommerce_product_field_hang_san_xuat = $_POST['_hang_san_xuat'];
    if (!empty($woocommerce_product_field_hang_san_xuat))
        update_post_meta($post_id, '_hang_san_xuat', esc_attr($woocommerce_product_field_hang_san_xuat));
    // Save field
    $woocommerce_product_field_xuat_xu = $_POST['_xuat_xu'];
    if (!empty($woocommerce_product_field_xuat_xu))
        update_post_meta($post_id, '_xuat_xu', esc_attr($woocommerce_product_field_xuat_xu));
    // Save field
    $woocommerce_product_field_ma_sp = $_POST['_ma_sp'];
    if (!empty($woocommerce_product_field_ma_sp))
        update_post_meta($post_id, '_ma_sp', esc_attr($woocommerce_product_field_ma_sp));
    // Save field
    $woocommerce_product_field_kich_thuoc = $_POST['_kich_thuoc'];
    if (!empty($woocommerce_product_field_kich_thuoc))
        update_post_meta($post_id, '_kich_thuoc', esc_attr($woocommerce_product_field_kich_thuoc));
    // Save field
    $woocommerce_product_field_do_day = $_POST['_do_day'];
    if (!empty($woocommerce_product_field_do_day))
        update_post_meta($post_id, '_do_day', esc_attr($woocommerce_product_field_do_day));
    // Save field
    $woocommerce_product_field_hesomaimonbemat = $_POST['_hesomaimonbemat'];
    if (!empty($woocommerce_product_field_hesomaimonbemat))
        update_post_meta($post_id, '_hesomaimonbemat', esc_attr($woocommerce_product_field_hesomaimonbemat));
    // Save field
    $woocommerce_product_field_bao_hanh = $_POST['_bao_hanh'];
    if (!empty($woocommerce_product_field_bao_hanh))
        update_post_meta($post_id, '_bao_hanh', esc_attr($woocommerce_product_field_bao_hanh));  
}


// echo get_post_meta( get_the_ID(), '_thong_so_ky_thuat', true );