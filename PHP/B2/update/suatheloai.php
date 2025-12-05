<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <?php  
    require 'connect.php';
    $id  = $_GET['id'];
    $sql = "SELECT * FROM the_loai WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $theLoai = mysqli_fetch_assoc($result);
    ?>

    <form action="index.php?page_layout=suatheloai&id=<?php echo $id; ?>" method="POST">
        <h1> Cập nhật thể loại</h1>
        <div>
            <p>Tên thể loại</p>
            <input type="text" name="ten_the_loai" 
                placeholder="Tên thể loại"
                value="<?php echo $theLoai['ten_the_loai'] ?>" />
        </div>

        <div>
            <button type="submit">Cập nhật</button>
        </div>
    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['ten_the_loai'])) {
            $tenTheLoai = $_POST['ten_the_loai'];
            $sql = "UPDATE the_loai SET ten_the_loai = '$tenTheLoai' WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                header('Location: index.php?page_layout=theloai');
                exit;
            } else {
                echo '<p class="warning">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
            }
        } else {
            echo "<p class='warning'> Vui lòng nhập đầy đủ thông tin ! </p>";
        }
    }
    ?>
</body>
</html>
