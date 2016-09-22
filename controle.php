<?php
//var_dump($_POST);
	if(isset($_POST['login']) && isset($_POST['pass'])){ /* Vérification de l'envoie */

		$login = $_POST['login'];
		$pass = $_POST['pass'];
		
		require('connexion/Database.php');
		
		if($_POST['type'] == "prof"){ /* Vérification de la qualification du compte */
				$PDO = new connexion();
				$req="SELECT * FROM Professeur WHERE identifiant = :identifiant AND mdp = :mdp";
				$tableau=array('identifiant'=>$login,
								'mdp' =>$pass 	
									);
									//print_r($tableau);
				$verif = $PDO->selectClause($req,$tableau);
			

    			if ($verif){
    				var_dump($verif, $verif = null);
        			
				}

    			else { header('location: index.php?mes=mdp');}
			//var_dump($verif);
			}elseif($_POST['type'] == "admin"){
			
			}else{
				echo "<script>alert('Ne modifie pas le code petit malin!');
				document.location.href='index.php';</script>";
			}
	}else{
		header('location: index.php');
	}
?>