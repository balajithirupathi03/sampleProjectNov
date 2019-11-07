<?php

class UserController
{
    use Render;
    use Request;

    private $userModel;
    //private $post;
    private $post;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->post=$this->getPost();
    }

    // private function getpost()
    // {
    //     $url = urldecode(file_get_contents("php://input"));
    //     $flag = 1;
    //     foreach (explode("&", $url) as $field) {
    //         foreach (explode('=', $field) as $data) {
    //             if ($flag) {
    //                 $key = $data;
    //                 $flag = 0;
    //             } else {
    //                 $value = $data;
    //                 $this->post[$key] = $value;
    //                 $flag = 1;
    //             }
    //         }
    //     }        
    // }

    public function loadHomePage()
    {
        $this->render('HomePage', $this->userModel->fetchEventData());
    }

    public function loadProfilePage()
    {
        if (isset($this->post['changeProfileDetails'])) {
            $this->userModel->updateProfile($this->post);
        } else if (isset($this->post['apllicationResponce'])) {
            $this->userModel->respondApplicationForm($this->post['teamId'], $this->post['responce']);
        }
        $this->render('ProfilePage', $this->userModel->fetchProfileDatas());
    }

    private function isValidUser($loginMailId, $loginPassword)
    {
        $userId = $this->userModel->checkMailIdIsAvailaple($loginMailId);
        if ($userId) {
            if ($this->userModel->isPasswordMatch($loginMailId, $loginPassword, $userId)) {
                return true;
            } else {
                $this->render('UserLoginForm', 'Entered password is wrong');
            }
        } else {
            $this->render('UserLoginForm', 'The Account is Not Available');
        }
    }


    public function login()
    {
       // $this->getpost();
        if (isset($this->post['userLoginSubmition']) and $this->isValidUser($this->post['LoginMailId'], $this->post['LoginPassword'])) {
            header('location: ../user/loadHomePage');
        } else{
            $this->render('UserLoginForm', '');
        }
    }

    public function createAccount()
    {
        if (isset($this->post['registerFormSubmit'])) {
            if (!$this->userModel->checkMailIdIsAvailaple($this->post['mailid'])) {
                $profile = $this->userModel->uploadImage('profile');
                $this->userModel->insertDetails($this->post, $profile);
                header('location: ../user/login');
            } else {
                $this->render('UserRegisterationForm', 'Your account Is Alredy Exist');
            }
        } else {
            $this->render('UserRegisterationForm', '');
        }
    }

    public function recoverForgotPassword()
    {
        if (isset($this->post['checkMailidSubmit'])) {
            if ($userId = $this->userModel->checkMailIdIsAvailaple($this->post['accountMailId'])) {
                $message = [$userId, false, $this->userModel->getSecretQuestionAndAnswer($userId)];
                $this->render('ForgotPassword', $message);
            } else {
                $message[2] = 'The account Is not Available';
                $this->render('ForgotPassword', $message);
            }
        } else if (isset($this->post['submitMySecrateAnswer'])) {
            if ($this->post['dataBaseAnswer'] == hash('sha256', $this->post['secrateAnswer'] . 'blaze2rage.com')) {
                $message = [$this->post['userId'], true];
                $this->render('ForgotPassword', $message);
            } else {
                $message = [$this->post['userId'], false, [$this->post['question'], $this->post['dataBaseAnswer'], 'The Answer is wrong. Try Again']];
                $this->render('ForgotPassword', $message);
            }
        } else if (isset($this->post['changePassword'])) {
            if ($this->post['newPassword'] == $this->post['reEnterYourNewPassword']) {
                $this->userModel->changePassword($this->post['newPassword'], $this->post['userId']);
                header('Location: ../user/login');
            } else {
                $message = [$this->post['userId'], true, 'The Passwords are does Not Match'];
                $this->render('ForgotPassword', $message);
            }
        } else {
            $this->render('ForgotPassword', '');
        }
    }

    public function logOut()
    {
        $this->userModel->logout();
        $this->render('HomePage', $this->userModel->fetchEventData());
    }
}
