<!DOCTYPE html>
<html>
<head>
    <title>Client</title>
</head>
<body>

    <h2>Client List</h2>
    <a href="/client/add">Add Client</a>
    <table border="1">
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Client Contact</th>
            <th>Client Details</th>
        </tr>
        <?php foreach ($client as $client): ?>
        <tr>
            <td><?= esc($client['Client_ID']) ?></td>
            <td><?= esc($client['Client_Name']) ?></td>
            <td><?= esc($client['Client_Contact']) ?></td>
            <td><?= esc($client['Client_Details']) ?></td>
            <td><a href="/client/edit/<?= esc($client['Client_ID']) ?>">Edit</a><td>
            <td><a href="/client/delete/<?= esc($client['Client_ID']) ?>">Delete</a><td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
