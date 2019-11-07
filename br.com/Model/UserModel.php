<?php

require_once 'Core/Sesstion.php';
require_once 'Config/UploadFilePathConfig.php';

class UserModel extends DataBaseAccessor
{
    public function uploadImage($fileName)
    {
        $image = $_FILES[$fileName]['name'];
        $newFileName = uniqid() . '.' . end(explode('.', $image));
        $uploadPath = uploadFilePath . $newFileName;
        move_uploaded_file($_FILES[$fileName]["tmp_name"], $uploadPath);
        return $newFileName;
    }

    public function logout()
    {
        unset($_SESSION['userId']);
    }

    public function updateProfile($formValues)
    {
        unset($formValues['changeProfileDetails']);
        $tableName = 'userDetails';
        $whereFeild = 'userId';
        $whrereValue = $_SESSION['userId'];
        foreach ($formValues as $updateFeild => $updateValue) {
            $this->update($tableName, $updateFeild, $updateValue, $whereFeild, $whrereValue);
        }
    }

    public function respondApplicationForm($teamId, $responce)
    {
        $tableName = 'teamDetails';
        $updateFeild = 'status';
        $updateValue = $responce;
        $whereFeild = 'teamId';
        $whrereValue = $teamId;
        $this->update($tableName, $updateFeild, $updateValue, $whereFeild, $whrereValue);
    }

    public function fetchProfileDatas()
    {
        $feilds = ['*'];
        $tableName = "userDetails";
        $whereValue = $_SESSION['userId'];
        $whereFeild = 'userId';
        $userDetails = $this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue);

        $tableNameOne = 'teamDetails';
        $tableNameTwo = 'eventDetails';
        $onCondition = 'teamDetails.tournamentId = eventDetails.tournamentId';
        $feilds = ['teamDetails.status', 'eventDetails.tournamentName'];
        $whereFeild = 'teamDetails.userId';
        $whereValue = $_SESSION['userId'];
        $appliedEventDeatails = $this->selectByInnerJoin($feilds, $tableNameOne, $tableNameTwo, $onCondition, $whereFeild, $whereValue);

        $feilds = ['tournamentName', 'tournamentId'];
        $tableName = 'eventDetails';
        $whereFeild = 'userId';
        $whereValue = $_SESSION['userId'];
        $hostedEventDetails = $this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue);
        $hostedEventDetailsReference = $this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue);
        $tempArray = array();

        while ($tournamentId = mysqli_fetch_array($hostedEventDetailsReference)) {
            $tableNameOne = 'teamDetails';
            $tableNameTwo = 'eventDetails';
            $feilds = ['teamDetails.teamId', 'teamDetails.teamName', 'teamDetails.captainName', 'teamDetails.captainMobileNumber',
                'teamDetails.viceCaptainName', 'teamDetails.viceCaptainMobileNumber', 'teamDetails.teamStrength', 'teamDetails.place', 'teamDetails.status'];
            $onCondition = 'teamDetails.tournamentId = eventDetails.tournamentId';
            $whereFeild = 'eventDetails.tournamentId';
            $whereValue = $tournamentId['tournamentId'] . ' AND teamDetails.status!= \'R\'';

            $teamDetails = $this->selectByInnerJoin($feilds, $tableNameOne, $tableNameTwo, $onCondition, $whereFeild, $whereValue);
            array_push($tempArray, $teamDetails);
        };
        return array($userDetails, $appliedEventDeatails, [$hostedEventDetails, $tempArray]);
    }

    public function checkMailIdIsAvailaple($LoginMailId)
    {
        $feilds = ['userId'];
        $tableName = 'userDetails';
        $whereFeild = 'mailId';
        $whereValue = '\'' . $LoginMailId . '\'';
        $mysqliObject = $this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue);
        $rowcount = mysqli_num_rows($mysqliObject);
        if ($rowcount > 0) {
            $row = mysqli_fetch_array($mysqliObject);
            return $row['userId'];
        }
        return false;
    }

    public function isPasswordMatch($LoginMailId, $loginPassword, $userId)
    {
        $feilds = ['password'];
        $tableName = 'userDetails';
        $whereFeild = 'mailId';
        $whereValue = '\'' . $LoginMailId . '\'';
        $dbUserPassword = mysqli_fetch_array($this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue));
        if ($dbUserPassword[0] == hash('sha256', $loginPassword . 'blaze2rage.com')) {
            $_SESSION["userId"] = $userId;
            return true;
        } else {
            return false;
        }
    }

    public function getSecretQuestionAndAnswer($userId)
    {
        $feilds = ['secretQuestion', 'secretAnswer'];
        $tableName = 'userDetails';
        $whereFeild = 'userId';
        $whereValue = $userId;
        $mysqliObject = $this->selectUsingCondition($feilds, $tableName, $whereFeild, $whereValue);
        return mysqli_fetch_array($mysqliObject);
    }

    public function insertDetails($formValues, $profile)
    {
        unset($formValues['registerFormSubmit']);
        $formValues['password'] = hash('sha256', $formValues['password'] . 'blaze2rage.com');
        $formValues['secretAnswer'] = hash('sha256', $formValues['secretAnswer'] . 'blaze2rage.com');
        $formValues['profile'] = $profile;
        $feilds = array_keys($formValues);
        $values = array_values($formValues);
        $tableName = 'userDetails';
        return $this->insert($tableName, $feilds, $values);
    }

    public function changePassword($newPassword, $userId)
    {
        $newPassword = hash('sha256', $newPassword . 'blaze2rage.com');
        $tableName = 'userDetails';
        $updateFeild = 'password';
        $whereFeild = 'userId';
        $whrereValue = $userId;
        $updateValue = $newPassword;
        $this->update($tableName, $updateFeild, $updateValue, $whereFeild, $whrereValue);
    }

    public function fetchEventData()
    {
        $tableNameOne = 'eventDetails';
        $tableNameTwo = 'userDetails';
        $onCondition = 'eventDetails.userId = userDetails.userId';
        $feild = ['eventDetails.*', 'userDetails.name', 'userDetails.profile'];
        $whereFeild = 'eventDetails.userId';
        $whereValue = 'userDetails.userId';
        return $this->selectByInnerJoin($feild, $tableNameOne, $tableNameTwo, $onCondition, $whereFeild, $whereValue);
    }
}
