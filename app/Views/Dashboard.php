<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Dashboard - Work Flow</title>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
</head>
<body>
  <header>
    <div class="logo">
        <img src="LOGO.png" alt="Logo">
      <span class="icon">📄</span>
      <a href="#" class="company">Your <strong>Company</strong></a>
    </div>
    <nav>
      <ul>
        <li><a href="/profile">Profil</a></li>
        <li><a href="/attendance">Attendance</a></li>
        <li><a href="/project">Project</a></li>
        <li><a href="/finance">Finance</a></li> 
        <li>
            <?php if ($user['Position'] == 'Admin'): ?>
                <a href="/admin" class="btn">Admin</a>
            <?php endif; ?>
        <li>
        <li><a href="/logout">Log-Out</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="content">
      <h1><span>MOBILE</span> ICEHRM</h1>
      <p class="subtitle">Determine The Application Platform To Be Made</p>
      <p class="description">
        Mobile apps are often thought of as the opposite of a desktop app running on a desktop computer,
        and a web app running on the device's web browser.
      </p>
    </div>
  </main>

  <footer>
    <p>
      Mobile apps are often thought of as the opposite of a desktop app running on a desktop computer,
      and a web app running on the device's web browser.
    </p>
  </footer>
</body>
</html>