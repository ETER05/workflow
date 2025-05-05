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

</body>
</html>
