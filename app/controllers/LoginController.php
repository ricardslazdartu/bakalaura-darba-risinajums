<?php

class LoginController
{
    public function showLoginPage()
    {
        renderWithVariables('login.index.php');
    }

    /**
     * @throws Exception
     */
    public function authorizeUser()
    {
        $user = UsersRepository::getUser($_POST['username']);

        if (!$user) {
            echo 'User could not be authorized';
            return;
        }

        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = [
                'username' => $user['username'],
                'role' => $user['role'],
            ];

            header('Location: ' . url('pagesIndex'));
        } else {
            echo 'User could not be authorized';
        }
    }

    /**
     * @throws Exception
     */
    public function createUser()
    {
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        UsersRepository::create($_POST['username'], $passwordHash, UsersRepository::REGULAR_USER);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . url('showLoginPage'));
    }
}