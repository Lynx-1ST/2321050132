CREATE DATABASE if not EXISTS cgv;

CREATE TABLE QuanLy (
  	id INT PRIMARY KEY,
    tenPhim varchar(50)
);
#1. Quản lí phim
CREATE TABLE quan_ly_phim (
    id INT PRIMARY KEY,
    tenPhim varchar(100),
    banner text,
    trailer text,
    maPhim int
    );
#2. USER
CREATE TABLE thong_tin_nguoi_dung (
    userName varchar(100),
    userID int PRIMARY KEY,
    userPass varchar(25),
 	subs BOOL,
    loai_subs int,
    FOREIGN KEY loai_subs REFERENCES subscription(loaiDangKi)
    );
#3. Thông tin phim
CREATE TABLE thong_tin_phim (
	thoiLuong double,
    daoDien varchar(100),
    namPhatHanh int,
    dienVien varchar(100),
    quocGia varchar(20),
    doTuoi int,
    theLoai varchar(20),
    filmID int,
	moTa text
);
#4. Subscription
CREATE TABLE subscription (
    userID int,
	FOREIGN KEY userID REFERENCES thong_tin_nguoi_dung(userID),
    ngayDangKi date,
    loaiDangKi int
);

#5. Rating
CREATE TABLE rating_film (
	rating int,
    userID int,
    maPhim int,
    FOREIGN KEY userID REFERENCES thong_tin_nguoi_dung(userID),
    FOREIGN KEY maPhim REFERENCES thong_tin_film(maPhim),
    tenPhim varchar(100),
    userName varchar(100),
    FOREIGN KEY userName REFERENCES thong_tin_nguoi_dung(userName)
);
#6. Permission
CREATE TABLE perms (
	id INT,
    role char
);
# Xây dựng 1 CSDL hoàn chỉnh, viết các câu lệnh để chạy nhiều lần không lỗi ! Mỗi 1 bảng tạo khoảng 30 dữ liệu