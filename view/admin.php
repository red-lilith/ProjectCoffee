<html>
<head>
    <meta charset="UTF-8">
    <title>VCO - Administrador</title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />

  <script src="js/login.js"></script>
  
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="css/manager.css">
   <link rel="stylesheet" href="css/statistics.css">
   <link rel="stylesheet" href="css/popUp.css">

   <link id="cofee_Reg" href="coffeeRegister.html" rel="import"/>

</head>

<body>
#OPCIONES#

<div class="bodyHome">
<section>
  <span style="text-align: left;font-size:30px;cursor:pointer" onclick="openNav()">&#9776; MENU</span>
    <p>Usted ha iniciado sesión como Administrador. Despliegue el menú para más opciones.</p><?php echo $tsArray ?>
  </section>

#MODALCOFFEES#

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#" onclick=showTable("regCoffee") >Registrar Café</a>
  <a href="#" onclick=showTable("regArticle") >Registrar Artículo</a>
  <a href="#" onclick=showTable("regProducer") >Registrar Productor</a>
  <a href="#" onclick=showTable("pos_Sales")>Posibles Ventas</a>
  <a href="#" onclick=showTable("statistic") >Estadísticas/Ventas</a>
  <a href="#" onclick="openConsult()">Cosultar</a>
<ul id="consult" style="display:none;">
    <li><a href="#" onclick=showTable("newCoffees")>Cafés Nuevos</a></li>
    <li><a href="#" onclick=showTable("tradCoffees")>Cafés Tradicionales</a></li>
    <li><a href="#" onclick=showTable("prod")>Nuevos Productores</a></li>
    <li><a href="#" onclick=showTable("releases")>Lanzamientos</a></li>
  </ul>
</div>

<div class="ContainerRight">

<form id="regCoffee" name="regCoffee" style="display:none;" action="index.php?action=saveCoffee" method="POST" class="register"> 
    <h1>Registar Marca de Café</h1>
  <fieldset>

   <div class="input">
      <tr><td>          
        <input type="text" name="nameCoffee" id="nameCoffee" class="input" size="32" value="" placeholder="Nombre" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="text" name="lineCoffee" id="lineCoffee" class="input" size="32" value="" placeholder="Variedad" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="text" name="photoCoffee" id="photoCoffee" class="input" size="32" value="" placeholder="URL de la imagen" required/>
        <span><i class="fa fa-picture-o"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="number" name="priceCoffee" id="priceCoffee" class="input" size="32" value="" placeholder="Precio" required/>
        <span><i class="fa fa-money"></i></span>
      </td></tr>
    </div>  
   <div class="input">
      <tr><td>          
        <input type="number" name="quantityCoffee" id="quantityCoffee" class="input" size="32" value="" placeholder="Cantidades disponibles"required/>
        <span><i class="fa fa-asterisk" aria-hidden="true"></i></span>
      </td></tr>
    </div>  
   <div class="input">
      <tr><td>          
        <input type="date" name="releaseCoffee" id="releaseCoffee" class="input" size="32" value="" placeholder="Fecha de Lanzamiento" required/>
        <span><i class="fa fa-calendar"></i></span>
      </td></tr>
    </div>
<div class="styled-select">
	<tr><td>
      <select name = "typeCoffee" id="typeCoffee">
	<option value="en grano">En grano</option>
	<option value="molido">Molido</option>
      </select>
	</tr></td>
    </div>
<div class="styled-select">
	<tr><td>
      <select name = "catCoffee" id="catCoffee">
	<option value="Tradicional">Tradicional</option>
	<option value="Nuevo">Nuevo</option>
      </select>
	</tr></td>
    </div>
<div class="styled-select">
	<tr><td>
      <select name = "originCoffee" id="originCoffee">
	<option value="Exótico">Exótico</option>
	<option value="Regional">Regional</option>
	<option value="Orgánico">Orgánico</option>
	<option value="Especial">Especial</option>
      </select>
	</tr></td>
    </div>
<div class="styled-select">
	<tr><td>
      <select name = "producerCoffee" id="producerCoffee">
		#PRODUCTORES#
      </select>
	</tr></td>
    </div>
    <tr><td>
	<button method="POST" type="submit" class="submit" name="saveCoffee" id="saveCoffee"><i class="fa fa-long-arrow-right" value="registrarCafe"></i></button>
</tr></td>  
  </fieldset> 
</form>

<form id="regArticle" name="regArticle" style="display:none;" action="index.php?action=saveArticle" method="POST" class="register"> 
    <h1>Registar Artículo</h1>
  <fieldset>

   <div class="input">
      <tr><td>          
        <input type="text" name="nameArticle" id="nameArticle" class="input" size="32" value="" placeholder="Nombre" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="text" name="descripArticle" id="descripArticle" class="input" size="32" value="" placeholder="Descripción" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="text" name="photoArticle" id="photoArticle" class="input" size="32" value="" placeholder="URL de la imagen" required/>
        <span><i class="fa fa-picture-o"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="number" name="priceArticle" id="priceArticle" class="input" size="32" value="" placeholder="Precio" required/>
        <span><i class="fa fa-money"></i></span>
      </td></tr>
    </div>  
   <div class="input">
      <tr><td>          
        <input type="number" name="quantityArticle" id="quantityArticle" class="input" size="32" value="" placeholder="Cantidades disponibles"required/>
        <span><i class="fa fa-asterisk" aria-hidden="true"></i></span>
      </td></tr>
    </div>  
    <tr><td>
	<button method="POST" type="submit" class="submit" name="saveArticle" id="saveArticle"><i class="fa fa-long-arrow-right" value="registrarCafe"></i></button>
</tr></td>  
  </fieldset> 
</form>

<form id="regProducer" name="regProducer" style="display:none;" action="index.php?action=saveProducer" method="POST" class="register"> 
    <h1>Registar Productor</h1>
  <fieldset>
   <div class="input">
      <tr><td>          
        <input type="text" name="nitProducer" id="nitProducer" class="input" size="32" value="" placeholder="Nit" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
   <div class="input">
      <tr><td>          
        <input type="text" name="companyProducer" id="companyProducer" class="input" size="32" value="" placeholder="Nombre de Compañia" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>  
   <div class="input">
      <tr><td>          
        <input type="text" name="estateProducer" id="estateProducer" class="input" size="32" value="" placeholder="Finca" required/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
<div class="input">
      <tr><td>
        <input type="email" name="emailProducer" id="emailProducer" class="input" value="" size="32"  placeholder="E-mail" required />
        <span><i class="fa fa-envelope-o"></i></span>
      </td></tr>
    </div>
<div class="styled-select">
	<tr><td>
      <select name = "experienceProducer" id="experienceProducer">
	<option value="1 Año o Menos">1 Año o Menos</option>
	<option value="2-5 Años">2-5 Años</option>
	<option value="6-9 Años">6-9 Años</option>
	<option value="10 o Más">10 o Más</option>
      </select>
	</tr></td>
    </div>
    <tr><td>
	<button method="POST" type="submit" class="submit" name="saveProducer" id="saveProducer"><i class="fa fa-long-arrow-right" value="registrarProductor"></i></button>
</tr></td>  
  </fieldset> 
</form>

<div class="list" style="display:none;" id="pos_Sales">
       <h1>Posibles Ventas de Café <i class="fa fa-coffee"></i></h1>
	<header><total><span style="align: center;">Estos son los Cafés que los clientes desean adquirir</span></total></header>
        <ul>
         #POSVENTAS#
	</ul>                   
</div>

<div id="statistic" style="display:none;">
<div class="stage">
  <div class="table">
    <h1>Ventas Mensuales - 2017</h1>
    <table>
      <tr>
        <th>50</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <tr>
        <th>40</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <tr>
        <th>30</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <tr>
        <th>20</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <tr>
        <th>10</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <tr>
        <th></th>
        <th style="font-size: 12px; padding-left: 48px;">ENE/FEB</th>
        <th style="font-size: 12px; padding-left: 18px;">MAR/ABR</th>
        <th style="font-size: 12px; padding-left: 18px;">MAY/JUN</th>
        <th style="font-size: 12px; padding-left: 18px;">JUL/AGO</th>
        <th style="font-size: 12px; padding-left: 18px;">SEP/OCT</th>
        <th style="font-size: 12px; padding-left: 18px;">NOV/DIC</th>
      </tr>
    </table>

<div class="chart">
	#COLUMNAS#
  </div>
  </div>

</div> 

<div class="stage">
<div class="table">
<h1>Estadísticas Generales</h1>

<div class="statbox" style="color:#E6293C">
  <div class="number">#TOTALCAFES#</div>
  <div class="type" style="color:#F26F7D">Cafés Vendidos
  <div class="details" style="color:#E6293C">Totales</div></div>
  </div>

<div class="statbox" style="color:#F4733D">
  <div class="number">#TOTALARTICULOS#</div>
  <div class="type" style="color:#FAB669">Artículos Vendidos
  <div class="details" style="color:#F4733D">Totales</div></div>
  </div>

<div class="statbox" style="color:#F1F73E">
  <div class="number">#TOTALPOSVENTAS#</div>
  <div class="type" style="color:#F4F799">Posibles Ventas
  <div class="details" style="color:#F1F73E">Café/Accesorios</div></div>
  </div>

<div class="statbox" style="color:#42C91C">
  <div class="number">#TOTALCOMENTARIOS#</div>
  <div class="type" style="color:#8AF26D">Comentarios/Preguntas</div>
  </div>

</div>
</div>

</div> <!--fin statistics-->

<div class="list" style="display:none;" id="newCoffees">
       <h1>Café Nuevo <i class="fa fa-coffee"></i></h1>
	<header><total><span style="align: center;">Estos son los Cafés clasificados como "Nuevos"</span></total></header>
        <ul>
         #NUEVOS#
	</ul>                   
</div>

<div class="list" style="display:none;" id="tradCoffees">
       <h1>Café Tradicional <i class="fa fa-coffee"></i></h1>
	<header><total><span style="align: center;">Estos son los Cafés clasificados como "Tradicionales"</span></total></header>
        <ul>
         #TRADICIONALES#
	</ul>                   
</div>

<div class="list" style="display:none;" id="prod">
       <h1>Productores <i class="fa fa-fire" aria-hidden="true"></i></h1>
	<header><total><span style="align: center;">Estos son todos los productores registrados</span></total></header>
        <ul>
         #PRODUCTOR_LISTA#
	</ul>                   
</div>

<div class="list" style="display:none;" id="releases">
       <h1>Próximos Lanzamientos <i class="fa fa-coffee"></i></h1>
	<header><total><span style="align: center;">Estos son los próximos lanzamientos de Café</span></total></header>
        <ul>
         #LANZAMIENTOS#
	</ul>                   
</div>

</div> <!--fin containerRight-->




</div> 

</div>
</body>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "19%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function openConsult() {
    document.getElementById("consult").style.display = 'block';
}

function showTable(name) {
    document.getElementById("regCoffee").style.display = 'none';
    document.getElementById("regArticle").style.display = 'none';
    document.getElementById("regProducer").style.display = 'none';
    document.getElementById("pos_Sales").style.display = 'none';
    document.getElementById("statistic").style.display = 'none';
    document.getElementById("newCoffees").style.display = 'none';
    document.getElementById("tradCoffees").style.display = 'none';
    document.getElementById("releases").style.display = 'none';
    document.getElementById("prod").style.display = 'none';
    document.getElementById(name).style.display = 'table';
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

