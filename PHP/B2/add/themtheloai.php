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
    <form action="index.php?page_layout=themtheloai" method="POST">
        <h1> Thêm thể loại</h1>
        <div>
            <p>Thể loại</p>
            <input type="text" name = "ten-the-loai" placeholder="Tên thể loại" />
        </div>
        <div>
            <button type="submit">Thêm mới</button>
        </div>
    </form>

    <?php 
require "connect.php";
if (!empty($_POST['ten-the-loai'])) {
    $tenTheLoai = $_POST['ten-the-loai'];
    $sql = "INSERT INTO the_loai (ten_the_loai) VALUES ('$tenTheLoai')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?page_layout=theloai');
        exit;
    } else {
        echo '<p class="warning">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
    }

} else {
    echo "<p class='warning'> Vui lòng nhập đầy đủ thông tin ! </p>";
}
?>
</body>
</html>