<?php

    class logueo{
        function validateLogueo(){
            $message="";
            $dbusername="";
            $dbpassword="";
            $dbRole="";
            $dbCode="";
            if(isset($_POST["login"])){
                if(!empty($_POST['username']) && !empty($_POST['password'])) {
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                    $query =pg_query("SELECT * FROM users WHERE login='".$username."' AND password='".$password."'");
                    $numrows=pg_num_rows($query);
                    if($numrows!=0){
                        while($row=pg_fetch_assoc($query)){
                        $dbusername=$row['login'];
                        $dbpassword=$row['password'];
                        $dbRole=$row['role'];
                        $dbCode=$row['code'];
                        }

                        if($username == $dbusername && $password == $dbpassword){                        
                               
                                
                                if(!isset($_SESSION["session_username"])) {
                                    $_SESSION['session_username']=$username;
                                    $_SESSION['session_password'] = $dbpassword;
                                    $_SESSION['session_role']=$dbRole;
                                    $_SESSION['session_code']=$dbCode;
                                    $message='Bienvenido'; 
                                }       
                            
                                
                        }
                    }else{
                        $message =  "Nombre de usuario ó contraseña invalida!";
                    }

                }else{
                    $message = "Todos los campos son requeridos!";
                }
            }
            return $message;
        }
    }
?>
