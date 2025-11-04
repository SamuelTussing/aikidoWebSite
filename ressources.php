<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aikido de la Zorn: les ressources</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles.css" media="screen">
    <meta name="TITLE" content="Association d'Aïkido du pays de la Zorn">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="TITLE" content="Association d'Aïkido du pays de la Zorn">
    <meta name="DESCRIPTION" content="Site Web associatif du club d'Aïkido de Schwindratzheim">
    <meta name="KEYWORDS" content="Aïkido, aikido, club, association, sport, arts martiaux, Schwindratzheim, Hochfelden">
    <meta name="LANGUAGE" content="FR">
    <meta name="SUBJECT" content="site du club d'Aïkido de Schwindratzheim et environs">
    <meta name="ROBOTS" content="All">
    <meta name="AUTHOR" content="Samuel Tussing,Bruno Boettcher">
    <meta name="OWNER" content="zorn.aikido@gmail.com">
    <meta name="RATING" content="aikido">
    <meta name="ABSTRACT" content="Site Web associatif du club d'Aïkido de Schwindratzheim">
    <meta name="REVISIT-AFTER" content="7 DAYS">
    <meta name="COPYRIGHT" content="LGPL">
    <link rel="Shortcut icon" href="images/logo/aapz_logo.svg" type="image/png">
</head>
<body>
    <header>
      <?php include 'header.html'; ?>
    </header>
    <section class="hero" id="accueil">
        <div class="hero-content">
            <h1>RESSOURCES</h1>
        </div>
    </section>
    <section class="white-bg" id="infos">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="./images/video.jpg" alt="chaine youtube du club">
                </div>
                <div class="col">
                    <h2>NOS VIDEOS</h2>
                    <p>Notre association est heureuse de partager avec vous des vidéos pédagogiques pour vous faire découvrir l'art de l’aïkido. Que vous soyez débutant, pratiquant confirmé ou simplement curieux, ces vidéos offrent un aperçu des techniques variées et des principes de cet art martial japonais. À travers des démonstrations guidées par nos enseignants et membres expérimentés, vous pourrez explorer les mouvements fondamentaux, les enchaînements, ainsi que les exercices d'équilibre et de coordination propres à l'aïkido. Chaque vidéo est conçue pour mettre en valeur la fluidité, la précision et l'esprit de non-violence qui sont au cœur de notre discipline. Plongez dans l'univers de l'aïkido, enrichissez votre pratique ou découvrez simplement une nouvelle perspective sur le mouvement et la maîtrise de soi.</p>
                    <a href="https://www.youtube.com/@aikido_zorn" class="btn">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <section class="flex-section">
        <h2>HORAIRES & STAGES</h2>
        <div class="separator" aria-hidden="true"></div>
        <p>
            Découvrez une gallerie photos retraçant les moments clés de l’association.
        </p>
    </section>
    <section class="tabs">
	<h2 class="visually-hidden">Navigation du Contenu</h2>
        <button class="tab active" data-category="dojo">Dojo</button>
        <button class="tab" data-category="stages">Stages</button>
        <button class="tab" data-category="cours">Cours</button>
    </section>

    <section class="image-grid" id="imageGrid">
	<h2 class="visually-hidden">Phototheque</h2>
        <!-- Les images seront insérées ici par JavaScript -->
    </section>
 
    <?php include 'footer.html'; ?>


    <script src="script.js"></script>
</body>
</html>
