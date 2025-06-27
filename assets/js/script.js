function toggleDropdown() {
  const dropdown = document.getElementById("avatarDropdown");
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
}

// Close the dropdown if the user clicks outside of it
document.addEventListener("click", event => {
  const dropdown = document.getElementById("avatarDropdown");
  const avatar = document.querySelector(".avatar");

  if (
    dropdown &&
    avatar &&
    !dropdown.contains(event.target) &&
    !avatar.contains(event.target)
  ) {
    dropdown.style.display = "none";
  }
});
