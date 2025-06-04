<?= $this->extend('layout/menuadmin') ?>

<?php $this->setVar('title', 'Edit Salary') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/salary" class="close-button" title="Kembali">&times;</a>
            <h2>Edit <?= esc($salary['Username']) ?>'s Salary </h2>
            <form action="/salary/editprocess" method="POST">
            <?= csrf_field() ?>
                <label for="salary_date">Salary Date:</label>
                <input type="date" id="salary_date" name="Salary_Date" value="<?= esc($salary['Salary_ID']) ?>">

                <label for="salary_amount">Salary Amount:</label>
                <input type="text" id="salary_amount" name="Salary_Amount" value="<?= esc($salary['Salary_Amount']) ?>">

                <button type="submit">Update</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>