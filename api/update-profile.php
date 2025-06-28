<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

try {
    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        http_response_code(405);
        exit;
    }

    // Check if the user is authenticated
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
        http_response_code(401);
        exit;
    }

    // Decode the incoming JSON request
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON payload.']);
        http_response_code(400);
        exit;
    }

    // Validate the action parameter
    $action = $_GET['action'] ?? null;
    if (!$action) {
        echo json_encode(['success' => false, 'message' => 'Action parameter is required.']);
        http_response_code(400);
        exit;
    }

    // Get the user ID
    $userId = $_SESSION['user_id'];

    // Handle different actions
    switch ($action) {
        case 'editName':
            $name = trim($data['name'] ?? '');
            if (empty($name)) {
                echo json_encode(['success' => false, 'message' => 'Name cannot be empty.']);
                http_response_code(400);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->execute([$name, $userId]);

            echo json_encode(['success' => true, 'message' => 'Name updated successfully.']);
            break;

        case 'editEmail':
            $email = trim($data['email'] ?? '');
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
                http_response_code(400);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $stmt->execute([$email, $userId]);

            echo json_encode(['success' => true, 'message' => 'Email updated successfully.']);
            break;

        case 'editPassword':
            $newPassword = trim($data['newPassword'] ?? '');
            $confirmPassword = trim($data['confirmPassword'] ?? '');

            if (empty($newPassword) || empty($confirmPassword)) {
                echo json_encode(['success' => false, 'message' => 'Password fields cannot be empty.']);
                http_response_code(400);
                exit;
            }

            if ($newPassword !== $confirmPassword) {
                echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
                http_response_code(400);
                exit;
            }

            if (strlen($newPassword) < 8) {
                echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long.']);
                http_response_code(400);
                exit;
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashedPassword, $userId]);

            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
            break;

        case 'editPhone':
            $phone = trim($data['phone'] ?? '');
            if (empty($phone) || !preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
                echo json_encode(['success' => false, 'message' => 'Invalid phone number.']);
                http_response_code(400);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE users SET phone = ? WHERE id = ?");
            $stmt->execute([$phone, $userId]);

            echo json_encode(['success' => true, 'message' => 'Phone number updated successfully.']);
            break;

        case 'closeAccount':
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$userId]);

            session_destroy();

            echo json_encode(['success' => true, 'message' => 'Account closed successfully.']);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            http_response_code(400);
            exit;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    http_response_code($e->getCode() ?: 500);
}
