<?php
	$conn = connexion();
?>

<form method="post" action="gestion_batiment.php?page=3">
	<p>
		<table>
			<tr>
				<td>
					Nom :
				</td>
				<td>
					<input type="text" name="nom" maxlength="50" required /><br />
				</td>
			</tr>
			<tr>
				<td>
					Sujet :
				</td>
				<td>
					<input type="text" Sujet="type_actionneur" maxlength="500" required /><br />
				</td>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="checkForm" value="votre demande">
					<input type="submit" value="Envoyer la demande">
				</td>
			</tr>
		</table>
	</p>
</form>
