<?php
// Configuration
$apiKey = $_ENV['OPENROUTER_API_KEY']; // Your OpenRouter API key
$endpoint = 'https://openrouter.ai/api/v1/chat/completions';

// Chat message history
$messages = [
    ["role" => "system", "content" => "You are a compassionate mental health assistant."],
    ["role" => "user", "content" => "I feel overwhelmed with school."],
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

// Output response
echo $result['choices'][0]['message']['content'] ?? "No response received.";
?>
<?php
// Configuration
$apiKey = 'sk-...'; // Your OpenRouter API key
$endpoint = 'https://openrouter.ai/api/v1/chat/completions';

// Chat message history
$messages = [
    ["role" => "system", "content" => "You are a compassionate mental health assistant."],
    ["role" => "user", "content" => "I feel overwhelmed with school."],
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

// Output response
echo $result['choices'][0]['message']['content'] ?? "No response received.";
?>
