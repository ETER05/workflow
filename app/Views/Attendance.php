<?= $this->extend('layout/menuuser') ?>

<?php $this->setVar('title', 'Attendace') ?>
<?= $this->section('content') ?>
    <div class="container">
        <div class="text-center mb-4">
            <a href="/overtime" class="btn1">Overtime</a>
            <a href="/leave" class="btn1">Leave</a>
        </div>

        <?php if (!$check): ?>
            <form method="post" action="/attendance/checkin">
                <div class="text-center">
                    <button type="submit" class="btn1">Check In</button>
                </div>
            </form>
        <?php else: ?>
            <form method="post" action="/attendance/checkout">
                <div class="text-center">
                    <button type="submit" class="btn1">Check Out</button>
                </div>
            </form>
        <?php endif; ?>

        <h1 class="text-center mb-4"><?= esc($username) ?>'s Attendance</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Attendance List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($attendance as $attendance): ?>
                        <tr>
                            <td><?= esc($attendance['Attendance_Date']) ?></td>
                            <td><?= esc($attendance['In_Time']) ?></td>
                            <td><?= esc($attendance['Out_Time']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
