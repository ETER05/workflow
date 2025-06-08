<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Add Project') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/project" class="close-button" title="Kembali">&times;</a>
            <h2>Add New Project</h2>
            <form action="/project/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="project_name">Project Name:</label>
                <input type="text" id="project_name" name="Project_Name">
                <br>

                <label for="project_description">Project Description:</label>
                <input type="text" id="project_description" name="Project_Description">
                <br>

                <label for="project_status">Project Status:</label>
                <input type="text" id="project_status" name="Project_Status">
                <br>

                <label for="manager_id">Manager:</label>
                <select id="manager_id" name="Manager_ID" >
                <option value=""></option>
                    <?php foreach ($manager as $manager): ?>
                        <option value="<?= $manager['Manager_ID'] ?>">
                            <?= esc($manager['Username']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>

                <label for="client_name">Client:</label>
                <select id="client_id" name="Client_ID">
                    <option value=""></option>
                    <?php foreach ($client as $client): ?>
                        <option value="<?= $client['Client_ID'] ?>">
                            <?= esc($client['Client_Name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>

                <button type="submit">Add</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>