<html>
<head>
<link rel = "stylesheet" href = "../../Public/View/Css/UserRegisterationForm.css" type = "text/css">
<script src = "../Public/View/JavaScript/UserRegisterationForm.js"></script>
</head>

<body>
    <div class = "body">
        <div class = "container">
        <h3>Registration Form</h3>
        <?php echo "<h4>$message</h4>" ?>
        <form method = "post" enctype = "multipart/form-data">
        <table>
            <tr>
                <td >Name </td>
                <td>: <input name = "name" pattern = "^[A-Za-z]*\s*[A-Za-z]*$" type = "text" placeholder = "Enter your Name" required></td>
            </tr>
            <tr>
                <td >Date Of Birth </td>
                <td>: <input name = "dateofbirth" min = '1900-01-01' max = <?php echo date("Y-m-d"); ?> class = "date_of_birth_field" type = "date" placeholder = "Enter your date of birth" required></td>
            </tr>
            <tr>
                <td>Gender </td>
                <td>: <input type = "radio" name = "gender" value = "m" required>Male
                      <input type = "radio" name = "gender" value = "f">Female
                      <input type = "radio" name = "gender" value = "o">Other<td>
            <tr>
            <tr>
                <td >Game </td>
                <td>: <input name = "game" type = "" placeholder = "Enter your game" required></td>
            </tr>
            <tr>
                <td >place </td>
                <td>: <input name = "place" placeholder = "Enter your place" required></td>
            </tr>
            <tr>
                <td >Mail id </td>
                <td>: <input type = "email" name = "mailid" placeholder = "Enter your Mail" required></td>
            </tr>
            <tr>
                <td >Phone Number </td>
                <td>: <input name = "mobilenumber" pattern = "[6-9][0-9]{9}" type = "text" placeholder = "+91" required></td>
            </tr>
            <tr>
                <td >Secret Question To Recover Password </td>
                <td>: <input name = "secretQuestion" type = "text" placeholder = "?" required></td>
            </tr>
            <tr>
                <td >Secret Answer To Recover Password </td>
                <td>: <input name = "secretAnswer" pattern  = '^[a-z]+$' placeholder = 'Only Small Charecters' type = "text" required></td>
            </tr>
            <tr>
                <td >Password </td>
                <td>: <input name = "password" type = "password"  pattern = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" placeholder = "" title = "Minimum 8 charectes must be entered. And Atleat one lower case letter,one upper case letter,and one special charecter should be present." required  ></td>
            </tr>
            <tr>
                <td>Profile pic</td>
                <td><input id = "profile" name = "profile" type = "file" onfocusout=checkFileType('profile','profileFileCheckMessage') accept = "image/png,image/jpeg,image/gif,image/jpg" required><p id='profileFileCheckMessage'>JPEG,PNG,JPG,GIF only allowed</p></td>
            </tr>
            <tr>
                <td></td>
                <td><input type = "submit" Value = 'Submit' name = "registerFormSubmit" class = "registerform_submit_button"><input type = "reset" class = "registerform_reset_button"></td>
            <tr>
        </table>
        </form>
        </div>
    </div>
</body>
</html>
