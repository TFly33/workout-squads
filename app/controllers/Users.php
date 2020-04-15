<?php
class Users extends Controller
{
    public function __construct()
    {
        // loading the model. 
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Sanitize POST data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            // check if empty 
            if (empty($data['email'])) {
                // set erro
                $data['email_err'] = 'Please enter email';
            } else {
                // check if email is taken. 
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }
            // Validate Name
            if (empty($data['name'])) {
                // set erro
                $data['name_err'] = 'Please enter name';
            }
            // Validate password 
            if (empty($data['password'])) {
                // set erro
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            // Validate confirm password
            if (empty($data['confirm_password'])) {
                // set error
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
            }

            // Make sure errors are empty 
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated

                // Hash password so we can't see it. 
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User 
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init Data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load View 
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form 
            // Sanitize POST data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            // check if empty 
            if (empty($data['email'])) {
                // set erro
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            // check if empty 
            if (empty($data['password'])) {
                // set erro
                $data['password_err'] = 'Please enter password';
            }

            // CHeck for user/email 
            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['email_err'] = 'No user found';
            }

            // make sure errors are empty. 
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user 
                $loggedInUser = $this->userModel->Login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password Incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init Data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load View 
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
