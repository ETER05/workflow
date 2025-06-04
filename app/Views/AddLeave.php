<?= $this->extend('layout/menuuser') ?>

<?php $this->setVar('title', 'Add Leave Request') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/leave" class="close-button" title="Kembali">&times;</a>
            <h2>Add Request Leave</h2>
            <form action="/leave/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="leave_type">Leave Type:</label>
                <input type="text" id="leave_type" name="Leave_Type">
                <br>

                <label for="leave_start">Leave Start:</label>
                <input type="date" id="leave_start" name="Leave_Start">
                <br>

                <label for="leave_end">Leave End:</label>
                <input type="date" id="leave_end" name="Leave_End">
                <br>

                <label for="reason">Reason:</label>
                <input type="text" id="reason" name="Reason">
                <br>

                <button type="submit">Add</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>