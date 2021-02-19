 <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">
            Profile
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link active">Home</a> 
            <a href="profile.php" class="nav-item nav-link"><?php echo $_SESSION['first_name']?></a></li>
            <a href="../about.php" class="nav-item nav-link">About</a></li>
            <a href="../alendar.php" class="nav-item nav-link">Calendar</a></li>
            <a href="../courses.php" class="nav-item nav-link">Courses</a></li>
            <a href="../template.php" class="nav-item nav-link">File Manager</a></li>
            <a href="../noti.php" class="nav-item nav-link">Notification</a><li>   
            </div>
            <div class="navbar-nav ml-auto">
			<?php if ($_SESSION['login'] = false) : ?>
                <a href="login.php" class="get-started-btn">Log In</a>
                <?php else : ?>
                <a href="logout.php" class="get-started-btn">Log Out</a>
            <?php endif; ?>			
            </div>
        </div>
    </nav>