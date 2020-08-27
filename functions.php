<?


//Redirect khi đăng nhập
function my_login_redirect( $redirect_to, $request, $user ) {
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) ) {
            return home_url();
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
function redirect_login_page() {
    $login_page  = home_url( '/dang-nhap.html/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');
Kết thúc Redirect khi đăng nhập
 
Kiểm tra lỗi đăng nhập
function login_failed() {
    $login_page  = home_url( '/dang-nhap.html/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );
function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/dang-nhap.html/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);