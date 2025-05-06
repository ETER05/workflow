<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        .btn {
            padding: 10px 20px;
            margin: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2><?= esc($userData['Username'])?></h2>

    <a href="/departement" class="btn">Departement</a>
    <a href="/addemployee" class="btn">Add Employee</a>
    <a href="/addproject" class="btn">Add Project</a>
    <br><br>

    <table border="1">
        <tr>
            <th>Employee ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Work Email</th>
            <th>Phone Number</th>
        </tr>
        <?php foreach ($employee as $employee): ?>
        <tr>
            <td><?= esc($employee['Employee_ID']) ?></td>
            <td><?= esc($employee['Username']) ?></td>
            <td><?= esc($employee['First_Name']) ?></td>
            <td><?= esc($employee['Last_Name']) ?></td>
            <td><?= esc($employee['Work_Email']) ?></td>
            <td><?= esc($employee['Phone_Number']) ?></td>
            <td><a href="/employee/edit/<?= esc($employee['Employee_ID']) ?>">Edit</a><td>
            <td><a href="/employee/delete/<?= esc($employee['Employee_ID']) ?>">Delete</a><td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
