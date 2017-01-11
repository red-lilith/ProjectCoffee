<html>
<head>
    <meta charset="UTF-8">
    <title>VCO - Perfil</title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="//www.powr.io/powr.js" external-type="html"></script> 
 
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/client.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="css/suscription.css">
   <link rel="stylesheet" href="css/popUp.css">

</head>

<body>
#OPCIONES#
<div class="bodyHome" style="height: 120%;">
<section>
  <span style="text-align: left;font-size:30px;cursor:pointer">&#9776; PERFIL</span>
    <p>Bienvenido a tu perfil #NOMBRE#!!!<br>Selecciona una opción </p> <?php echo $tsArray ?>
  </section>

#MODALCOFFEES#

<div id="mySidenav" style="top: 20%; width:18%; height: 70%;" class="sidenav">
  <a href="javascript:void(0)" onclick=show("editProfile") >Editar Perfil</a>
  <a href="javascript:void(0)" onclick="openSubs()">Suscripción</a>
  <ul id="subs" style="display:none;">
    <li><a href="javascript:void(0)" onclick=show("sub_1")>La Probadita</a></li>
    <li><a href="javascript:void(0)" onclick=show("sub_2")>CPC - Mensual</a></li>
    <li><a href="javascript:void(0)" onclick=show("sub_3")>CPC - Quincenal</a></li>
    <li><a href="javascript:void(0)" onclick=show("sub_4")>CPC - Semanal</a></li>
  </ul>
  <a href="javascript:void(0)" onclick=show("wishlist") >Cafés por Probar</a>
  <a href="javascript:void(0)" onclick=show("myCoffees") >Cafés Probados</a>
  <a href="javascript:void(0)" onclick=show("password") >Cambiar Contraseña</a>
</div>

<div class="ContainerRight">

<form id="editProfile" name="editProfile" style="display:none;" action="index.php?action=saveProfile" method="POST" class="register"> 
    <h1>Editar Perfil</h1>
  <fieldset>
  
   <div class="input">
      <tr><td>          
        <input type="text" name="nameUsers" id="nameUsers" class="input" size="32" value="" placeholder="Nombres"/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
    <div class="input">
      <tr><td>
        <input type="text" name="lastNameUsers" id="lastNameUsers" class="input" size="32" value=""  placeholder="Apellidos"/>
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
<div class="input">
      <tr><td>
        <input type="email" name="email" id="email" class="input" value="" size="32"  placeholder="E-mail" />
        <span><i class="fa fa-envelope-o"></i></span>
      </td></tr>
    </div> 
<div class="input">
      <tr><td>
        <input type="text" name="address" id="address" class="input" value="" size="32"  placeholder="Domicilio" />
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div> 
       <div class="styled-select">
	<tr><td>
      <select name = "department" id="department">
	#DEPARTAMENTO#
      </select>
	</tr></td>
    </div>
       <div class="styled-select">
	<tr><td>
      <select name = "city" id="city">
	#CIUDAD#
      </select>
	</tr></td>
    </div>
<textarea rows="4" cols="50" name="likes" id="likes" form="editProfile">
Gustos</textarea>

       <tr><td>
          <button method="POST" type="submit" class="submit" name="saveProfile" id="saveProfile"><i class="fa fa-long-arrow-right" value="ActualizarPerfil"></i></button>
        </tr></td>
  </fieldset> 
</form>

<form id="sub_1" style="display: none;" name="sub_1" action="" method="POST" class="register"> 
    <h1>La Probadita ($30.000)</h1>
<p style="color:#FFE4BA;"><b>Seleccione las características del Café</b></p>
  <fieldset>
      <b>ORIGEN</b><div class="styled-select">
	<tr><td>
      <select style="display:table; margin-left: 35%; margin-bottom: 4%" name = "myOrigin" id="myOrigin">
	<option value="Exótico">Exótico</option>
	<option value="Regional">Regional</option>
	<option value="Orgánico">Orgánico</option>
	<option value="Especial">Especial</option>
      </select>
	</tr></td>
    </div>
       <b>TIPO</b><div class="styled-select">
	<tr><td>
      <select style="display:table; margin-left: 35%; margin-bottom: 4%" name = "myType" id="myType">
	<option value="en grano">En grano</option>
	<option value="molido">Molido</option>
      </select>
	</tr></td>

       <tr><td>
          <button method="POST" type="submit" style="margin-bottom: 10px" class="sub" name="saveSub1" id="saveSub1">Enviar Selección</button>
        </tr></td>
	<div class="powr-paypal-button" id="64f884d8_1484087273576">
  </fieldset> 
</form>

<form id="sub_2" style="display: none;" name="" action="" class="register"> 
<h1>Café para la Casa - Mensual ($25.000)</h1>
    <div class="plan"> <div class="powr-paypal-button" id="1bf1201c_1484086672345"></div></div>
</form>

<form id="sub_3" style="display: none;" name="" action="" class="register"> 
<h1>Café para la Casa - Quincenal ($22.500)</h1>
    <div class="plan"> <div class="powr-paypal-button" id="9cae5ac1_1484087291445"></div></div>
</form>

<form id="sub_4" style="display: none;" name="" action="" class="register"> 
<h1>Café para la Casa - Semanal ($20.000)</h1>
    <div class="plan"> <div class="powr-paypal-button" id="4042f96e_1484087306076"></div></div>
</form>

	<div class="list" style="display:none;" id="wishlist">
                     <h1>Cafés por Probar <i class="fa fa-coffee"></i></h1>
			<header><total><span style="align: center;">Estos son los productos de café que deseas probar</span></total></header> 
                            <ul>
                                #XPROBAR#
                            </ul>                   
	</div>

<div class="list" style="display:none;" id="myCoffees">
                     <h1>Cafés Probados <i class="fa fa-coffee"></i></h1>
			<header><total><span style="align: center;">Estos son los productos de café que ya has probado</span></total></header> 
                            <ul>
                                #PROBADOS#
                            </ul>                   
                </div>


<form id="password" name="password" style="display:none;" action="index.php?action=changePassword" method="POST" class="register"> 
    <h1>Cambiar Contraseña</h1>
  <fieldset>
    <div class="input">
      <tr><td>
        <input type="password" name="old_password" id="old_password" class="input" value="" size="32" placeholder="Contraseña Antigua" required/>
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>
    <div class="input">
      <tr><td>
        <input type="password" name="new_password" id="new_password" class="input" value="" size="32" placeholder="Contraseña Nueva" required/>
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>
    <div class="input">
      <tr><td>
        <input type="password" name="new_password2" id="new_password2" class="input" value="" size="32" placeholder="Confirmar Contraseña Nueva" required/>
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>
 
       <tr><td>
          <button method="POST" type="submit" class="submit" name="changePassword" id="changePassword"><i class="fa fa-long-arrow-right" value="contrasena"></i></button>
        </tr></td>
  </fieldset> 
</form>

</div> <!--fin containerRight-->

</div> 
</body>

<script>

function openSubs() {
    document.getElementById("subs").style.display = 'block';
}


function show(name) {
    document.getElementById("editProfile").style.display = 'none';
    document.getElementById("wishlist").style.display = 'none';
    document.getElementById("myCoffees").style.display = 'none';
    document.getElementById("password").style.display = 'none';
    document.getElementById("sub_1").style.display = 'none';
    document.getElementById("sub_2").style.display = 'none';
    document.getElementById("sub_3").style.display = 'none';
    document.getElementById("sub_4").style.display = 'none';
    document.getElementById(name).style.display = 'table';
}


$("#department").change(function() {
  if ($(this).data('options') == undefined) {
    $(this).data('options', $('#city option').clone());
  }
  var id = $(this).val();
  var options = $(this).data('options').filter('[value1=' + id + ']');
  $('#city').html(options);
});

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

