<?= $this->extend('layout/menuadmin') ?>

<?php $this->setVar('title', 'Overtime Management') ?>
<?= $this->section('content') ?>

    <div class="container">
        <h1 class="text-center mb-4">Overtime Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Overtime List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Overtime Date</th>
                            <th>Overtime Start</th>
                            <th>Overtime End</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($overtime as $overtime): ?>
                        <tr>
                            <td><?= esc($overtime['Username']) ?></td>
                            <td><?= esc($overtime['Overtime_Date']) ?></td>
                            <td><?= esc($overtime['Overtime_Start']) ?></td>
                            <td><?= esc($overtime['Overtime_End']) ?></td>
                            <td><?= esc($overtime['Status']) ?></td>
                            <td><?= esc($overtime['Reason']) ?></td>
                            <td>
                                <?php
                                    $currentUserPosition = session('position');
                                    $requesterPosition = $overtime['Position'];
                                    $canApprove = false;

                                    if ($currentUserPosition === 'Admin') {
                                        $canApprove = true;
                                    }

                                    if ($currentUserPosition === 'Manager' && $requesterPosition === 'Employee') {
                                        $canApprove = true;
                                    }
                                ?>

                                <?php if ($canApprove): ?>
                                    <a href="/overtime/approve/<?= esc($overtime['Overtime_ID']) ?>" class="btn btn-success btn-sm">Approve</a>
                                    <a href="/overtime/reject/<?= esc($overtime['Overtime_ID']) ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php else: ?>
                                    <span class="text-muted">No action</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>