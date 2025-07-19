const sidebarToggleBtns = document.querySelectorAll(".sidebar-toggle");
const sidebar = document.querySelector(".sidebar");
const searchForm = document.querySelector(".search-form");
const menuLinks = document.querySelectorAll(".menu-link");
const userName = document.querySelector(".user-name");

function toggleUserName() {
  if (sidebar.classList.contains("collapsed")) {
    if (userName) userName.style.display = "none";
  } else {
    if (userName) userName.style.display = "block";
  }
}
// Toggle sidebar collapsed state on buttons click
sidebarToggleBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
    toggleUserName();
  });
});
// Expand the sidebar when the search form is clicked
searchForm.addEventListener("click", () => {
  if (sidebar.classList.contains("collapsed")) {
    sidebar.classList.remove("collapsed");
    searchForm.querySelector("input").focus();
    toggleUserName();
  }
});
// Expand sidebar by default on large screens
if (window.innerWidth > 768) {
  sidebar.classList.remove("collapsed");
  toggleUserName();
}