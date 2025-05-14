<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Project Details</title>
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
                    <a href="/profile">Profile</a>
                    <a href="/attendance">Attendance</a>
                    <a href="/project">Project</a>
                    <a href="/salary/view">Finance</a>
                    <?php if(session('position') == 'Admin'):?>
                        <a href="/admin">Admin</a>
                    <?php endif;?>
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
        <div class="card">
            <h2>Project: <?= esc($project['Project_Name']) ?></h2>
            <p><strong>Description:</strong> <?= esc($project['Project_Description']) ?></p>
            <p><strong>Status:</strong> <?= esc($project['Project_Status']) ?></p>
            <p><strong>Manager:</strong> <?= esc($project['Manager_Name']) ?></p>
            <p><strong>Client:</strong> <?= esc($project['Client_Name']) ?></p>

            <div class="card-header bg-primary text-white">
                <h4>Document</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($documents)): ?>
                        <?php foreach ($documents as $doc): ?>
                            <tr>
                                <td><?= esc($doc['Document']) ?></td>
                                <td>
                                    <a href="<?= base_url('project/download/' . $project['Project_ID'] . '/' . $doc['Document']) ?>">Download</a> |
                                    <a href="<?= base_url('project/deletefile/' . $project['Project_ID'] . '/' . $doc['Employee_Project_ID']) ?>"
                                    onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No documents uploaded yet.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

                <h3>Upload Document</h3>
                <form action="/project/upload/<?= esc($project['Project_ID']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <label for="document">Choose a file:</label>
                    <input type="file" name="document" id="document" required>
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
