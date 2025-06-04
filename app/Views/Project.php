<?= $this->extend('layout/menuuser') ?>

<?php $this->setVar('title', 'Project') ?>
<?= $this->section('content') ?> 
    <div class="container">
        <h1 class="text-center mb-4">Project Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Project List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Manager</th>
                            <th>Client</th>
                            <th>Works On</th>
                            <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                                <th>Actions</th>
                            <?php endif;?> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($project as $project): ?>
                        <tr>
                            <td><?= esc($project['Project_Name']) ?></td>
                            <td><?= esc($project['Project_Description']) ?></td>
                            <td><?= esc($project['Project_Status']) ?></td>
                            <td><?= esc($project['Manager_Name']) ?></td>
                            <td><?= esc($project['Client_Name']) ?></td>
                            <td><a href="/project/view/<?= esc($project['Project_ID']) ?>" class="btn btn-success btn-sm">Details</a></td>
                            <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                                <td><a href="/project/edit/<?= esc($project['Project_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/project/delete/<?= esc($project['Project_ID']) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            <?php endif;?> 
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                    <a href="/project/add" class="btn btn-custom">Add New Project</a>
                <?php endif;?> 
            </div>
        </div>
    </div>
<?= $this->endSection() ?>