<?php
require 'db.php';

$response = $db->query('SELECT * FROM logement');
$logements = $response->fetchAll(PDO::FETCH_ASSOC);


include('partials/_header.php'); ?>

<div class="col-4">
	<a href="ajoutBien.php" class="btn btn-sm btn-secondary">
		Ajouter un bien
	</a>
</div>

<h1 class="col-md-12 text-center">Biens disponibles</h1>

<table class="table">
	<?php foreach ($logements as $logement) :

		if (strlen($logement['description']) > 250) {
			$texte = substr($logement['description'], 0, 250) . "...";
		} else {
			$texte = $logement['description'];
		}


		?>

		<tr>
			<th style="white-space: nowrap;">Titre</th>
			<th>Adresse</th>
			<th>Ville</th>
			<th>Type</th>
			<th>Code postal</th>
			<th>Surface</th>
			<th>Prix</th>
			<th>Description</th>
			<th>Photo</th>
			<th style="white-space: nowrap;">Détails</th>
		</tr>
		<tr>
			<td style="white-space: nowrap;"> <?= $logement['titre'] ?> </td>
			<td> <?= $logement['adresse'] ?> </td>
			<td> <?= $logement['ville'] ?> </td>
			<td> <?= $logement['type'] ?> </td>
			<td> <?= $logement['cp'] ?> </td>
			<td> <?= $logement['surface'] ?> </td>
			<td> <?= $logement['prix'] ?> </td>
			<td> <?= $texte ?> </td>
			<td><img class="w-50" src="photo/<?= $logement['photo'] ?>" alt="logement"></td>
			<td style="white-space: nowrap;"><a href="#?<?= $logement['id_logement']; ?>">Plus d'infos</a> </td>
		</tr>

	<?php endforeach; ?>
</table>
</div>
</div>
</div>

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>