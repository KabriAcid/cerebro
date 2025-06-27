<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

// Decode the incoming JSON request
$data = json_decode(file_get_contents('php://input'), true);
$career = $data['career'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if ($career) {
    // Update the user's career in the database
    $stmt = $pdo->prepare("UPDATE users SET career = ?, registration_status = 'complete' WHERE id = ?");
    $success = $stmt->execute([$career, $user_id]);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid career provided.']);
}
