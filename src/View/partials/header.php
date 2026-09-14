<header class="site-header">
    <div class="site-header__inner container">
        <a href="index.php?controller=home&action=index" class="site-logo">
            <img src="assets/images/logo.svg" alt="">
        </a>

        <nav class="site-nav site-nav--main">
            <a href="index.php?controller=home&action=index">Accueil</a>
            <a href="index.php?controller=book&action=list">Nos livres à l'échange</a>
        </nav>

        <nav class="site-nav site-nav--user">
            <a href="index.php?controller=message&action=index" class="site-nav__messaging">
                <span><img src="assets/images/icon-messagerie.svg" alt="">Messagerie</span>
            </a>
            <a href="index.php?controller=user&action=account">
               <span><img src="assets/images/icon-account.svg" alt="">Mon compte</span>
            </a>
            <?php if ($this->isLoggedIn()): ?>
                <a href="index.php?controller=auth&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Connexion</a>
            <?php endif; ?>
        </nav>
    </div>
</header>