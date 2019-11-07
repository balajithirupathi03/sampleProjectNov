<!DOCTYPE html>
<html>

<head>
    <link rel = "stylesheet" href = "../../Public/View/Css/ForgotPassword.css" type = "text/css">
    <script>

    </script>
</head>

<body>
    <div class = "container">
        <h1 class = "container">Forgot password</h1>
        <?php
if ($message[0] and !$message[1]) {

    echo "
            <form method = 'post'>
            <table>
            <tr>
                <td>";
    echo $message[2][0];
    echo "</td>
                <td><input name = 'secrateAnswer' autocomplete='off'></td>
            </tr>
            <tr>
                <td></td>
                <td ><p class = 'message'>";
    echo $message[2][2];
    echo "</p></td>
            </tr>
            <tr>
                <td></td>
                <td><input type = 'submit' value = 'Submit My Answer' name = 'submitMySecrateAnswer'></td>
            </tr>
            </table>
                <input name = 'dataBaseAnswer' value = $message[2][1]";
    echo $message[2][1];
    echo ">
                <input name = 'userId' value = $message[0]>
                <input name = 'question' value = ";
    print $message[2][0];
    echo ">
            </form>
        ";
} else if ($message[0] and $message[1]) {
    echo "
            <form method = 'post'>
                <div class = 'change password'>
                    <input name = 'userId' value = $message[0]>
                    <p><label>Enter New password </label> : <input pattern = \"^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$\" name = 'newPassword' type = 'password'></p>
                    <p><label>Reenter New password </label> : <input pattern = \"^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$\" name = 'reEnterYourNewPassword' type = 'password'></p>
                    <p class = 'message'><label></label>$message[2] </p>
                    <p><label></label><input type = submit name = 'changePassword' value = 'change password'><p>
                </div>
            </form>
        ";
} else {
    echo "
            <form method = 'post'>
            <table>
            <tr><td>
                Enter your mail id :</td><td><input type = 'mail' pattern = '[^()\[\]\\.,;&:\s@\-0-9]+[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{2,4}' name = 'accountMailId' required>

                </td></tr>
                <tr><td class = 'message'> $message[2] </td><td>
            <input type = 'submit' name = 'checkMailidSubmit' value = 'Recovery My Account'>
            </td>
            </tr>
                </table>
                </form>
        ";
}
?>
     </div>
</body>

</html>