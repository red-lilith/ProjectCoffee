<!DOCTYPE html>
<head>
 <meta charset="UTF-8">
    <title>#TITLE#</title>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=EB+Garamond" />
    
  	<script src="js/login.js"></script>
  
   <link rel="stylesheet" href="css/products.css">
   <link rel="stylesheet" href="css/suscription.css">
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/socialMedia.css">
   <link rel="stylesheet" href="css/smallLogin.css">
   <link rel="stylesheet" href="css/search.css">
   <link rel="stylesheet" href="css/popUp.css">

</head>
<body>
			<div>
		#OPCIONES#
			</div>
		 #CONTENIDO# 
        
		
		
		<!-- end: contenido -->	
		

</body>
<script>
var modal = document.getElementById('loginPopup');

var span = document.getElementsByClassName("close")[0];

document.getElementById('sub1').onclick = function() {
    modal.style.display = "block";
}

document.getElementById('sub2').onclick = function() {
    modal.style.display = "block";
}

document.getElementById('sub3').onclick = function() {
    modal.style.display = "block";
}

document.getElementById('sub4').onclick = function() {
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

</script>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</html>
