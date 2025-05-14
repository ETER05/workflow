<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Add Department</title>
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

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .dashboard {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        h2 {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #374fc1;
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
            const dropdown = document.getElementById('menuDropdown');
            dropdown.style.display = dropdown.style.display === 'block' || dropdown.style.display === '' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            const dropdown = document.getElementById('menuDropdown');
            if (!event.target.closest('.menu') && dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            }
        }
    </script>

    <main>
        <div class="dashboard">
        <h2>Add New Department</h2>
        <form action="/department/addprocess" method="POST">
            <?= csrf_field() ?>
            <label for="department_id">Department ID:</label>
            <input type="text" id="department_id" name="Department_ID">
            <br>

            <label for="department_name">Department Name:</label>
            <input type="text" id="department_name" name="Department_Name">
            <br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="Description">
            <br>

            <label for="parent_structure">Parent Structure:</label>
            <input type="text" id="parent_structure" name="Parent_Structure">
            <br>

            <button type="submit">Add Department</button>
        </form>
        </div>
    </main>
</body>
</html>