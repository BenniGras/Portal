<?php 
namespace Website\User;

use Website\Core\AbstractController;

class LoginController extends AbstractController
{
    public function __construct(LoginService $loginService, UserRepository $userRepository)
    {
        $this->loginService = $loginService;
        $this->userRepository = $userRepository;
    }

    public function locked()
    {
        if(!empty($_POST['password']))
        {
            $password = $_POST['password'];

            if ($password == "Portal"){
                $_SESSION['locked'] = false;
                session_regenerate_id(true);
                header("Location: startseite");
                return;
            } else {
                $error = "Das Passwort stimmt leider nicht!";
            }
        }
        $this->render("locked", []);
    }

    public function login()
    {
        $this->loginService->isLocked();
        $error = null;

        if(!empty($_POST['email']) && !empty($_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->loginService->attempt($email, $password)){
                header("Location: startseite");
                return;
            } else {
                $error = true;
            }
        }
        $this->render("login", [
            'error' => $error
        ]);
    }

    public function logout()
    {
        $this->loginService->isLocked();
        $this->loginService->logout();
        header("Location: anmelden");
    }

    public function dashboard()
    {
        $this->loginService->isLocked();
        $this->loginService->check();
        $this->render("dashboard",[
            '' => ""
        ]);
    }

    public function renderRegistry()
    {
        $this->loginService->isLocked();
        $this->render("registry", [
            '' => ""
        ]);
    }

    public function addUser()
    {
        $this->loginService->isLocked();

        $addUser = null;
        $error = null;

        if(!empty($_POST))
        {
            $check = $this->userRepository->findByEmail($_POST['email']);
            if(!$check)
            {
                $addUser = $this->userRepository->insertUser($_POST);
            } else {
                $error = "Diese Email wird bereits benutzt.";
            }
        }

        $this->render("add_user", [
            'addUser' => $addUser,
            'error' => $error,
        ]);
    }

    public function addDealer()
    {
        $this->loginService->isLocked();

        $addDealer = null;
        $error = null;

    
        if(!empty($_POST))
        {
            $check = $this->userRepository->findByEmail($_POST['email']);
            if(!$check)
            {
                $addDealer = $this->userRepository->insertDealer($_POST);
            } else {
                $error = "Diese Email wird bereits benutzt.";
            }
        }

        $this->render("add_dealer", [
            'addDealer' => $addDealer,
            'error' => $error,
        ]);
    }

    public function showUser()
    {
        $this->loginService->isLocked();
        $this->loginService->check();
      
        $user = $this->userRepository->findByEmail($_SESSION['login']);

        $this->render("user_data", [
            'user' => $user
        ]);
    }

    public function editUser()
    {
        $this->loginService->isLocked();
        $this->loginService->check();

        $user = $this->userRepository->findByEmail($_SESSION['login']);

        if(!empty($_POST))
        {
           if(isset($_POST['companyname'])){
                $user->email = $_POST['email'];
                $user->companyname = $_POST['companyname'];
                $user->street = $_POST['street'];
                $user->number = $_POST['number'];
                $user->zipcode = $_POST['zipcode'];
                $user->city = $_POST['city'];
                $user->customer_email = $_POST['customer_email'];
                $user->customer_prefix = $_POST['customer_prefix'];
                $user->customer_phone = $_POST['customer_phone'];
           } else {
                $user->email = $_POST['email'];
                $user->firstname = $_POST['firstname'];
                $user->surname = $_POST['surname'];
                $user->street = $_POST['street'];
                $user->number = $_POST['number'];
                $user->zipcode = $_POST['zipcode'];
                $user->city = $_POST['city'];
                $user->customer_email = $_POST['customer_email'];
                $user->customer_prefix = $_POST['customer_prefix'];
                $user->customer_phone = $_POST['customer_phone'];
           }
           $this->userRepository->updateUser($user);
           $_SESSION['login'] = $_POST['email'];
           header("Location: meine_daten");
        }

        $this->render("edit_user", [
            'user' => $user
        ]);
    }

    public function changePassword()
    {
        $this->loginService->isLocked();
        
        $user = $this->userRepository->findByEmail($_SESSION['login']);
        $error = null;

        if(!empty($_POST['old_password']) && !empty($_POST['password_1']) && !empty($_POST['password_2']))
        {
            if (password_verify($_POST['old_password'], $user->password)){
                if($_POST['password_1'] == $_POST['password_2']){
                    $user->password = password_hash($_POST['password_1'], PASSWORD_DEFAULT);
                    $this->userRepository->updatePassword($user);
                    header("Location: meine_daten");
                } else {
                    $error = "Die Passwörter stimmen nicht überein.";
                }
            } else {
                $error = "Das Passwort stimmt nicht.";
            }

            $user->password = $_POST['password_1'];
        }

        $this->render("change_password", [
            'user' => $user,
            'error' => $error,
        ]);
    }
}
?>