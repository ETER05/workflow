<!DOCTYPE html>
<html>
<head>
    <title>Edit Salary</title>
</head>
<body>
    <h1>Edit Salary</h1>
    <form action="/salary/editprocess/<?= esc($SalaryData['Salary_ID'])?>" method="POST">
        <?= csrf_field() ?>
        <label for="salary_date">Salary Date:</label>
        <input type="text" id="salary_date" name="Salary_Date" value="<?= esc($SalaryData['Salary_ID']) ?>">
        <br>

        <label for="salary_amount">Salary Amount:</label>
        <input type="text" id="salary_amount" name="Salary_Amount" value="<?= esc($SalaryData['Salary_Amount']) ?>">
        <br>

        <label for="employee_id">Employee:</label>
        <select id="employee_id" name="Employee_ID" required>
        <option value=""></option>
            <?php foreach ($employee as $employee): ?>
                <option value="<?= $employee['Employee_ID'] ?>">
                    <?= esc($employee['Username']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>

        <button type="submit">Update</button>
    </form>
</body>
</html>