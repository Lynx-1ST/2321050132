<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quốc gia</title>
    <style>
        table { 
            width: 100%;
        }
    </style>
</head>
<body>

    <h1>Danh sách quốc gia</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Tên quốc gia</th>
            <th>Hành động</th>
        </tr>

        <?php 
        include("connect.php");
        $sql = "SELECT * FROM quoc_gia";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["ten_quoc_gia"] ?></td>
            <td>
                <button>Sửa</button>
                <a class="xoa" href="xoaquocgia.php?id=<?= $row['id'] ?>">Xoá</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
