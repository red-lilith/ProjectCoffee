<?php

/**
 * Created by PhpStorm.
 * User: ennuikibun
 * Date: 9/01/17
 * Time: 06:58 PM
 */
class managerProfile{

    function updateCoffee(){
        $name=$_POST['nameCoffee'];
        $line=$_POST['lineCoffee'];
        $photo=$_POST['photoCoffee'];
        $price=$_POST['priceCoffee'];
        $quantity=$_POST['quantityCoffee'];
        $release=$_POST['releaseCoffee'];
        $type=$_POST['typeCoffee'];
        $category=$_POST['catCoffee'];
        $origin=$_POST['originCoffee'];
        $producer=$_POST['producerCoffee'];

        $query=pg_query("SELECT code FROM coffees WHERE name='$name' AND code_producer='$producer'");
        $row=pg_num_rows($query);
        $row_ = pg_fetch_row($query);
        $code = $row_[0];
        if($row==0) {
            $result=0;
            $sql="INSERT INTO coffees (name, price, photo_url, type, quantity, release_date, line, date_created, traditional_or_new, origin, code_producer, last_update) VALUES ('$name','$price','$photo','$type','$quantity','$release','$line',now(),'$category','$origin','$producer',now()) ";
            $result=pg_query($sql);
            if($result){
                $message = "El café $name se ha registrado exitósamente";
            }
            else {
                $message = "Error al ingresar los datos!";
            }
        }
        else {
            $sql="UPDATE coffees SET price='$price',photo_url='$photo',type='$type',quantity='$quantity',release_date='$release',line='$line',traditional_or_new='$category',origin='$origin',last_update=now() WHERE code='$code'";
            pg_query($sql);
            $message = "El café $name ya se encontraba registrado.<br>Ha sido actualizado!";
        }

        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }

    function updateArticle(){
        $name=$_POST['nameArticle'];
        $description=$_POST['descripArticle'];
        $photo=$_POST['photoArticle'];
        $price=$_POST['priceArticle'];
        $quantity=$_POST['quantityArticle'];

        $query=pg_query("SELECT code FROM articles WHERE name='$name'");
        $row=pg_num_rows($query);
        $row_ = pg_fetch_row($query);
        $code = $row_[0];
        if($row==0) {
            $result=0;
            $sql="INSERT INTO articles (name, description, price, photo_url, quantity, date_created, last_update) VALUES ('$name','$description','$price','$photo','$quantity',now(),now())";
            $result=pg_query($sql);
            if($result){
                $message = "El Artículo $name se ha registrado exitósamente";
            }
            else {
                $message = "Error al ingresar los datos!";
            }
        }
        else {
            $sql="UPDATE articles SET description='$description', price='$price',photo_url='$photo',quantity='$quantity',last_update=now() WHERE code='$code'";
            pg_query($sql);
            $message = "El artículo $name ya se encontraba registrado.<br>Ha sido actualizado!";
        }

        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }

    function updateProducer(){
        $nit=$_POST['nitProducer'];
        $company=$_POST['companyProducer'];
        $estate=$_POST['estateProducer'];
        $exper=$_POST['experienceProducer'];
        $email=$_POST['emailProducer'];

        $query=pg_query("SELECT code FROM producer WHERE nit='$nit'");
        $row=pg_num_rows($query);
        $row_ = pg_fetch_row($query);
        $code = $row_[0];
        if($row==0) {
            $result=0;
            $sql="INSERT INTO producer (nit,company_name,estate,email,experience_time,date_created, last_update) VALUES ('$nit','$company','$estate','$email','$exper',now(),now())";
            $result=pg_query($sql);
            if($result){
                $message = "El productor de café $company se ha registrado exitósamente";
            }
            else {
                $message = "Error al ingresar los datos!";
            }
        }
        else {
            $sql="UPDATE producer SET company_name='$company',estate='$estate',email='$email',experience_time='$exper',last_update=now() WHERE code='$code'";
            pg_query($sql);
            $message = "El productor $company ya se encontraba registrado.<br>Ha sido actualizado!";
        }

        $messageReponse = '<h1>No existen resultados</h1>';

        if (!empty($message)) {
            $messageReponse = "<p class=\"error\">" . "". $message . "</p>";
        }
        return $messageReponse;
    }

    function possibleSales(){
        $message="";
        $sql = "SELECT code_coffee FROM coffees_wishlist";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $sql1 = "SELECT code, name, price, photo_url FROM coffees WHERE code='$row[0]'";
            $query1 = pg_query($sql1);
            while ($row1 = pg_fetch_row($query1)){
                $message.= "<li><a href=\"javascript:void(0)\" onclick=showInfo(\"$row[0]-product\",\"$row[0]-close\")><img src=\"$row[3]\" alt=\"\"></a><text>$row[1] $ $row[2]</text></li>";
            }
        }
        return $message;
    }

    function producers(){
        $message="";
        $sql = "SELECT code, company_name FROM producer";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            $message.= "<option value=\"$row[0]\">$row[1]</option>";
        }
        return $message;
    }

    function monthlySales(){
        $message="";
        for($i=1;$i<12;$i+=2){
            $j = $i+1;
            $query=pg_query("SELECT * FROM coffees_sales WHERE EXTRACT(MONTH FROM last_update)='$i' OR EXTRACT(MONTH FROM last_update)='$j'");
            $row=pg_num_rows($query);
            $message.=$this->htmlMonthlySales($row);
        }
        return $message;
    }

    function htmlMonthlySales($sales){
        $sales=$sales*30;
        $sales.="px";
        $html = "<div style=\"height:$sales;\" class=\"col\">
    </div>";
        return $html;
    }

    function coffeesSold(){
        $query=pg_query("SELECT * FROM coffees_sales");
        $row=pg_num_rows($query);
        return $row;
    }

    function articlesSold(){
        $query=pg_query("SELECT * FROM articles_sales");
        $row=pg_num_rows($query);
        return $row;
    }

    function wishlistTotal(){
        $query=pg_query("SELECT * FROM coffees_wishlist");
        $row=pg_num_rows($query);
        return $row;
    }

    function commentsTotal(){
        $query=pg_query("SELECT * FROM comments");
        $row=pg_num_rows($query);
        return $row;
    }

    function newCoffees(){
        $message="";
        $sql = "SELECT code, name, price, photo_url FROM coffees WHERE traditional_or_new='Nuevo'";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            $message.= "<li><a href=\"javascript:void(0)\" onclick=showInfo(\"$row[0]-product\",\"$row[0]-close\")><img src=\"$row[3]\" alt=\"\"></a><text>$row[1] $ $row[2]</text></li>";
        }
        return $message;
    }

    function tradCoffees(){
        $message="";
        $sql = "SELECT code, name, price, photo_url FROM coffees WHERE traditional_or_new='Tradicional'";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            $message.= "<li><a href=\"javascript:void(0)\" onclick=showInfo(\"$row[0]-product\",\"$row[0]-close\")><img src=\"$row[3]\" alt=\"\"></a><text>$row[1] $ $row[2]</text></li>";
        }
        return $message;
    }

    function releases(){
        $message="";
        $sql = "SELECT code, name, price, photo_url FROM coffees WHERE release_date>now()";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            $message.= "<li><a href=\"javascript:void(0)\" onclick=showInfo(\"$row[0]-product\",\"$row[0]-close\")><img src=\"$row[3]\" alt=\"\"></a><text>$row[1] $ $row[2]</text></li>";
        }
        return $message;
    }

    function allProducers(){
        $message="";
        $sql = "SELECT nit, company_name FROM producer";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            $message.= "<li><text style=\"float:left;\"><b>NIT:</b> $row[0]<br><b>Nombre:</b>$row[1]</text></li>";
        }
        return $message;
    }

}
?>
