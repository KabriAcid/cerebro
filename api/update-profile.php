<!-- filepath: c:\xampp\htdocs\cerebro\api\update-profile.php -->
<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../util/utilities.php';

header('Content-Type: application/json');

try {
    // Ensure the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.', 405);
    }

    // Check if the user is authenticated
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Unauthorized access.', 401);
    }

    // Decode the incoming JSON request
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        throw new Exception('Invalid JSON payload.', 400);
    }

    // Validate the action parameter
    $action = $_GET['action'] ?? null;
    if (!$action) {
        throw new Exception('Action parameter is required.', 400);
    }

    // Get the user ID
    $userId = $_SESSION['user_id'];

    // Handle different actions
    switch ($action) {
        case 'editName':
            $name = trim($data['name'] ?? '');
            if (empty($name)) {
                throw new Exception('Name cannot be empty.', 400);
            }

            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->execute([$name, $userId]);

            echo json_encode(['success' => true, 'message' => 'Name updated successfully.']);
            break;

        case 'editEmail':
            $email = trim($data['email'] ?? '');
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email address.', 400);
            }

            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $stmt->execute([$email, $userId]);

            echo json_encode(['success' => true, 'message' => 'Email updated successfully.']);
            break;

        case 'editPassword':
            $newPassword = trim($data['newPassword'] ?? '');
            $confirmPassword = trim($data['confirmPassword'] ?? '');

            if (empty($newPassword) || empty($confirmPassword)) {
                throw new Exception('Password fields cannot be empty.', 400);
            }

            if ($newPassword !== $confirmPassword) {
                throw new Exception('Passwords do not match.', 400);
            }

            if (strlen($newPassword) < 8) {
                throw new Exception('Password must be at least 8 characters long.', 400);
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashedPassword, $userId]);

            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
            break;

        case 'editPhone':
            $phone = trim($data['phone'] ?? '');
            if (empty($phone) || !preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
                throw new Exception('Invalid phone number.', 400);
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
            throw new Exception('Invalid action.', 400);
    }
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
