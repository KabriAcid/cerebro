let selectedRole = "";

// Set the first card as active by default
document.addEventListener("DOMContentLoaded", () => {
  const firstCard = document.querySelector(".info-card");
  if (firstCard) {
    selectCareer(firstCard.textContent.trim());
  }
});

function selectCareer(role) {
  selectedRole = role;

  // Highlight the selected card
  const cards = document.querySelectorAll(".info-card");
  cards.forEach(card => {
    card.style.border = "1px solid var(--gray)";
    card.style.backgroundColor = "var(--white)";
  });

  const selectedCard = Array.from(cards).find(card =>
    card.textContent.includes(role)
  );
  if (selectedCard) {
    selectedCard.style.border = `2px solid var(--primary)`;
    selectedCard.style.backgroundColor = "var(--gray)";
  }
}

function submitCareer() {
  if (!selectedRole) {
    alert("Please select a career before submitting.");
    return;
  }

  sendAjaxRequest(
    "../api/update-role.php",
    "POST",
    { role: selectedRole },
    function (response) {
      if (response.success) {
        // Hide the modal
        const modal = document.getElementById("roleModal");
        if (modal) {
          modal.style.display = "none";
        }
      } else {
        // Display error message
        alert("Failed to update career. Please try again.");
      }
    },
    function (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  );
}
