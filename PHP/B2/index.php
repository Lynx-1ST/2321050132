
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <style>
    body{
        margin: 0;
    }
    nav{
        background-color: greenyellow;
        display: flex;
        justify-content: space-between;
    }
    ul{
        display: flex;
        list-style: none;
        margin: 0;
    }
    li{
        padding: 10px;
    }
    a{
        text-decoration: none;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header('location: login.php');
    }

?>
    <header>
        <nav>
            <ul>
                <li class="">
                    <a class="" href="index.php?page_layout=trangchu">Trang chủ</a>
                </li>
                <li class="">
                    <a class="" href="index.php?page_layout=phim">Phim</a>
                </li>
                <li class="">
                    <a class="" href="index.php?page_layout=quocgia">Quốc gia</a>
                </li>
                <li class="">
                    <a class="" href="index.php?page_layout=theloai">Thể loại</a>
                </li>
                <li class="">
                    <a class="" href="index.php?page_layout=nguoidung">Người dùng</a>
                </li>
            </ul>
            <ul>
                <li class="">
                    <a class="" href="#">
                        <?php echo "Xin chào " . $_SESSION['username']; ?>
                    </a>
                </li>
                <li class="">
                    <a class="" href="#">Đăng xuất</a>
                </li>
            </ul>
        </nav>
        <?php 
        if (isset($_GET['page_layout'])) {
            switch($_GET['page_layout']) {
                case 'trangchu':
                    include "homepage.php";
                    break;
                
                case 'phim':
                    include "phim.php";
                    break;
                
                case 'nguoidung':
                    include "nguoidung.php";
                    break;
                
                case 'quocgia':
                    include "quocgia.php";
                    break;
                
                case 'theloai':
                    include "theloai.php";
                    break;
            }
        }
        ?>
    </header>
</body>


</html>