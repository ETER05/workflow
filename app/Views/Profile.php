<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

    <h2>Your Profile, <?= esc($user['Username']) ?>!</h2>
    <p><strong>First Name:</strong> <?= esc($user['First_Name']) ?></p>
    <p><strong>Last Name:</strong> <?= esc($user['Last_Name']) ?></p>
    <p><strong>Username:</strong> <?= esc($user['Username']) ?></p>
    <p><strong>Email:</strong> <?= esc($user['Work_Email']) ?></p>
    <p><strong>No HP:</strong> <?= esc($user['Phone_Number']) ?></p>
</body>
</html>
