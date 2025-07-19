// Sidebar toggle functionality
const sidebarToggleBtns = document.querySelectorAll('.sidebar-toggle');
const sidebar = document.querySelector('.sidebar');
const searchForm = document.querySelector('.search-form');
const userName = document.querySelector('.user-name');

function toggleUserName() {
  if (sidebar.classList.contains('collapsed')) {
    if (userName) userName.style.display = 'none';
  } else {
    if (userName) userName.style.display = 'block';
  }
}
sidebarToggleBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    toggleUserName();
  });
});
searchForm.addEventListener('click', () => {
  if (sidebar.classList.contains('collapsed')) {
    sidebar.classList.remove('collapsed');
    searchForm.querySelector('input').focus();
    toggleUserName();
  }
});
if (window.innerWidth > 768) {
  sidebar.classList.remove('collapsed');
  toggleUserName();
}

// Profile picture preview before upload
const profileInput = document.getElementById('profile_picture');
const currentPicture = document.querySelector('.current-picture img');
if (profileInput && currentPicture) {
  profileInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        currentPicture.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
}

// Show success/error alerts for 3s then hide
const alerts = document.querySelectorAll('.alert.success, .alert.error');
alerts.forEach(alert => {
  setTimeout(() => {
    alert.style.display = 'none';
  }, 3000);
});

// Optional: Prevent double submit on forms
const forms = document.querySelectorAll('form');
forms.forEach(form => {
  form.addEventListener('submit', function (e) {
    const btn = form.querySelector('button[type="submit"]');
    if (btn) {
      btn.disabled = true;
      btn.textContent = 'Aguarde...';
    }
  });
});
