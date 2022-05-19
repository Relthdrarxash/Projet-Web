<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <header>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
                <!-- Faire le menu en dynamique -->
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<a class="navbar-brand" href="#">Quentin Noilou</a>
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<?php 
						if 
						// Si la page du menu est la page courante
						?>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.html">CV Numérique</a>
						</li>
						<?php
						?>
						<?php 
						if 
						// Si la page du menu en est une autre
						?>
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="index.html">CV Numérique</a>
						</li>
						<?php
						?>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navbar -->
</header>
<!-- Fichier à inclure pour faire le footer -->