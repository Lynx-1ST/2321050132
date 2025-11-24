<?php   
    // Session
    # Lưu ở phía Server - Máy chủ.
    # Thông tin quan trọng nên được lưu trữ ở dây ! 
    session_start();
    $_SESSION['username'] = 'Lynx_1ST';


    // Cookie
    # Lưu ở phía Clients - Người dùng.
    # Không nên lưu thông tin nhạy cảm của trang web ở đây !
    $cookieName = "themeMode";
    $cookieValue = "Light Mode";
    setcookie($cookieName, $cookieValue, time()+(86400), "/");
    if (isset ($_COOKIE[$cookieName]) ) {
        echo "Cookie đã tồn tại !";
    } else {
        echo "Cookie chưa tồn tại !";
    }

?>