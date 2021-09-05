<?php
define("about", true);
require_once "includes/header.php";
require_once "includes/navbar.php";
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div class="container">
        <div class="card  card shadow border border-primary border-2 m-5" style="height: 100vh;">
            <div class="card-body text-center justify-content-center mt-2 ">
                <div class="display-6 pb-4"><u> About Us</u></div>
                <p>
                <h5 class="mb-3">The Muslim Community is a group of people with same religion called</h5></p> 
                <p><h5><strong><b>Islam</b>, "the religion of Love and Peace."</strong></h5>
                </p>
                <p>This website is designed to get the records of all Muslims of University of Ibadan into a Database</p>
                <p class="mb-3">If you are yet to join muslim community!, and you want to become a member </p>
                <a class="btn btn-primary btn-lg" href="register.php" role="button">Become a Member</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once "includes/footer.php";
?>