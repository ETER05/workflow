<!DOCTYPE html>
<html>
<head>
    <title>Department</title>
</head>
<body>

    <h2>Department List</h2>
    <a href="/department/add">Add Department</a>
    <table border="1">
        <tr>
            <th>Department ID</th>
            <th>Department Name</th>
            <th>Description</th>
            <th>Parent Structure</th>
        </tr>
        <?php foreach ($department as $department): ?>
        <tr>
            <td><?= esc($department['Department_ID']) ?></td>
            <td><?= esc($department['Department_Name']) ?></td>
            <td><?= esc($department['Description']) ?></td>
            <td><?= esc($department['Parent_Structure']) ?></td>
            <td><a href="/department/edit/<?= esc($department['Department_ID']) ?>">Edit</a><td>
            <td><a href="/department/delete/<?= esc($department['Department_ID']) ?>">Delete</a><td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
