<?php
//****************Fonctions utilisées**************************************



//****************Génération du menu**************************************
function generationMenu($tableauMenu)
{
    $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">'."\n".
    '<div class="container-fluid">'."\n".
    '<div class="collapse navbar-collapse" id="navbarTogglerDemo01">'."\n".
    '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    foreach ($tableauMenu as $page) {
        /* On peut ptet s'éviter de faire deux fois le même test si on met le active dans un if
             En mode <a class="nav-link "<?php if ($_SERVER['PHP_SELF'] == $page['url']) echo 'active';?href='{$page['url']}'>{$page['texte']}</a>\n";
            */
        if ($_SERVER['PHP_SELF'] == $page['url']) {
            // Ici on mettra le lien en active pour qu'il soit mis en évidence
            $html .= '<a class="nav-link active" aria-current="page"'."href='{$page['url']}'>{$page['texte']}</a>\n";
        } else {
            // Ici on va mettre toutes les autres pages qui seront pas en active du coup
            $html .= '<a class="nav-link" aria-current="page"'."href='{$page['url']}'>{$page['texte']}</a>\n";
        }
    }
    $html .= "</nav>\n";
    return $html;
}
?>
<!-- 
        Code à passer dans le PHP
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<a class="navbar-brand" href="#">Quentin Noilou</a>
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.html">CV Numérique</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="competences.html">Compétences</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="interets.html">Intérêts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="projetprofessionnel.html">Projet Professionnel</a>
						</li>	
						<li class="nav-item">
							<a class="nav-link" href="liensutiles.html">Liens Utiles</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>*
-->