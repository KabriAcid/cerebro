<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

// Your OpenRouter API key
$apiKey = $_ENV['OPENROUTER_API_KEY'] ?? 'sk-...'; // Replace with your actual API key
$endpoint = $_ENV['OPENROUTER_API_URL'] ?? 'https://openrouter.ai/api/v1/chat/completions';

try {
    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        http_response_code(405); // Method Not Allowed
        exit;
    }

    // Decode the incoming JSON request
    $data = json_decode(file_get_contents('php://input'), true);
    $userPrompt = $data['message'] ?? '';

    if (!$userPrompt) {
        echo json_encode(['success' => false, 'message' => 'Prompt cannot be empty.']);
        http_response_code(400); // Bad Request
        exit;
    }

    // Chat message history
    $messages = getDefaultMentalHealthPrompt($userPrompt);


    // Payload
    $payload = [
        "model" => "mistralai/mistral-7b-instruct:free",
        "messages" => $messages,
        "temperature" => 0.7,
        "max_tokens" => 250
    ];

    // Initialize cURL
    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json",
            "HTTP-Referer: dataspeed.com.ng", // Optional but recommended
            "X-Title: MentalHealthChatbot"   // Optional: Give your app a name
        ],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($payload),
    ]);

    // Execute and parse
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . curl_error($ch)]);
        curl_close($ch);
        exit;
    }
    curl_close($ch);

    // Log the raw response for debugging
    file_put_contents(__DIR__ . '/debug.log', $response, FILE_APPEND);

    $result = json_decode($response, true);

    // Extract the response message
    $responseMessage = $result['choices'][0]['message']['content'] ?? "No response received.";

    // Save chat into database
    $stmt = $pdo->prepare("INSERT INTO chat_logs (user_id, prompt, response, model) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'] ?? null,
        $userPrompt,
        $responseMessage,
        $payload['model']
    ]);


    echo json_encode(['success' => true, 'message' => $responseMessage]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage(),
        'details' => $e->getTraceAsString()
    ]);
    http_response_code(500); // Internal Server Error
}
