<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Edit Client') ?>
<?= $this->section('content') ?> 
    <main>
        <div class="dashboard position-relative">
            <a href="/client" class="close-button" title="Kembali">&times;</a>
            <h2>Edit Client</h2>
            <form action="/client/editprocess/<?= esc($ClientData['Client_ID'])?>"  method="POST">
                <?= csrf_field() ?>
                <label for="client_id">Client ID:</label>
                <input type="text" id="client_id" name="Client_ID" value="<?= esc($ClientData['Client_ID']) ?>">

                <label for="client_name">Client Name:</label>
                <input type="text" id="client_name" name="Client_Name" value="<?= esc($ClientData['Client_Name']) ?>">

                <label for="client_contact">Client Contact:</label>
                <input type="text" id="client_contact" name="Client_Contact" value="<?= esc($ClientData['Client_Contact']) ?>">

                <label for="client_details">Client Details:</label>
                <input type="text" id="client_details" name="Client_Details" value="<?= esc($ClientData['Client_Details']) ?>">

                <button type="submit">Update Data</button>
            </form>
        </div>
    </main>
<?= $this->endSection() ?>