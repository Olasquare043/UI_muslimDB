<?php
session_start();
define("register", true);
require_once "class/config.php";
require_once "includes/header.php";
require_once "includes/navbar.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['surname'],$_POST['othernames'],$_POST['email']) && !empty($_POST['surname']) && !empty($_POST['othernames']) && !empty($_POST['email'])) {
        $surname = trim($_POST['surname']);
        $othernames = trim($_POST['othernames']);
        $email = trim($_POST['email']);
        $gender = trim($_POST['gender']);
        $dob = trim($_POST['dob']);
        $telephone1 = trim($_POST['telephone1']);
        $telephone2 = trim($_POST['telephone2']);
        $employment_status = trim($_POST['employment_staus']);
        $occupation = trim($_POST['occupation']);
        $state = trim($_POST['state']);
        $lga = trim($_POST['lga']);
        $nok_name = trim($_POST['nok_name']);
        $relationship = trim($_POST['relationship']);
        $nok_phone = trim($_POST['nok_phone']);
        $nok_address = trim($_POST['nok_address']);
        //image manipultion
        $img_name=$_FILES["img"]["name"];
        $dir="uploads";
        $target_file= $dir.basename($_FILES["img"]["name"]);
        // $temp_name=$_FILES["img"]["temp_name"];
        $extension=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $img_ok=1;
        if($extension != "jpg" && $extension != "jpeg" && $extension != "gif" && $extension != "png"){
        $img_ok=0;
        $errors[]="Invalid image you can only upload(jpeg,jpg,gif and gif)";
        }
        if ($_FILES["img"]["size"]>500000){
            $img_ok=0;
            $errors[]="image size is too large..must not exceed 500kb";
            }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            if ($img_ok==1 ||  move_uploaded_file($_FILES["img"]["tmp_name"],$target_file)){
                $sql = 'select * from memberss where email = :email';
                $stmt = $pdo->prepare($sql);
                $p = [':email' => $email];
                $stmt->execute($p);
                if ($stmt->rowCount() == 0) {
                    $sql = "insert into memberss (surname, othernames,email,gender,dob,telephone1,telephone2,employment_status,
                    occupation,state,localgv,img,nok_name,relationship,nok_phone,nok_address) values(:fname,:lname,:email,:gender,
                    :dob,:telephone1,:telephone2,:employment_status,:occupation,:state,:lga,:img,:nok_name,:relationship,:nok_phone,:nok_address)";
    
                    try {
                        $handle = $pdo->prepare($sql);
                        $params = [
                            ':fname' => $surname,
                            ':lname' => $othernames,
                            ':email' => $email,
                            ':gender' => $gender,
                            ':dob' => $surname,
                            ':telephone1' => $telephone1,
                            ':telephone2' => $telephone2,
                            ':employment_status' => $employment_status,
                            ':occupation' => $occupation,
                            ':state' => $state,
                            ':lga' => $lga,
                            ':img' => $img_name,
                            ':nok_name' => $nok_name,
                            ':relationship' => $relationship,
                            ':nok_phone' => $nok_phone,
                            ':nok_address' => $nok_address
                            // ':pass' => $hashPassword
                        ];
    
                        $handle->execute($params);
    
                        $success = 'User has been created successfully';
                    } catch (PDOException $e) {
                        $errors[] = $e->getMessage();
                    }
                } else {
                    $errors[] = 'Email address already registered';
                }
            }else{
                $errors[]="image failed to upload";
            }
            
        } else {
            $errors[] = "Email address is not valid";
        }
    }
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $errors[] = 'Email is required';
    }
}
?>
<div class="container">
    <div id="content m-5 p-5">
        <div class="container mt-3 mb-3 width:auto align-content-center">
            <div class="card m-lg-5">
                <h5 class="card-header cardheader text-white text-center p-3">
                    <strong>UI Muslim Community Membership Form</strong>
                </h5>
                <?php
                if (isset($errors) && count($errors) > 0) {
                    foreach ($errors as $error_msg) {
                        echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                    }
                }
                if (isset($success)) {

                    echo '<div class="alert alert-success">' . $success . '</div>';
                }
                ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                    <div class="card-body p-4 m-2">
                        <?php if (isset($_SESSION['state']) && isset($_SESSION['surname'])) {
                        ?> <h5 class="bg-gray text-danger"><?php echo $_SESSION['surname'];
                                                            ?></h5>
                        <?php unset($_SESSION['msg']);
                            unset($_SESSION['status']);
                        }
                        ?>
                        <!--Reg Form-->
                        <div class="row mb-3 ">
                            <div class="col">
                                <!-- Surname -->
                                <div class=" mb-2">
                                    <input type="text" name="surname" id="surname" class="form-control"required>
                                    <label for="surname" class="text-muted">Surname</label>
                                </div>
                            </div>
                            <div class="col">
                                <!-- othername -->
                                <div class=" mb-2">
                                    <input type="text" name="othernames" id="othernames" class="form-control">
                                    <label for="othernames" class="text-muted">Othernames</label>
                                </div>
                            </div>
                        </div>
                        <!-- gender and DOB -->
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select form-control" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <label for="gender" class="text-muted">Gender</label>
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="dob">
                                <label for="dob" class="text-muted">Date of Birth</label>
                            </div>
                        </div>
                        <!-- telephone 1&2 -->
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3">
                                <input type="text" class="form-control" name="telephone1" required>
                                <label for="telephone1" class="text-muted">Telephone 1</label>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <input type="text" class="form-control" name="telephone2">
                                <label for="telephone2" class="text-muted">Telephone 2</label>
                            </div>
                        </div>
                        <!-- Employment status and Occupation -->
                        <div class="row mb-3">
                            <div class="col mb-sm-3">
                                <select class="form-select form-control" name="employment_staus">
                                    <option value="Government ">Government</option>
                                    <option value="Private Organisation">Private Organisation</option>
                                    <option value="Student">Student</option>
                                    <option value="Enterpreneur">Enterpreneur</option>
                                    <option value="Not Employed">Not Employed</option>
                                    <option value="Retired">Retired </option>
                                </select>
                                <label for="employmentStaus" class="text-muted">Employment Status</label>
                            </div>
                            <!-- occupation -->
                            <div class="col mb-3">
                                <input type="text" name="occupation" class="form-control">
                                <label for="occupation">Occupation</label>
                            </div>
                        </div>
                        <!-- State and local government -->
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select form-control" onchange="toggleLGA(this);" name="state" id="state" class="form-control">
                                    <option value="" selected="selected">- Select -</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="AkwaIbom">AkwaIbom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="FCT">FCT</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nasarawa">Nasarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamafara</option>
                                </select>
                                <label for="state" class="text-muted">State</label>
                            </div>
                            <div class="col">
                                <select name="lga" id="lga" class="form-select form-control select-lga">
                                </select>
                                <label for="localgv" class="text-muted">Local Govt.</label>
                            </div>
                        </div>
                        <!-- E-mail -->
                        <div class="row mb-3">
                            <div class="col">
                                <div class=" mb-2">
                                    <input type="email" name="email" id="email" class="form-control ">
                                    <label for="email" class="text-muted">E-mail</label>
                                </div>
                            </div>
                        </div>
                        <!-- upload image -->
                        <div class="row mb-3">
                            <div class="col">
                                <input type="file" name="img" id="img" class="form-control">
                                <label for="img" class="text-muted">Choose profile image</label>
                            </div>
                        </div>
                        <!-- Next of Kin Grouped info -->
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card shadow border-top border-primary border-2">
                                    <!-- Card Header -->
                                    <a class="card-header text-dark" data-bs-toggle="collapse" href="#collapseNextOfKIN" role="button" aria-expanded="false" aria-controls="collapseNextOfKIN">
                                        <strong>Next Of KIN <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10zM5 8l5 5 5-5H5z" fill-rule="evenodd"></path>
                                            </svg></strong>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse" id="collapseNextOfKIN">
                                        <div class="card-body">
                                            <div class=" row mb-3">
                                                <div class="col">
                                                    <input type="text" name="nok_name" class="form-control">
                                                    <label for="next_of_kin_name" class="text-muted">Name</label>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <div class="col">
                                                    <select class="form-select form-control form-control" name="relationship" id="relationship">
                                                        <option value="">...</option>
                                                        <option value="Spouse">Spouse</option>
                                                        <option value="Child">Child</option>
                                                        <option value="Sibling">Sibling</option>
                                                        <option value="Uncle">Uncle</option>
                                                        <option value="Aunt">Aunt</option>
                                                    </select>
                                                    <label for="relationship" class="text-muted">Relationship</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="nok_phone" class="form-control">
                                                    <label for="phone" class="text-muted">Phone</label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <textarea name="nok_address" class="form-control" rows="3"></textarea>
                                                    <label for="address" class="text-muted">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="d-flex mt-2">
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary text-center form-control p-3 ">Sign up</button>
                                    <a href="index.php" class="btn btn-sm btn-secondary offset-1 p-3 text-center form-control">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once "includes/footer.php";
