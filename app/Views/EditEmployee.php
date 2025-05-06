<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form action="/employee/editprocess/<?= esc($userData['Employee_ID'])?>" method="POST">
        <?= csrf_field() ?>
        <label for="employee_id">Employee Id:</label>
        <input type="text" id="employee_id" name="Employee_ID" value="<?= esc($userData['Employee_ID']) ?>">
        <br>

        <label for="department_id">Department ID:</label>
        <input type="text" id="department_id" name="Department_ID" value="<?= esc($userData['Department_ID']) ?>">
        <br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="First_Name" value="<?= esc($userData['First_Name']) ?>">
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="Last_Name" value="<?= esc($userData['Last_Name']) ?>">
        <br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="Username" value="<?= esc($userData['Username']) ?>" required>
        <br>

        <label for="user_password">User Password:</label>
        <input type="text" id="user_password" name="Employee_Password" value="<?= esc($userData['Employee_Password']) ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="Work_Email" value="<?= esc($userData['Work_Email']) ?>">
        <br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="Phone_Number" value="<?= esc($userData['Phone_Number']) ?>">
        <br>

        <!-- Tambahkan input lainnya sesuai kebutuhan -->

        <button type="submit">Update</button>
    </form>
</body>
</html>