<?= $this->extend('layout/menu') ?>

<?php $this->setVar('title', 'Overtime Details') ?>
<?= $this->section('content') ?> 
    <div class="container">
        <a href="<?= base_url('/overtime') ?>" class="btn btn-secondary mb-3">← Kembali ke List Overtime</a>
        <div class="card">
            <h2>Overtime <?= esc($overtime['Username']) ?></h2>
            <p><strong>Date:</strong> <?= esc($overtime['Overtime_Date']) ?></p>
            <p><strong>Start:</strong> <?= esc($overtime['Overtime_Start']) ?></p>
            <p><strong>End:</strong> <?= esc($overtime['Overtime_End']) ?></p>
            <p><strong>Status:</strong> <?= esc($overtime['Status']) ?></p>

            <div class="card-header bg-primary text-white">
                <h4>Document</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($documents)): ?>
                            <?php foreach ($documents as $doc): ?>
                                <tr>
                                    <td><?= esc($doc['Document']) ?></td>
                                    <td>
                                        <a href="<?= base_url('overtime/download/' . $overtime['Overtime_ID'] . '/' . $doc['Document']) ?>">Download</a> |
                                        <a href="<?= base_url('overtime/deletefile/' . $overtime['Overtime_ID'] . '/' . $doc['Overtime_Project_ID']) ?>"
                                        onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No documents uploaded yet.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($overtime['Status'] == 'Approved'): ?>
                    <h3>Upload Document</h3>
                    <form action="/overtime/upload/<?= esc($overtime['Overtime_ID']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <label for="Project_ID">Project:</label>
                        <select id="Project_ID" name="Project_ID" required>
                        <option value=""></option>
                            <?php foreach ($project as $project): ?>
                                <option value="<?= $project['Project_ID'] ?>">
                                    <?= esc($project['Project_Name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="document">Choose a file:</label>
                        <input type="file" name="document" id="document" required>
                        <button type="submit">Upload</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php if ($overtime['Status'] == 'Approved'): ?>
                <?php if ($documentcount >= 1): ?>
                    <a href="<?= base_url('/overtime/finalize/' . $overtime['Overtime_ID']) ?>" class="btn btn-success btn-sm"
                    onclick="return confirm('Finalize now?')">Finalize</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>
