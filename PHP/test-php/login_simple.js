// ============================================
// LOGIN - GỬI REQUEST TỚI PHP BACKEND
// ============================================

// ============================================
// 1. VALIDATION
// ============================================
function isValidUsername(username) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const phoneRegex = /^[0-9]{10,11}$/;
  const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;

  return (
    emailRegex.test(username) ||
    phoneRegex.test(username) ||
    usernameRegex.test(username)
  );
}

function validateForm() {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const errors = [];

  if (!username) {
    errors.push("Vui lòng nhập tên đăng nhập hoặc email");
  } else if (username.length < 3) {
    errors.push("Tên đăng nhập phải có ít nhất 3 ký tự");
  } else if (!isValidUsername(username)) {
    errors.push("Email, SĐT hoặc tên đăng nhập không hợp lệ");
  }

  if (!password) {
    errors.push("Vui lòng nhập mật khẩu");
  } else if (password.length < 6) {
    errors.push("Mật khẩu phải có ít nhất 6 ký tự");
  }

  return {
    isValid: errors.length === 0,
    errors,
  };
}

// ============================================
// 2. GỬI REQUEST TỚI PHP
// ============================================
async function handleLogin() {
  const validation = validateForm();
  if (!validation.isValid) {
    showNotification("error", "Lỗi xác thực", validation.errors);
    return;
  }

  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const loginBtn = document.querySelector(".login-button");

  // Loading
  const originalText = loginBtn.innerHTML;
  loginBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin"></i> Đang đăng nhập...';
  loginBtn.disabled = true;

  try {
    // Gửi POST request tới PHP
    const response = await fetch("login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ username, password }),
      credentials: "include", // Gửi cookie
    });

    const data = await response.json();

    if (data.success) {
      // Lưu token vào localStorage
      localStorage.setItem("auth_token", data.token);
      localStorage.setItem("user_id", data.user_id);
      localStorage.setItem("user_name", data.user_name);
      localStorage.setItem("email", data.email);
      localStorage.setItem("login_time", new Date().toLocaleString("vi-VN"));

      console.log("✅ Login Success:", data);

      showNotification("success", "Đăng nhập thành công!", [
        `Xin chào, ${data.user_name}!`,
        "Đang chuyển hướng...",
      ]);

      // Chuyển hướng sau 1.5 giây
      setTimeout(() => {
        showDashboardInfo(data);
      }, 1500);
    } else {
      showNotification("error", "Đăng nhập thất bại", [data.message]);
    }
  } catch (error) {
    console.error("Error:", error);
    showNotification("error", "Lỗi kết nối", [
      "Không thể kết nối tới server. Vui lòng thử lại.",
    ]);
  } finally {
    loginBtn.innerHTML = originalText;
    loginBtn.disabled = false;
  }
}

// ============================================
// 3. TOGGLE PASSWORD
// ============================================
function togglePassword() {
  const passwordInput = document.getElementById("password");
  const icon = event.target.closest("i");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.className = "fas fa-eye-slash";
  } else {
    passwordInput.type = "password";
    icon.className = "fas fa-eye";
  }
}

// ============================================
// 4. SHOW NOTIFICATION
// ============================================
function showNotification(type, title, messages) {
  let text = "";

  if (Array.isArray(messages) && messages.length > 0) {
    text = messages.join(" | ");
  } else if (typeof messages === "string" && messages.trim() !== "") {
    text = messages;
  } else if (title) {
    text = title;
  } else {
    text = "Thông báo";
  }

  createToast(type, text);
}

function createToast(type, message) {
  // Xóa toast cũ
  const old = document.querySelector(".simple-toast");
  if (old) old.remove();

  const toast = document.createElement("div");
  toast.className = "simple-toast " + type;
  toast.textContent = message;

  document.body.appendChild(toast);

  requestAnimationFrame(() => {
    toast.classList.add("show");
  });

  // Tự ẩn sau 3 giây
  setTimeout(() => {
    toast.classList.remove("show");
    setTimeout(() => toast.remove(), 250);
  }, 3000);
}

// ============================================
// 5. DASHBOARD INFO
// ============================================
function showDashboardInfo(data) {
  console.log("Dashboard info:", {
    user_id: data.user_id,
    user_name: data.user_name,
    email: data.email,
    token: data.token,
    expires_in: data.expires_in + " giây",
    localStorage: {
      auth_token: localStorage.getItem("auth_token"),
      user_id: localStorage.getItem("user_id"),
      user_name: localStorage.getItem("user_name"),
      email: localStorage.getItem("email"),
      login_time: localStorage.getItem("login_time"),
    },
    "Ghi chú": "PHP đã lưu session + cookie. Xem F12 > Application > Cookies",
  });

  showNotification("info", "Thông tin", [
    `Người dùng: ${data.user_name}`,
    "Chi tiết xem trong console (F12)",
    "Cookie được lưu bởi PHP",
  ]);
}

// ============================================
// 6. LOGOUT
// ============================================
function logout() {
  localStorage.clear();
  showNotification("success", "Đã đăng xuất", ["Bạn đã đăng xuất thành công"]);

  setTimeout(() => {
    location.reload();
  }, 1500);
}

// ============================================
// 7. INITIALIZE
// ============================================
function initializeForm() {
  const form = document.querySelector("form");
  if (form) form.reset();

  // Kiểm tra đã đăng nhập chưa
  const token = localStorage.getItem("auth_token");
  const userName = localStorage.getItem("user_name");

  if (token && userName) {
    showNotification("info", "Đã đăng nhập", [
      `Xin chào, ${userName}!`,
      "Bạn vừa đăng nhập",
    ]);
  }
}

// Gọi init khi load
window.addEventListener("load", initializeForm);
