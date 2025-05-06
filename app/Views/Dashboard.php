<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

    <h2>Welcome, <?= esc($user['Username']) ?>!</h2>

    <a href="/profile" class="btn">Profile</a>
    <a href="/attendance" class="btn">Attendance</a>
    <a href="/project" class="btn">Project</a>
    <a href="/finance" class="btn">Finance</a>
    <?php if ($user['Position'] == 'Admin'): ?>
        <a href="/admin" class="btn">Admin</a>
    <?php endif; ?>
    <a href="/logout" class="btn">Logout</a>
    
</body>
</html>
