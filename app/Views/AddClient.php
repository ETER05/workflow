<!DOCTYPE html>
<html>
<head>
    <title>Add Client</title>
</head>
<body>
    <h1>Add Client</h1>
    <form action="/client/addprocess" method="POST">
        <?= csrf_field() ?>
        <label for="client_id">Client ID:</label>
        <input type="text" id="client_id" name="Client_ID">
        <br>

        <label for="client_name">Client Name:</label>
        <input type="text" id="client_name" name="Client_Name">
        <br>

        <label for="client_contact">Client Contact:</label>
        <input type="text" id="client_contact" name="Client_Contact">
        <br>

        <label for="client_details">Client Details:</label>
        <input type="text" id="client_details" name="Client_Details">
        <br>

        <button type="submit">Add</button>
    </form>
</body>
</html>