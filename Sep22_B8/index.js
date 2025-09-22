// Nối chuỗi - cách dòng
document.writeln("Hello World <br>" + "<br>");

// Biến - truyền tham số
let hoTen = "Dao Quang Loc";
document.writeln(hoTen + "<br>");
// Hằng số
const pi = 3.14;

// Operators
let s1 = 10;
let s2 = 5;

let kq = 0;
kq = s1 + s2;
document.writeln(kq);
kq = s1 * s2;
document.writeln(kq);
kq = s1 / s2;
document.writeln(kq);

// Javascript - Thực hiện trước -> sau
kq++;
document.writeln(kq);
document.writeln(kq++); // !=

s1 += s2;
document.writeln(s1);

// So sánh
let s3 = 10;
let s4 = "10";
document.writeln(s3 != s4);
document.writeln(s3 !== s4); // === quan tâm đến kiểu dữ liệu - == không quan tâm kiểu dữ liệu
document.writeln(s3 == s4);

// Phủ định
document.writeln(!(s3 != s4));

// undefined
let s5;
document.writeln(s5 + "<br>");

// Object
let thongTinSinhVien = {
  hoTen: "Dao Quang Loc",
  maSV: "2321050132",
  gioiTinh: true,
  lop: "DCCTCT68_05",
  tuoi: "20",
};
let diaChi = {
  thanhPho: "TP_Thanh Hoa",
  phuong: "Dong Hai",
};
thongTinSinhVien.diaChi = diaChi;
let namNay = 2025;
document.writeln(
  "Xin chào, " +
    thongTinSinhVien.hoTen +
    "<br> Lớp: " +
    thongTinSinhVien.lop +
    "<br>Năm sinh: " +
    (namNay - thongTinSinhVien.tuoi) +
    "<br> ------------------------ Địa chỉ ---------------------- <br> " +
    "Thành phố: " +
    thongTinSinhVien.diaChi.thanhPho +
    "<br>Phường: " +
    thongTinSinhVien.diaChi.phuong +
    "<br>"
);

// Đổi kiểu dữ liệu
let int1 = parseInt("42.33"); // Đổi từ string về number (int)
let float1 = parseFloat("42.33"); // Đổi từ string về number (float)
document.writeln(int1);
document.writeln(float1);
document.writeln(typeof int1);

// parseInt  ->  let
let str = "10";
parseInt(str);
document.writeln(typeof str);
