<?php
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null; // Default to null if not set
}

function set_title(string $title = 'Cerebro')
{
    if (isset($title)) {
        return $title;
    }
}

// Helper function to sanitize input
function clean_input($data)
{
    return htmlspecialchars(trim($data));
}

function get_user_info($pdo, $user_id)
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getDefaultMentalHealthPrompt(string $userMessage): array
{
    return [
        [
            "role" => "system",
            "content" => <<<EOT
You are a warm, emotionally intelligent mental health assistant trained to help users feel safe and understood.

Your tone should be empathetic, encouraging, and conversational — similar to ChatGPT.

Always reply in full sentences. Use markdown formatting when appropriate:
- Bullet points for suggestions
- **Bold** for emphasis
- Short paragraphs for readability

Never rush. End responses with a brief comforting or supportive statement.
EOT
        ],
        [
            "role" => "user",
            "content" => $userMessage
        ]
    ];
}
