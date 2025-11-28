<?php
// ============================================
// LOGIN API - Xử lý đăng nhập & Token
// File: login_api.php
// ============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

// Ngăn chặn direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Method not allowed']);
  exit;
}

// Nhận dữ liệu JSON
$inputData = json_decode(file_get_contents('php://input'), true);

if (!$inputData) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Invalid request']);
  exit;
}

$username = $inputData['username'] ?? '';
$password = $inputData['password'] ?? '';

// ============================================
// VALIDATE INPUT
// ============================================
if (empty($username) || empty($password)) {
  echo json_encode([
    'success' => false,
    'message' => 'Vui lòng nhập đầy đủ thông tin đăng nhập'
  ]);
  exit;
}

// ============================================
// SIMULATE DATABASE AUTHENTICATION
// ============================================
// TODO: Thay bằng kết nối database thực
// Hiện tại sử dụng demo data

$validUsers = [
  [
    'id' => 1,
    'username' => 'admin@example.com',
    'password' => password_hash('123456', PASSWORD_BCRYPT), // Password: 123456
    'name' => 'Nguyen Van A',
    'email' => 'admin@example.com'
  ],
  [
    'id' => 2,
    'username' => 'user123',
    'password' => password_hash('password', PASSWORD_BCRYPT), // Password: password
    'name' => 'Tran Van B',
    'email' => 'user@example.com'
  ],
  [
    'id' => 3,
    'username' => '0912345678',
    'password' => password_hash('123456', PASSWORD_BCRYPT), // Password: 123456
    'name' => 'Le Van C',
    'email' => 'customer@example.com'
  ]
];

// ============================================
// AUTHENTICATE USER
// ============================================
$user = null;

// Tìm user theo username, email hoặc phone
foreach ($validUsers as $validUser) {
  if ($validUser['username'] === $username) {
    $user = $validUser;
    break;
  }
}

// Kiểm tra user tồn tại
if (!$user) {
  sleep(1); // Ngăn chặn brute force attack
  echo json_encode([
    'success' => false,
    'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
  ]);
  exit;
}

// Kiểm tra mật khẩu
if (!password_verify($password, $user['password'])) {
  sleep(1); // Ngăn chặn brute force attack
  echo json_encode([
    'success' => false,
    'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
  ]);
  exit;
}

// ============================================
// GENERATE TOKEN (JWT hoặc Simple Token)
// ============================================
// Phương pháp 1: Simple Token (Khuyến nghị cho bắt đầu)
$token = bin2hex(random_bytes(32)); // Token ngẫu nhiên 64 ký tự
$tokenExpiry = time() + (7 * 24 * 60 * 60); // Hết hạn sau 7 ngày

// Lưu token vào session file hoặc database
// TODO: Lưu token vào database (table: user_sessions)
// INSERT INTO user_sessions (user_id, token, token_expiry, created_at) 
// VALUES (?, ?, ?, NOW())

// Phương pháp 2: JWT Token (Nâng cao)
// $jwtSecret = 'your-secret-key-here'; // Lưu ở config
// $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
// $payload = json_encode([
//   'user_id' => $user['id'],
//   'username' => $user['username'],
//   'exp' => $tokenExpiry
// ]);
// $token = base64url_encode($header) . '.' . base64url_encode($payload) . '.' . 
//          base64url_encode(hash_hmac('sha256', 
//            base64url_encode($header) . '.' . base64url_encode($payload), 
//            $jwtSecret, true));

// ============================================
// START SESSION
// ============================================
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['token'] = $token;
$_SESSION['token_expiry'] = $tokenExpiry;
$_SESSION['login_time'] = time();

// ============================================
// SUCCESSFUL RESPONSE
// ============================================
echo json_encode([
  'success' => true,
  'message' => 'Đăng nhập thành công',
  'token' => $token,
  'user_id' => $user['id'],
  'user_name' => $user['name'],
  'email' => $user['email'],
  'token_expiry' => $tokenExpiry,
  'expires_in' => 7 * 24 * 60 * 60 // Hết hạn sau 7 ngày (giây)
]);

// ============================================
// HELPER FUNCTIONS
// ============================================

// Hàm mã hóa Base64 cho JWT
function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

// Hàm giải mã Base64 cho JWT
function base64url_decode($data) {
  return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 4 - strlen($data) % 4));
}
?>