<html>
<head>
    <meta charset="UTF-8">
    <title>VCO - Café Colombiano</title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/coffees.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/quantity.css">
    <link rel="stylesheet" href="css/popUp.css">
    <link rel="stylesheet" href="css/smallLogin.css">
 
</head>

<body>
#OPCIONES#

    <div class="bodyCoffees">
        <section>
            <span>NUESTRO CAFÉ!</span>
            <p>A continuación, encontrarás nuestros productos de Café Colombiano. Agrégalos a tu carrito y no te quedes sin probarlos!</p>
        </section>

<div id="loginPopup" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-head" style="padding: 20px 16px;">
      <span id="buying" class="close">&times;</span>
      <h2 style="none">#MODALHEADER#</h2>
    </div>
    <div class="modal-body">
      #POPUP#
    </div>
    <div class="modal-footer" style="padding: 20px 16px;">
      <h3>#MODALFOOTER#</h3>
    </div>
  </div>
</div>

 	#MODALCOFFEES#

        <div class="containerRight">

            <div class="search-box">
                <div class="searchform">
                    <input id="s" type="text" value="Buscar"/>
                    <div class="close">
                        <span class="front"></span>
                        <span class="back"></span>
                    </div>
                </div>
            </div>

            <div class="wrapper">

                <div class="cart">
                    <div class="shopping-cart">
                        <h1>Mi Carrito</h1>
                        <header>
                            <i class="fa fa-shopping-cart icon"></i><span class="badge">#NUM_ITEMS#</span>
                            <total>
                                <span>Total: $#TOTAL#</span>
                            </total>
                        </header> <!--fin header -->

                        <div class="items">
                            <ul>
                                #CARRITO#
                            </ul>
                        </div>

                        <button><a id="buy">Comprar</a> <i class="fa fa-shopping-cart"></i> </button>
                        <button><a href="index.php?action=emptyCart">Vaciar Carrito</a> <i class="fa fa-trash-o"></i> </button>

                    </div> <!--end shopping-cart -->
                </div>

                <div class="filter">
                    <div class="filters">
                        <h1>Filtrar</h1>
                        <h2>Tipo</h2>
			<a href="index.php?action=filterCoffee&id=all"><h3>Todos</h3></a>
                        <a href="index.php?action=filterCoffee&id=ground"><h3>Molido</h3></a>
                        <a href="index.php?action=filterCoffee&id=beans"><h3>En Grano</h3></a>
                    </div>
                </div>
            </div>

        </div> <!--fin de containerRight-->

        <div class="containerCenter">


            <!--Primeros Productos-->
            <ul class="catCardList">


                    #CAFES#


            </ul>

        </div> <!--fin de containerCenter-->

    </div> <!--fin de bodyHome-->
    
    

</body>

<script>

    jQuery('.quantity').each(function() {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

        btnUp.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });

var modal = document.getElementById('loginPopup');

var span = document.getElementById('buying');

var btn = document.getElementById('buy');

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var btn3 = document.getElementById('purchase');

btn3.onclick = function() {
    modal.style.display = "none";
}


var span_;
var product;

function showInfo(m,c){
 product = document.getElementById(m);
 product.style.display = "block";
 span_ = document.getElementById(c);
 span_.onclick = function() {
    product.style.display = "none";
 }
 window.onclick = function(event) {
    if (event.target == product) {
        product.style.display = "none";
    }
}
}   

</script>
</html>


