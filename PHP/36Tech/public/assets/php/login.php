<?php
require 'connect.php';
session_start();
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);
$username = trim($data['username'] ?? "");
$password = trim($data['password'] ?? "");

// Validate
if (!$username || !$password) {
  echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ!']);
  exit;
}

// tìm user
$find = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE username = ? LIMIT 1");
$find->bind_param("s", $username);
$find->execute();
$result = $find->get_result();

if ($result->num_rows === 0) {
  echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng!']);
  exit;
}

$user = $result->fetch_assoc();

// kiểm tra pass
if (!password_verify($password, $user['password'])) {
  echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng!']);
  exit;
}

// lưu thông tin khi đăng nhập thành công 
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $username;
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['email'] = $user['email'];
$_SESSION['login_time'] = date('d/m/Y H:i:s');

// Cookie bánh quy
$token = bin2hex(random_bytes(16));
setcookie('auth_token', $token, time() + 7*24*60*60, '/', '', false, true);
setcookie('username', $username, time() + 7*24*60*60, '/', '', false, false);

echo json_encode([
  'success' => true,
  'message' => 'Đăng nhập thành công!',
  'fullname' => $user['fullname'],
  'email' => $user['email'],
  'username' => $username
]);

$find->close();
$conn->close();
?>