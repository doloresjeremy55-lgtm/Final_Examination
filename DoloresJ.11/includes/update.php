<?php
require_once __DIR__ . '/db.php';


$id = $_POST['id'] ?? null;
$surname = $_POST['surname'] ?? '';
$name = $_POST['name'] ?? '';
$middlename = $_POST['middlename'] ?? '';
$address = $_POST['address'] ?? '';
$contact = $_POST['contact_number'] ?? '';

if (empty($id)) {
    die('Update Error: Missing student ID. Please use the Edit button from the student list.');
}

try {
    // SQL UPDATE
    $sql = "UPDATE students SET 
        surname = ?, 
        name = ?, 
        middlename = ?, 
        address = ?, 
        contact_number = ?
        WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    // execute
    $stmt->execute([
        $surname,
        $name,
        $middlename,
        $address,
        $contact,
        $id
    ]);

    header("Location: ../public/index.php?section=read&status=update_success");
    exit();

} catch (PDOException $e) {
    echo "Update Error: " . $e->getMessage();
}