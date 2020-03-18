<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #21282d;">
    <div class="container">
    <a class="navbar-brand" href="index">EcommerceWeb</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <!-- <li class="nav-item active">
                <a class="nav-link" href="index">Principale <span class="sr-only">(current)</span></a>
            </li> -->
            <?php if(isset($_SESSION['user'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="panier">Panier</a>
                </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav ml-auto">
        <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">S</button> -->
            </form>
        <?php if(isset($_SESSION['user'])){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']; ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="profile">Profile</a>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </li>
            <?php }else{ ?>
            <li class="nav-item">
                <a class="nav-link" href="login">S'indentifier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register">S'enregister</a>
            </li>
            <?php } ?>
        </ul>
</nav>