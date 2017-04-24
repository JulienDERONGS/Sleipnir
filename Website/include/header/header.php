<?php if(!isset($_SESSION)){session_start();}?>
<nav class="sticky_nav">
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="equipments.php">Equipments</a>
        </li>
        <?php
            // Only visible if not yet logged in
        	if (!(isset($_SESSION['email'])) && !(isset($_SESSION['password'])))
        	{ echo "
        <li>
            <a href=\"login.php\">Log in</a>
        </li>
        	";}
        ?>
        <?php
            // Only visible if already logged in
        	if ((isset($_SESSION['email'])) && (isset($_SESSION['password'])))
        	{ echo "
        <li>
            <a href=\"logout.php\">Log out</a>
        </li>
        <div class=\"logged_email\">
        	Logged in as <br>". $_SESSION['email']. "
        </div>
        ";}
        
        ?>
    </ul>
</nav>