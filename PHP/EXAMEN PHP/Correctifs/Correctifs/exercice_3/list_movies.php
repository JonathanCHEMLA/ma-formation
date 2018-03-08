<?php

// On inclut les fichiers nécessaires
require_once 'inc/connect.php';

$query = $dbh->prepare('SELECT id_movie, title, director, year_of_prod FROM movies');
$query->execute();
$movies = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des films</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

	<h1>Liste des films</h1>

	<table>

		<thead>
			<tr>
				<th>Nom du film</th>
				<th>Producteur</th>
				<th>Année de production</th>
				<th>Détails</th>
			</tr>
		</thead>

		<tbody>
		<?php if(empty($movies)): // S'il n'y a pas de film ?>
			<tr>
				<td colspan="4" class="errors center">Aucun film correspondant</td>
			</tr>
		<?php else: ?>
			<?php foreach($movies as $movie): ?>
				<tr>
					<td><?=$movie['title'];?></td>
					<td><?=$movie['director'];?></td>
					<td><?=$movie['year_of_prod'];?></td>
					<td>
						<a href="view_movie.php?id_movie=<?=$movie['id_movie'];?>">Plus d'infos</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>

</body>
</html>