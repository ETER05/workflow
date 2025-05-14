<!DOCTYPE html>
<html>
<head>
    <title>Salary</title>
</head>
<body>

    <h2>Your Salary</h2>
    <table border="1">
        <tr>
            <th>Salary Date</th>
            <th>Salary Amount</th>
        </tr>
        <?php foreach ($salary as $row): ?>
        <tr>
            <td><?= esc($row['Salary_Date']) ?></td>
            <td><?= esc($row['Salary_Amount']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
