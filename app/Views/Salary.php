<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Finance') ?>
<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center mb-4"><?= session('username')?>'s Finance</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Finance List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Salary Date</th>
                            <th>Salary Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($salary as $salary): ?>
                        <tr>
                            <td><?= esc($salary['Salary_Date']) ?></td>
                            <td><?= esc($salary['Salary_Amount']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>