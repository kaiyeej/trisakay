<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="./profile" class="nav-link">
        <div class="nav-profile-image">
            <img src="assets/images/face.png" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2"><?= $_SESSION["trisakay_user_fullname"] ?></span>
            <span class="text-secondary text-small"><?= $_SESSION["trisakay_user_category"] == "A" ? "Admin" : "Driver" ?></span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./transactions">
        <span class="menu-title">Transactions</span>
        <i class="mdi mdi-file-multiple menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./users">
        <span class="menu-title">Users</span>
        <i class="mdi mdi-account-multiple-plus menu-icon"></i>
        </a>
    </li>
    
    </ul>
</nav>