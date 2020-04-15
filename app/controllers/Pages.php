<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        // $posts = $this->postModel->getPosts();
        if (isLoggedIn()) {
            redirect('posts');
        }
        $data = [
            'title' => 'Shareposts',
            'description' => 'Workout Competition'
        ];


        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'Workout Competition App'
        ];
        $this->view('pages/about', $data);
    }
}
