<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        header {
            background: linear-gradient(135deg, #2575fc, #5b0ab3);
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center;">
            <img src="logoatas.png" alt="Company Logo" style="width: 50px; height: 50px; margin-right: 10px;">
            <span>WORKFLOW</span>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()" style="cursor: pointer; font-size: 1.5rem; color: white;">
            <i class="fas fa-bars"></i>
            </div>
        </div>
        <nav id="menu" style="display: 5none; margin-top: 10px; text-align: center;">
            <a href="#profile" style="color: white; text-decoration: none; margin: 0 10px;">Profile</a>
            <a href="#settings" style="color: white; text-decoration: none; margin: 0 10px;">Settings</a>
            <a href="#logout" style="color: white; text-decoration: none; margin: 0 10px;">Logout</a>
        </nav>
        <script>
            function toggleMenu() {
            const menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "none" || menu.style.display === "" ? "block" : "none";
            }
        </script>
    </header>
    <div class="container">
        <h1 class="text-center mb-4">Client Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Client List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Contact</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($client as $client): ?>
                        <tr>
                            <td><?= esc($client['Client_ID']) ?></td>
                            <td><?= esc($client['Client_Name']) ?></td>
                            <td><?= esc($client['Client_Contact']) ?></td>
                            <td><?= esc($client['Client_Details']) ?></td>
                            <td><a href="/client/edit/<?= esc($client['Client_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/client/delete/<?= esc($client['Client_ID']) ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/client/add" class="btn btn-custom">Add New Client</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
