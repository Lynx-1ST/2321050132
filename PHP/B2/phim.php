<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin phim</title>
    <style>
        table {
            width: 100%;
        }
    </style>
</head>
<body>

    <h1>Thông tin phim</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Tên phim</th>
            <th>Năm phát hành</th>
            <th>Đạo diễn</th>
            <th>Diễn viên</th>
            <th>Số tập</th>
            <th>Hành động</th>
        </tr>

        <?php 
        // 28->30 la ket noi voi SQL va lay danh sach phimmmmm
        include("connect.php");
        $sql = "SELECT * FROM phim";
        $result = mysqli_query($conn, $sql);
        // duyệt từng dòng trong cái select trên
        while ($phim = mysqli_fetch_array($result)) { //fetch_array - lay du lieu tu kq SQL roi tra ve duoi dang array
            $phim_id = $phim["id"];
            // dao_dien_id là khoá ngoại -> lấy 
            $sql = "SELECT ho_ten FROM nguoi_dung WHERE id = ".$phim['dao_dien_id']; // tạo 1 biến sql để lưu trữ query ( kh tạo cũng đc :> )
            $ketQua = mysqli_query($conn, $sql );
            // lấy cột ho_ten ròi lưu vào biến daoDien để tí in ra 
            $daoDien = mysqli_fetch_array($ketQua)['ho_ten'];

            // dien vien
            $tenDienVien = "";
            $sql = "SELECT dv.ten_dien_vien FROM phim_dien_vien pdv 
                    JOIN dien_vien dv ON dv.id = pdv.dien_vien_id
                    WHERE pdv.phim_id = $phim_id";
            $ketQua = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($ketQua)) {
                $tenDienVien .= $row['ten_dien_vien'] . ", "; // nối 2 chuỗi với nhau, cách nhau bằng dấu ,
            }
            $tenDienVien = rtrim($tenDienVien, ", ");

            // so tap
            $sql = "SELECT COUNT(*) AS tong_tap FROM tap_phim WHERE phim_id = $phim_id";
            $ketQua = mysqli_query($conn, $sql);
            $so_tap = mysqli_fetch_array($ketQua)['tong_tap'];
        ?>

        <tr>
            <td><?= $phim["ten_phim"] ?></td>
            <td><?= $phim["nam_phat_hanh"] ?></td>
            <td><?= $daoDien ?></td>
            <td><?= $tenDienVien ?></td>
            <td><?= $so_tap ?></td>
            <td>
                <button>Sửa</button>
                <a class="xoa" href="xoaphim.php?id=<?= $phim['id'] ?>">Xoá</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</body>
</html>
