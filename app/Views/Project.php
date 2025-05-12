<!DOCTYPE html>
<html>
<head>
    <title>Project</title>
</head>
<body>

    <h2>Project List</h2>
    <a href="/project/add">Add Project</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Manager</th>
            <th>Client</th>
            <th>Works On</th>
        </tr>
        <?php foreach ($project as $project): ?>
        <tr>
            <td><?= esc($project['Project_Name']) ?></td>
            <td><?= esc($project['Project_Description']) ?></td>
            <td><?= esc($project['Project_Status']) ?></td>
            <td><?= esc($project['Manager_Name']) ?></td>
            <td><?= esc($project['Client_Name']) ?></td>
            <td><a href="/project/view/<?= esc($project['Project_ID']) ?>">Details</a></td>
            <td><a href="/project/edit/<?= esc($project['Project_ID']) ?>">Edit</a></td>
            <td><a href="/project/delete/<?= esc($project['Project_ID']) ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
