<?php
require 'connect.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (
            !empty($_POST['tenPhim']) && 
            !empty($_POST['dao_dien']) && 
            !empty($_POST['namPhatHanh']) && 
            !empty($_POST['Poster']) && 
            !empty($_POST['quocGia']) && 
            !empty($_POST['soTap']) &&
            !empty($_POST['trailer']) && 
            !empty($_POST['moTa'])
        ) {

            $tenPhim = $_POST['tenPhim'];
            $daoDien = $_POST['dao_dien'];      
            $namPhatHanh = $_POST['namPhatHanh'];
            $Poster = $_POST['Poster'];
            $quocGia = $_POST['quocGia'];       
            $soTap = $_POST['soTap'];
            $trailer = $_POST['trailer'];
            $moTa = $_POST['moTa'];

            $sql = "INSERT INTO phim
                        (ten_phim, dao_dien_id, nam_phat_hanh, poster, quoc_gia_id, so_tap, trailer, mo_ta)
                    VALUES
                        ('$tenPhim', '$daoDien', '$namPhatHanh', '$Poster', '$quocGia', '$soTap', '$trailer', '$moTa')";

            if (mysqli_query($conn, $sql)) {
                header('Location: index.php?page_layout=phim');
                exit;
            } else {
                echo '<p class="warning">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
            }

        } else {
            echo "<p class='warning'> Vui lòng nhập đầy đủ thông tin ! </p>";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bộ phim</title>
    <style>
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <form action="index.php?page_layout=themphim" method="POST">
        <h1> Thêm bộ phim</h1>

        <div>
            <p>Tên phim</p>
            <input type="text" name="tenPhim" placeholder="Tên phim" />
        </div>

        <div class="div">
            <p>Đạo diễn</p>
            <select name="dao_dien">
                <?php
                $sql = "SELECT nd.* FROM nguoi_dung nd WHERE vai_tro_id = 2";
                $result = mysqli_query($conn, $sql);
                while ($daoDien = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $daoDien['id']; ?>">
                        <?php echo $daoDien['ho_ten']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="div">
            <p>Năm phát hành</p>
            <input type="number" name="namPhatHanh" placeholder="Năm phát hành" />
        </div>

        <div class="div">
            <p>Poster</p>
            <input type="text" name="Poster" placeholder="Poster" />
        </div>

        <div class="div">
            <p>Quốc gia</p>
            <select name="quocGia">
                <?php
                $sql = "SELECT * FROM quoc_gia";
                $result = mysqli_query($conn, $sql);
                while ($qg = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $qg['id']; ?>">
                        <?php echo $qg['ten_quoc_gia']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="div">
            <p>Số tập</p>
            <input type="number" name="soTap" placeholder="Số tập" />
        </div>

        <div class="div">
            <p>Trailer</p>
            <input type="text" name="trailer" placeholder="Trailer" />
        </div>

        <div class="div">
            <p>Mô tả</p>
            <textarea name="moTa" placeholder="Mô tả"></textarea>
        </div>

        <div>
            <button type="submit">Thêm mới</button>
        </div>
    </form>


</body>
</html>
