<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Add Overtime Request') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/overtime" class="close-button" title="Kembali">&times;</a>
            <h2>Add Request Overtime</h2>
            <form action="/overtime/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="overtime_date">Overtime Date:</label>
                <input type="date" id="overtime_date" name="Overtime_Date">
                <br>

                <label for="overtime_start">Overtime Start:</label>
                <input type="time" id="overtime_start" name="Overtime_Start">
                <br>

                <label for="overtime_end">Overtime End:</label>
                <input type="time" id="overtime_end" name="Overtime_End">
                <br>

                <label for="reason">Reason:</label>
                <input type="text" id="reason" name="Reason">
                <br>

                <button type="submit">Add</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>