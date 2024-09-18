<?php
include_once('model/User.php');
include_once('EntityController.php');
class UserController extends EntityController
{
    public function index($relatedEntityId = null)
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $entities = (new DatabaseModel($this->entity))->getAll();
            include("view/{$this->view}.php");
        } else {
            include("view/login.php");
        }
    }
    public function loginUser()
    {
        if (isset($_POST['password']) && isset($_POST['action'])) {
            $user = User::login($_POST['username'], $_POST['password']);
            if (is_null($user)) {
                $msgHeader = 'User not found!';
                $msg = 'Try once again';
                $color = 'orange';
                header("Refresh:2");
            } elseif ($user === false) {
                $msgHeader = 'Password not correct!';
                $msg = 'Try once again';
                $color = 'red';
                header("Refresh:2");
            } elseif ($user[0] === true) {
                $_SESSION = ['username' => $user[1], 'role' => $user[2], 'loggedin' => true, 'user_ip' => $_SERVER['REMOTE_ADDR']];
                $msgHeader = 'Password correct!';
                $msg = 'You are now logged in.';
                $color = 'green';
                $this->redirectAfter(2, '/' . homeDir());
            }
        }
        include('view/login.php');
    }
    public function logoutUser()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: .");
    }
    public function addUser($username = null, $psw = null, $role = null)
    {
        if (isset($_POST['username'])) {
            $data = [
                'username' => htmlspecialchars($_POST['username']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => htmlspecialchars($_POST['role']),
            ];
            $success = (new DatabaseModel('user'))->add($data);
            $this->setMessage(
                $success ? "User added" : "Oops!",
                $success ? "User {$data['username']} was successfully added" : "Something went wrong! Try once again.",
                $success ? 'green' : 'red'
            );
            $this->redirectAfter(2);
        }
        include('view/user-add.php');
        $this->unsetMessage();
    }
    public function editUser()
    {
        if (isset($_POST['username'])) {
            $data = [
                'username' => htmlspecialchars($_POST['username']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => htmlspecialchars($_POST['role']),
            ];
            $success = (new DatabaseModel('user'))->edit($_SESSION['user_id'], $data);
            $this->setMessage(
                $success ? "User updated" : "Error",
                $success ? "User '{$data['username']}' was successfully updated" : "Something went wrong! Try again.",
                $success ? 'green' : 'red'
            );
            unset($_SESSION['user_id']);
            $this->redirectAfter(2);
        }
        include('view/user-edit.php');
        $this->unsetMessage();
    }
    public static function checkIpAddress()
    {
        $storedIp = $_SESSION['user_ip'] ?? null;
        $userIp = $_SERVER['REMOTE_ADDR'];
        if ($storedIp !== $userIp) {
            $_SESSION = ['msg_header' => 'Oeps!', 'msg' => 'Please login once again.', 'msg_color' => 'orange'];
            session_destroy();
            include('view/login.php');
        }
        return true;
    }
    public static function sessionRegenaration()
    {
        isset($_SESSION['initiated']) ?: (session_regenerate_id() && $_SESSION['initiated'] = 1);
        $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;
    }
}
