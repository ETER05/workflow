<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Leave Request') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Request Leave, <?= session('username') ?></h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Leave Request</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>Leave Start</th>
                            <th>Leave End</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($leave as $leave): ?>
                        <tr>
                            <td><?= esc($leave['Leave_Type']) ?></td>
                            <td><?= esc($leave['Leave_Start']) ?></td>
                            <td><?= esc($leave['Leave_End']) ?></td>
                            <td><?= esc($leave['Status']) ?></td>
                            <td><?= esc($leave['Reason']) ?></td>
                            <?php if ($leave['Status'] === 'Rejected'): ?>
                                <td><a href="/leave/delete/<?= esc($leave['Leave_ID']) ?>">Pull</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/leave/add" class="btn btn-custom">Request Leave</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
