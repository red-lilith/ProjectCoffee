<?php
	class logout{
		function logoutSession(){
			session_start();
			session_unset();
			session_destroy();
			
		}
	} 

?>