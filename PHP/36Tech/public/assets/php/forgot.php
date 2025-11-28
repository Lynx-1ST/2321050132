<?php
require 'connect.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);
$username = trim($data['username'] ?? "");
$email = trim($data['email'] ?? "");
$newpw = trim($data['newpw'] ?? "");

// kiểm tra 
if (!$username || !$email || !$newpw) {
  echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin!']);
  exit;
}
if (strlen($newpw) < 6) {
  echo json_encode(['success' => false, 'message' => 'Mật khẩu mới quá ngắn!']);
  exit;
}

// tìm user
$find = $conn->prepare("SELECT id FROM users WHERE username = ? AND email = ? LIMIT 1");
$find->bind_param("ss", $username, $email);
$find->execute();
$result = $find->get_result();

if ($result->num_rows === 0) {
  echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc email không đúng!']);
  exit;
}

$user = $result->fetch_assoc();
$hashedPassword = password_hash($newpw, PASSWORD_BCRYPT);

// cập nhật lại pass
$update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$update->bind_param("si", $hashedPassword, $user['id']);

if ($update->execute()) {
  echo json_encode(['success' => true, 'message' => 'Đã đổi mật khẩu!']);
} else {
  echo json_encode(['success' => false, 'message' => 'Lỗi cập nhật!']);
}

$find->close();
$update->close();
$conn->close();
?>