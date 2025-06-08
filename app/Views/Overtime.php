<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Overtime Request') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4">Request Overtime, <?= session('username') ?></h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Overtime Request</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Overtime Date</th>
                            <th>Overtime Start</th>
                            <th>Overtime End</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($overtime as $row): ?>
                    <tr>
                        <td><?= esc($row['Overtime_Date']) ?></td>
                        <td><?= esc($row['Overtime_Start']) ?></td>
                        <td><?= esc($row['Overtime_End']) ?></td>
                        <td><?= esc($row['Status']) ?></td>
                        <td><?= esc($row['Reason']) ?></td>
                        <?php if ($row['Status'] === 'Rejected'): ?>
                            <td><a href="/overtime/delete/<?= esc($row['Overtime_ID']) ?>">Pull</a></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/overtime/add" class="btn btn-custom">Request Overtime</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
