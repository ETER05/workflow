<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Finance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- For ☰ icon -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            background: linear-gradient(135deg, #2575fc, #5b0ab3);
            padding: 20px;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .menu {
            cursor: pointer;
            font-size: 20px;
            position: relative;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background: #ffffff;
            color: #000;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: normal;
            text-decoration: none;
            color: #2d2d2d;
        }

        .dropdown a:hover {
            background: #f0f0f0;
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
        <div class="header-container">
            <div class="header-left">
                <img src="Workflow.png" alt="WF">
                <span>WORKFLOW</span>
            </div>
                <div class="menu" onclick="toggleMenu()">☰
                    <div class="dropdown" id="menuDropdown">
                        <a href="/dashboard">Dashboard</a>
                        <a href="/admin">Admin</a>
                        <a href="/department">Department</a>
                        <a href="/overtime/approval">Overtime Request</a>
                        <a href="/leave/approval">Leave Request</a>
                        <a href="/project">Project</a>
                        <a href="/client">Client</a>
                        <a href="/salary">Finance</a>
                        <a href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <script>
    function toggleMenu() {
        const dropdown = document.getElementById("menuDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    document.addEventListener("click", function(event) {
        const menu = document.querySelector(".menu");
        const dropdown = document.getElementById("menuDropdown");
        if (!menu.contains(event.target)) {
        dropdown.style.display = "none";
        }
    });
    </script>

    <div class="container">
        <h1 class="text-center mb-4">Finance Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Salary List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Salary Date</th>
                            <th>Salary Amount</th>
                            <th>Employee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($salary as $salary): ?>
                        <tr>
                            <td><?= esc($salary['Username']) ?></td>
                            <td><?= esc($salary['Salary_Date']) ?></td>
                            <td><?= esc($salary['Salary_Amount']) ?></td>
                            <td><a href="/salary/edit/<?= esc($salary['Salary_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/salary/delete/<?= esc($salary['Salary_ID']) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/salary/add" class="btn btn-custom">Add Salary</a>
            </div>
        </div>
    </div>
</body>
</html>
