<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Add Client') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/department" class="close-button" title="Kembali">&times;</a>
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
<?= $this->endSection() ?>