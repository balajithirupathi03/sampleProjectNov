<?php

class EventsController
{
    use Render;

    private $eventsModel;
    private $postDtata;

    public function __construct()
    {
        $this->eventsModel = new EventsModel();
        $this->this->postDtata = $_POST;
    }

    public function registerEvents()
    {
        if (isset($this->postDtata['eventRegistrationSubmit'])) {
            if ($this->eventsModel->isAvailableEvent($this->postDtata['tournamentName'], $this->postDtata['tournamentDaysFrom']) === false) {
                $broucherImage = $this->eventsModel->uploadImage('broucherImage');
                $fixturesImage = $this->eventsModel->uploadImage('fixturesImage');
                $this->eventsModel->registerEvents($this->postDtata, $broucherImage, $fixturesImage);
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
        if (isset($this->postDtata['participationFormSubmission'])) {
            if (!($this->eventsModel->isAvailapleTeam($this->postDtata['teamName']))) {
                $this->eventsModel->registerParticipants($this->postDtata, $tournamentId[0]);
                header('user/loadHomePage');
            } else {
                $this->render('ParticipationForm', 'Your team was already Registered this tournament');
            }
        } else {
            $this->render('ParticipationForm', '');
        }
    }
}
