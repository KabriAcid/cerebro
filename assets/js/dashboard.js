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
  if (e.key === "Enter" && !e.shiftKey) {
    e.preventDefault();
    submitPrompt();
  }
});


// Handle prompt submission
function submitPrompt() {
  const userPromptEl = document.getElementById("userPrompt");
  const chatContainer = document.getElementById("chatContainer");
  const introText = document.getElementById("introText");
  const userPrompt = userPromptEl.value.trim();

  if (!userPrompt) return;

  // Hide intro text
  if (introText) introText.style.display = "none";

  // Clear input and disable temporarily
  userPromptEl.value = "";
  userPromptEl.disabled = true;
  autoResize(userPromptEl);

  // Add user message
  const userMsg = document.createElement("div");
  userMsg.className = "user-message mb-2 p-2 rounded shadow-sm";
  userMsg.textContent = userPrompt;
  chatContainer.appendChild(userMsg);
  scrollToBottom();

  // Show "Typing..." indicator
  const typing = document.createElement("div");
  typing.className = "bot-message bot-typing mb-5 p-2 rounded shadow-sm";
  typing.innerHTML = `<img src="../assets/img/logo.png" alt="App Logo" class="blinking-logo">`;
  chatContainer.appendChild(typing);
  scrollToBottom();

  // AJAX with timeout
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../api/chat.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.timeout = 10000;

  xhr.onload = function () {
    chatContainer.removeChild(typing);
    userPromptEl.disabled = false;

    if (xhr.status >= 200 && xhr.status < 300) {
      const response = JSON.parse(xhr.responseText);

      const rawHTML = marked.parse(response.message || "No response.");
      const sanitizedHTML = DOMPurify.sanitize(rawHTML); // Optional for security

      // Create bot message container
      const botMsg = document.createElement("div");
      botMsg.className = "bot-message mb-5 p-2 rounded shadow-sm";
      botMsg.innerHTML = "";
      chatContainer.appendChild(botMsg);

      // Typing effect for parsed HTML
      let index = 0;
      const typingEffect = setInterval(() => {
        botMsg.innerHTML = sanitizedHTML.slice(0, index + 1);
        index++;
        scrollToBottom();

        if (index >= sanitizedHTML.length) {
          clearInterval(typingEffect);
        }
      }, 8);
    } else {
      handleError("Server error: " + xhr.status);
    }
  };

  xhr.onerror = function () {
    chatContainer.removeChild(typing);
    userPromptEl.disabled = false;
    handleError("Network error occurred. Please check your connection.");
  };

  xhr.ontimeout = function () {
    chatContainer.removeChild(typing);
    userPromptEl.disabled = false;
    handleError("Request timed out. Please try again.");
  };

  xhr.send(JSON.stringify({ message: userPrompt }));
}

// Show error nicely
function handleError(errorMessage) {
  const chatContainer = document.getElementById("chatContainer");

  const errorMsg = document.createElement("div");
  errorMsg.className = "bot-message text-danger mb-5 p-2 rounded shadow-sm";
  errorMsg.textContent = errorMessage;
  chatContainer.appendChild(errorMsg);

  const spacer = document.createElement("div");
  spacer.style.height = "20px";
  chatContainer.appendChild(spacer);

  scrollToBottom();
}

// Scroll chat container to bottom
function scrollToBottom() {
  const chatContainer = document.getElementById("chatContainer");
  setTimeout(() => {
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }, 0);
}
