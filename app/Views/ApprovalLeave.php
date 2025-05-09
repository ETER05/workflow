<!DOCTYPE html>
<html>
<head>
    <title>Overtime</title>
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

    <h2>Overtime, <?= session('username') ?>!</h2>

    <a href="/overtime/approval" class="btn">Add Overtime</a>
    <br><br>

    <table border="1">
        <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Leave Start</th>
            <th>Leave End</th>
            <th>Status</th>
            <th>Reason</th>
            <th>Approve</th>
            <th>Reject</th>
        </tr>
        <?php foreach ($leave as $row): ?>
        <tr>
            <td><?= esc($row['Username']) ?></td>
            <td><?= esc($row['Leave_Type']) ?></td>
            <td><?= esc($row['Leave_Start']) ?></td>
            <td><?= esc($row['Leave_End']) ?></td>
            <td><?= esc($row['Status']) ?></td>
            <td><?= esc($row['Reason']) ?></td>
            <td><a href="/leave/approve/<?= esc($row['Leave_ID']) ?>">Approve</a></td>
            <td><a href="/leave/reject/<?= esc($row['Leave_ID']) ?>">Reject</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
