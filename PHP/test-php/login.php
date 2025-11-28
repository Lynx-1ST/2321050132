<?php
// ============================================
// LOGIN API - PHP BACKEND
// File: login.php
// Lưu session + cookie khi đăng nhập
// ============================================

header('Content-Type: application/json; charset=utf-8');

// Bắt đầu session
session_start();

// Kiểm tra request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Method not allowed']);
  exit;
}

// Lấy dữ liệu JSON từ JS
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// ============================================
// DEMO DATA - Users
// ============================================
$demoUsers = [
  [
    'id' => 1,
    'username' => 'admin@example.com',
    'password' => '123456',
    'name' => 'Admin',
    'email' => 'admin@example.com'
  ],
  [
    'id' => 2,
    'username' => 'user123',
    'password' => 'password',
    'name' => 'User',
    'email' => 'user@example.com'
  ],
  [
    'id' => 3,
    'username' => '0912345678',
    'password' => '123456',
    'name' => 'Guest',
    'email' => 'customer@example.com'
  ]
];

// ============================================
// VALIDATE INPUT
// ============================================
if (empty($username) || empty($password)) {
  echo json_encode([
    'success' => false,
    'message' => 'Vui lòng nhập đầy đủ thông tin'
  ]);
  exit;
}

// ============================================
// AUTHENTICATE USER
// ============================================
$user = null;
foreach ($demoUsers as $u) {
  if ($u['username'] === $username) {
    $user = $u;
    break;
  }
}

// Kiểm tra user tồn tại
if (!$user) {
  echo json_encode([
    'success' => false,
    'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
  ]);
  exit;
}

// Kiểm tra password
if ($user['password'] !== $password) {
  echo json_encode([
    'success' => false,
    'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
  ]);
  exit;
}

// ============================================
// LOGIN SUCCESS - Tạo TOKEN & LƯU SESSION
// ============================================

// Tạo token
$token = bin2hex(random_bytes(16)); // Token 32 ký tự
$tokenExpiry = time() + (7 * 24 * 60 * 60); // 7 ngày

// ============================================
// CÁCH 1: LƯU VÀO SESSION (chỉ tồn tại trên server)
// ============================================
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['email'] = $user['email'];
$_SESSION['auth_token'] = $token;
$_SESSION['token_expiry'] = $tokenExpiry;
$_SESSION['login_time'] = date('d/m/Y H:i:s');

// ============================================
// CÁCH 2: LƯU VÀO COOKIE (gửi về client)
// ============================================
setcookie('auth_token', $token, $tokenExpiry, '/', '', false, true);
  // httponly=true, không cho JS truy cập (an toàn hơn)
setcookie('user_id', $user['id'], $tokenExpiry, '/', '', false, false);
setcookie('user_name', $user['name'], $tokenExpiry, '/', '', false, false);
setcookie('email', $user['email'], $tokenExpiry, '/', '', false, false);

// Có thể lưu token không httponly để JS truy cập
setcookie('auth_token_js', $token, $tokenExpiry, '/', '', false, false);
  // httponly=false, cho JS truy cập

// ============================================
// TRẢ VỀ RESPONSE
// ============================================
echo json_encode([
  'success' => true,
  'message' => 'Đăng nhập thành công',
  'token' => $token,
  'user_id' => $user['id'],
  'user_name' => $user['name'],
  'email' => $user['email'],
  'token_expiry' => $tokenExpiry,
  'expires_in' => 60 * 60 // 1 phút
]);

// ============================================
// LƯU Ý:
// - SESSION: Lưu trên server, an toàn hơn
// - COOKIE: Gửi về client, client gửi lại mỗi request
// - Token từ PHP sẽ được gửi qua Header Authorization
// ============================================
?>
