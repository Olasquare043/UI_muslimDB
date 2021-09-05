 <?php
    if (defined("register")) {
    ?>

     <body>
         <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
             <!-- <nav class="navbar navbar-expand-md navbar-white text-dark "> -->
             <div class="container-fluid">
                 <a class="navbar-brand" href="index.php">
                     <img src="img/uilogo.png" alt="Brand logo" style="height: 40px">
                 </a>
                 <button class="navbar-toggler text-black " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon "></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                     <div class="navbar-nav">
                         <a class="nav-link" href="index.php"><strong>Home</strong> </a>
                         <a class="nav-link active" aria-current="page" href="register.php"><strong>Register</strong> </a>
                         <a class="nav-link" href="about.php"> <strong>About</strong></a>
                     </div>
                 </div>
             </div>
         </nav>
     <?php
    } else {
        ?>

         <body>
             <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
                 <!-- <nav class="navbar navbar-expand-md navbar-white text-dark "> -->
                 <div class="container-fluid">
                     <a class="navbar-brand" href="index.php">
                         <img src="img/uilogo.png" alt="Brand logo" style="height: 40px">
                     </a>
                     <button class="navbar-toggler text-black " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon "></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                         <div class="navbar-nav">
                             <?php
                                if (defined("about")) {
                                ?>
                                 <a class="nav-link" href="index.php"><strong>Home</strong> </a>
                                 <a class="nav-link" href="register.php"><strong>Register</strong> </a>
                                 <a class="nav-link active" aria-current="page" href="about.php"> <strong>About</strong></a>
                             <?php
                                } else {
                                ?>
                                 <a class="nav-link active" aria-current="page" href="index.php"><strong>Home</strong> </a>
                                 <a class="nav-link" href="register.php"><strong>Register</strong> </a>
                                 <a class="nav-link" href="about.php"> <strong>About</strong></a>
                             <?php }
                                ?>

                         </div>
                     </div>
                 </div>
             </nav>
         <?php
        }
            ?>