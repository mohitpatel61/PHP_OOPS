<?php

require_once './BaseController.php';

class BlogController extends BaseController {

    public function __construct() {
        parent::__construct(); // Ensure BaseController constructor runs to initialize sessions
    }


    public function index() {

        $this->addScript('/dist/blog.bundle.js');
        $this->loadView('Blog/index');

        // $this->addScript('/assets/js/Blog.js'); // Load JS
        // $this->addStyle('/assets/css/Blog.css'); // Load CSS
        // $this->loadView('Blog/index');
    }
}