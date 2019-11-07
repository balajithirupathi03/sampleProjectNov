<!DOCTYPE html>
<html>

<head>

<link rel = "stylesheet" href = "../../Public/View/Css/ParticipationForm.css" type = "text/css">
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php echo $message; ?>    
<div class = "headingContainer">
    <h1>Participation Register Form</h2>
</div>

    <form method = "POST">
        <table><tr><td>Team Name </td> <td><input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "teamName" type = "text" title = 'Team name should not contain any numaric charecter and No special charecter.' required></td></tr>
        <tr><td>Captain Name </td> <td><input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "captainName" type = "text" title = 'Name should not contain any numaric charecter and No special charecter.' required></td></tr>
        <tr><td>Captain Contact Number </td> <td><input placeholder = '+91' pattern = "[6-9][0-9]{9}" name = "captainMobileNumber" title = 'Required 10 digits mobile number' required></td></tr>
        <tr><td>Vice Captain Name </td> <td><input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "viceCaptainName" type = "text" title = 'Name should not contain any numaric charecter and No special charecter.' required></td></tr>
        <tr><td>Vice Captain Contact Number </td> <td><input placeholder = '+91' pattern = "[6-9][0-9]{9}" name = "viceCaptainMobileNumber" title = 'Required 10 digits mobile number' required></td></tr>
        <tr><td>Team Strength </td> <td><input name = "teamStrength" min = 1 max = 21 type = "number" required></td></tr>
        <tr><td>Location </td> <td><input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "place" type = "text" title = 'Location should not contain any numaric charecter and No special charecter.' required></td></tr>
        <tr><td class = 'submit' colspan = 2 ><input type = "submit" value = "Apply" name = "participationFormSubmission"></td></tr></table>
        <input name = "userId" value = "<?php echo $_SESSION['userId'] ?>">
        
    </form>
</body>
</html>