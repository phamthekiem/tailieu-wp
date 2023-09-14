<!-- I. thao tác thêm, sửa, xóa DB -->

1.Tạo bảng mới trong database wordpress:
<?php 
    function hk_CreatDatabaseContacts(){
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $contactTable = $wpdb->prefix . 'contacts';
        $createContactTable = "CREATE TABLE IF NOT EXISTS `{$contactTable}` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `phone` varchar(20) NULL,
            `address` varchar(255) NULL,
            `content` longtext NULL,
            `date` timestamp NOT NULL,
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createContactTable );
    }
 
    add_action('init', 'hk_CreatDatabaseContacts');
?>


2.Tạo bảng mới trong database wordpress với khóa ngoại:

<?php
function hk_CreatDatabaseContacts(){
    global $wpdb;
    $charsetCollate = $wpdb->get_charset_collate();
    $contactTable = $wpdb->prefix . 'contacts';
    $createContactTable = "CREATE TABLE IF NOT EXISTS `{$contactTable}` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` bigint(20) UNSIGNED NOT NULL,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(20) NULL,
        `address` varchar(255) NULL,
        `content` longtext NULL,
        `date` timestamp NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (user_id) REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE ON UPDATE CASCADE
    ) {$charsetCollate};";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $createContactTable );
}
 
add_action('init', 'hk_CreatDatabaseContacts');
?>
<!-- Ở đây user_id là khóa ngoại, Liên kết bảng wp_contacts với bảng wp_users nha. -->

3.Xóa một bảng trong database wordpress:

<?php
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}contacts" );
?>

4 Tạo database khi active theme:

	<?php add_action( 'after_switch_theme', 'hk_CreatDatabaseContacts' ); ?>

5.Tạo database khi active plugin:

<?php 
	function detect_plugin_activation( $plugin, $network_activation ) {
    // Đoạn code tạo database
	}
	add_action( 'activated_plugin', 'detect_plugin_activation', 10, 2 );
 ?>



<!-- II. Hướng dẫn query dữ liệu database wordpress -->


1. Get results
Get results sử dụng trong trường hợp lấy nhiều record trong 1 bảng. Ví dụ mình có đoạn code sau:

<?php
  global $wpdb; // Biến toàn cục lớp $wpdb được sử dụng trong khi tương tác với databse wordpress
  $limit = 10; // Số lượng record cần lấy
  $offset = 0; // Số lượng record bỏ qua
  $table = $wpdb->prefix . 'posts'; // Khai báo bảng cần lấy
  $sql = "SELECT * FROM {$table} WHERE `post_type` = 'post' LIMIT %d OFFSET %d"; // cậu sql query 
  $data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A); // thực thi câu query, trả về dữ liệu trong biến $data
?>

2. Get row
Get row sử dụng trong trường hợp bạn muốn lấy ra 1 record. Ví dụ như get 1 bài viết, dùng để get trang chi tiết bài viết…

<?php 
  global  $wpdb;
  $postID = 5; // id bài viết cần lấy
  $table  = $wpdb->prefix . 'posts'; // Bảng cần lấy
  $sql    = "SELECT * FROM {$table} WHERE `ID` = %d"; //câu sql query
  $data   = $wpdb->get_row( $wpdb->prepare($sql, $postID), ARRAY_A); //trả về dữ liệu trong biến $data
?>

3. Get var
Get var được sử dụng trong trường hợp lấy 1 giá trị nào đó trong database. Ví dụ số lượng bài viết, số lượng view của 1 bài viết…

<?php 
  global $wpdb; 
  $user_id = 1; // Đặt biết user_id
  $table = $wpdb->prefix . 'posts'; // Bảng cần lấy 
  $sql = "SELECT COUNT(*) FROM {$table} WHERE `post_author` = %d"; //câu sql query 
  $number = $wpdb->get_var( $wpdb->prepare($sql, $user_id)); //trả về dữ liệu trong biến $number 
?>


<!-- III. Hướng dẫn join 1, nhiều bảng và query dữ liệu database wordpress -->

1. Join 1 bảng và query dữ liệu
Bài toán ví dụ: Get bài viết có kèm tên tác giả của bài viết đó.

<?php 
	global $wpdb; 
	$user_id = 1;
	$table_post = $wpdb->prefix . 'posts'; // Bảng post 
	$table_user = $wpdb->prefix . 'users'; // Bảng bảng user
	$limit = 10;
	$offset = 0; 
	$sql = "SELECT {$table_post}.`ID`, `post_title`, `post_date`, `display_name`
			FROM {$table}
			LEFT JOIN {$table_user} ON {$table_post}.`post_author` = {$table_user}.`ID`
			WHERE `post_status` = 'publish' AND `post_type` = 'post'
			LIMIT %d OFFSET %d"; //câu sql query 
	$data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A); //trả về dữ liệu trong biến $data 
?>

2. Join nhiều bảng và query dữ liệu
Bài toán ví dụ: Get bài viết có kèm tên và mô tả tác giả của bài viết đó.

<?php 
	global $wpdb; 
	$user_id = 1;
	$table_post = $wpdb->prefix . 'posts'; // Bảng post 
	$table_user = $wpdb->prefix . 'users'; // Bảng bảng user
	$table_usermeta = $wpdb->prefix . 'usermeta'; // User meta
	$limit = 10;
	$offset = 0; 
	$sql = "SELECT {$table_post}.`ID`, `post_title`, `post_date`, `display_name`, {$table_usermeta}.`meta_value` as description
			FROM {$table}
			LEFT JOIN {$table_user} ON {$table_post}.`post_author` = {$table_user}.`ID`
			LEFT JOIN {$table_usermeta} ON {$table_usermeta}.`user_id` = {$table_user}.`ID`
			WHERE `post_status` = 'publish' AND `post_type` = 'post' AND {$table_usermeta}.`meta_key` = 'description'
			LIMIT %d OFFSET %d"; //câu sql query 
	$data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A); //trả về dữ liệu trong biến $data 
?>

<!-- Ở bài này mình join thêm 1 bảng wp_usermeta. Bảng user và bảng usermeta liên kết với thông qua user_id. Chúng ta tiến hành join như bình thường! -->


<!-- IV. Thực hành query dữ liệu database wordpress sử dụng wpdb -->

1. Truy vấn sql database wordpress get 10 bài viết mới nhất có hình đại diện

<?php 
	global $wpdb;
    $table 		= $wpdb->prefix . 'posts';
    $tablemeta 	= $wpdb->prefix . 'postmeta';
    $limit 		= 10;
    $offset 	= 0;
    $sql = "SELECT  `post`.`ID`,
    				`post`.`post_author` as author,
    				`post`.`post_date` as date,
    				`post`.`post_title` as title,
    				`post`.`post_name` as slug,
    				`imagethumb`.`guid` as image
    FROM $table as post
    LEFT JOIN $tablemeta as thumbnail ON `thumbnail`.`post_id` = `post`.`ID` AND `thumbnail`.`meta_key` = '_thumbnail_id'
    LEFT JOIN $table as imagethumb ON `imagethumb`.`ID` = `thumbnail`.`meta_value`
    WHERE 	`post`.`post_type` = 'post' AND
    		`post`.`post_status` = 'publish' 
    GROUP BY `ID`
    ORDER BY `date` DESC
    LIMIT %d OFFSET %d";
    $data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A);
?>

2. Truy vấn sql database wordpress get list danh mục với số lượng bài viết

<?php 
 	global $wpdb;
 	$limit = 100;
 	$offset = 0;
    $tableterm  = $wpdb->prefix . 'terms';
    $tabletaxo  = $wpdb->prefix . 'term_taxonomy';
    $sql = "SELECT  `term`.`term_id` as id,
                    `term`.`name`   as title,
                    `term`.`slug`   as slug,
                    `tax`.`parent`  as parent,
                    `tax`.`count`   as count
    FROM $tableterm as term
    LEFT JOIN $tabletaxo as tax ON `term`.`term_id` = `tax`.`term_id`
    WHERE `tax`.`taxonomy` = 'category'  
    ORDER BY `term`.`term_id` DESC
    LIMIT %d OFFSET %d";
    $data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A);
?>

3. Truy vấn sql database wordpress get danh sách thành viết bình luận nhiều trong tháng
Đây là đoạn code được nhiều người cần để list top thành viên bình luận nhiều. Code này mình lấy top 10 thành viên bình luận nhiều nhất.

<?php 
	$m = (string)date('m', time());
    $y = (string)date('Y', time());
    global $wpdb;
    $comments = $wpdb->get_results(
        "SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, count(comment_author_email) As count 
        FROM `wp_comments` 
        WHERE comment_approved=1 
        AND `comment_date` LIKE '$y-$m%' Group by comment_author_email order by count DESC LIMIT 10"
    );
   $data =(array)$comments;
?>

4. Get top thành viên viết bài nhiều nhất trong tháng
Bạn nào làm tổng kết báo cáo website chắc cần đoạn code này. Code get 10 thành viên viết bài nhiều nhất trong tháng

<?php 
	$month = (string)date('m', time());
    $year = (string)date('Y', time());
    global $wpdb;
    $table_post = $wpdb->prefix . 'posts';
    $table_user = $wpdb->prefix . 'users';
    $query = "SELECT u.ID, u.display_name, u.user_email, count(post_title) as num 
    		FROM {$table_post} p JOIN {$table_user} u ON p.post_author = u.ID 
    		WHERE post_type='post' AND post_status='publish' AND YEAR(post_date)=%d AND MONTH(post_date)=%d 
    		GROUP BY post_author ORDER BY num DESC LIMIT 10";
    $data = $wpdb->get_results( $wpdb->prepare( $query, $year, $month ));
?>