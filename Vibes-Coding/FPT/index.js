let danhSachPhim = [
  {
    id: 1,
    tenPhim: "Mưa Đỏ",
    namPhatHanh: 2025,
    doTuoi: 16,
    thoiLuong: 2,
    quocGia: "Việt Nam",
    poster: "./assets/muado-banner.jpg",
  },
  {
    id: 2,
    tenPhim: "Conan",
    namPhatHanh: 2023,
    doTuoi: 10,
    thoiLuong: 1.5,
    quocGia: "Nhật Bản",
    poster: "./assets/tham-tu-lung-danh-conan-cu-dam-sapphire-xanh.jpg",
  },
];

let currFilm = danhSachPhim[0];
let banner = document.getElementsByClassName("banner-img")[0];

function hienThiThongTin(phim) {
  document.getElementById("tenPhim").innerText = phim.tenPhim;
  document.getElementById("namPhatHanh").innerText = phim.namPhatHanh;
  document.getElementById("thoiLuong").innerText = phim.thoiLuong;
  document.getElementById("quocGia").innerText = phim.quocGia;
  document.getElementById("doTuoi").innerText = phim.doTuoi;
}

function chFilm(id) {
  for (let i = 0; i < danhSachPhim.length; i++) {
    if (danhSachPhim[i].id == id) {
      currFilm = danhSachPhim[i];
      banner.src = currFilm.poster;
      hienThiThongTin(currFilm);
      break;
    }
  }
}
hienThiThongTin(currFilm);
