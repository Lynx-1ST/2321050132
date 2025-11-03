let danhSachPhim = [
  {
    id: 1,
    tenPhim: "Mua Do",
    namPhatHanh: 2025,
    doTuoi: 16,
    thoiLuong: 2,
    quocGia: "Viet Nam",
    poster: "./assets/muado-banner.jpg",
  },
  {
    id: 2,
    tenPhim: "Conan",
    namPhatHanh: 2023,
    doTuoi: 10,
    thoiLuong: 1.5,
    quocGia: "Nhật Bản",
    poster: "./assets/conan.jpg",
  },
];

let currFilm = danhSachPhim[0];
let banner = document.getElementsByClassName("banner-img")[0];

function chFilm(id) {
  for (let i = 0; i < danhSachPhim.length; i++) {
    if (danhSachPhim[i].id == id) {
      banner.src = danhSachPhim[i].poster;
      alert("Đang mở phim: " + danhSachPhim[i].tenPhim);
      hienThiThongTin(currFilm);
      break;
    }
  }
}
function hienThiThongTin(phim) {
  document.getElementById("namPhatHanh").innerText = phim.namPhatHanh;
  document.getElementById("thoiLuong").innerText = phim.thoiLuong;
  document.getElementById("quocGia").innerText = phim.quocGia;
  document.getElementById("doTuoi").innerText = phim.doTuoi;
}
