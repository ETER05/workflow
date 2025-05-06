<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form action="/employee/addprocess" method="POST">
        <?= csrf_field() ?>
        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="Employee_ID">
        <br>

        <label for="department_id">Departement ID:</label>
        <input type="text" id="department_id" name="Department_ID">
        <br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="First_Name">
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="Last_Name">
        <br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="Username">
        <br>

        <label for="user_password">User Password:</label>
        <input type="text" id="user_password" name="Employee_Password">
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="Work_Email">
        <br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="Phone_Number">
        <br>

        <!-- Tambahkan input lainnya sesuai kebutuhan -->

        <button type="submit">Add</button>
    </form>
</body>
</html>