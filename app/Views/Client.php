<?= $this->extend('layout/menuadmin') ?>

<?php $this->setVar('title', 'Client') ?>
<?= $this->section('content') ?>    
    <div class="container">
        <h1 class="text-center mb-4">Client</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Client List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Contact</th>
                            <th>Details</th>
                            <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                                <th>Actions</th>
                            <?php endif;?> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($client as $client): ?>
                        <tr>
                            <td><?= esc($client['Client_ID']) ?></td>
                            <td><?= esc($client['Client_Name']) ?></td>
                            <td><?= esc($client['Client_Contact']) ?></td>
                            <td><?= esc($client['Client_Details']) ?></td>
                            <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                                <td><a href="/client/edit/<?= esc($client['Client_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/client/delete/<?= esc($client['Client_ID']) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            <?php endif;?> 
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if(session('position') == 'Admin' || session('position') == 'Manager'):?>
                    <a href="/client/add" class="btn btn-custom">Add New Client</a>
                <?php endif;?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
