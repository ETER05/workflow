<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Edit Department') ?>
<?= $this->section('content') ?> 
    <main>
        <div class="dashboard position-relative">
            <a href="/department" class="close-button" title="Kembali">&times;</a>
            <h2>Edit Department</h2>
            <form action="/department/editprocess/<?= esc($DepartmentData['Department_ID'])?>"  method="POST">
                <?= csrf_field() ?>
                <label for="department_id">Department ID:</label>
                <input type="text" id="department_id" name="Department_ID" value="<?= esc($DepartmentData['Department_ID']) ?>">

                <label for="department_name">Department Name:</label>
                <input type="text" id="department_name" name="Department_Name" value="<?= esc($DepartmentData['Department_Name']) ?>">
                <input type="text" id="department_name" name="Department_Name" value="<?= esc($DepartmentData['Department_Name']) ?>">

                <label for="description">Description:</label>
                <input type="text" id="descripton" name="Description" value="<?= esc($DepartmentData['Description']) ?>">

                <label for="parent_structure">Parent Structure:</label>
                <input type="text" id="parent_structure" name="Parent_Structure" value="<?= esc($DepartmentData['Parent_Structure']) ?>">

                <button type="submit">Update</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>