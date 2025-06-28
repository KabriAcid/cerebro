function toggleDropdown() {
  const dropdown = document.getElementById("avatarDropdown");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
}

// Optional: close dropdown when clicking outside
document.addEventListener("click", function (e) {
  const dropdown = document.getElementById("avatarDropdown");
  const avatar = document.querySelector(".avatar");

  if (!dropdown.contains(e.target) && !avatar.contains(e.target)) {
    dropdown.style.display = "none";
  }
});
