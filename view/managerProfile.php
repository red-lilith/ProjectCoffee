<html>
<head>
  <meta charset="UTF-8">
  <title>VCO - Registro</title>
    <script src="js/register.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/register.css">
  
</head>
<body>
  <div>
<b><?php  if (isset($messageSaveM)){echo $messageSaveM; }  ?></b>
</div>
<form class="login"  name="profileManagerForm" id="profileManagerForm" action="index.php?action=updateManagerP" method="post">

  <fieldset>    
    <legend class="legend">
      Perfil :  <?php if (isset($tsArray)){echo $tsArray; }   ?>
    </legend>
    

    <div class="input">
      <tr><td>          
        <input type="text" name="nameManager" id="nameManager" class="input" size="32" value='<?php echo $response[1] ?>' placeholder="Nombres" required  />
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>

    <div class="input">
      <tr><td>          
        <input type="text" name="lastNameManager" id="lastNameManager" class="input" size="32" value='<?php echo $response[2] ?>' placeholder="Apellidos" required  />
        <span><i class="fa fa-pencil fa-fw"></i></span>
      </td></tr>
    </div>
    <div class="input">
      <tr><td>
        <input type="email" name="userManager" id="userManager" class="input" size="32" value='<?php echo $_SESSION["session_username"] ?>'  placeholder="Usuario" required  />
        <span><i class="fa fa-envelope-o"></i></span>
      </td></tr>
    </div>

    <div class="input">
      <tr><td>
        <input type="password" name="passwordManager" id="passwordManager" class="input" value="" size="32" placeholder="Contraseña Antigua" required  />
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>

    <div class="input">
      <tr><td>
        <input type="password" name="passwordManagerN" id="passwordManagerN" class="input" value="" size="32" placeholder="Contraseña Nueva" required  />
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>

    <div class="input">
      <tr><td>
        <input type="password" name="passwordManagerR" id="passwordManagerR" class="input" value="" size="32" placeholder="Digita nuevamente la contraseña" required  />
        <span><i class="fa fa-lock"></i></span>
      </td></tr>
    </div>

     <tr><td>
          <button method="POST" type="submit" class="submit" name="updateManagerP" id="updateManagerP"><i class="fa fa-long-arrow-right" value="Guardar"></i></button>
        </tr></td>
  </fieldset>
      
  <div class="feedback">
    Registro Exitoso. <br />
    Redireccionando...
  </div>
</form>
  



</body>
</html>
