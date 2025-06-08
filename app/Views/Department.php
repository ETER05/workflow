<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Department') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Department</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Department List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Department ID</th>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Parent Structure</th>
                            <?php if(session('position') == 'Admin'):?>
                                <th>Actions</th>
                            <?php endif;?> 
                        </tr>
                    </thead>
                    <tbody>
                    </tr>
                    <?php foreach ($department as $department): ?>
                    <tr>
                        <td><?= esc($department['Department_ID']) ?></td>
                        <td><?= esc($department['Department_Name']) ?></td>
                        <td><?= esc($department['Description']) ?></td>
                        <td><?= esc($department['Parent_Structure']) ?></td>
                        <?php if(session('position') == 'Admin'):?>
                            <td><a href="/department/edit/<?= esc($department['Department_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/department/delete/<?= esc($department['Department_ID']) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (session('position') == 'Admin'): ?>
                    <a href="/department/add" class="btn btn-custom">Add New Department</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
