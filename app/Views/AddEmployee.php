<?= $this->extend('layout/menuadmin') ?>

<?php $this->setVar('title', 'Add Employee') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/admin" class="close-button" title="Kembali">&times;</a>
            <h2>Add New Employee</h2>
            <form action="/employee/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="employee_id">Employee ID:</label>
                <input type="text" id="employee_id" name="Employee_ID">

                <label for="department_id">Departement ID:</label>
                <input type="text" id="department_id" name="Department_ID">

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="First_Name">

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Last_Name">

                <label for="Position">Position</label>
                <select id="Position" name="Position" required>
                    <option value="">-- Choose Position --</option>
                    <option value="Employee">Employee</option>
                    <?php if (session()->get('position') === 'Admin'):?> 
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                    <?php endif; ?>
                </select>

                <label for="username">Username:</label>
                <input type="text" id="username" name="Username">

                <label for="user_password">User Password:</label>
                <input type="text" id="user_password" name="Employee_Password">

                <label for="email">Email:</label>
                <input type="text" id="email" name="Work_Email">

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="Phone_Number">

                <button type="submit">Add Employee</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>