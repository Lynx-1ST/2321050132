// ============================================
// LOGIN FORM VALIDATION & AUTHENTICATION
// ============================================

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");
  const loginBtn = document.querySelector(".login-button");

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
// 2. HANDLE LOGIN & TOKEN/SESSION
// ============================================
async function handleLogin(e) {
  e.preventDefault();

  // Validate form
  const validation = validateForm();
  if (!validation.isValid) {
    showNotification("error", "Lỗi xác thực", validation.errors);
    return;
  }

  // Show loading state
  const loginBtn = document.querySelector(".login-button");
  const originalText = loginBtn.innerHTML;
  loginBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin"></i> Đang đăng nhập...';
  loginBtn.disabled = true;

  try {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    // Gửi request tới PHP backend
    const response = await fetch("login_api.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        username: username,
        password: password,
      }),
    });

    const data = await response.json();

    if (data.success) {
      // Lưu token vào sessionStorage (ngắn hạn - khi đóng tab sẽ xóa)
      sessionStorage.setItem("auth_token", data.token);
      sessionStorage.setItem("user_id", data.user_id);
      sessionStorage.setItem("user_name", data.user_name);

      // Hoặc lưu vào localStorage (dài hạn - 7 ngày)
      // localStorage.setItem('auth_token', data.token);
      // localStorage.setItem('token_expiry', new Date().getTime() + 7 * 24 * 60 * 60 * 1000);

      showNotification("success", "Đăng nhập thành công!", [
        `Xin chào, ${data.user_name}!`,
        "Đang chuyển hướng...",
      ]);

      // Chuyển hướng sau 1.5 giây
      setTimeout(() => {
        window.location.href = "dashboard.php";
      }, 1500);
    } else {
      showNotification("error", "Đăng nhập thất bại", [data.message]);
    }
  } catch (error) {
    console.error("Error:", error);
    showNotification("error", "Lỗi kết nối", [
      "Không thể kết nối tới server. Vui lòng thử lại sau.",
    ]);
  } finally {
    // Restore button state
    loginBtn.innerHTML = originalText;
    loginBtn.disabled = false;
  }
}

// ============================================
// 3. NOTIFICATION SYSTEM (Hiển thị lỗi/thành công)
// ============================================
function showNotification(type, title, messages) {
  // Remove existing notification
  const existingNotification = document.querySelector(
    ".notification-container"
  );
  if (existingNotification) {
    existingNotification.remove();
  }

  // Create notification container
  const container = document.createElement("div");
  container.className = "notification-container";

  // Create notification card
  const notification = document.createElement("div");
  notification.className = `notification notification--${type}`;

  // Icon mapping
  const icons = {
    success: "fa-check-circle",
    error: "fa-exclamation-circle",
    warning: "fa-exclamation-triangle",
    info: "fa-info-circle",
  };

  // Build messages HTML
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

  // Auto remove after 5 seconds
  setTimeout(() => {
    notification.classList.add("notification--hide");
    setTimeout(() => container.remove(), 300);
  }, 5000);
}

// ============================================
// 4. TOGGLE PASSWORD VISIBILITY
// ============================================
function addPasswordToggle() {
  const passwordInput = document.getElementById("password");
  const passwordLabel = document.querySelector('label[for="password"]');

  // Create toggle button
  const toggleBtn = document.createElement("button");
  toggleBtn.type = "button";
  toggleBtn.className = "password-toggle";
  toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
  toggleBtn.title = "Hiển thị mật khẩu";

  // Insert toggle button after password input
  passwordInput.parentNode.insertBefore(toggleBtn, passwordInput.nextSibling);

  // Toggle password visibility
  toggleBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const type = passwordInput.type === "password" ? "text" : "password";
    passwordInput.type = type;

    // Update button icon
    const icon = toggleBtn.querySelector("i");
    if (type === "password") {
      icon.className = "fas fa-eye";
      toggleBtn.title = "Hiển thị mật khẩu";
    } else {
      icon.className = "fas fa-eye-slash";
      toggleBtn.title = "Ẩn mật khẩu";
    }
  });

  // Adjust password input padding
  passwordInput.style.paddingRight = "40px";
}

// ============================================
// 5. INITIALIZE FORM
// ============================================
function initializeForm() {
  // Check if already logged in
  const token = sessionStorage.getItem("auth_token");
  if (token) {
    // Verify token is still valid
    verifyToken(token);
  }

  // Clear form on page load
  document.querySelector("form").reset();
}

// Verify token validity with server
async function verifyToken(token) {
  try {
    const response = await fetch("verify_token.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const data = await response.json();
    if (data.valid) {
      // Token hợp lệ, chuyển hướng đến dashboard
      window.location.href = "dashboard.php";
    } else {
      // Token hết hạn
      sessionStorage.clear();
    }
  } catch (error) {
    console.error("Token verification error:", error);
  }
}

// ============================================
// 6. SOCIAL LOGIN HANDLERS
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const socialIcons = document.querySelectorAll(".social-icon");

  socialIcons.forEach((icon) => {
    icon.addEventListener("click", function (e) {
      e.preventDefault();

      if (this.classList.contains("fb")) {
        handleSocialLogin("facebook");
      } else if (this.classList.contains("tw")) {
        handleSocialLogin("twitter");
      } else if (this.classList.contains("in")) {
        handleSocialLogin("instagram");
      }
    });
  });
});

function handleSocialLogin(platform) {
  showNotification("info", "Đăng nhập xã hội", [
    `Tính năng đăng nhập bằng ${platform} đang được cập nhật...`,
  ]);

  // Implementation: Redirect to OAuth provider
  // Example: window.location.href = `social_login.php?provider=${platform}`;
}

// ============================================
// 7. LOGOUT FUNCTION
// ============================================
function logout() {
  sessionStorage.clear();
  // localStorage.removeItem('auth_token');
  // localStorage.removeItem('token_expiry');

  showNotification("success", "Đã đăng xuất", ["Bạn đã đăng xuất thành công"]);

  setTimeout(() => {
    window.location.href = "login.html";
  }, 1500);
}

// ============================================
// 8. AUTO LOGOUT (nếu token hết hạn)
// ============================================
function setupAutoLogout() {
  // Kiểm tra hết hạn mỗi 1 phút
  setInterval(() => {
    const token = sessionStorage.getItem("auth_token");
    if (token) {
      verifyToken(token);
    }
  }, 60000);
}
