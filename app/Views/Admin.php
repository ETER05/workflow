<?= $this->extend('layout/menuadmin') ?>

<?php $this->setVar('title', 'Admin Dashboard') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Admin</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Employee List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Status</th>
                            <th>Clock</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Work Email</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employee as $employee): ?>
                        <tr>
                            <td><?= esc($employee['Employee_ID']) ?></td>
                            <td>
                                <?= isset($employee['is_online']) && $employee['is_online'] ? 'Online' : 'Offline' ?>
                            </td>
                            <td>
                                <?= isset($employee['is_clocked_in']) && $employee['is_clocked_in'] ? 'Clocked In' : 'Clocked Out' ?>
                            </td>
                            <td><?= esc($employee['Username']) ?></td>
                            <td><?= esc($employee['First_Name']) ?></td>
                            <td><?= esc($employee['Last_Name']) ?></td>
                            <td><?= esc($employee['Position']) ?></td>
                            <td><?= esc($employee['Work_Email']) ?></td>
                            <td><?= esc($employee['Phone_Number']) ?></td>
                            <td>
                                <?php
                                    $currentUserPosition = session('position');
                                    $currentPosition = $employee['Position'];
                                    $canEdit = false;

                                    if ($currentUserPosition === 'Admin') {
                                        $canEdit = true;
                                    }

                                    if ($currentUserPosition === 'Manager' && $currentPosition === 'Employee') {
                                        $canEdit = true;
                                    }
                                ?>

                                <?php if ($canEdit): ?>
                                    <a href="/employee/edit/<?= esc($employee['Employee_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/employee/delete/<?= esc($employee['Employee_ID']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                <?php else: ?>
                                    <span class="text-muted">No action</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/employee/add" class="btn btn-custom">Add New Employee</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
