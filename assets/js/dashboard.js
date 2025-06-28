function autoResize(textarea) {
  textarea.style.height = "auto";
  textarea.style.height = textarea.scrollHeight + "px";
}

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

document.getElementById("userPrompt").addEventListener("keydown", function (e) {
  // Submit on Enter (without Shift)
  if (e.key === "Enter" && !e.shiftKey) {
    e.preventDefault();
    submitPrompt();
  }
});

function submitPrompt() {
  const userPromptEl = document.getElementById("userPrompt");
  const chatContainer = document.getElementById("chatContainer");
  const introText = document.getElementById("introText");
  const userPrompt = userPromptEl.value.trim();

  if (!userPrompt) return;

  // Hide intro text if visible
  if (introText) introText.style.display = "none";

  // Clear the input field immediately
  userPromptEl.value = "";
  autoResize(userPromptEl);

  // Append user's message
  const userMsg = document.createElement("div");
  userMsg.className = "user-message mb-2 p-2 rounded shadow-sm";
  userMsg.textContent = userPrompt;
  chatContainer.appendChild(userMsg);

  // Scroll to bottom immediately after appending user's message
  scrollToBottom();

  // Simulate typing bot response
  const typing = document.createElement("div");
  typing.className = "bot-message bot-typing mb-2 p-2 rounded shadow-sm";
  typing.innerHTML = `<em>Typing...</em>`;
  chatContainer.appendChild(typing);

  // Scroll to bottom after appending typing indicator
  scrollToBottom();

  sendAjaxRequest(
    "../api/chat.php",
    "POST",
    { message: userPrompt },
    function (response) {
      // Remove typing indicator
      chatContainer.removeChild(typing);

      // Create bot message container
      const botMsg = document.createElement("div");
      botMsg.className = "bot-message mb-5 p-2 rounded shadow-sm";

      // Use marked.js to render markdown safely
      try {
        botMsg.innerHTML = marked.parse(response.message || "No response.");
      } catch (error) {
        botMsg.textContent = response.message || "No response.";
      }

      chatContainer.appendChild(botMsg);

      // Add spacer
      const spacer = document.createElement("div");
      spacer.style.height = "20px";
      chatContainer.appendChild(spacer);

      scrollToBottom();
    },
    function (error) {
      chatContainer.removeChild(typing);

      const errorMsg = document.createElement("div");
      errorMsg.className = "bot-message text-danger";
      errorMsg.textContent = "An error occurred: " + error;
      chatContainer.appendChild(errorMsg);

      const spacer = document.createElement("div");
      spacer.style.height = "20px";
      chatContainer.appendChild(spacer);

      scrollToBottom();
    }
  );
}

// Scroll to bottom of chat container
function scrollToBottom() {
  const chatContainer = document.getElementById("chatContainer");
  chatContainer.scrollTop = chatContainer.scrollHeight;
}
