<!DOCTYPE html>
<html>
<head>
    <title>Admin - Salary</title>
</head>
<body>

    <h2>Salary List</h2>
    <a href="/salary/add">Add Salary</a>
    <table border="1">
        <tr>
            <th>Salary Date</th>
            <th>Salary Amount</th>
            <th>Employee</th>
        </tr>
        <?php foreach ($salary as $salary): ?>
        <tr>
            <td><?= esc($salary['Salary_Date']) ?></td>
            <td><?= esc($salary['Salary_Amount']) ?></td>
            <td><?= esc($salary['Username']) ?></td>
            <td><a href="/salary/edit/<?= esc($salary['Salary_ID']) ?>">Edit</a><td>
            <td><a href="/salary/delete/<?= esc($salary['Salary_ID']) ?>">Delete</a><td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
