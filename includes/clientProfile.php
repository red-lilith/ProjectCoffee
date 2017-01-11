<?php

/**
 * Created by PhpStorm.
 * User: ennuikibun
 * Date: 7/01/17
 * Time: 11:15 PM
 */
class clientProfile
{
    function updateProfile(){
        $name=$_POST['nameUsers'];
        $lastName=$_POST['lastNameUsers'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $dept=$_POST['department'];
        $city=$_POST['city'];
        $likes=$_POST['likes'];
        $username=$_SESSION['session_username'];
        $code=$_SESSION['session_code'];

        $query=pg_query("SELECT code FROM users WHERE login='$username'");
        $row=pg_num_rows($query);

        if(!$row==0)
        {
            $result=0;
            if(!$name==""){
                pg_query("UPDATE account SET name='$name' WHERE code_user='$code'");
            }
            if(!$lastName==""){
                pg_query("UPDATE account SET last_name='$lastName' WHERE code_user='$code'");
            }
            if(!$email==""){
                pg_query("UPDATE account SET email='$email' WHERE code_user='$code'");
            }
            if(!$address==""){
                pg_query("UPDATE account SET address='$address' WHERE code_user='$code'");
            }
            if(!$dept==""){
                pg_query("UPDATE account SET code_department='$dept' WHERE code_user='$code'");
            }
            if(!$city==""){
                pg_query("UPDATE account SET code_city='$city' WHERE code_user='$code'");
            }
            if(!$likes=="Gustos"){
                pg_query("UPDATE account SET likes='$likes' WHERE code_user='$code'");
            }
            $result=pg_query("UPDATE account SET last_update=now() WHERE code_user='$code'");

            if($result){
                $message = "Su Perfil ha sido Actualizado";
            }

            else {
                $message = "Error al ingresar los datos!";
            }
        }
        else {
            $message = "Error, no se encuentra el usuario!";
        }
        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }

    function updatePassword(){
        $oldPass=$_POST['old_password'];
        $newPass=$_POST['new_password'];
        $newPassConfirm=$_POST['new_password2'];
        $username=$_SESSION['session_username'];
        $code=$_SESSION['session_code'];

        $query=pg_query("SELECT password FROM users WHERE login='$username'");
        $row=pg_num_rows($query);

        $result=false;
        if(!$row==0) {
            $row_ = pg_fetch_row($query);
            if ($row_[0] == $oldPass) {
                if ($newPass == $newPassConfirm) {
                    pg_query("UPDATE users SET password='$newPass' WHERE code='$code'");

                    $result = pg_query("UPDATE users SET last_update=now() WHERE code='$code'");
                } else
                    $message = "La nueva contraseña no coincide";
            } else
                $message = "Contraseña Incorrecta";

            if($result){
                $message = "Su Contraseña se ha actualizado";
            }
        }

        else {
            $message = "Error, no se encuentra el usuario!";
        }
        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }

    function addWishedCoffee($id){
        $code=$_SESSION['session_code'];
        $sql_ = "SELECT * FROM coffees_wishlist WHERE code_client='$code' AND code_coffee='$id'";
        $query_ = pg_query($sql_);
        $numrows=pg_num_rows($query_);
        if($numrows==0){
            $sql = "INSERT INTO coffees_wishlist (code_client, code_coffee) VALUES ('$code','$id')";
            $query = pg_query($sql);
        }
    }

    function deleteWishedCoffee($id){
        $code=$_SESSION['session_code'];
        $sql_ = "DELETE FROM coffees_wishlist WHERE code_client='$code' AND code_coffee='$id'";
        $query_ = pg_query($sql_);
    }

    function wishlistCoffees(){
        $message="";
        $code=$_SESSION['session_code'];
        $sql = "SELECT code_coffee FROM coffees_wishlist WHERE code_client='$code'";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $sql1 = "SELECT code, name, price, photo_url FROM coffees WHERE code='$row[0]'";
            $query1 = pg_query($sql1);
            while ($row1 = pg_fetch_row($query1)){
                $message.= "<li> 
            <a href=\"index.php?action=delete&id=$row1[0]\"><close>&times;</a></close>
<a href=\"javascript:void(0)\" onclick=showInfo(\"$row1[0]-product\",\"$row1[0]-close\")><img src=\"$row1[3]\" alt=\"\"></a><text>$row1[1] $ $row1[2]</text>
            </li>";
            }
        }
        return $message;
    }

    function myCoffees(){
        $message="";
        $code=$_SESSION['session_code'];
        $sql = "SELECT code_coffee FROM coffees_sales WHERE code_client='$code'";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $sql1 = "SELECT code, name, price, photo_url FROM coffees WHERE code='$row[0]'";
            $query1 = pg_query($sql1);
            while ($row1 = pg_fetch_row($query1)){
                $message.= "<li> </close>
<a href=\"javascript:void(0)\" onclick=showInfo(\"$row1[0]-product\",\"$row1[0]-close\")><img src=\"$row1[3]\" alt=\"\"></a><text>$row1[1] $ $row1[2]</text>
            </li>";
            }
        }
        return $message;
    }

    function departments(){
        $message="";
        $sql = "SELECT code, name FROM department";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $message.= "<option value=\"$row[0]\">$row[1]</option>";
        }
        return $message;
    }

    function cities(){
        $message="";
        $sql = "SELECT code, code_department, name FROM city";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $message.= "<option value1=\"$row[1]\" value=\"$row[0]\">$row[2]</option>";
        }
        return $message;
    }

    function updateSub(){
        $message="";
        $origin=$_POST['myOrigin'];
        $type=$_POST['MyType'];
        $code=$_SESSION['session_code'];
        $sql = "UPDATE account SET origin_sub='$origin', type_sub='$type' WHERE code_user='$code'";
        $query = pg_query($sql);
        if($query)
            $message = "Selección Almacenada. Haga click en el botón de 'Suscribirme' para completar la suscripción";
        return $message;
    }

}
?>
