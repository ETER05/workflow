<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Profile') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">      
            <h2>Your Profile</h2>
            <p><strong>Full Name:</strong> <?= esc($user['First_Name']) ?> <?= esc($user['Last_Name']) ?></p>
            <p><strong>Department:</strong> <?= esc($user['Department_ID']) ?></p>
            <p><strong>Position:</strong> <?= esc($user['Position']) ?></p>
            <p><strong>Username:</strong> <?= esc($user['Username']) ?></p>
            <p><strong>Password:</strong> <?= esc($user['Employee_Password']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['Work_Email']) ?></p>
            <p><strong>Phone Number:</strong> <?= esc($user['Phone_Number']) ?></p>
            <br>
            <a href="/profile/update" class="btn btn-primary">Update</a>
        </div>
    </main>
<?= $this->endSection() ?>