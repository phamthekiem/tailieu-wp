//Form
[text ho_ten id:ho_ten class:ho_ten placeholder "Họ & tên"]
[text phone id:phone class:phone placeholder "Số điện thoại"]

[select tinh_thanh id:tinh_thanh class:tinh_thanh]
[select quan_huyen id:quan_huyen class:quan_huyen]
[select phuong_xa id:phuong_xa class:phuong_xa]

[submit id:send class:send "Gửi thông tin"]

<!-- API --
add_action('wp_ajax_nopriv_province', 'province');
add_action('wp_ajax_province', 'province');

function province(){
    $tinh_thanh = file_get_contents('https://partner.viettelpost.vn/v2/categories/listProvince');
    $tinh_thanh = json_decode($tinh_thanh);
    wp_send_json_success($tinh_thanh);
}

add_action('wp_ajax_nopriv_district', 'district');
add_action('wp_ajax_district', 'district');

function district(){
    $id = $_GET['id'];
    $quan_huyen = file_get_contents('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$id);
    $quan_huyen = json_decode($quan_huyen);
    wp_send_json_success($quan_huyen);
}

add_action('wp_ajax_nopriv_ward', 'ward');
add_action('wp_ajax_ward', 'ward');

function ward(){
    $id = $_GET['id'];
    $phuong_xa = file_get_contents('https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$id);
    $phuong_xa = json_decode($phuong_xa);
    wp_send_json_success($phuong_xa);
}

<!-- Ajax -->
add_action('wp_footer', function(){
    ?>
        <script>
            jQuery(document).ready(function($){
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    data: {
                        action: 'province'
                    },
                    success(res) {
                        var province = res.data.data

                        var html = '<option value="">Chọn tỉnh thành</option>';

                        $.each(province, function(i, v) {
                            html += `<option value="${v.PROVINCE_NAME}" data-id="${v.PROVINCE_ID}">${v.PROVINCE_NAME}</option>`;
                        });

                        $('#tinh_thanh').html(html)
                    }
                });

                $(document).on('change', '#tinh_thanh', function(){
                    var id = $(this).find(':selected').attr('data-id')
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php') ?>',
                        data: {
                            action: 'district',
                            id: id
                        },
                        success(res) {
                            console.log(res)
                            var district = res.data.data

                            var html = '<option value="">Chọn quận huyện</option>';

                            $.each(district, function(i, v) {
                                html += `<option value="${v.DISTRICT_NAME}" data-id="${v.DISTRICT_ID}">${v.DISTRICT_NAME}</option>`;
                            });

                            $('#quan_huyen').html(html)
                        }
                    });
                })

                $(document).on('change', '#quan_huyen', function(){
                    var id = $(this).find(':selected').attr('data-id')
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php') ?>',
                        data: {
                            action: 'ward',
                            id: id
                        },
                        success(res) {
                            console.log(res)
                            var ward = res.data.data

                            var html = '<option value="">Chọn phường xã</option>';

                            $.each(ward, function(i, v) {
                                html += `<option value="${v.WARDS_NAME}" data-id="${v.WARDS_ID}">${v.WARDS_NAME}</option>`;
                            });

                            $('#phuong_xa').html(html)
                        }
                    });
                })
            });
        </script>
    <?php
});

// Fix lỗi Undefined value was submitted through this field
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 );
