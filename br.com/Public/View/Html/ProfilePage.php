<?php
$userdetails = mysqli_fetch_array($message[0]);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel = "stylesheet" href = "../../Public/View/Css/ProfilePage.css" type = "text/css"> 
    <script src = "../Public/View/JavaScript/ProfilePage.js"></script>
</head>

<body>
    <div class = "container">
        <h1>Profile</h1>
        <table class = "head_menu_bar">
            <tr>
                <td class = "profilePicOfUser"><div><?php echo "<img src = \"/Public/View/Uploads/$userdetails[profile]\">"; ?></div></td>
                <td class = "userName"><?php echo $userdetails['name'] ?></td>
                <td class="editProfile"><button onclick = "showProfileDetails();">Edit profile</button></td>
            </tr>
        </table>

        <div class = "personalDetailsHiddenPart" id = "personalDetailsHiddenPart">
            <form method = "post">
                <table>
                    <tr>
                        <td>Name</td>
                        <td> : <input value = "<?php echo $userdetails['name'] ?>" name = "name" pattern = "^[A-Za-z]*\s*[A-Za-z]*$" type = "text" placeholder = "Enter your Name" required></td>
                    </tr>
                    <tr>
                        <td>Date Of Birth </td>
                        <td> : <input value = "<?php echo $userdetails['dateOfBirth'] ?>" min = '1900-01-01' max = <?php echo date("Y-m-d");?> name = "dateofbirth" class = "date_of_birth_field" type = "date" placeholder = "Enter your date of birth" required></td>
                    </tr>
                    <tr>
                        <td>Game</td>
                        <td> : <input value = "<?php echo $userdetails['game'] ?>" name = "game" type = "" placeholder = "Enter your game" required></td>
                    </tr>
                    <tr>
                        <td>place</td>
                        <td> : <input value = "<?php echo $userdetails['place'] ?>" type = "" name = "place" placeholder = "Enter your place" required></td>
                    </tr>
                    <tr>
                        <td>Mail id</td>
                        <td> : <input value = "<?php echo $userdetails['mailId'] ?>" type = "email" name = "mailid" placeholder = "Enter your Mail" pattern = "[^()\[\]\\.,;&:\s@\-0-9]+[a-zA-Z0-9._\-]+@[a-zA-Z.\-]+\.[a-zA-Z]{2,4}" required></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td> : <input value = "<?php echo $userdetails['mobileNumber'] ?>" name = "mobilenumber" pattern = "[6-9][0-9]{9}" type = "text" placeholder = "+91" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type = "submit" name = "changeProfileDetails" class = "changeProfileDetails" value = "Apply Changes"></td>
                    </tr>
                </table>
            </form>
        </div>


        <div class = "apllicationDetails">
            <h3 onclick = "showAppliedDetails();">Applied Events &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#9662;</h3>
            <div class = 'applicationContainer' id = 'applicationContainer'>
                <?php
                while ($eventDetails = mysqli_fetch_array($message[1])) {
                    echo "<div class = 'appliedEventName'>$eventDetails[tournamentName]</div>
                          <div class = 'appliedEventStatus'>";
                          if($eventDetails['status'] == 'a'){
                              echo 'Approved';
                          }
                          else if($eventDetails['status'] == 'r'){
                              echo 'Rejected';
                          }
                          else if($eventDetails['status'] == 'w'){
                              echo 'Waiting';
                          }
                          echo "</div>";
                }
                ?>
            </div>
        </div>


        <div class = "organizingEventDetails">
            <h3 >Organized Event</h3>
            <?php
            $i = 0;
            while ($organizedEvents = mysqli_fetch_array($message[2][0])) {
                echo "<div class = 'organizingContainer' id = 'organizingContainer'>
                      <div class = 'myEventName'>$organizedEvents[tournamentName]
                      </div> ";
                while ($aaa = mysqli_fetch_array($message[2][1][$i])) {
                    if ($aaa['status'] == 'w') {
                        echo "<div class = 'teamName'>Team Name : $aaa[teamName]
                              </div>
                             <div class = 'accept'>                           
                             <form method = 'POST'>
                                <input name = 'teamId' value = '$aaa[teamId]'>
                                <input name = 'responce' value = 'a'>
                                <input class = 'acceptButton' name = 'apllicationResponce' type = 'submit' value = 'Accept'>
                             </form>
                             </div>
                            
                             <div class = 'reject'>
                             <form method = 'POST'>
                                <input name = 'teamId' value = '$aaa[teamId]'>
                                <input name = 'responce' value = 'r'>
                                <input calss = 'rejectButton' name = 'apllicationResponce' type = 'submit' value = 'Reject'>
                             </form>
                             </div>";
                    } else if ($aaa['status'] == 'a') {
                        echo "<div class = 'teamName'>Team Name : $aaa[teamName] </div>
                              <div class = 'status' > status : Appoved </div>";
                    }

                    echo "<div class = 'contentTeamDetails' id = 'contentTeamDetails'>                          
                            <p><label>Captain Name </label>: <input readonly value = '$aaa[captainName]' ></p>
                            <p><label>Captain Contact Number </label>: <input readonly value = '$aaa[captainMobileNumber]'></p>
                            <p><label>Vice Captain Name </label>: <input readonly value = '$aaa[viceCaptainName]'></p>
                            <p><label>Vice Captain Contact Number</label> : <input readonly value = '$aaa[viceCaptainMobileNumber]'></p>
                            <p><label>Team Strength </label>: <input readonly value = '$aaa[teamStrength]'></p>
                            <p><label>Location </label>: <input readonly value = '$aaa[place]'></p>
                         </div>";
                }
                $i++;
                echo "</div>";
            }
            ?>
        </div>
</body>

</html>