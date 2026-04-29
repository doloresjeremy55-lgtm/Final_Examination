// Function to show selected section and hide others
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content, .homecontent').forEach(section => {
        section.style.display = 'none';
    });

    // Show selected section
    const target = document.getElementById(sectionId);
    if (target) {
        target.style.display = 'block';
    }
}

// Function to edit student
function editStudent(id) {
    showSection('update');

    fetch('get_student.php?id=' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load student data: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }

            document.getElementById('update_id_input').value = data.id;
            document.getElementById('update_id').value = data.id;
            document.getElementById('update_surname').value = data.surname;
            document.getElementById('update_name').value = data.name;
            document.getElementById('update_middlename').value = data.middlename;
            document.getElementById('update_address').value = data.address;
            document.getElementById('update_contact_number').value = data.contact_number;
            const updateBtn = document.getElementById('updatebtn');
            if (updateBtn) {
                updateBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Unable to load student record for editing. Please refresh the page and try again.\nDetails: ' + error.message);
        });
}

// Function to delete student
function deleteStudent(id) {
    if (confirm("Delete this student?")) {
        window.location.href = "delete.php?id=" + id;
    }
}

// When page loads, show the appropriate section
window.onload = function () {
    // Always start with home section on page load
    showSection('home');
    
    // Clean the URL to remove any query parameters
    window.history.replaceState({}, document.title, window.location.pathname);

    // Disable update until a record is loaded
    const updateBtn = document.getElementById('updatebtn');
    const updateIdField = document.getElementById('update_id');
    if (updateBtn) {
        updateBtn.disabled = true;
        if (updateIdField && updateIdField.value) {
            updateBtn.disabled = false;
        }
    }

    // Clear fields event listeners
    document.getElementById('clrbtn').addEventListener('click', function() {
        document.getElementById('surname').value = '';
        document.getElementById('name').value = '';
        document.getElementById('middlename').value = '';
        document.getElementById('address').value = '';
        document.getElementById('contact_number').value = '';
    });

    document.getElementById('clrbtn_update').addEventListener('click', function() {
        document.getElementById('update_id_input').value = '';
        document.getElementById('update_id').value = '';
        document.getElementById('update_surname').value = '';
        document.getElementById('update_name').value = '';
        document.getElementById('update_middlename').value = '';
        document.getElementById('update_address').value = '';
        document.getElementById('update_contact_number').value = '';
        document.getElementById('updatebtn').disabled = true;
    });

    document.getElementById('clrbtn_delete').addEventListener('click', function() {
        document.getElementById('delete_id').value = '';
    });

    // Load student for update by ID
    document.getElementById('loadstudent').addEventListener('click', function() {
        const idInput = document.getElementById('update_id_input').value;
        if (!idInput) {
            alert('Please enter a Student ID');
            return;
        }
        editStudent(idInput);
    });
}
