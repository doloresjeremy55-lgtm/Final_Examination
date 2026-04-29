<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link   rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
<img src="../images/mylogo.png" onclick="showSection('home')"
style="height:55px; width:55px; border-radius:50%; cursor:pointer;">
   <button class="navbarbuttons" onclick="showSection('create')">Create</button>
<button class="navbarbuttons" onclick="showSection('read')">Read</button>
<button class="navbarbuttons" onclick="showSection('update')">Update</button>
<button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
    </nav>
    <section id="home" class="homecontent"> 
        <h1 class="splash">Welcome to Student Management System</h1>
        <h2 class="splash">A Project in Integrative Programming Technologies</h2>
    </section>
    
    <section id="create" class="content">
        <h1 class="contenttitle"> Insert New Student </h1>

    <form action="insert.php" method="POST">
        <label for="surname" class="label">Surname</label>
        <input type="text" name="surname" id="surname" class="field" required><br/>

        <label for="name" class="label">Name</label>
        <input type="text" name="name" id="name" class="field" required><br/>

        <label for="middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="middlename" class="field"><br/>

        <label for="address" class="label">Address</label>
        <input type="text" name="address" id="address" class="field"><br/>

        <label for="contact_number" class="label">Mobile Number</label>
        <input type="text" name="contact_number" id="contact_number" class="field"><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
            <button type="submit" id="savebtn" class="btns">Save</button>
        </div>

        <div id="success-toast" class="toast-hidden">
            Registration Successful!
        </div>
        <div id="update-toast" class="toast-hidden">
            Update Successful!
        </div>
    </form>   

    </section>

    <section id="read" class="content" style="display:none;">
        <h1 class="contenttitle">Student List</h1>

    <?php
    require_once "../includes/db.php";

    try {
        $stmt = $pdo->query("SELECT * FROM students");
        $updateStmt = $pdo->query("SELECT id, surname, name FROM students ORDER BY id");
    } catch (Exception $e) {
        echo "Error loading data";
    }
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Surname</th>
            <th>Name</th>
            <th>Middle</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>

        <?php if(isset($stmt)): ?>
        <?php while($row = $stmt->fetch()): ?>
        <tr>
            <td><?= $row['id'] ?? '' ?></td>
            <td><?= $row['surname'] ?? '' ?></td>
            <td><?= $row['name'] ?? '' ?></td>
            <td><?= $row['middlename'] ?? '' ?></td>
            <td><?= $row['address'] ?? '' ?></td>
            <td><?= $row['contact_number'] ?? '' ?></td>

            <td>
                <a href="#" onclick="editStudent(<?= $row['id'] ?>)">Edit</a> |
                <a href="#" onclick="deleteStudent(<?= $row['id'] ?>)">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php endif; ?>
    </table>
</section>

<br/><br/><br/><br/>

    <section id="update" class="content" style="display:none;">
        <h1 class="contenttitle">Update Student</h1>
    <form id="updateForm" action="update.php" method="POST">
        <label for="update_id_input" class="label">Student ID</label>
        <input type="number" id="update_id_input" class="field" placeholder="Enter Student ID" required><br/>
        <button type="button" id="loadstudent" class="btns">Load Student</button><br/><br/>
        <input type="hidden" name="id" id="update_id">

        <label for="update_surname" class="label">Surname</label>
        <input type="text" name="surname" id="update_surname" class="field" required><br/>

        <label for="update_name" class="label">Name</label>
        <input type="text" name="name" id="update_name" class="field" required><br/>

        <label for="update_middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="update_middlename" class="field"><br/>

        <label for="update_address" class="label">Address</label>
        <input type="text" name="address" id="update_address" class="field"><br/>

        <label for="update_contact_number" class="label">Mobile Number</label>
        <input type="text" name="contact_number" id="update_contact_number" class="field"><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn_update" class="btns">Clear Fields</button><br/>
            <button type="submit" id="updatebtn" class="btns">Update</button>
        </div>
    </form>
</section>

    <section id="delete" class="content" style="display:none;">
        <h1 class="contenttitle">Delete Student</h1>
    <form id="deleteForm" action="delete.php" method="POST">
        <label for="delete_id" class="label">Student ID</label>
        <input type="number" name="id" id="delete_id" class="field" required><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn_delete" class="btns">Clear Fields</button><br/>
            <button type="submit" id="deletebtn" class="btns">Delete</button>
        </div>
    </form>
</section>

    <script src="script.js"></script>
</body>
</html>