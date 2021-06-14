<nav class="navbar navbar-light navbar-expand-lg">
    <div class="container">
        <!-- <a href="index.php"><img src="{{asset('images/logo-fifa-1.png')}}" alt="Logo" class="logo"> -->
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">FIFA<sup>Offline</sup></div>
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li clas="navbar-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>

                <li clas="navbar-item">
                    <a href="photos.php" class="nav-link">Foto</a>
                </li>

                <li clas="navbar-item">
                    <a href="about.php" class="nav-link">Cum functioneaza</a>
                </li>

                <li clas="navbar-item">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Modal for Login System -->
           <x-modal></x-modal>
        </div>
    </div>
</nav>