<?php
// BaseController.php
class BaseController {

    public function __construct() {
        $this->initializeSession();
        // Optionally, initialize any common functionality here (e.g., timezone, session, etc.)
    }

    protected $scripts = [];

    protected function addScript($scriptPath) {
        $this->scripts[] = $scriptPath;
    }

    protected function getScripts() {
        return $this->scripts;
    }

     // Method to start and manage session
     protected function initializeSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session if not already started
        }
    }

    protected function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Helper method to get session data
    protected function getSession($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Helper method to unset (delete) session data
    protected function unsetSession($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Helper method to destroy the entire session (e.g., on logout)
    protected function destroySession() {
        session_unset();
        session_destroy();
    }


    public function loadView($viewName, $data = []) {

        extract($data);
        foreach ($this->scripts as $script) {
            echo "<script src=\"$script\" defer></script>";
        }
        require "views/$viewName.php";


        // $viewPath = __DIR__ . '/views/' . $viewName . '.php';
        // if (file_exists($viewPath)) {
        //     extract($data); // Extract the data array into variables
        //     include($viewPath); // Include the view
        // } else {
        //     echo "View not found!";
        // }
    }
}
