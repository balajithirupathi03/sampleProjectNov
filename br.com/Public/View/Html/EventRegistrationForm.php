
<!DOCTYPE html>
<html>

<head>
    <link rel = "stylesheet" href = "../../Public/View/Css/EventRegistrationForm.css" type = "text/css">
    <script src = "../Public/View/JavaScript/EventRegistrationForm.js"></script>
</head>

<body>

    <div class = "headingContainer">
        <h2>Event Registration Form</h2>
        <?php
        echo "<h3>$message</h3>";
        ?>
    </div>

    <form method = "POST" enctype = "multipart/form-data">
        <table>
            <tr>
                <td>Tournament Name</td>
                <td> : <input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "tournamentName" type = "text" placeholder = 'Tournament Name' title = 'Tournament name should not contain any numaric charecter and No special charecter.' required></td>
            </tr>
            <tr>
                <td>Game</td>
                <td> : <input placeholder = 'Game' pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "game" type = "text" title = 'Game name should not contain any numaric charecter and No special charecter.' required></td>
            </tr>
            <tr>
                <td>Participants</td>
                <td> : <input value = "m" name = "gender" type = "radio" required>Male
                    <input value = "f" name = "gender" type = "radio" required>Female
                    <input value = "b" name = "gender" type = "radio" required>Both</td>
            </tr>
            <tr>
                <td>Age Limit</td>
                <td> &nbsp;Min. : <input id = 'minAge' min = '1' max = '120' name = "ageLimitFrom" type = "number" onchange = "setMinimumAge()" required>
                     &nbsp;Max. : <input id = 'maxAge' min = '1' max = '120' name = "ageLimitTo" type = "number" required>    
                </td>
            </tr>

            <tr>
                <td>Weight Limit</td>
                <td>&nbsp;Min. : <input id = 'minWeight' min = '20' max = '300' name = "weightLimitFrom" type = "number" onchange = "setMinimumWeight()" required>
                    &nbsp;Max. : <input id = 'maxWeight' min = '20' max = '300' name = "weightLimitTo" type = "number" required>
                </td>
            </tr>
            <tr>
                <td rowspan = "2">Tournament Days</td>
                <td>&nbsp;From : <input min = <?php echo date("Y-m-d"); ?> onchange = "setMinimunTodate()" max = <?php echo date(date('Y-m-d', strtotime('+1 years'))); ?> id = 'tournamentDaysFrom' name = "tournamentDaysFrom" type = "date" required></td>
            </tr>
            <tr>
                <td>&nbsp;To : <input name = "tournamentDaysTo" id = 'tournamentDaysTo' max = <?php echo date(date('Y-m-d', strtotime('+1 years'))); ?> type = "date" required></td>
            </tr>

            <tr>
                <td>Last Date For Registration</td>
                <td> : <input min = <?php echo date("Y-m-d"); ?> id = 'lastDateForRegistration' name = "lastDateForRegistration" type = "date" required></td>
            </tr>
            <tr>
                <td>Entry Fees</td>
                <td> : <input name = "entryFee" min = 0 type = "number" required></td>
            </tr>

            <tr>
                <td>Tournament Location</td>
                <td> : <input pattern = "^[A-Za-z]*\s*[A-Za-z]*$" name = "place" type = "text" title = 'Tournament Location name should not contain any numaric charecter and No special charecter.' required></td>
            </tr>

            <tr>
                <td>Tournament Starts At</td>
                <td> : <input name = "startingTime" type = "time" required></td>
            </tr>


            <tr>
                <td>Per Team Maximum Players Count</td>
                <td> : <input name = "perTeamMaximumPlayersCount" min = 1 max = 21 type = "number" required></td>
            </tr>
            <tr>
                <td>Maximum Team Count You Allowed</td>
                <td> : <input min = 2 max = 500 name = "maxTeamCountYouAllowed" type = "number" required></td>
            </tr>


            <tr>
                <td>Broucher Image</td>
                <td> :&nbsp;&nbsp;&nbsp; <input id='broucherImage' name = "broucherImage" type = "file" onchange=checkFileType('broucherImage','broucherFileCheckMessage') accept = "image/png,image/jpeg" required><p id='broucherFileCheckMessage'>JPEG,PNG,JPG,GIF only allowed</p></td>
            </tr>
            <tr>
                <td>Fixtures Image</td>  
                <td> :&nbsp;&nbsp;&nbsp; <input id='fixturesImage' name = "fixturesImage" accept = "image/png,image/jpeg" type = "file" onchange=checkFileType('fixturesImage','fixturesFileCheckMessage')><p id='fixturesFileCheckMessage'>JPEG,PNG,JPG,GIF only allowed</p></td>
            </tr>

            <tr>
                <td>Accommodation Providence</td>
                <td> : <input name = "accomodation" value = "y" type = "radio" onclick = 'showAccommodation()' required>Yes
                     : <input name = "accomodation" value = "n" type = "radio" onclick = 'hideAccommodation()' required>No</td>
            </tr>
            <tr id = 'acccomadtaionHiddenPart'>
                <td>Accommodation Fee per head (Per Day)</td>
                <td> : <input name = "accomadationFeePerHead" min = 0 value=0 type = "number"></td>
            </tr>
            <tr>
                <td>Event Manager Contect Primary Number</td>
                <td> : <input placeholder = "+91" pattern = "[6-9][0-9]{9}" name = "eventManagerMobileNumberOne" title = 'Required 10 digits mobile number' required></td>
            </tr>
            <tr>
                <td>Event Manager Contect Secondary Number</td>
                <td> : <input placeholder = "+91" pattern = "[6-9][0-9]{9}" name = "eventManagerMobileNumberTwo" title = 'Required 10 digits mobile number' required></td>
            </tr>
            <td> <input name = "userId" value = "<?php echo $_SESSION['userId'] ?>">
                <tr>
                    <td></td>
                    <td> <input type = "submit" name = "eventRegistrationSubmit" value = "Register Event"> <input type = "reset"></td>
                </tr>
        </table>
    </form>
</body>

</html>