<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
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

    <h2>Attendance, <?= esc($username) ?>!</h2>
    <a href="/overtime" class="btn">Overtime</a>
    <a href="/leave" class="btn">Leave</a>

    <br><br>
    
    <?php if (!$check): ?>
        <form method="post" action="/attendance/checkin">
            <button type="submit" class="btn">Check In</button>
        </form>
    <?php else: ?>
        <form method="post" action="/attendance/checkout">
            <button type="submit" class="btn">Check Out</button>
        </form>
    <?php endif; ?>

    <br>

    <table border="1">
        <tr>
            <th>Date</th>
            <th>Check In</th>
            <th>Check Out</th>
        </tr>
        <?php foreach ($attendance as $row): ?>
        <tr>
            <td><?= esc($row['Attendance_Date']) ?></td>
            <td><?= esc($row['In_Time']) ?></td>
            <td><?= esc($row['Out_Time']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
