<?php
require 'connect.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);
$fullname = trim($data['fullname'] ?? "");
$email = trim($data['email'] ?? "");
$username = trim($data['username'] ?? "");
$password = trim($data['password'] ?? "");

// Validate
if (!$fullname || !$email || !$username || !$password) {
  echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin!']);
  exit;
}
if (strlen($username) < 3) {
  echo json_encode(['success' => false, 'message' => 'Tài khoản phải >= 3 ký tự!']);
  exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(['success' => false, 'message' => 'Email không hợp lệ!']);
  exit;
}
if (strlen($password) < 6) {
  echo json_encode(['success' => false, 'message' => 'Mật khẩu phải >= 6 ký tự!']);
  exit;
}

// kiểm tra có trùng lặp dữ liệu không 
$check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
$check->bind_param("ss", $username, $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo json_encode(['success' => false, 'message' => 'Tài khoản hoặc email đã tồn tại!']);
  exit;
}

// hàm băm = mã hoá
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// thêm user vào
$add = $conn->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
$add->bind_param("ssss", $fullname, $email, $username, $hashedPassword);

if ($add->execute()) {
  echo json_encode(['success' => true, 'message' => 'Đăng ký thành công!']);
} else {
  echo json_encode(['success' => false, 'message' => 'Lỗi khi đăng ký: ' . $add->error]);
}

$add->close();
$check->close();
$conn->close();
?>