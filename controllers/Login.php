<?php
// controllers/Registration.php
require_once './BaseController.php';
require_once 'models/RegistrationModel.php';

class Login extends BaseController {
    private $registrationModel;

    public function __construct() {
        parent::__construct(); // Ensure BaseController constructor runs to initialize sessions
        $this->registrationModel = new RegistrationModel();
    }

    // Method to display the login form
    public function index() {
        $this->addScript('/dist/login.bundle.js');
        $this->loadView('login');
    }

    // Method to handle form submission
    public function userLogin() {
        $response = ['success' => false, 'message' => ''];

        // Get the raw POST data
        $data = json_decode(file_get_contents("php://input"), true);
    
        if (isset($data['email']) && isset($data['password'])) {
            $email = trim($data['email']);
            $password = trim($data['password']);
    
            // Validate input data
            if (empty($email) || empty($password)) {
                $response['message'] = "All fields are required!";
            } else {
                $dataArr = array('email' => $email, 'password' => $password);
    
                if ($this->registrationModel->loginCheck($dataArr)) {
                    // Login successful, set session data
                    $this->setSession('user_email', $email);
                    $this->setSession('logged_in', true);
    
                    // Send a success message
                    $response['success'] = true;
                    $response['message'] = 'Login successful!';
                } else {
                    // Invalid login credentials
                    $response['message'] = 'Invalid email or password.';
                }
            }
        } else {
            $response['message'] = 'Email and password are required.';
        }
    
        // Return a JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    

    public function logout() {
        // Destroy session
        session_destroy();
    
        // Redirect to login
        header('Location: /login-user');
        exit();
    }
    
}
