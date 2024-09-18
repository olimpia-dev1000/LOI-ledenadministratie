<?php class User
{

    public static function login($un_temp, $pw_temp)
    {
        global $conn;
        // $un_temp = sanitize($conn, $un_temp);
        // $pw_temp = sanitize($conn, $pw_temp);

        $stmt = $conn->prepare("SELECT * FROM user WHERE BINARY username = ?");
        $stmt->bindParam(1, $un_temp);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            $un = $user['username'];
            $pw = $user['password'];
            $rl = $user['role'];
            if (password_verify(str_replace("'", "", $pw_temp), $pw)) {
                return array(true, $un, $rl);
            } else {
                return false;
            }
        }
    }

    public static function add($username, $psw, $role)
    {
        global $conn;
        try {
            $stmt = $conn->prepare("INSERT INTO user (user_id, username, password, role) VALUES (NULL, ?, ?, ?)");
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $psw);
            $stmt->bindParam(3, $role);
            $stmt->execute();

            echo '<div class="main msg center">Account created. You can now login. </div>';
            header("Refresh:1");
        } catch (PDOException $e) {
            echo '<div class="main msg center">Failed to create an account. Account already exists. </div>' . $e;
            header("Refresh:1");
        }
    }
}
