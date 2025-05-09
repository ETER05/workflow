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
            <th>Overtime Date</th>
            <th>Overtime Start</th>
            <th>Overtime End</th>
            <th>Status</th>
            <th>Reason</th>
            <th>Approve</th>
            <th>Reject</th>
        </tr>
        <?php foreach ($overtime as $row): ?>
        <tr>
            <td><?= esc($row['Username']) ?></td>
            <td><?= esc($row['Overtime_Date']) ?></td>
            <td><?= esc($row['Overtime_Start']) ?></td>
            <td><?= esc($row['Overtime_End']) ?></td>
            <td><?= esc($row['Status']) ?></td>
            <td><?= esc($row['Reason']) ?></td>
            <td><a href="/overtime/approve/<?= esc($row['Overtime_ID']) ?>">Approve</a></td>
            <td><a href="/overtime/reject/<?= esc($row['Overtime_ID']) ?>">Reject</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
