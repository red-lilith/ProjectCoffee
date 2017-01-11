<?php

/**
 * Created by PhpStorm.
 * User: ennuikibun
 * Date: 11/01/17
 * Time: 02:45 AM
 */
class purchase{

    function isSubscribed(){
        $code=$_SESSION['session_code'];
        $query=pg_query("SELECT code_subscription FROM account WHERE code_user='$code'");
        $row = pg_fetch_row($query);
        if($row[0]==""||$row[0]==1)
            return false;
        else
            return true;
    }

    function purchaseCart(){
        $code=$_SESSION['session_code'];
        $total=0;
        $qtyT=0;
        $message = "";
        $coffees ="";

        $sql = "SELECT code FROM coffees";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            if(isset($_SESSION['cart'][$row[0]])){
                foreach ($_SESSION['cart'] as $row[0] => $value) {
                    $coffees .= $row[0] . ",";
                }
            }
        }

        $coffees = substr($coffees, 0, -1);

        $sql = "SELECT code, price FROM coffees WHERE code IN ($coffees) ORDER BY name ASC";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)) {
            foreach ($_SESSION['cart'][$row[0]] as $key => $value){
                $qty=$_SESSION['cart'][$row[0]][$key];
                if(!$qty==0){
                    $qtyT += $qty;
                    $val=0;
                    $grams=250;
                    if($key=="_500") {
                        $val = 1;
                        $grams = 500;
                    }
                    if($key=="_1000"){
                        $val=2;
                        $grams = 1000;
                    }
                    $this->addCoffeePurchased($row[0],$qty,$grams);
                    $subtotal = $qty * $row[1] * (2**$val) ;
                    $total += $subtotal;
                }
            }
        }

        $sql = "SELECT code, price FROM articles";
        $query = pg_query($sql);
        while ($row = pg_fetch_row($query)){
            if(isset($_SESSION['cart2'][$row[0]])){
                $qty=$_SESSION['cart2'][$row[0]]['quantity'];
                $qtyT += $qty;
                $subtotal = $qty * $row[1];
                $total += $subtotal;
                $this->addArticlePurchased($row[0],$qty);
            }
        }
        $sql="INSERT INTO sales_check (code_user, total, date_purchase) VALUES ('$code','$total',now())";
        $query = pg_query($sql);
        if($query)
            $message = "<p>Usted ha realizado un pedido de <b>$qtyT</b> productos de nuestra tienda por un valor total de <b>$ $total</b><br></p>";
        return $message;

    }

    function addCoffeePurchased($codeC,$quantity,$grams){
        $code=$_SESSION['session_code'];
        $sql = "INSERT INTO coffees_sales (code_client, code_coffee, quantity,grams, last_update) VALUES ('$code','$codeC','$quantity','$grams',now())";
        $query = pg_query($sql);
    }

    function addArticlePurchased($codeA,$quantity){
        $code=$_SESSION['session_code'];
        $sql = "INSERT INTO articles_sales (code_client, code_article, quantity, last_update) VALUES ('$code','$codeA','$quantity',now())";
        $query = pg_query($sql);
    }

    function buttonBuy($total){
        $total = $total * 0.000334; //conversión a dólares
        $html = "<form name=\"_xclick\" action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
    <input type=\"hidden\" name=\"business\" value=\"dianagarco@gmail.com\">
    <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
    <input type=\"hidden\" name=\"amount\" value=\"$total\">
    <input type=\"image\" src=\"http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">
</form>";
        return $html;
    }


}

?>
