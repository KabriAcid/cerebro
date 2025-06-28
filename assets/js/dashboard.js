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

function submitPrompt() {
  const userPromptEl = document.getElementById("userPrompt");
  const chatContainer = document.getElementById("chatContainer");
  const submitBtn = document.getElementById("submitBtn");
  const infoText = document.getElementById("info-text");
  const userPrompt = userPromptEl.value.trim();

  if (!userPrompt) return;

  // Hide info text if visible
  if (infoText) infoText.style.display = "none";

  // Disable input and button
  userPromptEl.disabled = true;
  submitBtn.disabled = true;

  // Append user's message
  const userMsg = document.createElement("div");
  userMsg.className = "user-message align-self-end mb-2 p-2 rounded shadow-sm";
  userMsg.textContent = userPrompt;
  chatContainer.appendChild(userMsg);
  scrollToBottom();

  // Simulate typing bot response
  const typing = document.createElement("div");
  typing.className =
    "bot-message bot-typing align-self-start mb-2 p-2 rounded shadow-sm";
  typing.innerHTML = `<em>Typing...</em>`;
  chatContainer.appendChild(typing);
  scrollToBottom();

  // AJAX request
  sendAjaxRequest(
    "../api/chat.php",
    "POST",
    { message: userPrompt },
    function (response) {
      // Replace typing indicator with actual bot message
      chatContainer.removeChild(typing);

      const botMsg = document.createElement("div");
      botMsg.className =
        "bot-message align-self-start mb-2 p-2 rounded shadow-sm";

      // Use marked.js for markdown rendering
      if (response.message) {
        botMsg.innerHTML = marked.parse(response.message);
      } else {
        botMsg.textContent = "No response.";
      }

      chatContainer.appendChild(botMsg);
      scrollToBottom();

      // Reset form
      userPromptEl.value = "";
      autoResize(userPromptEl);
      userPromptEl.disabled = false;
      submitBtn.disabled = false;
      userPromptEl.focus();
    },
    function (error) {
      chatContainer.removeChild(typing);

      const errorMsg = document.createElement("div");
      errorMsg.className = "bot-message text-danger";
      errorMsg.textContent = "An error occurred: " + error;
      chatContainer.appendChild(errorMsg);

      userPromptEl.disabled = false;
      submitBtn.disabled = false;
    }
  );
}

// Scroll to bottom of chat
function scrollToBottom() {
  const container = document.getElementById("chatContainer");
  container.scrollTop = container.scrollHeight;
}
