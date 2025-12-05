<?php
require "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['phim_id']) && !empty($_POST['the_loai_id'])) {
            $phimId = $_POST['phim_id'];
            $theLoaiId = $_POST['the_loai_id'];
            
            $sql = "INSERT INTO phim_the_loai (phim_id, the_loai_id) 
                    VALUES ('$phimId', '$theLoaiId')";
            
            if (mysqli_query($conn, $sql)) {
                header('Location: index.php?page_layout=phimtheloai');
                exit;
            } else {
                echo '<p class="warning"> Lỗi SQL: ' . mysqli_error($conn) . '</p>';
            }
        } else {
            echo "<p class='warning'>Vui lòng chọn phim và thể loại!</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gán thể loại cho phim</title>
    <style>
        .warning { color: red; }
    </style>
</head>
<body>
    <form action="index.php?page_layout=themphimtheloai" method="POST">
        <h1>Gán thể loại cho phim</h1>
        
        <div class="div">
            <p>Chọn phim</p>
            <select name="phim_id" required>
                <option value="">Chọn phim</option>
                <?php
                $sql = "SELECT * FROM phim";
                $result = mysqli_query($conn, $sql);
                while ($phim = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $phim['id']; ?>">
                        <?php echo ($phim['ten_phim']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="div">
            <p>Chọn thể loại</p>
            <select name="the_loai_id" required>
                <option value="">Chọn thể loại</option>
                <?php
                $sql = "SELECT * FROM the_loai";
                $result = mysqli_query($conn, $sql);
                while ($theLoai = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $theLoai['id']; ?>">
                        <?php echo ($theLoai['ten_the_loai']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <button type="submit">Gán thể loại</button>
        </div>
    </form>

    
</body>
</html>
