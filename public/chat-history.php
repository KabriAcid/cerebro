<?php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../util/utilities.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$userId = $_SESSION['user_id'];
$user = get_user_info($pdo, $userId);

// Fetch chat logs for the user
$stmt = $pdo->prepare("SELECT prompt, response, model, created_at FROM chat_logs WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$chatLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require __DIR__ . '/../components/header.php'; ?>

<body>
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn primary" onclick="window.history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l5.147 5.146a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708.708L2.707 7.5H14.5a.5.5 0 0 1 .5.5z" />
                </svg>
            </button>
            <h5 class="mb-0 fw-bold">Chat History</h5>
            <button class="btn primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm5 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg>
            </button>
        </div>

        <?php if (empty($chatLogs)): ?>
            <p class="text-muted">No chat history available.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($chatLogs as $log): ?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span class="text-primary"><?= $user['username']; ?></span>
                            <small class="text-muted"><?= date('Y-m-d H:i', strtotime($log['created_at'])) ?></small>
                        </div>
                        <p class="mb-2"><?= htmlspecialchars($log['prompt']) ?></p>

                        <div class="d-flex justify-content-between">
                            <span class="text-secondary">Bot (<?= htmlspecialchars($log['model']) ?>):</span>
                        </div>
                        <p class="mb-0"><?= htmlspecialchars($log['response']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>

</html>