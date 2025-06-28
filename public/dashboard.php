<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';

// Your OpenRouter API key
$apiKey = $_ENV['OPENROUTER_API_KEY'] ?? ''; // Replace with your actual API key
$endpoint = $_ENV['OPENROUTER_API_URL'] ?? 'https://openrouter.ai/api/v1/chat/completions';

// Handle form submission
$responseMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userPrompt = $_POST['message'] ?? '';

    if ($userPrompt) {
        // Chat message history
        $messages = [
            ["role" => "system", "content" => "You are a compassionate mental health assistant."],
            ["role" => "user", "content" => $userPrompt],
        ];

        // Payload
        $data = [
            "model" => "moonshot/moonshot-v1-128k:free", // Model ID for Moonshot AI
            "messages" => $messages,
        ];

        // Initialize cURL
        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiKey",
                "Content-Type: application/json",
                "HTTP-Referer: yourdomain.com", // Optional but recommended
                "X-Title: MentalHealthChatbot"   // Optional: Give your app a name
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);

        // Execute and parse
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);

        // Extract the response message
        $responseMessage = $result['choices'][0]['message']['content'] ?? "No response received.";
    }
}
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <?php require __DIR__ . '/../components/dashboard-navbar.php'; ?>
    <main>
        <section class="intro-section">
            <h1 class="text-center fw-bold">How may I assist you today?</h1>
        </section>

        <!-- Form container -->
        <section class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="position-relative d-flex align-items-center">
                    <!-- Input Field -->
                    <input type="text" class="input-field" placeholder="Type your message here" name="message" required>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.1525 1.55322L10.1772 19.0044L8.50684 10.4078L1 5.89796L21.1525 1.55322ZM21.1525 1.55322L8.45564 10.4437" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-secondary my-3 text-center">This chatbot is not a substitute for professional help.</p>
            </form>
        </section>

        <!-- Response container -->
        <section class="response-container">
            <?php if ($responseMessage): ?>
                <div class="response-message">
                    <p class="text-primary"><?= htmlspecialchars($responseMessage) ?></p>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <script src="../assets/js/ajax.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>