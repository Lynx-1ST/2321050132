// ============================================
// LOGIN FORM VALIDATION & AUTHENTICATION
// VERSION: Offline Test (No Server Required)
// ============================================

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");

  // Initialize
  initializeForm();

  // Event Listeners
  form.addEventListener("submit", handleLogin);
  passwordInput.addEventListener("keyup", function (e) {
    if (e.key === "Enter") handleLogin(e);
  });

  // Add password toggle button
  addPasswordToggle();
});

// ============================================
// TEST DATA - Demo Users
// ============================================
const demoUsers = [
  {
    id: 1,
    username: "admin@example.com",
    password: "123456",
    name: "Admin",
    email: "admin@example.com",
  },
  {
    id: 2,
    username: "user123",
    password: "password",
    name: "User",
    email: "user@example.com",
  },
  {
    id: 3,
    username: "0912345678",
    password: "123456",
    name: "Guest",
    email: "customer@example.com",
  },
];

// ============================================
// 1. VALIDATE FORM
// ============================================
function validateForm() {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const errors = [];

  // Kiểm tra username
  if (!username) {
    errors.push("Vui lòng nhập tên đăng nhập hoặc email");
  } else if (username.length < 3) {
    errors.push("Tên đăng nhập phải có ít nhất 3 ký tự");
  } else if (!isValidUsername(username)) {
    errors.push("Email hoặc tên đăng nhập không hợp lệ");
  }

  // Kiểm tra password
  if (!password) {
    errors.push("Vui lòng nhập mật khẩu");
  } else if (password.length < 6) {
    errors.push("Mật khẩu phải có ít nhất 6 ký tự");
  }

  return {
    isValid: errors.length === 0,
    errors: errors,
  };
}

// Kiểm tra username/email hợp lệ
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

// ============================================
// 2. HANDLE LOGIN
// ============================================
async function handleLogin(e) {
  e.preventDefault();

  // Validate
  const validation = validateForm();
  if (!validation.isValid) {
    showNotification("error", "Lỗi xác thực", validation.errors);
    return;
  }

  // Loading
  const loginBtn = document.querySelector(".login-button");
  const originalText = loginBtn.innerHTML;
  loginBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin"></i> Đang đăng nhập...';
  loginBtn.disabled = true;

  try {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    // Delay
    await new Promise((resolve) => setTimeout(resolve, 1000));

    // Offline Auth
    const user = demoUsers.find((u) => u.username === username);

    if (!user) {
      showNotification("error", "Đăng nhập thất bại", [
        "Tên đăng nhập hoặc mật khẩu không chính xác",
      ]);
      return;
    }

    if (user.password !== password) {
      showNotification("error", "Đăng nhập thất bại", [
        "Tên đăng nhập hoặc mật khẩu không chính xác",
      ]);
      return;
    }

    // Gen token
    const token = generateToken();
    const tokenExpiry = new Date().getTime() + 60 * 1000; // 1 phút hết hạn token

    // Lưu thông tin vào session
    sessionStorage.setItem("auth_token", token);
    sessionStorage.setItem("user_id", user.id);
    sessionStorage.setItem("user_name", user.name);
    sessionStorage.setItem("username", user.username);
    sessionStorage.setItem("email", user.email);
    sessionStorage.setItem("token_expiry", tokenExpiry);
    sessionStorage.setItem("login_time", new Date().toLocaleString("vi-VN"));

    // Noti - thành công
    showNotification("success", "Đăng nhập thành công!", [
      `Xin chào, ${user.name}!`,
      "Đang chuyển hướng...",
    ]);

    // Log login info
    console.log("✅ Login Success:", {
      user_id: user.id,
      user_name: user.name,
      username: user.username,
      token: token,
      token_expiry: new Date(tokenExpiry).toLocaleString("vi-VN"),
    });

    // Show dashboard
    setTimeout(() => {
      showDashboardInfo(user, token);
    }, 1500);
  } catch (error) {
    console.error("Error:", error);
    showNotification("error", "Lỗi", ["Có lỗi xảy ra. Vui lòng thử lại."]);
  } finally {
    loginBtn.innerHTML = originalText;
    loginBtn.disabled = false;
  }
}

// ============================================
// 3. NOTIFICATION SYSTEM
// ============================================
function showNotification(type, title, messages) {
  // Xoá thông báo đã có
  const existingNotification = document.querySelector(
    ".notification-container"
  );
  if (existingNotification) {
    existingNotification.remove();
  }

  // Tạo container thông báo
  const container = document.createElement("div");
  container.className = "notification-container";
  const notification = document.createElement("div");
  notification.className = `notification notification--${type}`;

  const icons = {
    success: "fa-check-circle",
    error: "fa-exclamation-circle",
    warning: "fa-exclamation-triangle",
    info: "fa-info-circle",
  };

  const messagesHTML = Array.isArray(messages)
    ? messages
        .map((msg) => `<p class="notification__message">${msg}</p>`)
        .join("")
    : `<p class="notification__message">${messages}</p>`;

  notification.innerHTML = `
    <div class="notification__icon">
      <i class="fas ${icons[type]}"></i>
    </div>
    <div class="notification__content">
      <h4 class="notification__title">${title}</h4>
      ${messagesHTML}
    </div>
    <button class="notification__close" onclick="this.parentElement.parentElement.remove()">
      <i class="fas fa-times"></i>
    </button>
  `;

  container.appendChild(notification);
  document.body.appendChild(container);

  // Tự động xoá sau 5 giây
  setTimeout(() => {
    if (notification.parentElement) {
      notification.classList.add("notification--hide");
      setTimeout(() => {
        if (container.parentElement) container.remove();
      }, 300);
    }
  }, 5000);
}

// ============================================
// 4. TOGGLE PASSWORD VISIBILITY
// ============================================
function addPasswordToggle() {
  const passwordInput = document.getElementById("password");
  const passwordLabel = document.querySelector('label[for="password"]');

  // Tạo nút hiển thị mật khẩu
  const toggleBtn = document.createElement("button");
  toggleBtn.type = "button";
  toggleBtn.className = "password-toggle";
  toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
  toggleBtn.title = "Hiển thị mật khẩu";

  // Hiển thị sau khi nhập mật khẩu
  passwordInput.parentNode.insertBefore(toggleBtn, passwordInput.nextSibling);

  // Bật/Tắt
  toggleBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const type = passwordInput.type === "password" ? "text" : "password";
    passwordInput.type = type;

    // Cập nhật nút bật/tắt
    const icon = toggleBtn.querySelector("i");
    if (type === "password") {
      icon.className = "fas fa-eye";
      toggleBtn.title = "Hiển thị mật khẩu";
    } else {
      icon.className = "fas fa-eye-slash";
      toggleBtn.title = "Ẩn mật khẩu";
    }
  });
}

// ============================================
// 5. INITIALIZE FORM
// ============================================
function initializeForm() {
  // Check đã đăng nhập hay chưa ?
  const token = sessionStorage.getItem("auth_token");
  if (token) {
    const userName = sessionStorage.getItem("user_name");
    const loginTime = sessionStorage.getItem("login_time");

    showNotification("info", "Đã đăng nhập", [
      `Bạn là ${userName}`,
      `Đăng nhập lúc: ${loginTime}`,
    ]);
  }

  // Clear form sau khi f5
  document.querySelector("form").reset();
}

// ============================================
// 6. GENERATE FAKE TOKEN
// ============================================
function generateToken() {
  return "token_" + Math.random().toString(36).substr(2, 32) + "_" + Date.now();
}

// ============================================
// 7. SHOW DASHBOARD INFO
// ============================================
function showDashboardInfo(user, token) {
  const dashboardModal = document.createElement("div");
  dashboardModal.className = "dashboard-modal";
  dashboardModal.innerHTML = `
    <div class="dashboard-content">
      <div class="dashboard-header">
        <h2>✅ Đăng nhập thành công</h2>
        <button onclick="this.closest('.dashboard-modal').remove()" class="close-btn">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="dashboard-body">
        <div class="user-info">
          <h3>Thông tin người dùng:</h3>
          <p><strong>ID:</strong> ${user.id}</p>
          <p><strong>Tên:</strong> ${user.name}</p>
          <p><strong>Username:</strong> ${user.username}</p>
          <p><strong>Email:</strong> ${user.email}</p>
        </div>
        <div class="token-info">
          <h3>Thông tin Token:</h3>
          <p><strong>Token:</strong></p>
          <code>${token}</code>
          <p><strong>Hết hạn:</strong> Sau 7 ngày</p>
        </div>
        <div class="storage-info">
          <h3>Dữ liệu lưu trữ (sessionStorage):</h3>
          <table>
            <tr>
              <td><strong>auth_token</strong></td>
              <td><code>${sessionStorage.getItem("auth_token")}</code></td>
            </tr>
            <tr>
              <td><strong>user_id</strong></td>
              <td><code>${sessionStorage.getItem("user_id")}</code></td>
            </tr>
            <tr>
              <td><strong>user_name</strong></td>
              <td><code>${sessionStorage.getItem("user_name")}</code></td>
            </tr>
            <tr>
              <td><strong>username</strong></td>
              <td><code>${sessionStorage.getItem("username")}</code></td>
            </tr>
            <tr>
              <td><strong>email</strong></td>
              <td><code>${sessionStorage.getItem("email")}</code></td>
            </tr>
            <tr>
              <td><strong>login_time</strong></td>
              <td><code>${sessionStorage.getItem("login_time")}</code></td>
            </tr>
          </table>
        </div>
        <div class="dashboard-actions">
          <button onclick="logout()" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
          </button>
          <button onclick="this.closest('.dashboard-modal').remove()" class="btn-close">
            <i class="fas fa-times"></i> Đóng
          </button>
        </div>
      </div>
    </div>
  `;

  document.body.appendChild(dashboardModal);
}

// ============================================
// 8. LOGOUT FUNCTION
// ============================================
function logout() {
  sessionStorage.clear();

  showNotification("success", "Đã đăng xuất", [
    "Bạn đã đăng xuất thành công",
    "Trang sẽ reload sau 2 giây",
  ]);

  setTimeout(() => {
    location.reload();
  }, 2000);
}

// ============================================
// 9. SOCIAL LOGIN HANDLERS
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const socialIcons = document.querySelectorAll(".social-icon");

  socialIcons.forEach((icon) => {
    icon.addEventListener("click", function (e) {
      e.preventDefault();

      if (this.classList.contains("fb")) {
        handleSocialLogin("Facebook");
      } else if (this.classList.contains("tw")) {
        handleSocialLogin("Twitter/X");
      } else if (this.classList.contains("in")) {
        handleSocialLogin("Instagram");
      }
    });
  });
});

function handleSocialLogin(platform) {
  showNotification("info", "Đăng nhập xã hội", [
    `Tính năng đăng nhập bằng ${platform} đang được cập nhật...`,
  ]);
}
