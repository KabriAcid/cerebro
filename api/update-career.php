<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

try {
    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method. Only POST is allowed.']);
        http_response_code(405); // Method Not Allowed
        exit;
    }

    // Decode the incoming JSON request
    $data = json_decode(file_get_contents('php://input'), true);
    $career = $data['career'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;

    // Check if the user is authenticated
    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
        http_response_code(401); // Unauthorized
        exit;
    }

    // Validate the career input
    if (!$career) {
        echo json_encode(['success' => false, 'message' => 'Invalid career provided.']);
        http_response_code(400); // Bad Request
        exit;
    }

    // Update the user's career in the database
    $stmt = $pdo->prepare("UPDATE users SET career = ?, registration_status = 'complete' WHERE id = ?");
    $success = $stmt->execute([$career, $user_id]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Career updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
        http_response_code(500); // Internal Server Error
    }
} catch (PDOException $e) {
    // Handle database-related errors
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    http_response_code(500); // Internal Server Error
} catch (Exception $e) {
    // Handle general runtime errors
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()]);
    http_response_code(500); // Internal Server Error
}
