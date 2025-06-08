<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Edit Salary') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/salary" class="close-button" title="Kembali">&times;</a>
            <h2>Add Salary</h2>
            <form action="/salary/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="employee_id">Employee:</label>
                <select id="employee_id" name="Employee_ID">
                <option value=""></option>
                    <?php foreach ($employee as $employee): ?>
                        <option value="<?= $employee['Employee_ID'] ?>">
                            <?= esc($employee['Username']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>

                <label for="salary_date">Salary Date:</label>
                <input type="date" id="salary_date" name="Salary_Date">
                <br>

                <label for="salary_amount">Salary Amount:</label>
                <input type="int" id="salary_amount" name="Salary_Amount">
                <br><br>

                <button type="submit">Add</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>