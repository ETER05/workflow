<!DOCTYPE html>
<html>
<head>
    <title>Add Request Leave</title>
</head>
<body>
    <h1>Add Request Leave</h1>
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
</body>
</html>