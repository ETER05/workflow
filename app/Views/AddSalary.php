<!DOCTYPE html>
<html>
<head>
    <title>Add Salary</title>
</head>
<body>
    <h1>Add Salary</h1>
    <form action="/salary/addprocess" method="POST">
        <?= csrf_field() ?>
        <label for="salary_date">Salary Date:</label>
        <input type="date" id="salary_date" name="Salary_Date">
        <br>

        <label for="salary_amount">Salary Amount:</label>
        <input type="int" id="salary_amount" name="Salary_Amount">
        <br>

        <label for="employee_id">Employee:</label>
        <select id="employee_id" name="Employee_ID">
        <option value=""></option>
            <?php foreach ($employee as $employee): ?>
                <option value="<?= $employee['Employee_ID'] ?>">
                    <?= esc($employee['Username']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit">Add</button>
    </form>
</body>
</html>