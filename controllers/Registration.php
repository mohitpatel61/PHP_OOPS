<?php
// controllers/Registration.php
require_once './BaseController.php';
require_once 'models/RegistrationModel.php';

class Registration extends BaseController {
    private $registrationModel;

    public function __construct() {
        $this->registrationModel = new RegistrationModel();
    }

    // Method to display the registration form
    public function index() {
        $this->loadView('registration');
    }

    // Method to handle form submission
    public function register() {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validate input data
            if (empty($name) || empty($email) || empty($password)) {
                $message = "All fields are required!";
            } elseif ($this->registrationModel->emailExists($email)) {
                $message = "Email is already taken!";
            } else {
                // Register the user
                $dataArr = array('name'=> $name, 'email' => $email, 'password'=> $password);
                if ($this->registrationModel->registerUser($dataArr)) {
                    $message = "Registration successful!";
                    header('Location: /login-user'); 
                } else {
                    $message = "Registration failed. Please try again.";
                }
            }

            // Pass message to the view
            
        }

}
}