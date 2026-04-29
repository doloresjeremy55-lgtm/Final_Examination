<?php
require_once __DIR__ . '/db.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        echo json_encode($student);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Student not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No ID provided']);
}
?>