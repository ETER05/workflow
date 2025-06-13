<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflow Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            color: #000;

            overflow: hidden;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: linear-gradient(135deg, #5b0ab3, #2575fc);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #fff;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 80px;
            margin-right: 15px;
            border-radius: 40%;
        }
        .logo span {
            font-size: 25px;
            font-weight: bold;
        }
        .menu {
            cursor: pointer;
            font-size: 20px;
            position: relative;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .menu-wrapper {
            display: flex;
            gap: 15px;
            align-items: center;
            position: relative;
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
        @keyframes fadeIn {
            from {
            opacity: 0;
            transform: translateY(-10px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
        }
        .welcome {
            text-align: center;
            margin: 30px auto 10px;
            animation: fadeInUp 1s ease forwards;
        }

        .welcome h1 {
            font-size: 26px;
            font-weight: bold;
             background: linear-gradient(135deg, #5b0ab3, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid #000;
            width: 0;
            animation: typing 3s steps(40, end) forwards, blink-caret 0.75s step-end 4;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #333;
            font-size: 16px;
            opacity: 0.9;
            animation: fadeIn 2s ease forwards;
            animation-delay: 1s;
        }

        @keyframes fadeInUp {
            from {
            opacity: 0;
            transform: translateY(20px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            0%, 100% { border-color: transparent }
            50% { border-color: #000 }
        }

        .inscroll{
            width: 100%;
            overflow: scroll;
        }

        .container {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 20px;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .container::-webkit-scrollbar {
            display: none;
        }

        .card {
            flex: 0 0 18%;
            scroll-snap-align: start;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            height: 150px;
            background: linear-gradient(135deg, #ffffff, #ffffff);
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15), 0 20px 25px rgba(0, 0, 0, 0.1), inset 0 0 12px rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
            bottom: -10px;
            position: relative;
            padding: 10px;
            margin: 50px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #ffffff, #ffffff);
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            transition: opacity 0.4s ease;
            opacity: 0;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 8px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3));
            transition: transform 0.4s ease;
        }

        .card:hover img {
            transform: rotate(10deg) scale(1.1);
        }

        .card span {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            transition: color 0.4s ease;
        }

        .card:hover span {
            color: #0000ff;
        }

        .footer {
           background: linear-gradient(135deg, #5b0ab3, #2575fc);
            padding: 15px 30px;
            text-align: center;
            color: #fff;
            font-size: 14px;
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content p {
            margin: 5px 0;
            animation: fadeIn 1s ease forwards;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="<?= base_url('Logo Putih.png')?>" alt="Workflow">
            <span>Employee Management System</span>
        </div>
        <div class="menu-wrapper">
            <!-- Admin Menu -->
            <?php if (session('position') === 'Admin' || session('position') === 'Manager'): ?>
            <div class="menu" onclick="toggleAdminMenu()">🛠️
                <div class="dropdown" id="adminMenuDropdown">
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
            <?php endif; ?>

            <!-- User Menu -->
            <div class="menu" onclick="toggleUserMenu()">☰
                <div class="dropdown" id="userMenuDropdown">
                        <a href="/dashboard">Dashboard</a>
                        <a href="/profile">Profile</a>
                        <a href="/attendance">Attendance</a>
                        <a href="/project">Project</a>
                        <a href="/salary/view">Finance</a>
                        <a href="/department">Departmentt</a>
                        <a href="/client">Client Info</a>
                        <a href="/logout">Logout</a>
                </div>
            </div>
        </div> 
    </div>

    <script>
        function toggleUserMenu() {
            const userDropdown = document.getElementById("userMenuDropdown");
            const adminDropdown = document.getElementById("adminMenuDropdown");
            userDropdown.style.display = userDropdown.style.display === "block" ? "none" : "block";
            adminDropdown.style.display = "none";
        }

        function toggleAdminMenu() {
            const adminDropdown = document.getElementById("adminMenuDropdown");
            const userDropdown = document.getElementById("userMenuDropdown");
            adminDropdown.style.display = adminDropdown.style.display === "block" ? "none" : "block";
            userDropdown.style.display = "none";
        }

        // Close dropdowns if clicked outside
        document.addEventListener("click", function(event) {
            const userMenu = document.getElementById("userMenuDropdown");
            const adminMenu = document.getElementById("adminMenuDropdown");
            const menus = document.querySelectorAll(".menu");

            if (![...menus].some(menu => menu.contains(event.target))) {
                if (userMenu) userMenu.style.display = "none";
                if (adminMenu) adminMenu.style.display = "none";
            }
        });
    </script>

    <div class="welcome">
        <h1>Welcome to Workflow Employee Information System</h1>
        <p>Manage your employee data easily and quickly.</p>
    </div>
    
    <div class="inscroll">
        <div class="container">
            <div class="card" onclick="window.location.href='/profile'">
                <img src="<?= base_url('Profile.png') ?>" alt="Profil">
                <span>Profile</span>
            </div>
            <div class="card" onclick="window.location.href='/attendance'">
                <img src="<?= base_url('Absen.png') ?>" alt="Kehadiran">
                <span>Attendance</span>
            </div>
            <div class="card" onclick="window.location.href='/project'">
                <img src="<?= base_url('Ikon Project.png') ?>" alt="Proyek">
                <span>Project</span>
            </div>
            <div class="card" onclick="window.location.href='/salary/view'">
                <img src="<?= base_url('finance.png') ?>" alt="Keuangan">
                <span>Finance</span>
            </div>
            <div class="card" onclick="window.location.href='/department'">
            <img src="<?= base_url('department ikon.png') ?>" alt="Department">
                <span>Department</span>
            </div>
            <div class="card" onclick="window.location.href='/client'">
                <img src="<?= base_url('client ikon.png') ?>" alt="Client">
                <span>Client</span>
            </div>
            <?php if (session('position') == 'Admin' || session('position') == 'Manager'): ?>
            <div class="card" onclick="window.location.href='/admin'">
                <img src="<?= base_url('admin ikon.png') ?>" alt="Admin">
                <span>Admin</span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
    <div class="footer-content">
        <p>&copy; 2025 Employee Management System - Workflow</p>
        <p>Developed by Tim IT Workflow</p>
    </div>
    </footer>
</body>
</html>