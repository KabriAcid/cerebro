let selectedCareer = "";

// Set the first card as active by default
document.addEventListener("DOMContentLoaded", () => {
  const firstCard = document.querySelector(".info-card");
  if (firstCard) {
    selectCareer(firstCard.textContent.trim());
  }
});

function selectCareer(career) {
  selectedCareer = career;

  // Highlight the selected card
  const cards = document.querySelectorAll(".info-card");
  cards.forEach(card => {
    card.style.border = "1px solid var(--gray)";
    card.style.backgroundColor = "var(--white)";
  });

  const selectedCard = Array.from(cards).find(card =>
    card.textContent.includes(career)
  );
  if (selectedCard) {
    selectedCard.style.border = `2px solid var(--primary)`;
    selectedCard.style.backgroundColor = "var(--gray)";
  }
}

function submitCareer() {
  if (!selectedCareer) {
    alert("Please select a career before submitting.");
    return;
  }

  sendAjaxRequest(
    "../api/update-career.php",
    "POST",
    { career: selectedCareer },
    function (response) {
      if (response.success) {
        // Hide the modal
        const modal = document.getElementById("careerModal");
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

function submitPrompt() {
  const userPrompt = document.getElementById("userPrompt").value.trim();
  const introText = document.getElementById("introText");
  const loader = document.getElementById("loader");
  const responseContainer = document.getElementById("responseContainer");
  const responseMessage = document.getElementById("responseMessage");

  if (!userPrompt) {
    alert("Please enter a message.");
    return;
  }

  // Append the user's message to the response container
  const userMessage = document.createElement("div");
  userMessage.className = "response-message";
  userMessage.innerHTML = `<p class="text-secondary"><strong>You:</strong> ${userPrompt}</p>`;
  responseContainer.appendChild(userMessage);

  // Show loader and keep the button active
  introText.style.display = "none";
  loader.style.display = "block";
  responseContainer.style.display = "block";

  // Send AJAX request using the custom AJAX function
  sendAjaxRequest(
    "../api/chat.php",
    "POST",
    { message: userPrompt },
    function (response) {
      loader.style.display = "none"; // Hide loader

      // Append the chatbot's response to the response container
      const botMessage = document.createElement("div");
      botMessage.className = "response-message";
      botMessage.innerHTML = `<p class="text-primary"><strong>Bot:</strong> ${response.message}</p>`;
      responseContainer.appendChild(botMessage);

      // Clear the input field for the next message
      document.getElementById("userPrompt").value = "";
    },
    function (error) {
      loader.style.display = "none"; // Hide loader

      // Append the error message to the response container
      const errorMessage = document.createElement("div");
      errorMessage.className = "response-message";
      errorMessage.innerHTML = `<p class="text-danger"><strong>Error:</strong> ${error}</p>`;
      responseContainer.appendChild(errorMessage);
    }
  );
}