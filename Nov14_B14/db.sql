-- 1. Bảng thể loại
CREATE TABLE IF NOT EXISTS the_loai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_the_loai VARCHAR(50) NOT NULL
);

-- 2. Bảng vai trò
CREATE TABLE IF NOT EXISTS vai_tro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_vai_tro VARCHAR(20) NOT NULL
);

-- 3. Bảng quốc gia
CREATE TABLE IF NOT EXISTS quoc_gia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_quoc_gia VARCHAR(50) NOT NULL
);

-- 4. Bảng người dùng
CREATE TABLE IF NOT EXISTS nguoi_dung (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_dang_nhap VARCHAR(50) NOT NULL,
    mat_khau VARCHAR(50) NOT NULL,
    ho_ten VARCHAR(50),
    email VARCHAR(50),
    sdt VARCHAR(10),
    vai_tro_id INT,
    ngay_sinh DATETIME,
    FOREIGN KEY (vai_tro_id) REFERENCES vai_tro(id)
);

-- 5. Bảng phim
CREATE TABLE IF NOT EXISTS phim (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_phim VARCHAR(255) NOT NULL,
    dao_dien_id INT,
    nam_phat_hanh INT,
    poster VARCHAR(255),
    quoc_gia_id INT,
    so_tap INT,
    trailer VARCHAR(255),
    mo_ta TEXT,
    FOREIGN KEY (dao_dien_id) REFERENCES nguoi_dung(id),
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id)
);

-- 6. Bảng phim - diễn viên
CREATE TABLE IF NOT EXISTS phim_dien_vien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    phim_id INT,
    dien_vien_id INT,
    FOREIGN KEY (phim_id) REFERENCES phim(id),
    FOREIGN KEY (dien_vien_id) REFERENCES nguoi_dung(id)
);

-- 7. Bảng phim - thể loại
CREATE TABLE IF NOT EXISTS phim_the_loai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    phim_id INT,
    the_loai_id INT,
    FOREIGN KEY (phim_id) REFERENCES phim(id),
    FOREIGN KEY (the_loai_id) REFERENCES the_loai(id)
);

-- 8. Bảng tập phim
CREATE TABLE IF NOT EXISTS tap_phim (
    id INT PRIMARY KEY AUTO_INCREMENT,
    so_tap INT,
    tieu_de VARCHAR(255),
    phim_id INT,
    thoi_luong FLOAT,
    trailer VARCHAR(255),
    FOREIGN KEY (phim_id) REFERENCES phim(id)
);
-- GIẢ ĐỊNH: đã USE quan_ly_web_phim;

-- 1. the_loai
INSERT INTO the_loai (ten_the_loai) VALUES
('Hành động'),
('Tình cảm'),
('Hài'),
('Kinh dị'),
('Viễn tưởng'),
('Hoạt hình'),
('Tâm lý'),
('Hình sự'),
('Phiêu lưu'),
('Gia đình');

-- 2. vai_tro
INSERT INTO vai_tro (ten_vai_tro) VALUES
('admin'),
('dao_dien'),
('dien_vien'),
('user');

-- 3. quoc_gia
INSERT INTO quoc_gia (ten_quoc_gia) VALUES
('Viet Nam'),
('My'),
('Han Quoc'),
('Nhat Ban'),
('Anh'),
('Phap'),
('Duc'),
('Trung Quoc'),
('Thai Lan'),
('An Do');

-- 4. nguoi_dung
-- id 1: admin
-- id 2-11: dao_dien
-- id 12-30: dien_vien
INSERT INTO nguoi_dung
(ten_dang_nhap, mat_khau, ho_ten, email, sdt, vai_tro_id, ngay_sinh) VALUES
('admin', 'pass_admin', 'Admin He Thong', 'admin@example.com', '0900000001', 1, '1985-01-01 00:00:00'),

('dd1', 'pass_dd1', 'Dao Dien 1', 'dd1@example.com', '0900000002', 2, '1970-01-01 00:00:00'),
('dd2', 'pass_dd2', 'Dao Dien 2', 'dd2@example.com', '0900000003', 2, '1971-02-02 00:00:00'),
('dd3', 'pass_dd3', 'Dao Dien 3', 'dd3@example.com', '0900000004', 2, '1972-03-03 00:00:00'),
('dd4', 'pass_dd4', 'Dao Dien 4', 'dd4@example.com', '0900000005', 2, '1973-04-04 00:00:00'),
('dd5', 'pass_dd5', 'Dao Dien 5', 'dd5@example.com', '0900000006', 2, '1974-05-05 00:00:00'),
('dd6', 'pass_dd6', 'Dao Dien 6', 'dd6@example.com', '0900000007', 2, '1975-06-06 00:00:00'),
('dd7', 'pass_dd7', 'Dao Dien 7', 'dd7@example.com', '0900000008', 2, '1976-07-07 00:00:00'),
('dd8', 'pass_dd8', 'Dao Dien 8', 'dd8@example.com', '0900000009', 2, '1977-08-08 00:00:00'),
('dd9', 'pass_dd9', 'Dao Dien 9', 'dd9@example.com', '0900000010', 2, '1978-09-09 00:00:00'),
('dd10', 'pass_dd10', 'Dao Dien 10', 'dd10@example.com', '0900000011', 2, '1979-10-10 00:00:00'),

('dv1', 'pass_dv1', 'Dien Vien 1', 'dv1@example.com', '0910000001', 3, '1990-01-01 00:00:00'),
('dv2', 'pass_dv2', 'Dien Vien 2', 'dv2@example.com', '0910000002', 3, '1990-02-02 00:00:00'),
('dv3', 'pass_dv3', 'Dien Vien 3', 'dv3@example.com', '0910000003', 3, '1990-03-03 00:00:00'),
('dv4', 'pass_dv4', 'Dien Vien 4', 'dv4@example.com', '0910000004', 3, '1990-04-04 00:00:00'),
('dv5', 'pass_dv5', 'Dien Vien 5', 'dv5@example.com', '0910000005', 3, '1990-05-05 00:00:00'),
('dv6', 'pass_dv6', 'Dien Vien 6', 'dv6@example.com', '0910000006', 3, '1990-06-06 00:00:00'),
('dv7', 'pass_dv7', 'Dien Vien 7', 'dv7@example.com', '0910000007', 3, '1990-07-07 00:00:00'),
('dv8', 'pass_dv8', 'Dien Vien 8', 'dv8@example.com', '0910000008', 3, '1990-08-08 00:00:00'),
('dv9', 'pass_dv9', 'Dien Vien 9', 'dv9@example.com', '0910000009', 3, '1990-09-09 00:00:00'),
('dv10', 'pass_dv10', 'Dien Vien 10', 'dv10@example.com', '0910000010', 3, '1990-10-10 00:00:00'),
('dv11', 'pass_dv11', 'Dien Vien 11', 'dv11@example.com', '0910000011', 3, '1990-11-11 00:00:00'),
('dv12', 'pass_dv12', 'Dien Vien 12', 'dv12@example.com', '0910000012', 3, '1990-12-12 00:00:00'),
('dv13', 'pass_dv13', 'Dien Vien 13', 'dv13@example.com', '0910000013', 3, '1991-01-01 00:00:00'),
('dv14', 'pass_dv14', 'Dien Vien 14', 'dv14@example.com', '0910000014', 3, '1991-02-02 00:00:00'),
('dv15', 'pass_dv15', 'Dien Vien 15', 'dv15@example.com', '0910000015', 3, '1991-03-03 00:00:00'),
('dv16', 'pass_dv16', 'Dien Vien 16', 'dv16@example.com', '0910000016', 3, '1991-04-04 00:00:00'),
('dv17', 'pass_dv17', 'Dien Vien 17', 'dv17@example.com', '0910000017', 3, '1991-05-05 00:00:00'),
('dv18', 'pass_dv18', 'Dien Vien 18', 'dv18@example.com', '0910000018', 3, '1991-06-06 00:00:00'),
('dv19', 'pass_dv19', 'Dien Vien 19', 'dv19@example.com', '0910000019', 3, '1991-07-07 00:00:00');

-- 5. phim (30 phim, dao_dien_id = 2..11, quoc_gia_id = 1..10)
INSERT INTO phim
(ten_phim, dao_dien_id, nam_phat_hanh, poster, quoc_gia_id, so_tap, trailer, mo_ta) VALUES
('Phim 1', 2, 2010, 'phim1.jpg', 1, 1, 'https://example.com/trailer/p1', 'Mo ta phim 1'),
('Phim 2', 3, 2011, 'phim2.jpg', 2, 1, 'https://example.com/trailer/p2', 'Mo ta phim 2'),
('Phim 3', 4, 2012, 'phim3.jpg', 3, 1, 'https://example.com/trailer/p3', 'Mo ta phim 3'),
('Phim 4', 5, 2013, 'phim4.jpg', 4, 1, 'https://example.com/trailer/p4', 'Mo ta phim 4'),
('Phim 5', 6, 2014, 'phim5.jpg', 5, 1, 'https://example.com/trailer/p5', 'Mo ta phim 5'),
('Phim 6', 7, 2015, 'phim6.jpg', 6, 1, 'https://example.com/trailer/p6', 'Mo ta phim 6'),
('Phim 7', 8, 2016, 'phim7.jpg', 7, 1, 'https://example.com/trailer/p7', 'Mo ta phim 7'),
('Phim 8', 9, 2017, 'phim8.jpg', 8, 1, 'https://example.com/trailer/p8', 'Mo ta phim 8'),
('Phim 9', 10, 2018, 'phim9.jpg', 9, 1, 'https://example.com/trailer/p9', 'Mo ta phim 9'),
('Phim 10', 11, 2019, 'phim10.jpg', 10, 1, 'https://example.com/trailer/p10', 'Mo ta phim 10'),
('Phim 11', 2, 2020, 'phim11.jpg', 1, 1, 'https://example.com/trailer/p11', 'Mo ta phim 11'),
('Phim 12', 3, 2021, 'phim12.jpg', 2, 1, 'https://example.com/trailer/p12', 'Mo ta phim 12'),
('Phim 13', 4, 2015, 'phim13.jpg', 3, 1, 'https://example.com/trailer/p13', 'Mo ta phim 13'),
('Phim 14', 5, 2016, 'phim14.jpg', 4, 1, 'https://example.com/trailer/p14', 'Mo ta phim 14'),
('Phim 15', 6, 2017, 'phim15.jpg', 5, 1, 'https://example.com/trailer/p15', 'Mo ta phim 15'),
('Phim 16', 7, 2018, 'phim16.jpg', 6, 1, 'https://example.com/trailer/p16', 'Mo ta phim 16'),
('Phim 17', 8, 2019, 'phim17.jpg', 7, 1, 'https://example.com/trailer/p17', 'Mo ta phim 17'),
('Phim 18', 9, 2020, 'phim18.jpg', 8, 1, 'https://example.com/trailer/p18', 'Mo ta phim 18'),
('Phim 19', 10, 2021, 'phim19.jpg', 9, 1, 'https://example.com/trailer/p19', 'Mo ta phim 19'),
('Phim 20', 11, 2022, 'phim20.jpg', 10, 1, 'https://example.com/trailer/p20', 'Mo ta phim 20'),
('Phim 21', 2, 2010, 'phim21.jpg', 1, 1, 'https://example.com/trailer/p21', 'Mo ta phim 21'),
('Phim 22', 3, 2011, 'phim22.jpg', 2, 1, 'https://example.com/trailer/p22', 'Mo ta phim 22'),
('Phim 23', 4, 2012, 'phim23.jpg', 3, 1, 'https://example.com/trailer/p23', 'Mo ta phim 23'),
('Phim 24', 5, 2013, 'phim24.jpg', 4, 1, 'https://example.com/trailer/p24', 'Mo ta phim 24'),
('Phim 25', 6, 2014, 'phim25.jpg', 5, 1, 'https://example.com/trailer/p25', 'Mo ta phim 25'),
('Phim 26', 7, 2015, 'phim26.jpg', 6, 1, 'https://example.com/trailer/p26', 'Mo ta phim 26'),
('Phim 27', 8, 2016, 'phim27.jpg', 7, 1, 'https://example.com/trailer/p27', 'Mo ta phim 27'),
('Phim 28', 9, 2017, 'phim28.jpg', 8, 1, 'https://example.com/trailer/p28', 'Mo ta phim 28'),
('Phim 29', 10, 2018, 'phim29.jpg', 9, 1, 'https://example.com/trailer/p29', 'Mo ta phim 29'),
('Phim 30', 11, 2019, 'phim30.jpg', 10, 1, 'https://example.com/trailer/p30', 'Mo ta phim 30');

-- 6. phim_the_loai (mỗi phim 1–2 thể loại)
INSERT INTO phim_the_loai (phim_id, the_loai_id) VALUES
(1,1),(1,2),
(2,2),(2,3),
(3,2),
(4,1),
(5,5),
(6,5),
(7,1),(7,9),
(8,7),
(9,5),
(10,2),(10,9),
(11,1),
(12,4),
(13,7),
(14,2),
(15,3),
(16,1),
(17,5),
(18,7),
(19,1),(19,5),
(20,2),
(21,1),
(22,3),
(23,7),
(24,4),
(25,2),
(26,1),
(27,5),
(28,7),
(29,1),
(30,2);

-- 7. phim_dien_vien (mỗi phim 2 diễn viên: dùng id 12..30)
INSERT INTO phim_dien_vien (phim_id, dien_vien_id) VALUES
(1,12),(1,13),
(2,13),(2,14),
(3,14),(3,15),
(4,15),(4,16),
(5,16),(5,17),
(6,17),(6,18),
(7,18),(7,19),
(8,19),(8,20),
(9,20),(9,21),
(10,21),(10,22),
(11,22),(11,23),
(12,23),(12,24),
(13,24),(13,25),
(14,25),(14,26),
(15,26),(15,27),
(16,27),(16,28),
(17,28),(17,29),
(18,29),(18,30),
(19,12),(19,13),
(20,14),(20,15),
(21,16),(21,17),
(22,18),(22,19),
(23,20),(23,21),
(24,22),(24,23),
(25,24),(25,25),
(26,26),(26,27),
(27,28),(27,29),
(28,30),(28,12),
(29,13),(29,14),
(30,15),(30,16);

-- 8. tap_phim (5 phim đầu, mỗi phim 3 tập = 15 rows)
INSERT INTO tap_phim (so_tap, tieu_de, phim_id, thoi_luong, trailer) VALUES
(1,'Phim 1 - Tap 1',1,90,'https://example.com/trailer/p1_t1'),
(2,'Phim 1 - Tap 2',1,92,'https://example.com/trailer/p1_t2'),
(3,'Phim 1 - Tap 3',1,88,'https://example.com/trailer/p1_t3'),

(1,'Phim 2 - Tap 1',2,45,'https://example.com/trailer/p2_t1'),
(2,'Phim 2 - Tap 2',2,47,'https://example.com/trailer/p2_t2'),
(3,'Phim 2 - Tap 3',2,44,'https://example.com/trailer/p2_t3'),

(1,'Phim 3 - Tap 1',3,50,'https://example.com/trailer/p3_t1'),
(2,'Phim 3 - Tap 2',3,51,'https://example.com/trailer/p3_t2'),
(3,'Phim 3 - Tap 3',3,49,'https://example.com/trailer/p3_t3'),

(1,'Phim 4 - Tap 1',4,40,'https://example.com/trailer/p4_t1'),
(2,'Phim 4 - Tap 2',4,42,'https://example.com/trailer/p4_t2'),
(3,'Phim 4 - Tap 3',4,41,'https://example.com/trailer/p4_t3'),

(1,'Phim 5 - Tap 1',5,60,'https://example.com/trailer/p5_t1'),
(2,'Phim 5 - Tap 2',5,62,'https://example.com/trailer/p5_t2'),
(3,'Phim 5 - Tap 3',5,59,'https://example.com/trailer/p5_t3');


SELECT 
    p.*, 
    qg.ten_quoc_gia,
    us.ho_ten AS dao_dien,
    dv.ten_dien_vien
FROM phim p
JOIN quoc_gia qg ON p.quoc_gia_id = qg.id
JOIN nguoi_dung us ON p.dao_dien_id = us.id
JOIN phim_dien_vien pdv ON p.id = pdv.phim_id
JOIN nguoi_dung dv ON pdv.dien_vien_id = dv.id
WHERE p.id = 10;

SELECT p.ten_phim, qg.ten_quoc_gia, nd.ho_ten as dao_dien, dv.ho_ten as dien_vien 
from phim p 
join quoc_gia qg on p.quoc_gia_id = qg.id
join nguoi_dung nd on p.dao_dien_id = nd.id 
join phim_dien_vien pdv on p.id = pdv.phim_id 
join nguoi_dung dv on pdv.dien_vien_id = dv.id 
where p.id = 10;