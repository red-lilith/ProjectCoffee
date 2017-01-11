<?php

class register
{
    function validateRegister(){


        if(!empty($_POST['nameUsers']) && !empty($_POST['lastNameUsers']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $name=$_POST['nameUsers'];
            $lastName=$_POST['lastNameUsers'];
            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];

            $query=pg_query("SELECT * FROM users WHERE login='$username'");
            $numrows=pg_num_rows($query);

            if($numrows==0)
            {
                $result=0;
                $sql = "INSERT INTO users (role, login, password, date_created, last_update) VALUES ('cliente','$username','$password', now(), now()) RETURNING code";
                $result=pg_query($sql);
                $row = pg_fetch_row($result);
                $userCode = $row[0];
                $sqlRegister = "INSERT INTO account (code_user, name, last_name, email, date_created, last_update) VALUES ('$userCode', '$name', '$lastName', '$email',now(), now())";
                $resultRegister=pg_query($sqlRegister);

                if($result){
                    $message = "Cuenta Correctamente Creada";
                }

                else {
                    $message = "Error al ingresar datos de la información!";
                }
            }
            else {
                $message = "El nombre de usuario ya existe! Por favor, intenta con otro!";
            }

        }
        else {

            $message = "Todos los campos deben estar completos!";
        }

        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }
}



?>
