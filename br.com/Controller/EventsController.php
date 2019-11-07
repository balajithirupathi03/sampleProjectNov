<?php

class EventsController
{
    use Render;

    private $eventsModel;

    public function __construct()
    {
        $this->eventsModel = new EventsModel();
    }

    public function registerEvents()
    {
        if (isset($_POST['eventRegistrationSubmit'])) {
            if ($this->eventsModel->isAvailableEvent($_POST['tournamentName'], $_POST['tournamentDaysFrom']) === false) {
                $broucherImage = $this->eventsModel->uploadImage('broucherImage');
                $fixturesImage = $this->eventsModel->uploadImage('fixturesImage');
                $this->eventsModel->registerEvents($_POST, $broucherImage, $fixturesImage);
                header('location:/user/loadHomePage');
            } else {
                $this->render('EventRegistrationForm', 'Your team was already Registered');
            }
        } else {
            $this->render('EventRegistrationForm', '');
        }
    }

    public function registerParticipants($tournamentId)
    {
        if (isset($_POST['participationFormSubmission'])) {
            if (!($this->eventsModel->isAvailapleTeam($_POST['teamName']))) {
                $this->eventsModel->registerParticipants($_POST, $tournamentId[0]);
                header('user/loadHomePage');
            } else {
                $this->render('ParticipationForm', 'Your team was already Registered this tournament');
            }
        } else {
            $this->render('ParticipationForm', '');
        }
    }
}
