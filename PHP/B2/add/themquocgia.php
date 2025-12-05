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
        .container {
            display: flex;
            justify-content: center;
        }
        form {
            border: 1px solid cyan;
            padding: 50px;
            border-radius: 10px;
            align-self: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <form action="index.php?page_layout=themquocgia" method="POST">
        <h1> Thêm quốc gia</h1>
        <div>
            <p>Quốc gia</p>
            <input type="text" name = "ten-quoc-gia" placeholder="Tên quốc gia" />
        </div>
        <div>
            <button type="submit">Thêm mới</button>
        </div>
        </div>
    </form>
    <?php 
require "connect.php";

if (!empty($_POST['ten-quoc-gia'])) {
    $tenQuocGia = $_POST['ten-quoc-gia'];
    $sql = "INSERT INTO quoc_gia (ten_quoc_gia) VALUES ('$tenQuocGia')";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?page_layout=quocgia');
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