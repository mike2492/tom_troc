<div class="container page-books">
    <div class="page-books__header">
        <h1>Nos livres à l'échange</h1>
        <form method="GET" action="index.php" class="search-form">
            <input type="hidden" name="controller" value="book">
            <input type="hidden" name="action" value="list">
            <input type="text" name="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" class="btn-search">
        </form>
    </div>

    <?php if (empty($books)): ?>
        <p class="empty-state">Aucun livre ne correspond à votre recherche.</p>
    <?php else: ?>
        <div class="book-grid">
            <?php foreach ($books as $book): ?>
                <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>" class="book-card">
                    <div class="book-card__image">
                        <?php if ($book->getAvailability() === 'unavailable'): ?>
                            <span class="pill pill--danger">non dispo.</span>
                        <?php endif; ?>
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
    <?php endif; ?>
</div>