<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" href = "../../Public/View/Css/UserLoginForm.css" type = "text/css">
</head>

<body>
    <div class = "container">

        <form action="login" method="POST"><table>
            <tr>
                <td colspan = 2><h1>User Login</h1></td>
            </tr>
            <tr>
                <td class = 'lable'>Mail Id</td>
                <td> : <input  type = "email" name = "LoginMailId" placeholder = "Enter your mail id" pattern = "[^()\[\]\\.,;&:\s@\-0-9]+[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{2,4}" required><td>
            </tr>
            <tr>
                <td class = 'lable'>Passsword</td>
                <td> : <input type = "password" name = "LoginPassword"
                    placeholder = "Ex:Password@123" name = "password" autocomplete  = "off" pattern = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" required></td>
            </tr>
            <tr class = 'message'>
                <td colspan = 2 ><?php echo $message; ?></td>
            </tr>
            <tr>
                <td colspan = 2 ><input type = "submit" name = "userLoginSubmition" value = "Login"></td>
            </tr>
            <tr>
                <td colspan = 2 >New user? Signup <a class = 'link' onclick = "location.href = 'createAccount'" >here. </a></td>
            </tr>
            <tr>
                <td colspan = 2 ><input type = "button" onclick = "location.href = 'recoverForgotPassword'" value = "Forgot Password"></td>
            </tr>
        </table></form>
    </div>
</body>

</html>




