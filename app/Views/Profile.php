<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
    <h2>Your Profile, <?= esc($user['Username']) ?>!</h2>
    <a href="/profile/update" class="btn">Update Profile</a>
    <p><strong>First Name:</strong> <?= esc($user['First_Name']) ?></p>
    <p><strong>Last Name:</strong> <?= esc($user['Last_Name']) ?></p>
    <p><strong>Username:</strong> <?= esc($user['Username']) ?></p>
    <p><strong>Email:</strong> <?= esc($user['Work_Email']) ?></p>
    <p><strong>No HP:</strong> <?= esc($user['Phone_Number']) ?></p>
</body>
</html>
