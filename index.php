<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with PHP, MySQL, AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Manage Users</h2>

    <!-- Form to Add New User -->
    <form id="add-user-form">
        <input type="text" id="new_usr_id" placeholder="User ID" required>
        <input type="text" id="new_usr_name" placeholder="User Name" required>
        <input type="email" id="new_usr_email" placeholder="User Email" required>
        <button type="submit">Add User</button>
    </form>

    <!-- Table to Display Users -->
    <table id="data-table" border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be fetched from the database here -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            // Fetch and display users on page load
            fetchUsers();

            // Add a new user
            $('#add-user-form').submit(function(e) {
                e.preventDefault();
                let usr_id = $('#new_usr_id').val();
                let usr_name = $('#new_usr_name').val();
                let usr_email = $('#new_usr_email').val();

                $.ajax({
                    url: 'add.php',
                    method: 'POST',
                    data: { usr_id: usr_id, usr_name: usr_name, usr_email: usr_email },
                    success: function(response) {
                        alert(response);
                        fetchUsers(); // Refresh the table
                    }
                });
            });

            // Fetch users from the database
            function fetchUsers() {
                $.ajax({
                    url: 'fetch.php',
                    method: 'GET',
                    success: function(data) {
                        $('#data-table tbody').html(data);
                    }
                });
            }

            // Update user data on double-click
            $(document).on('dblclick', 'td.editable', function() {
                let currentElement = $(this);
                let currentValue = currentElement.text();
                let column = currentElement.data('column');
                let id = currentElement.data('id');

                let input = $('<input>', {
                    type: 'text',
                    value: currentValue,
                    blur: function() { // When the input loses focus
                        updateData(id, column, $(this).val());
                    },
                    keyup: function(event) { // On pressing Enter
                        if (event.which === 13) {
                            $(this).blur(); // Trigger the blur event
                        }
                    }
                });

                currentElement.html(input);
                input.focus();
            });

            // Update data using AJAX
            function updateData(id, column, newValue) {
                $.ajax({
                    url: 'update.php',
                    method: 'POST',
                    data: { id: id, column: column, value: newValue },
                    success: function(response) {
                        alert(response);
                        fetchUsers(); // Refresh the table
                    }
                });
            }

            // Delete a user
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: 'delete.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            alert(response);
                            fetchUsers(); // Refresh the table
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
