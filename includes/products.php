<?php

/**
 * Created by PhpStorm.
 * User: ennuikibun
 * Date: 28/12/16
 * Time: 09:55 AM
 */
class products
{

    function filterCoffee($filter){
        $message = "";
        if($filter=="all"){
            $query=pg_query("SELECT code, name, price, photo_url FROM coffees WHERE release_date<=now()");
            $numrows=pg_num_rows($query);
            if ($numrows > 0) {
                while($row = pg_fetch_row($query)) {
                    $message.= $this->htmlCoffees($row[0],$row[1],$row[2],$row[3]);
                }
            } else {
                $message = "0 results";
            }
        }

        else if ($filter=="ground"){
            $query=pg_query("SELECT code, name, price, photo_url FROM coffees WHERE type='molido' AND release_date<=now()");
            $numrows=pg_num_rows($query);
            if ($numrows > 0) {
                while($row = pg_fetch_row($query)) {
                    $message.= $this->htmlCoffees($row[0],$row[1],$row[2],$row[3]);
                }
            } else {
                $message = "0 results";
            }
        }

        else if($filter=="beans"){
            $query=pg_query("SELECT code, name, price, photo_url FROM coffees WHERE type='en grano' AND release_date<=now()");
            $numrows=pg_num_rows($query);
            if ($numrows > 0) {
                while($row = pg_fetch_row($query)) {
                    $message.= $this->htmlCoffees($row[0],$row[1],$row[2],$row[3]);
                }
            } else {
                $message = "0 results";
            }
        }
        return $message;
    }

    function coffeeDescrip(){
        $message="";
        $query=pg_query("SELECT code, name, price, photo_url, type, origin, code_producer, line, traditional_or_new, release_date FROM coffees");
        $numrows=pg_num_rows($query);
        if ($numrows > 0) {
            while($row = pg_fetch_row($query)) {
                $query_=pg_query("SELECT company_name, estate FROM producer WHERE code='$row[6]'");
                $row_ = pg_fetch_row($query_);
                $message.= "<div id=\"$row[0]-product\" class=\"modal\">
  <div class=\"modal-content\">
    <div class=\"modal-head\" style=\"padding: 20px 16px;\">
      <span id=\"$row[0]-close\" class=\"close\">&times;</span>
      <h2>$row[1]  $ $row[2]</h2>
    </div>
    <div class=\"modal-body\">
     <img style=\"height: 160px; width: 210px; margin: 10px 16px 5px 25px; border: 1px solid #5F1101;\" src=\"$row[3]\" alt=\"\">
      <p><b>DESCRIPCIÓN</b></p>
      <p style=\"color:#A52B12; margin-bottom: 0;\">Café 100% Colombiano $row[4] de origen $row[5], proveniente de la finca $row_[1] y producido por $row_[0]</p><br>
      <p style=\"color:#A52B12; margin-top: 0; margin-bottom: 0\"><b>Variedad:</b> $row[7]</p>
      <p style=\"color:#A52B12; margin-top: 0; margin-bottom: 0\"><b>Categoría:</b> $row[8]</p>
      <p style=\"color:#A52B12; margin-top: 0; margin-bottom: 0\"><b>Lanzamiento:</b> $row[9]</p>
    </div>
    <div class=\"modal-footer\">
      <h3></h3> </div>
  </div>

</div>";
            }
        }
        return $message;
    }

    function articleDescrip(){
        $message="";
        $query=pg_query("SELECT code, name, price, photo_url, description FROM articles");
        $numrows=pg_num_rows($query);
        if ($numrows > 0) {
            while($row = pg_fetch_row($query)) {
                //$query_=pg_query("SELECT company_name FROM producer WHERE code='$row[7]'");
                //$row_ = pg_fetch_row($query_);
                $message.= "<div id=\"$row[0]-product\" class=\"modal\">
  <div class=\"modal-content\">
    <div class=\"modal-head\" style=\"padding: 20px 16px;\">
      <span id=\"$row[0]-close\" class=\"close\">&times;</span>
      <h2>$row[1]  $ $row[2]</h2>
    </div>
    <div class=\"modal-body\">
     <img style=\"height: 160px; width: 210px; margin: 10px 16px 5px 25px; border: 1px solid #5F1101;\" src=\"$row[3]\" alt=\"\">
      <p><b>DESCRIPCIÓN</b></p>
      <p style=\"color:#A52B12;\">$row[4]</p><br>
    </div>
    <div class=\"modal-footer\">
      <h3></h3> </div>
  </div>

</div>";
            }
        }
        return $message;
    }

    function showArticles(){
        $message = "";
        $query=pg_query("SELECT code, name, price, photo_url FROM articles");
        $numrows=pg_num_rows($query);
        if ($numrows > 0) {
            while($row = pg_fetch_row($query)) {
                $message.= $this->htmlArticles($row[0],$row[1],$row[2],$row[3]);
            }
        } else {
            $message = "0 results";
        }
        return $message;
    }


    function addToCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            if($_POST['grams']=="250gr")
                $_SESSION['cart'][$id]['_250']+=$_POST['quantity'];
            if($_POST['grams']=="500gr")
                $_SESSION['cart'][$id]['_500']+=$_POST['quantity'];
            if($_POST['grams']=="1000gr")
                $_SESSION['cart'][$id]['_1000']+=$_POST['quantity'];

        }
        else {
            $query = pg_query("SELECT code, price FROM coffees WHERE code=$id");
            $numrows = pg_num_rows($query);
            if ($numrows > 0) {
                $row = pg_fetch_row($query);
                if ($_POST['grams'] == "250gr")
                    $_SESSION['cart'][$row[0]] = array(
                        "_250" => $_POST['quantity'],
                        "_500" => 0,
                        "_1000" => 0
                    );
                else if ($_POST['grams'] == "500gr")
                    $_SESSION['cart'][$row[0]] = array(
                        "_250" => 0,
                        "_500" => $_POST['quantity'],
                        "_1000" => 0
                    );
                else if ($_POST['grams'] == "1000gr")
                    $_SESSION['cart'][$row[0]] = array(
                        "_250" => 0,
                        "_500" => 0,
                        "_1000" => $_POST['quantity']
                    );
            }
        }

        $products = "";
        $message = "";
        $numItems = 0;
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $id => $value) {
            $products .= $id . ",";
        }

        $products = substr($products, 0, -1);

        $sql = "SELECT code, name, price, photo_url FROM coffees WHERE code IN ($products) ORDER BY name ASC";
        $query = pg_query($sql);

        while ($row = pg_fetch_row($query)) {
            foreach ($_SESSION['cart'][$row[0]] as $key => $value){
                $qty=$_SESSION['cart'][$row[0]][$key];
                if(!$qty==0){
                    $numItems+=$qty;
                    $val=0;
                    if($key=="_500")
                        $val=1;
                    if($key=="_1000")
                        $val=2;
                    $subtotal = $qty * $row[2] * (2**$val) ;
                    $totalPrice += $subtotal;
                    $message.= $this->htmlCart($row[1],$key,$qty,$subtotal,$row[3]);
                }
            }


        }

        $_SESSION['htmlCart'] = $message;
        $_SESSION['items'] = $numItems;
        $_SESSION['total'] = $totalPrice;
    }

    function addToCartArticle($id)
    {
        if (isset($_SESSION['cart2'][$id])) {
            $_SESSION['cart2'][$id]['quantity']+=$_POST['quantity'];
        }
        else {
            $query = pg_query("SELECT code, price FROM articles WHERE code=$id");
            $numrows = pg_num_rows($query);
            if ($numrows > 0) {
                $row = pg_fetch_row($query);
                $_SESSION['cart2'][$row[0]] = array(
                    "quantity" => $_POST['quantity'],
                    "price" => $row[1]
                );
            }
        }

        $products = "";
        $message = "";
        $numItems = 0;
        $totalPrice = 0;

        foreach ($_SESSION['cart2'] as $id => $value) {
            $products .= $id . ",";
        }

        $products = substr($products, 0, -1);

        $sql = "SELECT code, name, price, photo_url FROM articles WHERE code IN ($products) ORDER BY name ASC";
        $query = pg_query($sql);

        while ($row = pg_fetch_row($query)) {
            $qty=$_SESSION['cart2'][$row[0]]['quantity'];
            $numItems+=$qty;
            $subtotal = $qty * $row[2];
            $totalPrice += $subtotal;
            $message.= $this->htmlCart($row[1],"",$qty,$subtotal,$row[3]);
        }

        $_SESSION['htmlCart2'] = $message;
        $_SESSION['items2'] = $numItems;
        $_SESSION['total2'] = $totalPrice;

    }


    function htmlCoffees($code, $name, $price, $url_image){
        $html = "<form method=\"POST\" action=\"index.php?id=$code\">
<li class=\"catCardList\">
	<div class=\"catCard\"><a href=\"javascript:void(0)\" onclick=showInfo(\"$code-product\",\"$code-close\")><img src=\"$url_image\" alt=\"\"></a>
	<div class=\"lowerCatCard\">
        <h3>$name</h3>
        <div class=\"price\"><h3>Precio(250gr):</h3> <span>$ $price</span><br> 
	<a href=\"index.php?action=addlist&id=$code\">Café por probar</a>
	<div class=\"styled-select semi-square\">  
        <tr><td>
        <select name =\"grams\">
    	<option>250gr</option>
   	 <option>500gr</option>
   	 <option>1000gr</option>
 	 </select>
 	 </td></tr>
	</div>	
	<div class=\"quantity\">
  	<tr><td>
  	<input type=\"number\" name=\"quantity\" min=\"1\" max=\"9\" step=\"1\" value=\"1\"></td></tr>
	<div class=\"quantity-nav\">
	<div class=\"quantity-button quantity-up\">+</div>
	<div class=\"quantity-button quantity-down\">-</div></div></div></div>
	<button method=\"POST\" type=\"submit\" class=\"buy\" name=\"add\" id=\"catCardButton\"><a>Agregar al Carrito</a> <i class=\"fa fa-shopping-cart\"></i></button>

	</div>
	</div>
	</li>
	</form>";
        return $html;
    }

    function htmlArticles($code, $name, $price, $url_image){
        $html = "<form method=\"POST\" action=\"index.php?id=$code\">
<li class=\"catCardList\">
	<div class=\"catCard\"><a href=\"javascript:void(0)\" onclick=showInfo(\"$code-product\",\"$code-close\")><img src=\"$url_image\" alt=\"\"></a>
	<div class=\"lowerCatCard\">
        <h3>$name</h3>
        <div class=\"price\"><h3>Precio:</h3> <span>$ $price</span><br> 
	<a href=\"#\">Más Información</a> 
	<div class=\"quantity\">
  	<tr><td>
  	<input type=\"number\" name=\"quantity\" min=\"1\" max=\"9\" step=\"1\" value=\"1\"></td></tr>
	<div class=\"quantity-nav\">
	<div class=\"quantity-button quantity-up\">+</div>
	<div class=\"quantity-button quantity-down\">-</div></div></div></div>
	<button method=\"POST\" type=\"submit\" class=\"buy\" name=\"add\" id=\"catCardButton\"><a>Agregar al Carrito</a> <i class=\"fa fa-shopping-cart\"></i></button>

	</div>
	</div>
	</li>
	</form>";
        return $html;
    }

    function htmlCart($name,$weight,$quantity,$price,$url_image){
        $grams = "x 250gr";
        if($weight=="_500")
            $grams = "x 500gr";
        if($weight=="_1000")
            $grams = "x 1000gr";
        if($weight=="")
            $grams = "";
        $html = "<li class=\"clearfix\"> 
            <img src=\"$url_image\" alt=\"\"/> <name>$name $grams</name><span class=\"innerbadge\">$quantity</span><price>$ $price</price>
            </li>";
        return $html;
    }

    function emptyCart(){
        $query=pg_query("SELECT code FROM coffees");
        $numrows=pg_num_rows($query);
        if ($numrows > 0) {
            while($row = pg_fetch_row($query)) {
                unset($_SESSION['cart'][$row[0]]);
            }
        }

        $query=pg_query("SELECT code FROM articles");
        $numrows=pg_num_rows($query);
        if ($numrows > 0) {
            while($row = pg_fetch_row($query)) {
                unset($_SESSION['cart2'][$row[0]]);
            }
        }
        unset($_SESSION['htmlCart']);
        unset($_SESSION['htmlCart2']);
        unset($_SESSION['items']);
        unset($_SESSION['total']);
        unset($_SESSION['total2']);
        unset($_SESSION['items2']);
    }

    function latestCoffee(){
        $query=pg_query("SELECT name, price, photo_url FROM coffees WHERE last_update = (SELECT MAX(last_update) FROM coffees)");
        $row = pg_fetch_row($query);
        $name = $row[0];
        $price = $row[1];
        $photo = $row[2];
        $html = "<div class=\"wrapper\"> <h1>Nuevo Producto</h1>
           <name><i class=\"fa fa-coffee\"></i> $name </name>
        <a href=\"#\"><img src=\"$photo\" alt=\"\"/></a>
</div>";
        return $html;
    }

    function cartProduct(){
        return $_SESSION['htmlCart'].$_SESSION['htmlCart2'];
    }

    function items(){
        return $_SESSION['items']+$_SESSION['items2'];
    }

    function totalPrice(){
        return $_SESSION['total']+$_SESSION['total2'];
    }
}


?>
