<form method="post" action="projet.php?page=3">
	<p>
		<table>
			<tr>
				<td>
					<center>
						Nom :
					</center>
				</td>
				<td>
					<input type="text" name="nom" maxlength="10" required /><br />
				</td>
			</tr>
			<tr>
				<td>
					<center>
					Mail : 
					</center>
				</td>
				<td>
					<input type="text" name="mail" maxlength="30" required /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" id="etudiant" name="fonction" value="etudiant" checked />
					<label for="etudiant">Etudiant</label>
				</td>
				<td>
					<input type="radio" id="professeur" name="fonction" value="professeur" />
					<label for="professeur">Professeur</label>
					<input type="radio" id="ST" name="fonction" value="ST" />
					<label for="ST">Service technique</label>
				</td>
			</tr>
			<!--
			<tr>
				<td>
					mot de passe : 
				</td>
			
				<td>
					<input type="passeword" name="mot_de_passe" maxlength="50" /><br />
				</td>
			</tr>
			-->
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