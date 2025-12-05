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
    $sql = "SELECT * FROM quoc_gia WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $quocGia = mysqli_fetch_assoc($result);
    ?>

    <form action="index.php?page_layout=suaquocgia&id=<?php echo $id; ?>" method="POST">
        <h1> Cập nhật quốc gia</h1>
        <div>
            <p>Tên quốc gia</p>
            <input type="text" name="ten_quoc_gia" 
                placeholder="Tên quốc gia"
                value="<?php echo $quocGia['ten_quoc_gia']; ?>" />
        </div>

        <div>
            <button type="submit">Cập nhật</button>
        </div>
    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['ten_quoc_gia'])) {
            $tenQuocGia = $_POST['ten_quoc_gia'];
            $sql = "UPDATE quoc_gia
                    SET ten_quoc_gia = '$tenQuocGia'
                    WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                header('Location: index.php?page_layout=quocgia');
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
