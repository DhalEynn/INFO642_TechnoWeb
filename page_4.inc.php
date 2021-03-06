<?php
	if (isConnected())
	{
		$conn = connexion();
		if(isset($_POST["checkForm"]))
		{
			unset($_POST["checkForm"]);
			// Prepare the query.
			$sql = $conn->prepare ("SELECT * FROM `demandes` WHERE idDem = ?");
			// Execute the query.
			$sql->execute(array($_POST["idDem"]));

			if($array = $sql->fetch(PDO::FETCH_ASSOC))
			{
				echo "<table style=\"width=auto;\">";

					echo "<tr>";
						echo "<td>";
							echo "id:";
						echo "</td><td>";
							echo $array["idDem"];
						echo "</td>";
					echo "</tr>";

					echo "<tr class=\"color2\">";
						echo "<td>";
							echo "Sujet:";
						echo "</td><td>";
							echo $array["sujet"];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "Contenu:";
						echo "</td><td>";
							echo $array["contenu"];
						echo "</td>";
					echo "</tr>";

					echo "<tr class=\"color2\">";
						echo "<td>";
							echo "Date de création:";
						echo "</td><td>";
							echo $array["dateCreation"];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "Date d'expiration:";
						echo "</td><td>";
							echo $array["dateExpiration"];
						echo "</td>";
					echo "</tr>";

					echo "<tr class=\"color2\">";
						echo "<td>";
							echo "Mail Etudiant:";
						echo "</td><td>";
							echo $array["mailEtu"];
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td>";
							echo "Mail Professeur:";
						echo "</td><td>";
							echo $array["mailProf"];
						echo "</td>";
					echo "</tr>";

					echo "<tr class=\"color2\">";
						echo "<td>";
							echo "Status:";
						echo "</td><td>";
							echo $array["status"];
						echo "</td>";
					echo "</tr>";

				echo "</table>";
				echo "<a href=\"?page=4\">Retour</a>";
			}
		}
		else
		{
			if(isEtudiant())
			{
				$sql = $conn->prepare ("SELECT idDem, sujet, dateCreation, dateExpiration, mailProf as mailPers, status FROM `demandes` WHERE mailEtu = ? AND status NOT LIKE \"Archive\"");
				$sql->execute(array($_SESSION["mail"]));
			}
			elseif(isProfesseur())
			{
				$sql = $conn->prepare ("SELECT idDem, sujet, dateCreation, dateExpiration, mailEtu as mailPers, status FROM `demandes` WHERE mailProf = ? AND status NOT LIKE \"Archive\"");
				$sql->execute(array($_SESSION["mail"]));
			}
			else
			{
				$sql = $conn->prepare ("SELECT idDem, sujet, dateCreation, dateExpiration, mailProf as mailPers, status FROM `demandes` WHERE status NOT LIKE \"Archive\"");
				$sql->execute(array());
			}

			if (is_null($sql) || $sql->rowCount() == 0)
			{
				echo "</br>Vous n'avez aucune demande en cours.";
			}
			else
			{
			?>
			<table>
				<tr class="presentation">
					<td class="idDem">
						<center>id :</center>
					</td>
					<td class="sujetDem">
						<center>Sujet :</center>
					</td>
					<td class="mailDem">
						<center>
							<?php
								if (isProfesseur())
								{
									echo "Etudiant :";
								}
								else
								{
									echo "Référent :";
								}
							?>
						</center>
					</td>
					<td class="dateDem">
						<center>Création :</center>
					</td>
					<td class="dateDem">
						<center>Expiration :</center>
					</td>
					<td class="statusDem">
						<center>Status :</center>
					</td>
				</tr>
				<!-- Ecarte le nom des colonnes du contenu des colonnes resultat -->
				<tr class="ecarteColonne"></tr> <!-- Ce n'est pas un bug, c'est une feature... -->
				<form method="post" action="projet.php?page=4">
					<input type="hidden" name="checkForm" value="formulaire" /></br>
					<?php
						$i = 0;
						while($array = $sql->fetch(PDO::FETCH_ASSOC))
						{
							if ($i % 2 != 0)
							{
								echo "<tr class=\"color2\">";
							}
							else {
								echo "<tr>";
							}
							?>
								<td class="idDem">
									<input type="submit" name="idDem" value="<?php echo $array["idDem"] ?>" />
								</td>
								<td class="sujetDem">
									<center>
										<?php
											echo $array["sujet"];
										?>
									</center>
								</td>
								<td class="mailDem">
									<center>
		  							<?php
		  								echo $array["mailPers"];
		  							?>
		              </center>
								</td>
								<td class="dateDem">
									<center>
										<?php
											echo $array["dateCreation"];
										?>
									</center>
								</td>
								<td class="dateDem">
									<center>
										<?php
											echo $array["dateExpiration"];
										?>
									</center>
								</td>
								<td class="statusDem">
									<center>
		  							<?php
		  								echo $array["status"];
		  							?>
		              </center>
								</td>
							</tr>
							<?php
							$i = $i + 1;
						}
					?>
				</form>
			</table>
			<?php
			}
		}
	}
	else
	{
		header("refresh:0;url=projet.php");
		die(0);
	}
?>
