<section class="hero container">
    <div class="hero__content">
        <h1>Rejoignez nos lecteurs passionnés</h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
        <a href="index.php?controller=book&action=list" class="btn btn--primary">Découvrir</a>
    </div>
    <figure class="hero__media">
        <img src="assets/images/hero-image.png" alt="Étagères remplies de livres dans une librairie">
        <figcaption>Hamza</figcaption>
    </figure>
</section>

<section class="latest-books">
    <div class="container">
        <h2>Les derniers livres ajoutés</h2>

        <div class="book-grid">
            <?php foreach ($latestBooks as $book): ?>
                <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>" class="book-card">
                    <div class="book-card__image">
                        <?php if ($book->getImage()): ?>
                            <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
                        <?php endif; ?>
                    </div>
                    <div class="book-card__infos">
                        <h3 class="book-card__title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="book-card__author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <p class="book-card__seller">Vendu par : <?= htmlspecialchars($owners[$book->getUserId()]->getUsername()) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="latest-books__cta">
            <a href="index.php?controller=book&action=list" class="btn btn--primary">Voir tous les livres</a>
        </div>
    </div>
</section>

<section class="how-it-works">
    <div class="container">
        <div class="intro">
            <h2>Comment ça marche ?</h2>
            <p class="how-it-works__intro">Échanger des livres avec TomTroc c'est simple et 
            amusant ! Suivez ces étapes pour commencer :</p>
        </div>

        <div class="steps-grid">
            <div class="step-card">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="step-card">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="step-card">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </div>
            <div class="step-card">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </div>
        </div>

        <div class="how-it-works__cta">
            <a href="index.php?controller=book&action=list" class="btn btn--outline">Voir tous les livres</a>
        </div>
    </div>
</section>

<figure class="values-banner">
    <img src="assets/images/mask-group.png" alt="Personne lisant dans une bibliothèque">
</figure>

<section class="values">
    <div class="container">
        <h2>Nos valeurs</h2>
        <div class="values__text">
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
            <p class="values__signature">L'équipe Tom Troc</p>
        </div>
        <div class="values-media">
            <img src="assets/images/vector-2.svg" alt="">
        </div>
    </div>
</section>