<?php
require_once __DIR__ . '/db.php';

try {
    $sql = "SELECT id, name, surname, middlename, address, contact_number FROM students ORDER BY surname, name";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
    
    if (count($students) > 0) {
        echo '<table class="student-table">';
        echo '<thead><tr><th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th><th>Address</th><th>Contact</th><th>Actions</th></tr></thead>';
        echo '<tbody>';
        foreach ($students as $student) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($student['id']) . '</td>';
            echo '<td>' . htmlspecialchars($student['surname']) . '</td>';
            echo '<td>' . htmlspecialchars($student['name']) . '</td>';
            echo '<td>' . htmlspecialchars($student['middlename']) . '</td>';
            echo '<td>' . htmlspecialchars($student['address']) . '</td>';
            echo '<td>' . htmlspecialchars($student['contact_number']) . '</td>';
            echo '<td>';
            echo '<button onclick="editStudent(' . $student['id'] . ')" class="btns">Edit</button>';
            echo '<button onclick="deleteStudent(' . $student['id'] . ')" class="btns">Delete</button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No students found.</p>';
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>