<?php
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
