<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$career = $data['career'] ?? null;

if ($career) {
    $stmt = $pdo->prepare("UPDATE users SET career = ?, registration_status = 'complete' WHERE id = ?");
    $success = $stmt->execute([$career, $user_id]);

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid career']);
}
