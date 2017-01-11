<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>VCO - Iniciar Sesión</title>
  <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/login.css">

  
</head>

<body>

  <form class="login" name="loginForm" id="loginForm" action="index.php?action=login" method="post" >
  
  <fieldset>
    
    <legend class="legend">Iniciar Sesión </legend>
    
    <div class="input">
      <input type="userName" name="username" id="username" placeholder="Nombre de Usuario" required />
      <span><i class="fa fa-envelope-o"></i></span>
    </div>
    
    <div class="input">
      <input type="password" name="password" id="password" placeholder="Contraseña" required />
      <span><i class="fa fa-lock"></i></span>
    </div>
    
     <button method="POST" type="submit" class="submit" name="login" id="login"><i class="fa fa-long-arrow-right"></i></button>
    
  </fieldset>
  
  
  
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

   

</body>
</html>
