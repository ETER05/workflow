<!DOCTYPE html>
<html>
<head>
    <title>Project Details</title>
</head>
<body>

    <h2>Project: <?= esc($project['Project_Name']) ?></h2>
    <p><strong>Description:</strong> <?= esc($project['Project_Description']) ?></p>
    <p><strong>Status:</strong> <?= esc($project['Project_Status']) ?></p>
    <p><strong>Manager:</strong> <?= esc($project['Manager_Name']) ?></p>
    <p><strong>Client:</strong> <?= esc($project['Client_Name']) ?></p>

    <h3>Documents</h3>
    <table border="1">
        <tr>
            <th>File Name</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($documents)): ?>
            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= esc($doc['Document']) ?></td>
                    <td>
                        <a href="<?= base_url('project/download/' . $project['Project_ID'] . '/' . $doc['Document']) ?>">Download</a> |
                        <a href="<?= base_url('project/deletefile/' . $project['Project_ID'] . '/' . $doc['Employee_Project_ID']) ?>"
                        onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No documents uploaded yet.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Form Upload -->
    <h3>Upload Document</h3>
    <form action="/project/upload/<?= esc($project['Project_ID']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <label for="document">Choose a file:</label>
        <input type="file" name="document" id="document" required>
        <button type="submit">Upload</button>
    </form>

</body>
</html>
