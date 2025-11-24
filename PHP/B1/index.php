<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - B1</title>
</head>
<body>
    <?php
     //1. In ra màn hình
     echo "Hello World <br>";
     echo "Hi ! <br>";

     //2. Biến
     $ten = "Dao Quang Loc";
     $tuoi = "28";
     echo $ten . "<br>";
     echo $ten . " " . $tuoi . " tuổi ! <br>";

     //3. Hằng
     define("soPi", "3.14 <br>");
     echo(soPi);

     //4. Phân biệt ' ' và " "
     echo '$ten' . "<br>";
     echo "$ten" . "<br>";

     //5. Chuỗi
     #5.1. Kiểm tra độ dài của chuỗi
     echo strlen($ten);
     #5.2. Đếm số từ
     echo str_word_count($ten);
     #5.3. Tìm kiếm ký tự trong chuỗi
     echo strpos($ten, "L");
     #5.4. Thay thế kí tự trong chuỗi
     echo str_replace("Loc", "L", $ten) . "<br>";

     //6. Toán tử
     $soThuNhat = 10;
     $soThuHai = 5;
     # + - * /
     # So sánh: == != > < >= <= ===
     # echo $soThuNhat += $soThuHai;

     //7. Câu điều kiện
     # if (clause) { } elseif(clause) { }
     # Kiểm tra tổng của số thứ nhất và số thứ hai, nếu nhỏ hơn 15 thì in ra "Nhỏ hơn 15", tương tự bằng và lớn hơn .
     $tong = $soThuNhat + $soThuHai;
     if ($tong < 15) {
        echo ("Nhỏ hơn 15");
     } elseif ($tong > 15) {
        echo ("Lớn hơn 15");
     } else {
        echo ("Bằng 15");
     }

     //8. Switch Case
     $color = "red";
     switch ($color) {
        case "red":
            echo "is red";
            break;
        case "blue":
            echo "is blue";
            break;
        default:
            echo "no color";
            break;        
     }

     //9. Vòng Lặp
     for ($i=0; $i < 100; $i++) {
        echo $i . "<br>";
     }

     //10. Mảng - Array
     $arr = ["Hi", "Hello", "Bonjour"];
     # Đếm phần tử
     echo count($arr);
     # In ra và xem giá trị mảng
     # echo $arr[1] - Không dùng được !
     print_r($arr);
     # Đổi phần tử khong mảng - Thay thế giá trị
     $arr[0] = "Halo";
     print_r($arr);
     # Xoá phần tử trong mảng
     unset($arr[2]);
     print_r($arr);
     # Sắp xếp mảng
     $mang = ["C", "B","D", "A"];
     print_r($mang);
     echo "<br>";
     # SX tăng 
     sort($mang);
     print_r($mang);
     # SX giảm
     rsort($mang);
     print_r($mang);

     #String to array
     $ten = "Dung, Kien, Hao, Minh, Phuong, Nam";

     //11. Kiểm tra xem biến có tồn tại hay không ?
     $bienA = "hello";
     isset($bienA);
     isset($bienB);

     if(isset($bienB)) {
        echo "Bien nay co ton tai !";
     } else {
        echo "Bien nay khong ton tai !";
     }

     # Check empty variable
     $check = "";
     if (empty($check)) {
        echo "empty";
     } else {
        echo "not empty";
     }

     //12. Hàm - Operator
     #Hàm không tham số 
     function xinChao() {
        return "Hello World";
     }
     echo xinChao();
     # Hàm có tham số
     function xinChao2($ten) {
        return "Hello " . $ten;
     }
     echo xinChao2("Lộc");
    ?>

</body>
</html>