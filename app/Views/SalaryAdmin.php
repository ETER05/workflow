<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Finance Management') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Finance Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Salary List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Salary Date</th>
                                <th>Salary Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($salary as $salary): ?>
                            <tr>
                                <td><?= esc($salary['Username']) ?></td>
                                <td><?= esc($salary['Salary_Type']) ?></td>
                                <td><?= esc($salary['Salary_Date']) ?></td>
                                <td><?= esc($salary['Salary_Amount']) ?></td>
                                <td>
                                    <?php
                                        $currentUserPosition = session('position');
                                        $targetPosition = $salary['Position'];
                                        $Permission = false;

                                        if ($currentUserPosition === 'Admin') {
                                            $Permission = true;
                                        }

                                        if ($currentUserPosition === 'Manager' && $targetPosition === 'Employee') {
                                            $Permission = true;
                                        }
                                    ?>

                                    <?php if ($Permission): ?>
                                        <a href="/salary/edit/<?= esc($salary['Salary_ID']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/salary/delete/<?= esc($salary['Salary_ID']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                    <?php else: ?>
                                        <span class="text-muted">No action</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="/salary/add" class="btn btn-custom">Add Salary</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>