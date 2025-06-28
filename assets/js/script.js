document.addEventListener("click", function (e) {
  const dropdown = document.getElementById("avatarDropdown");
  const avatar = document.querySelector(".avatar");

  // Toggle dropdown when avatar is clicked
  if (avatar.contains(e.target)) {
    dropdown.classList.toggle("show");
  } else {
    // Close dropdown if clicked outside
    dropdown.classList.remove("show");
  }
});
