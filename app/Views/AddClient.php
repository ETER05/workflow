<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Add Client') ?>
<?= $this->section('content') ?>
    <main>
        <div class="dashboard position-relative">
            <a href="/client" class="close-button" title="Kembali">&times;</a>
            <h2>Add New Client</h2>
            <form action="/client/addprocess" method="POST">
                <?= csrf_field() ?>
                <label for="client_id">Client ID:</label>
                <input type="text" id="client_id" name="Client_ID">

                <label for="client_name">Client Name:</label>
                <input type="text" id="client_name" name="Client_Name">

                <label for="client_contact">Client Contact:</label>
                <input type="text" id="client_contact" name="Client_Contact">

                <label for="client_details">Client Details:</label>
                <input type="text" id="client_details" name="Client_Details">

                <button type="submit">Add Client</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>