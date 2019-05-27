<?php
	if (isConnected())
	{
		header("refresh:0;url=projet.php");
		die(0);
	}
	else
	{
		$conn = connexion();

		if(isset($_POST["checkForm"]))
		{
			unset($_POST["checkForm"]);
			if ($_POST["password"] != "" || strlen($_POST["password"]) > 50)
			{
				$except = ajoutUser ($_POST["mail"], $_POST["nom"], $_POST["password"], $_POST["travail"]);
				if (is_null($except))
				{
					$_SESSION["mail"] = $_POST["mail"];
					$_SESSION["nom"] = $_POST["nom"];
					$_SESSION["travail"] = $_POST["travail"];
					header("refresh:0;url=projet.php");
					die(0);
				}
				else
				{
					echo "Adresse mail déjà utilisée, veuillez réessayer avec une autre adresse mail.";
				}
			}
			else
			{
				echo "Vous n'avez pas entré un mot de passe valide, veuillez réessayer.";
			}
		}
		?>

		<form method="post" action="projet.php?page=signup">
			<p>
				<table>
					<tr>
						<td>
							<center>
							Mail :
							</center>
						</td>
						<td>
							<input type="email" name="mail" maxlength="60" placeholder="toto@titi.tata" required /><br />
						</td>
					</tr>
					<tr>
						<td>
							<center>
								Nom :
							</center>
						</td>
						<td>
							<input type="text" name="nom" maxlength="30" required /><br />
						</td>
					</tr>
					<tr>
					  <td>
					    Mot de passe :
					  </td>
					  <td>
					    <input type="passeword" name="password" maxlength="50" value="" placeholder="50 caractères max" required /><br />
					  </td>
					</tr>
					<tr>
						<td>
							<input type="radio" id="etudiant" name="travail" value="Etudiant" checked />
							<label for="etudiant">Etudiant</label>
						</td>
						<td>
							<input type="radio" id="professeur" name="travail" value="Professeur" />
							<label for="professeur">Professeur</label>
							<input type="radio" id="ST" name="travail" value="Service Technique" />
							<label for="ST">Service technique</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="checkForm" value="formulaire">
							<input type="submit" value="Connexion">
						</td>
					</tr>
				</table>
			</p>
		</form>

	<?php
	}
?>
