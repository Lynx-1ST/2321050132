<?php
require 'connect.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['tenPhim']) && !empty($_POST['dao_dien_id']) 
    && !empty($_POST['namPhatHanh']) && !empty($_POST['poster']) 
    && !empty($_POST['quoc_gia_id']) && !empty($_POST['soTap'])
    && !empty($_POST['trailer']) && !empty($_POST['moTa']) ) {
        $tenPhim = $_POST['tenPhim'];
        $daoDienId = $_POST['dao_dien_id'];
        $namPhatHanh = $_POST['namPhatHanh'];
        $poster = $_POST['poster'];
        $quocGiaId = $_POST['quoc_gia_id'];
        $soTap = $_POST['soTap'];
        $trailer = $_POST['trailer'];
        $moTa = $_POST['moTa'];

    $sql = "UPDATE phim SET ten_phim = '$tenPhim',
        dao_dien_id = '$daoDienId', 
        nam_phat_hanh = '$namPhatHanh',
        poster        = '$poster',
        quoc_gia_id   = '$quocGiaId',
        so_tap        = '$soTap',
        trailer       = '$trailer',
        mo_ta         = '$moTa'
        WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?page_layout=phim');
            exit;
        } else {
            $error = 'Lỗi SQL: ' . mysqli_error($conn);
        }
    } else {
        echo "<p class='warning'> Vui lòng nhập đầy đủ thông tin ! </p>";
    }
}
$sql = "SELECT * FROM phim WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$phim = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật phim</title>
    <style>
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <form action="index.php?page_layout=suaphim&id=<?php echo $id; ?>" method="POST">
        <h1> Cập nhật phim</h1>
        <div>
            <p>Tên phim</p>
            <input type="text" name="tenPhim" placeholder="Tên phim" value="<?php echo $phim['ten_phim']; ?>" />
        </div>
        <div class="div">
            <p>Đạo diễn</p>
            <select name="dao_dien_id">
                <?php
                $sql = "SELECT nd.* FROM nguoi_dung nd WHERE vai_tro_id = 2";
                $result = mysqli_query($conn, $sql);
                while ($daoDien = mysqli_fetch_assoc($result)) {
                    $selected = ($daoDien['id'] == $phim['dao_dien_id']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $daoDien['id']; ?>" <?php echo $selected; ?>>
                        <?php echo $daoDien['ho_ten']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="div">
            <p>Năm phát hành</p>
            <input type="number" name="namPhatHanh" placeholder="Năm phát hành"
                value="<?php echo $phim['nam_phat_hanh']; ?>" />
        </div>
        <div class="div">
            <p>Poster (link hoặc tên file)</p>
            <input type="text" name="poster" placeholder="Poster"
                value="<?php echo $phim['poster']; ?>" />
        </div>
        <div class="div">
            <p>Quốc gia</p>
            <select name="quoc_gia_id">
                <?php
                $sql = "SELECT * FROM quoc_gia";
                $result = mysqli_query($conn, $sql);
                while ($qg = mysqli_fetch_assoc($result)) {
                    $selected = ($qg['id'] == $phim['quoc_gia_id']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $qg['id']; ?>" <?php echo $selected; ?>>
                        <?php echo $qg['ten_quoc_gia']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="div">
            <p>Số tập</p>
            <input type="number" name="soTap" placeholder="Số tập"
                value="<?php echo $phim['so_tap']; ?>" />
        </div>

        <div class="div">
            <p>Trailer (link)</p>
            <input type="text" name="trailer" placeholder="Trailer"
                value="<?php echo $phim['trailer']; ?>" />
        </div>

        <div class="div">
            <p>Mô tả</p>
            <textarea name="moTa" placeholder="Mô tả"><?php echo $phim['mo_ta']; ?></textarea>
        </div>

        <div>
            <button type="submit">Cập nhật</button>
        </div>
    </form>
</body>
</html>
