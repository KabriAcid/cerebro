<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$role = $data['role'] ?? null;

if ($role) {
    $stmt = $pdo->prepare("UPDATE users SET role = ?, registration_status = 'complete' WHERE id = ?");
    $success = $stmt->execute([$role, $user_id]);

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid role']);
}
