<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav id="navbar" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class=" container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../img/logo call you.jpg" alt="">
            </a>
            <?php if (isset($_SESSION['id'])) { ?>
    <?php if ($_SESSION['perfil'] == 'comum') { ?>
        <div class="flex-shrink-0 navbar-text dropdown login">
    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-light"
        data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $_SESSION['name'] ?> 
    </a>
    <ul class="dropdown-menu text-small shadow" data-popper-placement="bottom-end">
        <li><a class="dropdown-item text-black" href="../paginas/perfil.php">Perfil</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item text-black" href="../function/logout.php">Sair</a></li>
    </ul>
</div>
    <?php } elseif ($_SESSION['perfil'] == 'master') { ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="usuarios.php">Consulta de Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modelo-db.php">Modelo DB</a>
                </li>
            </ul>
            <div class="flex-shrink-0 navbar-text dropdown login">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-light"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['name'] ?> 
                </a>
                <ul class="dropdown-menu text-small shadow" data-popper-placement="bottom-end">
                    <li><a class="dropdown-item text-black" href="#">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-black" href="../function/logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div id="div_login" class="navbar-text">
        <a href="login.php">Login</a>
    </div>
<?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>

    </nav>
</header>