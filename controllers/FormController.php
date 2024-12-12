<?php
require_once "models/Database.php";
require_once "models/User.php";
require_once "services/Validator.php";

class FormController {
    private $user;
    private $celebrate = false;
    private $heading = "";
    private $message = "";

    public function __construct() {
        $db = new Database();
        $this->user = new User($db->connect());
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitising form input
            $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dob = filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            // Validating the name
            if (!Validator::validateName($name)) {
                $this->heading = "An error occurred";
                $this->message = "Name is invalid, please try again.";
                return false;
            }

            // Validating the DOB
            if (!Validator::validateDob($dob)) {
                $this->heading = "An error occurred";
                $this->message = "DOB is invalid, please try again.";
                return false;
            }

            // Validating the email
            if (!Validator::validateEmail($email)) {
                $this->heading = "An error occurred";
                $this->message = "Email is invalid, please try again.";
                return false;
            }

            // Checking if user already exists
            if ($this->user->exists($email)) {
                $this->heading = "An error occurred";
                $this->message = "A user with this email already exists.";
                return false;
            }

            // Saving to database
            if ($this->user->create($name, $dob, $email)) {
                $userId = $this->user->recent();

                if ($userId % 10 === 0 || $userId % 10 === 5) {
                    $this->celebrate = true;
                    $this->heading = "Congratulations, you're #{$userId} 🥳";
                    $this->message = "We've received your details and you've won our raffle!";
                } else {
                    $this->heading = "Thank you";
                    $this->message = "We've succesfully received your details.";
                }   

                return true;
            } else {
                $this->heading = "An error occurred";
                $this->message = "We were unsuccessful in saving your details.";
                return false;
            }
        }
        return null;
    }

    public function getCelebrateStatus() {
        return $this->celebrate;
    }

    public function getHeading() {
        return $this->heading;
    }

    public function getMessage() {
        return $this->message;
    }
}
