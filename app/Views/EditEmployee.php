<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Edit Employee') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/admin" class="close-button" title="Kembali">&times;</a>
            <h2>Edit Employee</h2>
            <form action="/employee/editprocess/<?= esc($UserData['Employee_ID'])?>" method="POST">
                <?= csrf_field() ?>
                <label for="employee_id">Employee Id:</label>
                <input type="text" id="employee_id" name="Employee_ID" value="<?= esc($UserData['Employee_ID']) ?>">

                <label for="department_id">Department ID:</label>
                <input type="text" id="department_id" name="Department_ID" value="<?= esc($UserData['Department_ID']) ?>">

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="First_Name" value="<?= esc($UserData['First_Name']) ?>">

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Last_Name" value="<?= esc($UserData['Last_Name']) ?>">

                <label for="Position">Position:</label>
                <select id="Position" name="Position" required>
                    <option value="Employee" <?= $UserData['Position'] === 'Employee' ? 'selected' : '' ?>>Employee</option>    
                    <?php if (session()->get('position') === 'Admin'):?> 
                        <option value="Manager" <?= $UserData['Position'] === 'Manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="Admin" <?= $UserData['Position'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <?php endif; ?>
                </select>

                <label for="username">Username:</label>
                <input type="text" id="username" name="Username" value="<?= esc($UserData['Username']) ?>" required>

                <label for="user_password">User Password:</label>
                <input type="text" id="user_password" name="Employee_Password" value="<?= esc($UserData['Employee_Password']) ?>" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="Work_Email" value="<?= esc($UserData['Work_Email']) ?>">

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="Phone_Number" value="<?= esc($UserData['Phone_Number']) ?>">

                <button type="submit">Update</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>