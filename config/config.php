<?php

	class basedatos
	{

		function conectar ($host,$port,$db,$user,$pass)
		{
			$connect = pg_connect("host = $host port = $port dbname = $db user = $user password = $pass");
			if(!$connect)
			{
				echo "error ¡¡¡ SERVIDOR NO RESPONDE !!!";
				exit;
			}
			

			
		}
	}

?>