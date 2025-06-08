<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Update Profile') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/profile" class="close-button" title="Kembali">&times;</a>
            <h2>Update Profile</h2>
            <form action="/profile/updateProcess" method="POST">
                <?= csrf_field() ?>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="First_Name" value="<?= esc($user['First_Name']) ?>">
                <br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Last_Name" value="<?= esc($user['Last_Name']) ?>">
                <br>

                <label for="username">Username:</label>
                <input type="text" id="username" name="Username" value="<?= esc($user['Username']) ?>" required>
                <br>

                <label for="user_password">Password:</label>
                <input type="text" id="user_password" name="Employee_Password" value="<?= esc($user['Employee_Password']) ?>" required>
                <br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="Work_Email" value="<?= esc($user['Work_Email']) ?>">
                <br>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="Phone_Number" value="<?= esc($user['Phone_Number']) ?>">
                <br>

                <button type="submit">Update</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>