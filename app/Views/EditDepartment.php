<!DOCTYPE html>
<html>
<head>
    <title>Edit Department</title>
</head>
<body>
    <h1>Edit Department</h1>
    <form action="/department/editprocess/<?= esc($DepartmentData['Department_ID'])?>" method="POST">
        <?= csrf_field() ?>
        <label for="department_id">Departement ID:</label>
        <input type="text" id="department_id" name="Department_ID" value="<?= esc($DepartmentData['Department_ID']) ?>">
        <br>

        <label for="department_name">Departement Name:</label>
        <input type="text" id="department_name" name="Department_Name" value="<?= esc($DepartmentData['Department_Name']) ?>">
        <input type="text" id="department_name" name="Department_Name" value="<?= esc($DepartmentData['Department_Name']) ?>">
        <br>

        <label for="description">Description:</label>
        <input type="text" id="descripton" name="Description" value="<?= esc($DepartmentData['Description']) ?>">
        <br>

        <label for="parent_structure">Parent Structure:</label>
        <input type="text" id="parent_structure" name="Parent_Structure" value="<?= esc($DepartmentData['Parent_Structure']) ?>">
        <br>

        <button type="submit">Update</button>
    </form>
</body>
</html>