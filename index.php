<?php
	$nom = $Prenom = $email = $Age = "";

	$nameErr="";
	$emailErr="";
	$AgeErr="";
	$passwordErr="";
	$confPasswordErr="";	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nom = traiter_input($_POST['Nom']);
		$Prenom = traiter_input($_POST['Prenom']);
		$email = traiter_input($_POST['email']);
		$Age = traiter_input($_POST['Age']);
		$password = traiter_input($_POST['passeword']);
		$ConfPass = traiter_input($_POST['ConfirmationPassword']);

		if (empty($nom)) {
			$nameErr = "obligatoire";
		} 
		
		if (empty($email)) {
			$emailErr = "obligatoire";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "format d'email invalide";
		}

		$age_sql = 0;
		if (empty($Age)) {
    		$age_sql = 0;}
		elseif(is_numeric($Age)){
			$age_sql = (int)$Age;
			$AgeErr = "";		
		}
		else{
			$AgeErr = "* l'âge doit être un nombre";
		}
	
		if(empty($password)){
			$passwordErr="obligatoire";
		}elseif (strlen($password) < 6) {
			$passwordErr="Minimum 6 caractères";
		}
		else{
			if(trim($password) !== trim($ConfPass)){
				$confPasswordErr="* le mot de passe ne correspondent pas";
			}
		}

		require_once 'db.php';

		$sql_verif=mysqli_query($con,"SELECT id FROM client WHERE email = '$email'");

		if (mysqli_num_rows($sql_verif) > 0){
			$message="Désolé, vous avez déjà un compte avec cet email";
		}
		else { 
			if (empty($nameErr) && empty($emailErr) && empty($AgeErr) && empty($passwordErr) && empty($confPasswordErr)) {
				$sql_inser="INSERT INTO client (nom, prenom, email,age) VALUES ('$nom', '$Prenom', '$email', $age_sql)";					
				if (mysqli_query($con,$sql_inser)) {
					$infos = array("nom" => $nom, "prenom" => $Prenom, "email" => $email);
					$donnees_preparees = urlencode(serialize($infos));
					header("Location: redirection.php?data=" . $donnees_preparees);
					exit();
				} else {
					$message = "Erreur : " . mysqli_error($con);
				}
			}
			
		}

		mysqli_close($con);
	}
	function traiter_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title> TP3 Formulaire </title>
	<style>
		* {
			box-sizing: border-box;
		}

		.form-container {
			width: 100%;         
			max-width: 500px;    
			margin: 50px auto; 
			border: 1px solid rgb(0, 110, 255); 
			font-family: Arial, sans-serif; 
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			padding: 30px;   
		}

		body {
			background-color: #f0f2f5;
			display: flex;
			justify-content: center;
		}

		.ligne-container {
			width: 100%;
			display: flex;
			margin-bottom: 10px;
		}

		.ligne {
			width: 30%;
			align-items: center;
			flex-shrink: 0;
		}

		.etoile {
			color: red;
		}

		.error {
			color: red;
			font-size: 10px;
			width: 25%;
		}

		.division{
			width: 45%;      
    		flex-shrink: 0;
		}
		
		.division input{
			width: 100%;  
			height: 40px;
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 4px;    
		}

		.suscribe {
			background-color: rgb(0, 110, 255);
			color: white;
			border-radius: 8px;
			font-size: 18px;
			font-weight: bold;
			border: none;
			cursor: pointer;
			width: 100%;
			margin: 10px;
			transition: opacity 0.15s;
		}

		.suscribe:hover {
			opacity: 0.9;
		}

		.suscribe:active {
			opacity: 0.5;
		}

		.message_confirmation{
			margin-top: 20px; 
			padding: 10px;
			color: red;
		}
		/*responsive*/
		@media (max-width: 600px) {
			nav,main {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<div class="form-container">
		<section class="formulaire">
		
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="formulaire">
				<h1>Formulaire d'inscription au cours de PWEB</h1>
				<p>Ce formulaire est conçu dans le cadre du TP de cours de Programmation Web ISILA.
					Remplissez toutes les cases possibles.
				</p>
				<p>
					Les champs marqués par <span class="etoile">*</span> sont <strong>obligatoires</strong>.
				</p>

				<div class="ligne-container">
					<div class="ligne">
						<label for="Nom">Nom : </label>
					</div>
					<div class="division">
						<input type="text" id="Nom" placeholder="Saisissez votre nom" name="Nom" autocomplete="off" value=<?php echo $nom?>>
					</div>
					<div class="error">
						<span id="messageErreurNom" style="color:red;">*<?php echo $nameErr;?></span>
					</div>
				</div>

				<div class="ligne-container">
					<div class="ligne">
						<label for="Prenom">Prénom: </label>
					</div>
					<div class="division">
						<input type="text" id="Prenom" name="Prenom" placeholder="Saisissez votre prenom" autocomplete="off" value=<?php echo $Prenom?>>
					</div>
					<div class="error">
						<span></span>
					</div>
				</div>

				<div class="ligne-container">
					<div class="ligne">
						<label for="email">email : </label>
					</div>
					<div class="division">
						<input type="text" id="email" name="email" placeholder="Saisissez votre email"
							autocorrect="off" value=<?php echo $email?>>
					</div>
					<div class="error">
						<span style="color:red;">*<?php echo $emailErr;?></span>
					</div>
				</div>

				<div class="ligne-container">
					<div class="ligne">
						<label for="Age">Âge : </label>
					</div>
					<div class="division">
						<input type="text" id="Age" name="Age" placeholder="Saisissez votre âge" autocomplete="off" value=<?php echo $Age?>>
					</div>
					<div class="error">
						<span id="messageErreurAge"><?php echo $AgeErr;?></span>
					</div>
				</div>

				<div class="ligne-container">
					<div class="ligne">
						<label for="motDePasse">Mot de passe :</label>
					</div>
					<div class="division">
						<input type="password" id="motDePasse" name="passeword"
							placeholder="Saisissez votre mot de passe" autocorrect="off">
					</div>
					<div class="error">
						<span id="messageErreurPassword">*<?php echo $passwordErr;?></span>
					</div>
				</div>

				<div class="ligne-container">
					<div class="ligne">
						<label for="ConfirmationMotDePasse">Confirmez :</label>
					</div>
					<div class="division">
						<input type="password" id="ConfirmationMotDePasse" name="ConfirmationPassword"
							placeholder="Confirmez votre mot de passe" autocorect="off">
					</div>
					<div class="error">
						<span id="messageErreurConfirmPassword"><?php echo $confPasswordErr;?></span>
					</div>
				</div>

				<input type="submit" class="suscribe" value="Envoyer" id="registrationForm">
				<?php 
					if (!empty($message)) {
						echo '<div class="message_confirmation">';
						echo '<p>' . $message . '</p>';
						echo '</div>';
					}
				?>

			</form>
		</section>
	</div>

	<script>
		/*
			Le code javascript
		*/
	</script>
	
</body>

</html>