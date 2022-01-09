<?php
namespace Website\User;

class LoginService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function isLocked()
    {
        if (isset($_SESSION['locked'])) {
            return true;
        } else {
             header("Location: locked");
             die();
        }
    }

    public function check()
    {
        if (isset($_SESSION['login'])) {
            return true;
        } else {
             header("Location: anmelden");
             die();
        }
    }

    public function attempt($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if (empty($user)){
            return false;
        }

        if (password_verify($password, $user->password)){
            $_SESSION['login'] = $user->email;
            $_SESSION['id'] = $user->id;
            session_regenerate_id(true);
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        session_regenerate_id(true);
    }
}
?>