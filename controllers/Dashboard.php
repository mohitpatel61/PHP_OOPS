<?php
// controllers/Dashboard.php
require_once './BaseController.php';
require_once 'models/RegistrationModel.php';

class Dashboard extends BaseController {
    private $registrationModel;

    public function __construct() {
        parent::__construct(); // Ensure the parent constructor runs (for session start, etc.)
        $this->registrationModel = new RegistrationModel();
    }

    // Method to display the dashboard
    public function index() {
        // Example of retrieving user data if needed for the dashboard
        $dashboardData = $this->getDashboardData();
        
        // Load the view and pass data to it
        $this->loadView('dashboard', ['data' => $dashboardData]);
    }

    // Method to retrieve data (example implementation)
    private function getDashboardData() {
        // Example: Check if user is logged in (adjust based on your session structure)
        if ($this->getSession('logged_in')) {
            $userEmail = $this->getSession('user_email');
            // Example logic: fetch data from the model (adjust based on your application's needs)
            $userData = $this->registrationModel->getUserByEmail($userEmail);
            return $userData;
        } else {
            // Redirect to login page if user is not logged in
            header('Location: /login-user');
            exit();
        }
    }
}
