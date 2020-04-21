<?php

class Posts extends Controller
{
    public function __construct()
    {
        // Only allowing post functionality for logged in users. If not logged in, then redirect to the users login page. 
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        // Get Posts 
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'pushups' => trim($_POST['pushups']),
                'situps' => trim($_POST['situps']),
                'run_miles' => trim($_POST['run_miles']),
                'bike_miles' => trim($_POST['bike_miles']),
                'body_err' => '',
            ];

            // Converting empties to zeroes.
            if (empty($data['situps'])) {
                $data['situps'] = 0;
            }
            if (empty($data['run_miles'])) {
                $data['run_miles'] = 0;
            }
            if (empty($data['bike_miles'])) {
                $data['bike_miles'] = 0;
            }
            if (empty($data['pushups'])) {
                $data['pushups'] = 0;
            }

            // Trying to have the following validation: 
            // 1. Everything that is blank gets converted to a zero ^ 
            // 2. If all of the workout submissions are zeros, an error message appears. For some reason this isn't working. 
            if ($data['pushups'] === 0 && $data['situps'] === 0 && $data['run_miles'] === 0 && $data['bike_miles'] === 0) {
                $data['body_err'] = 'Please enter at least one workout, you lazy piece of shit.';
            }

            // Make sure there are no errors. 
            // if (empty($data['body_err'])) {
            // Validated
            if ($this->postModel->addPost($data)) {
                flash('post_message', 'Post Added');
                redirect('posts');
            } else {
                die('Something went wrong');
                // }
            }

            // } else {
            //     // Load view with errors
            //     $this->view('posts/add', $data);
            // }
        } else {
            $data = [
                // 'title' => '',
                'body' => '',
                'pushups' => '',
                'situps' => '',
                'run_miles' => '',
                'bikes_miles' => '',
            ];

            $this->view('posts/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title-err' => '',
                'body-err' => '',
            ];

            // Validate data 
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure there are no errors. 
            if (empty($data['title_err']) && empty($data['body_err'])) {
                // Validated
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/edit', $data);
            }
        } else {
            // Fetch post. 
            $post = $this->postModel->getPostById($id);
            // Check for owner. 
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }

    // posts/show/id
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            // The variable we are getting from the model "Post" 
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Fetch post. 
            $post = $this->postModel->getPostById($id);
            // Check for owner. 
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}
