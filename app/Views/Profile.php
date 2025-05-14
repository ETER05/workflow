<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: linear-gradient(135deg, #5b0ab3, #2575fc);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #fff;
        }
        .header img {
            height: 50px;
            width: auto;
        }
        .header span {
            font-size: 1.2rem;
            font-weight: bold;
            margin-left: 10px;
        }
        .container {
            max-width: 700px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 25px;
            color: #6a11cb;
        }
        p {
            font-size: 1.1rem;
            margin: 15px 0;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin: 25px 0;
            background-color: #6a11cb;
            color: white;
            border: none;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #2575fc;
            transform: scale(1.05);
        }
        .profile-info {
            margin-top: 25px;
        }
        .profile-info p strong {
            color: #6a11cb;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #ddd;
        }
        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="Logo Putih.png" alt="ICEHRM">
            <span>Employee Information System</span>
        </div>
    </div>
    <div class="container">
        <h2>Welcome, <?= esc($user['Username']) ?>!</h2>
        <a href="/profile/update" class="btn">Update Profile</a>
        <div class="profile-info">
            <p><strong>First Name:</strong> <?= esc($user['First_Name']) ?></p>
            <p><strong>Last Name:</strong> <?= esc($user['Last_Name']) ?></p>
            <p><strong>Username:</strong> <?= esc($user['Username']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['Work_Email']) ?></p>
            <p><strong>Phone Number:</strong> <?= esc($user['Phone_Number']) ?></p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2023 Employee Information System. All rights reserved. <a href="/terms">Terms</a> | <a href="/privacy">Privacy</a></p>
    </div>
</body>
</html>
