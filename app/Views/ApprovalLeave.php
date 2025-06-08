<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Leave Management') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Leave Management</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Leave List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Leave Type</th>
                            <th>Leave Start</th>
                            <th>Leave End</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($leave as $leave): ?>
                    <tr>
                        <td><?= esc($leave['Username']) ?></td>
                        <td><?= esc($leave['Leave_Type']) ?></td>
                        <td><?= esc($leave['Leave_Start']) ?></td>
                        <td><?= esc($leave['Leave_End']) ?></td>
                        <td><?= esc($leave['Status']) ?></td>
                        <td><?= esc($leave['Reason']) ?></td>
                        <td>
                            <?php
                                $currentUserPosition = session('position');
                                $requesterPosition = $leave['Position'];
                                $canApprove = false;

                                if ($currentUserPosition === 'Admin') {
                                    $canApprove = true;
                                }

                                if ($currentUserPosition === 'Manager' && $requesterPosition === 'Employee') {
                                    $canApprove = true;
                                }
                            ?>

                            <?php if ($canApprove): ?>
                                <a href="/leave/approve/<?= esc($leave['Leave_ID']) ?>" class="btn btn-success btn-sm">Approve</a>
                                <a href="/leave/reject/<?= esc($leave['Leave_ID']) ?>" class="btn btn-danger btn-sm">Reject</a>
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

