<?php

$db = new PDO('mysql:host=localhost;dbname=cv_portfolio',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
				));
				
if ( $_POST ){

	if( !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['msg'])){

		$email = htmlspecialchars($_POST['email']);
		$objet = htmlspecialchars($_POST['objet'], ENT_QUOTES);
		$msg = htmlspecialchars($_POST['msg'], ENT_QUOTES);

		$req = $db->prepare("INSERT INTO messages VALUES (NULL,:email,:objet,:msg, NOW())");
		$req->execute(array( 'email'=> $email,
							 'objet'=> $objet,
							 'msg'=> $msg, ));
	}
}


?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>CV</title>
		<meta name="description" content="ma description"/>
		<meta name="keywords" content="mots-clefs, clés"/>
		<link rel="stylesheet" href="css/normalize.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Hind:300" rel="stylesheet">
	</head>
	<body>
		<!-- Présentation / Réalisation / Parcours / Contact -->
		<header>
			<div class="conteneur ligne">
				<div class="bloc40">
					<h1>Chloé</h1>
				</div>
				<nav class="bloc60">
					<a href="#link1">Présentation</a>
					<a href="#link2">Réalisations</a>
					<a href="#link3">Parcours</a>
					<a href="#link4">Contact</a>
				</nav>
			</div>
		</header>
		<section id="section1">
			<div id="link1"></div>
			<div class="conteneur ligne">
				<div class="bloc70">
					<h2>Présentation</h2>
				</div>
				<div class="bloc30">
					<h2>compétences</h2>
						<ul>
							<?php

							$competences = $db->query("SELECT * FROM competences");

							while ($competence = $competences->fetch(PDO::FETCH_ASSOC)){
							echo '<li><h3>'.$competence['titre'].'</h3>
								<div class="jauge_fond">
									<div class="jauge_couleur" style="background:'.$competence['couleur'].'; width:'.$competence['pourcentage'].'%;"></div>
								</div>
							</li>';}
							?>
							<!-- <li><h3>fezfzf</h3>
								<div class="jauge_fond">
									<div class="jauge_couleur" style="background: #87c6bf; width:20%;"></div>
								</div>
							<li><h3>feeeee</h3>
								<div class="jauge_fond">
									<div class="jauge_couleur" style="background: #87c6bf; width:70%;"></div>
								</div>
							</li> -->
							
						</ul>
				</div>
			<div class="bloc100">
				<h2>Mes langages favoris</h2>
				<?php

				$langages = $db->query("SELECT * FROM langages");

				while ( $langage = $langages->fetch(PDO::FETCH_ASSOC)){

				echo '<div class="bloc25">
					<img src="'.$langage['image'].'" alt="'.$langage['alternatif'].'">
				</div>';}
				?>
				<!-- <div class="bloc25">
					<img src="images/css.jpg">
				</div>
				<div class="bloc25">
					<img src="images/php.jpg">
				</div>
				<div class="bloc25">
					<img src="images/mysql.jpg">
				</div> -->
			</div>
			</div>
		</section>
		<section id="section2">
			<div id="link2"></div>
			<div class="conteneur ligne">
				<h2>Réalisations</h2>
				<?php

				$realisations = $db->query("SELECT * FROM realisation");

				while ( $realisation = $realisations->fetch(PDO::FETCH_ASSOC)){
				 echo '<div class="bloc33">
					<figure>
						<img src="'.$realisation['image'].'" alt="'.$realisation['alternatif'].'" />
						<figcaption>
							<h3><a href="">'.$realisation['legende'].'</a></h3>
						</figcaption>
					</figure>
				</div>';}
				?>
				<!-- <div class="bloc33">
					<figure>
						<img src="images/image2.jpg" alt="GG" />
						<figcaption>
							<h3><a href="">Ma légende</a></h3>
						</figcaption>
					</figure>
				</div>
				<div class="bloc33">
					<figure>
						<img src="images/image3.jpg" alt="GG" />
						<figcaption>
							<h3><a href="">Ma légende</a></h3>
						</figcaption>
					</figure>
				</div>
				<div class="bloc33">
					<figure>
						<img src="images/image4.jpg" alt="GG" />
						<figcaption>
							<h3><a href="">Ma légende</a></h3>
						</figcaption>
					</figure>
				</div>
				<div class="bloc33">
					<figure>
						<img src="images/image5.jpg" alt="GG" />
						<figcaption>
							<h3><a href="">Ma légende</a></h3>
						</figcaption>
					</figure>
				</div>
				<div class="bloc33">
					<figure>
						<img src="images/image6.jpg" alt="GG" />
						<figcaption>
							<h3><a href="">Ma légende</a></h3>
						</figcaption>
					</figure>
				</div> -->
			</div>
		</section>
		<section id="section3">
			<div id="link3"></div>
			<div class="conteneur ligne">
				<div class="bloc50">
					<h2>Expérience</h2>
					<?php

						$experiences = $db->query("SELECT * FROM experiences ORDER BY annee_fin DESC");

						while ( $experience = $experiences->fetch(PDO::FETCH_ASSOC)){

							$date_formatee= new DateTime($experience['annee_fin']);
							$annee_fin= $date_formatee->format('M Y');
							$date_formatee= new DateTime($experience['annee_debut']);
							$annee_debut= $date_formatee->format('M Y');

						echo '<table>
								<tr>
									<td class="year" rowspan="2">'.$annee_fin.'<p>'.$annee_debut.'</p></td>
									<td class="job">'.$experience['travail'].'</td>
								</tr>
								<tr>
									<td class="job_desc">'.$experience['descriptif'].'</td>
								</tr>
							</table>' ;}
					?>
						<!-- <table>
							<tr>
								<td class="year" rowspan="2">2008<p>2005</p></td>
								<td class="job">Webdesigner</td>
							</tr>
							<tr>
								<td class="job_desc">Descriptif du taff blz zj hzkhz jzkhejkizhei euaizehuziheuzaie azehuaiehu taff blz zj hzkhz jzkhejkizhei euaizehuziheuzaie azehuaiehu taff blz zj hzkhz jzkhejkizhei euaizehuziheuzaie azehuaiehu taff blz zj hzkhz jzkhejkizhei</td>
							</tr>
						</table> -->
				</div>
				<div class="bloc40 marge">
					<h2>Parcours</h2>
					<?php

						$parcours = $db->query("SELECT * FROM parcours ORDER BY annee_fin DESC");

						while ( $monparcours = $parcours->fetch(PDO::FETCH_ASSOC)){

							$date_formatee= new DateTime($monparcours['annee_fin']);
							$annee_fin= $date_formatee->format('M Y');
							$date_formatee= new DateTime($monparcours['annee_debut']);
							$annee_debut= $date_formatee->format('M Y');

						echo '<table>
								<tr>
									<td class="year" rowspan="2">'.$annee_fin.'<p>'.$annee_debut.'</p></td>
									<td class="job">'.$monparcours['formation'].'</td>
								</tr>
								<tr>
									<td class="job_desc">'.$monparcours['descriptif'].'</td>
								</tr>
							</table>' ;}
					?>
				</div>
			</div>
		</section>
		<section id="section4">
			<div id="link4"></div>
			<div class="conteneur ligne">
				<div class="bloc50">
					<h2>Coordonnées</h2>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3171.8424959042245!2d-85.3456294501879!3d37.3462373797408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8868723ac1b5b5bb%3A0xd9c962bbbd4574be!2s514-598+State+Hwy+289%2C+Campbellsville%2C+KY+42718%2C+%C3%89tats-Unis!5e0!3m2!1sfr!2sfr!4v1513093658418" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="bloc50">
					<h2>Contact</h2>
					<form method="post" action="#">
						<label for="monemail">Email</label>
						<input type="email" id="monemail" name="email" placeholder="superexemple@gmail.com" required/>
						
						<label for="objet">Objet</label>
						<input type="text" id="objet" name="objet" required/>
						
						<label for="message">Message</label>
						<textarea id="message" name="msg" required></textarea>
						
						<input type="submit" name="envoi" value="Enregistrer" />
					</form>
				</div>
			</div>
		</section>
		<footer>
			<div class="conteneur">
				Bas de page
			</div>
		</footer>
		
	</body>
</html>