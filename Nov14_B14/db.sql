DROP DATABASE IF EXISTS quan_ly_web_phim;
CREATE DATABASE IF NOT EXISTS quan_ly_web_phim;
USE quan_ly_web_phim;

CREATE TABLE IF NOT EXISTS the_loai (
  id INT PRIMARY KEY,
  ten_the_loai VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS vai_tro (
  id INT PRIMARY KEY,
  ten_vai_tro VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS quoc_gia (
  id INT PRIMARY KEY,
  ten_quoc_gia VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS nguoi_dung (
  id INT PRIMARY KEY,
  ten_dang_nhap VARCHAR(50),
  mat_khau VARCHAR(50),
  ho_ten VARCHAR(50),
  email VARCHAR(50),
  sdt VARCHAR(10),
  vai_tro_id INT,
  ngay_sinh DATETIME,
  FOREIGN KEY (vai_tro_id) REFERENCES vai_tro(id)
);

CREATE TABLE IF NOT EXISTS dien_vien (
  id INT PRIMARY KEY,
  ten_dien_vien VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS phim (
  id INT PRIMARY KEY,
  ten_phim VARCHAR(255),
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

CREATE TABLE IF NOT EXISTS phim_dien_vien (
  id INT PRIMARY KEY,
  phim_id INT,
  dien_vien_id INT,
  FOREIGN KEY (phim_id) REFERENCES phim(id),
  FOREIGN KEY (dien_vien_id) REFERENCES dien_vien(id)
);

CREATE TABLE IF NOT EXISTS phim_the_loai (
  id INT PRIMARY KEY,
  phim_id INT,
  the_loai_id INT,
  FOREIGN KEY (phim_id) REFERENCES phim(id),
  FOREIGN KEY (the_loai_id) REFERENCES the_loai(id)
);

CREATE TABLE IF NOT EXISTS tap_phim (
  id INT PRIMARY KEY,
  so_tap INT,
  tieu_de VARCHAR(255),
  phim_id INT,
  thoi_luong FLOAT,
  trailer VARCHAR(255),
  FOREIGN KEY (phim_id) REFERENCES phim(id)
);


INSERT IGNORE INTO vai_tro (id, ten_vai_tro) VALUES
  (1, 'admin'),
  (2, 'user'),
  (3, 'guest');


INSERT IGNORE INTO quoc_gia (id, ten_quoc_gia) VALUES
  (1, 'Việt Nam'),
  (2, 'Mỹ'),
  (3, 'Hàn Quốc'),
  (4, 'Nhật Bản'),
  (5, 'Pháp'),
  (6, 'Anh'),
  (7, 'Trung Quốc'),
  (8, 'Ấn Độ'),
  (9, 'Đức'),
  (10, 'Úc');


INSERT IGNORE INTO the_loai (id, ten_the_loai) VALUES
  (1, 'Hành Động'),
  (2, 'Phiêu Lưu'),
  (3, 'Hài Hước'),
  (4, 'Kinh Dị'),
  (5, 'Tình Cảm'),
  (6, 'Viễn Tưởng'),
  (7, 'Hoạt Hình'),
  (8, 'Tài Liệu'),
  (9, 'Chiến Tranh'),
  (10, 'Âm Nhạc');


INSERT INTO nguoi_dung (id, ten_dang_nhap, mat_khau, ho_ten, email, sdt, vai_tro_id, ngay_sinh) VALUES
  (1, 'user1', 'pass1', 'Nguyen Van A', 'user1@mail.com', '0123456781', 1, '1990-01-01'),
  (2, 'user2', 'pass2', 'Tran Thi B', 'user2@mail.com', '0123456782', 2, '1991-02-02'),
  (3, 'user3', 'pass3', 'Le Van C', 'user3@mail.com', '0123456783', 3, '1992-03-03'),
  (4, 'user4', 'pass4', 'Pham Thi D', 'user4@mail.com', '0123456784', 1, '1993-04-04'),
  (5, 'user5', 'pass5', 'Hoang Van E', 'user5@mail.com', '0123456785', 2, '1994-05-05'),
  (6, 'user6', 'pass6', 'Bui Thi F', 'user6@mail.com', '0123456786', 3, '1995-06-06'),
  (7, 'user7', 'pass7', 'Do Van G', 'user7@mail.com', '0123456787', 1, '1990-07-07'),
  (8, 'user8', 'pass8', 'Vu Thi H', 'user8@mail.com', '0123456788', 2, '1991-08-08'),
  (9, 'user9', 'pass9', 'Luong Van I', 'user9@mail.com', '0123456789', 3, '1992-09-09'),
  (10, 'user10', 'pass10', 'Phan Thi K', 'user10@mail.com', '0123456790', 1, '1993-10-10'),
  (11, 'user11', 'pass11', 'Trinh Van L', 'user11@mail.com', '0123456791', 2, '1994-11-11'),
  (12, 'user12', 'pass12', 'Ngoc Thi M', 'user12@mail.com', '0123456792', 3, '1995-12-12'),
  (13, 'user13', 'pass13', 'Dinh Van N', 'user13@mail.com', '0123456793', 1, '1996-01-13'),
  (14, 'user14', 'pass14', 'Quach Thi O', 'user14@mail.com', '0123456794', 2, '1997-02-14'),
  (15, 'user15', 'pass15', 'Mai Van P', 'user15@mail.com', '0123456795', 3, '1998-03-15'),
  (16, 'user16', 'pass16', 'Ngo Thi Q', 'user16@mail.com', '0123456796', 1, '1999-04-16'),
  (17, 'user17', 'pass17', 'Tran Van R', 'user17@mail.com', '0123456797', 2, '2000-05-17'),
  (18, 'user18', 'pass18', 'Le Thi S', 'user18@mail.com', '0123456798', 3, '2001-06-18'),
  (19, 'user19', 'pass19', 'Pham Van T', 'user19@mail.com', '0123456799', 1, '2002-07-19'),
  (20, 'user20', 'pass20', 'Hoang Thi U', 'user20@mail.com', '0123456700', 2, '2003-08-20'),
  (21, 'user21', 'pass21', 'Bui Van V', 'user21@mail.com', '0123456701', 3, '2004-09-21'),
  (22, 'user22', 'pass22', 'Do Thi W', 'user22@mail.com', '0123456702', 1, '2005-10-22'),
  (23, 'user23', 'pass23', 'Vu Van X', 'user23@mail.com', '0123456703', 2, '2006-11-23'),
  (24, 'user24', 'pass24', 'Luong Thi Y', 'user24@mail.com', '0123456704', 3, '2007-12-24'),
  (25, 'user25', 'pass25', 'Phan Van Z', 'user25@mail.com', '0123456705', 1, '2008-01-25'),
  (26, 'user26', 'pass26', 'Trinh Thi A1', 'user26@mail.com', '0123456706', 2, '2009-02-26'),
  (27, 'user27', 'pass27', 'Ngoc Van B1', 'user27@mail.com', '0123456707', 3, '2010-03-27'),
  (28, 'user28', 'pass28', 'Dinh Thi C1', 'user28@mail.com', '0123456708', 1, '2011-04-28'),
  (29, 'user29', 'pass29', 'Quach Van D1', 'user29@mail.com', '0123456709', 2, '2012-05-29'),
  (30, 'user30', 'pass30', 'Mai Thi E1', 'user30@mail.com', '0123456710', 3, '2013-06-30');

INSERT INTO dien_vien (id, ten_dien_vien) VALUES
  (1, 'Bruce Willis'),
  (2, 'Scarlett Johansson'),
  (3, 'Tom Hanks'),
  (4, 'Natalie Portman'),
  (5, 'Denzel Washington'),
  (6, 'Jennifer Lawrence'),
  (7, 'Leonardo DiCaprio'),
  (8, 'Angelina Jolie'),
  (9, 'Johnny Depp'),
  (10, 'Emma Stone'),
  (11, 'Morgan Freeman'),
  (12, 'Margot Robbie'),
  (13, 'Samuel L. Jackson'),
  (14, 'Gal Gadot'),
  (15, 'Chris Evans'),
  (16, 'Anne Hathaway'),
  (17, 'Matt Damon'),
  (18, 'Charlize Theron'),
  (19, 'Ryan Reynolds'),
  (20, 'Viola Davis'),
  (21, 'Hugh Jackman'),
  (22, 'Amy Adams'),
  (23, 'Will Smith'),
  (24, 'Emily Blunt'),
  (25, 'Jake Gyllenhaal'),
  (26, 'Rachel McAdams'),
  (27, 'Robert Downey Jr.'),
  (28, 'Natalie Dormer'),
  (29, 'Mark Ruffalo'),
  (30, 'Zoe Saldana');

INSERT INTO phim (id, ten_phim, dao_dien_id, nam_phat_hanh, poster, quoc_gia_id, so_tap, trailer, mo_ta) VALUES
  (1, 'The Scent of Green Papaya', 1, 1993, 'poster1.jpg', 1, 12, 'trailer1.mp4', 'Phim Việt Nam kinh điển, đoạt giải Cannes.'),
  (2, 'The Shawshank Redemption', 2, 1994, 'poster2.jpg', 2, 22, 'trailer2.mp4', 'Một trong những phim hay nhất mọi thời đại.'),
  (3, 'Parasite', 3, 2019, 'poster3.jpg', 3, 12, 'trailer3.mp4', 'Phim Hàn Quốc đoạt giải Oscar Phim hay nhất.'),
  (4, 'Seven Samurai', 4, 1954, 'poster4.jpg', 4, 14, 'trailer4.mp4', 'Tác phẩm kinh điển Nhật Bản của Akira Kurosawa.'),
  (5, 'Amélie', 5, 2001, 'poster5.jpg', 5, 15, 'trailer5.mp4', 'Phim Pháp lãng mạn nổi tiếng.'),
  (6, 'The King’s Speech', 6, 2010, 'poster6.jpg', 6, 13, 'trailer6.mp4', 'Phim Anh về vua George VI vượt khó.'),
  (7, 'Crouching Tiger, Hidden Dragon', 7, 2000, 'poster7.jpg', 7, 18, 'trailer7.mp4', 'Phim võ thuật Trung Quốc nổi tiếng.'),
  (8, 'Dangal', 8, 2016, 'poster8.jpg', 8, 19, 'trailer8.mp4', 'Phim Ấn Độ về nữ đô vật.'),
  (9, 'The Lord of the Rings: The Return of the King', 9, 2003, 'poster9.jpg', 2, 20, 'trailer9.mp4', 'Phim sử thi giả tưởng Mỹ.'),
  (10, 'Furie', 10, 2019, 'poster10.jpg', 1, 10, 'trailer10.mp4', 'Phim hành động Việt Nam với nữ chính mạnh mẽ.'),
  (11, 'Train to Busan', 11, 2016, 'poster11.jpg', 3, 12, 'trailer11.mp4', 'Phim zombie Hàn Quốc gay cấn.'),
  (12, 'The White Silk Dress', 12, 2006, 'poster12.jpg', 1, 11, 'trailer12.mp4', 'Phim Việt Nam kể về chiến tranh.'),
  (13, 'Avengers: Endgame', 13, 2019, 'poster13.jpg', 2, 22, 'trailer13.mp4', 'Phim siêu anh hùng Mỹ nổi tiếng.'),
  (14, 'Ikiru', 14, 1952, 'poster14.jpg', 4, 14, 'trailer14.mp4', 'Phim Nhật Bản của đạo diễn Kurosawa.'),
  (15, 'La Haine', 15, 1995, 'poster15.jpg', 5, 13, 'trailer15.mp4', 'Phim Pháp về xã hội và bạo lực.'),
  (16, 'Sherlock Holmes', 16, 2009, 'poster16.jpg', 6, 15, 'trailer16.mp4', 'Phim trinh thám Anh với Robert Downey Jr.'),
  (17, 'Hero', 17, 2002, 'poster17.jpg', 7, 19, 'trailer17.mp4', 'Phim võ thuật Trung Quốc với Jet Li.'),
  (18, '3 Idiots', 18, 2009, 'poster18.jpg', 8, 16, 'trailer18.mp4', 'Phim hài đời học sinh Ấn Độ.'),
  (19, 'The Dark Knight', 19, 2008, 'poster19.jpg', 2, 21, 'trailer19.mp4', 'Phim siêu anh hùng Mỹ của Christopher Nolan.'),
  (20, 'Inside the Yellow Cocoon Shell', 20, 2023, 'poster20.jpg', 1, 12, 'trailer20.mp4', 'Phim Việt Nam đề tài tâm linh.'),
  (21, 'The Intouchables', 21, 2011, 'poster21.jpg', 5, 14, 'trailer21.mp4', 'Phim Pháp kể chuyện cảm động.'),
  (22, 'The Rebel', 22, 2007, 'poster22.jpg', 1, 13, 'trailer22.mp4', 'Phim hành động Việt Nam.'),
  (23, 'Bohemian Rhapsody', 23, 2018, 'poster23.jpg', 6, 14, 'trailer23.mp4', 'Phim tiểu sử âm nhạc Anh.'),
  (24, 'Ip Man', 24, 2008, 'poster24.jpg', 7, 18, 'trailer24.mp4', 'Phim võ thuật Trung Quốc về võ sư Vịnh Xuân.'),
  (25, 'Kantara: A Legend Chapter-1', 25, 2025, 'poster25.jpg', 8, 21, 'trailer25.mp4', 'Phim hành động Ấn Độ mới nổi.'),
  (26, 'Don’t Burn', 26, 2009, 'poster26.jpg', 1, 11, 'trailer26.mp4', 'Phim chiến tranh Việt Nam.'),
  (27, 'Once Upon a Time in Vu Dai Village', 27, 1982, 'poster27.jpg', 1, 10, 'trailer27.mp4', 'Phim Việt Nam cổ điển.'),
  (28, 'My Neighbor Totoro', 28, 1988, 'poster28.jpg', 4, 12, 'trailer28.mp4', 'Phim hoạt hình Nhật Bản cổ điển.'),
  (29, 'Lawrence of Arabia', 29, 1962, 'poster29.jpg', 6, 15, 'trailer29.mp4', 'Phim điện ảnh sử thi Anh.'),
  (30, 'Avatar: The Way of Water', 30, 2022, 'poster30.jpg', 2, 22, 'trailer30.mp4', 'Phim giả tưởng Mỹ Hollywood.');

INSERT INTO phim_dien_vien (id, phim_id, dien_vien_id) VALUES
  (1, 1, 1),
  (2, 2, 2),
  (3, 3, 3),
  (4, 4, 4),
  (5, 5, 5),
  (6, 6, 6),
  (7, 7, 7),
  (8, 8, 8),
  (9, 9, 9),
  (10, 10, 10),
  (11, 11, 11),
  (12, 12, 12),
  (13, 13, 13),
  (14, 14, 14),
  (15, 15, 15),
  (16, 16, 16),
  (17, 17, 17),
  (18, 18, 18),
  (19, 19, 19),
  (20, 20, 20),
  (21, 21, 21),
  (22, 22, 22),
  (23, 23, 23),
  (24, 24, 24),
  (25, 25, 25),
  (26, 26, 26),
  (27, 27, 27),
  (28, 28, 28),
  (29, 29, 29),
  (30, 30, 30);

INSERT INTO phim_the_loai (id, phim_id, the_loai_id) VALUES
  (1, 1, 1),
  (2, 2, 2),
  (3, 3, 3),
  (4, 4, 4),
  (5, 5, 5),
  (6, 6, 6),
  (7, 7, 7),
  (8, 8, 8),
  (9, 9, 9),
  (10, 10, 10),
  (11, 11, 1),
  (12, 12, 2), 
  (13, 13, 3), 
  (14, 14, 4), 
  (15, 15, 5),
  (16, 16, 6), 
  (17, 17, 7), 
  (18, 18, 8), 
  (19, 19, 9), 
  (20, 20, 10),
  (21, 21, 1), 
  (22, 22, 2), 
  (23, 23, 3), 
  (24, 24, 4), 
  (25, 25, 5),
  (26, 26, 6), 
  (27, 27, 7), 
  (28, 28, 8), 
  (29, 29, 9), 
  (30, 30, 10);


INSERT INTO tap_phim (id, so_tap, tieu_de, phim_id, thoi_luong, trailer) VALUES
  (1, 1, 'Episode 1', 1, 45.0, 'tap1.mp4'),
  (2, 2, 'Episode 2', 1, 44.5, 'tap2.mp4'),
  (3, 3, 'Episode 3', 2, 46.0, 'tap3.mp4'),
  (4, 4, 'Episode 4', 2, 47.0, 'tap4.mp4'),
  (5, 5, 'Episode 5', 3, 45.5, 'tap5.mp4'),
  (6, 6, 'Episode 6', 3, 44.0, 'tap6.mp4'),
  (7, 7, 'Episode 7', 4, 46.5, 'tap7.mp4'),
  (8, 8, 'Episode 8', 4, 47.3, 'tap8.mp4'),
  (9, 9, 'Episode 9', 5, 45.7, 'tap9.mp4'),
  (10, 10, 'Episode 10', 5, 44.8, 'tap10.mp4'),
  (11, 11, 'Episode 11', 6, 46.1, 'tap11.mp4'),
  (12, 12, 'Episode 12', 6, 47.2, 'tap12.mp4'),
  (13, 13, 'Episode 13', 7, 45.6, 'tap13.mp4'),
  (14, 14, 'Episode 14', 7, 44.7, 'tap14.mp4'),
  (15, 15, 'Episode 15', 8, 46.3, 'tap15.mp4'),
  (16, 16, 'Episode 16', 8, 47.1, 'tap16.mp4'),
  (17, 17, 'Episode 17', 9, 45.9, 'tap17.mp4'),
  (18, 18, 'Episode 18', 9, 44.6, 'tap18.mp4'),
  (19, 19, 'Episode 19', 10, 46.4, 'tap19.mp4'),
  (20, 20, 'Episode 20', 10, 47.0, 'tap20.mp4'),
  (21, 21, 'Episode 21', 11, 45.8, 'tap21.mp4'),
  (22, 22, 'Episode 22', 11, 44.9, 'tap22.mp4'),
  (23, 23, 'Episode 23', 12, 46.2, 'tap23.mp4'),
  (24, 24, 'Episode 24', 12, 47.4, 'tap24.mp4'),
  (25, 25, 'Episode 25', 13, 45.3, 'tap25.mp4'),
  (26, 26, 'Episode 26', 13, 44.4, 'tap26.mp4'),
  (27, 27, 'Episode 27', 14, 46.6, 'tap27.mp4'),
  (28, 28, 'Episode 28', 14, 47.5, 'tap28.mp4'),
  (29, 29, 'Episode 29', 15, 45.1, 'tap29.mp4'),
  (30, 30, 'Episode 30', 15, 44.3, 'tap30.mp4');
