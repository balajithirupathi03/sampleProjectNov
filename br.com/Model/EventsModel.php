<?php
require_once 'Core/Sesstion.php';
require_once 'Config/UploadFilePathConfig.php';

class EventsModel extends DataBaseAccessor
{
    public function uploadImage($fileName)
    {
        $image = $_FILES[$fileName]['name'];
        $newFileName = uniqid() . '.' . end(explode('.', $image));
        $uploadPath = uploadFilePath . $newFileName;
        move_uploaded_file($_FILES[$fileName]["tmp_name"], $uploadPath);
        return $newFileName;
    }

    public function isAvailableEvent($tournamentTitle, $tournamentDaysFrom)
    {
        $fields = ['tournamentId'];
        $tableName = 'eventDetails';
        $whereFiled = 'tournamentName';
        $whereValue = '\'' . $tournamentTitle . '\' AND tournamentDaysFrom = \'' . $tournamentDaysFrom . '\'';
        $rowCount = mysqli_num_rows($this->selectUsingCondition($fields, $tableName, $whereFiled, $whereValue));
        if ($rowCount > 0) {
            return true;
        }
        return false;
    }

    public function registerEvents($formValues, $broucherImage, $fixturesImage)
    {
        $tableName = 'eventDetails';
        unset($formValues['eventRegistrationSubmit']);
        $formValues['brouchers'] = $broucherImage;
        $formValues['fixtures'] = $fixturesImage;
        $fields = array_keys($formValues);
        $values = array_values($formValues);
        $this->insert($tableName, $fields, $values);
    }

    public function isAvailapleTeam($teamName)
    {
        $fields = ['teamId'];
        $tableName = 'teamDetails';
        $whereFiled = 'teamName';
        $whereValue = '\''.$teamName.'\'';
        $rowCount = mysqli_num_rows($this->selectUsingCondition($fields, $tableName, $whereFiled, $whereValue));
        if ($rowCount > 0) {
            return true;
        }
        return false;
    }

    public function registerParticipants($formValues, $tournamentId)
    {
        $tableName = 'teamDetails';
        unset($formValues['participationFormSubmission']);
        $formValues['status'] = 'w';
        $formValues['tournamentId'] = $tournamentId;
        $fields = array_keys($formValues);
        $values = array_values($formValues);
        return $this->insert($tableName, $fields, $values);
    }
}
