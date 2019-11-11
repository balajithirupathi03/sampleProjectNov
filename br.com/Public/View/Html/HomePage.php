<!DOCTYPE html>
<html>

<head>
    <link rel = "stylesheet" href = "../../Public/View/Css/HomePage.css" type = "text/css">
</head>

<body>
    <div >
       <table class = "head_menu_bar">
       <tr>
        <td class = "website_name">
            <h1>Blaze2Rage</h1>
        </td>
        <td class = "post">
            <?php
if (isset($_SESSION['userId'])) {
    echo "<h4><input type = 'button' value = 'Event Registration' onclick = \"location.href = '../Events/registerEvents'\" name = 'eventRegistration'></h4>";
} else {
    echo "<h4><input type = 'button' value = 'Event Registration' onclick = \"location.href = '../user/login'\" name = 'eventRegistration'></h4>";
}
?>
        </td>
        <td class = "profile">
            <?php
if (isset($_SESSION['userId'])) {
    echo "<h4>  <input type = 'button' name = 'profilePage' value = 'Profile' onclick = \"location.href = '../user/loadProfilePage'\"></h4>";
    echo "<h4>  <input type = 'button' name = 'logout' value = 'Logout' onclick = \"location.href = '../user/logOut'\"></h4>";
} else {
    echo "<h4>  <input type = 'button' name = 'goLoginPage' value = 'Login / Signup' onclick = \"location.href = '../user/login'\"></h4>";
}
?>
        </td>
        </tr>
        </table>
        </div>

    <div class = "newsfeed_container">

<?php
while ($rows = mysqli_fetch_array($message)) {
    echo "
            <div class = 'news_block'>
            <div class = 'news_left_part'>
            <div class = 'part-top'>
            <div class = 'part-one'>";
    echo "<img src = \"/Public/View/Uploads/$rows[profile]\">";
    echo "
            </div>
            <div class = 'part-two'>
            " . $rows['name'] . "<br>
            </div>
            </div>
            <div class = 'part-bottom'>";
    echo "<img src = \"/Public/View/Uploads/$rows[brouchers]\">";
    echo "
            </div>
            </div>

            <div class = 'news_right_part'>
            <div class = 'tournamanetName'>" . $rows['tournamentName'] . "</div>
            <table>
            <tr>
                <td class = 'title'>Game :</td>
                <td  class = 'value'>" . $rows['game'] . "</td>
            </tr>
            <tr>
                <td class = 'title'>Gender :</td>
                <td class = 'value'>";
    if ($rows['gender'] == 'm') {
        echo 'Male';
    } else if ($rows['genter' == 'f']) {
        echo 'Female';
    } else {
        echo 'Others';
    }
    echo "
                </td>
            </tr>
            <tr>
                <td class = 'title'>Place : </td>
                <td class = 'value'>" . $rows['place'] . "</td>
            </tr>
            <tr>
                <td class = 'title'>Event Date :</td>
                <td  class = 'value'>" . date("m-d-Y", strtotime($rows['tournamentDaysFrom'])) . "</td>
            </tr>
            <tr>
                <td class = 'title'>Time :</td>
                <td  class = 'value'>" . implode(':', (array_slice(explode(':', $rows['startingTime']), 0, 2))) . "</td>
            </tr>
            </table>
            <div class = 'apply'>";
    if (isset($_SESSION['userId'])) {
        echo "
                    <input name = 'tournamentId' type = 'text' value = " . $rows['tournamentId'] . ">
                    <input type = 'submit' name = 'participationForm' value = 'Apply' onclick = \"location.href = '../Events/registerParticipants/" . $rows['tournamentId'] . "'\">
                    ";
    } else {
        echo "<input type = 'button' name = 'participationForm' value = 'Apply' onclick = \"location.href = '../user/login'\">";
    }
    echo "
            </div>
            </div>
            </div>";
}
?>
        <div>
</body>

</html>