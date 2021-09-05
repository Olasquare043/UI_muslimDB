<?php
require_once "class/config.php";
 
if(isset($_POST['signup']))
{
    // if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']))
    // {
        // $firstName = trim($_POST['first_name']);
        // $lastName = trim($_POST['last_name']);
        // $email = trim($_POST['email']);
        // $password = trim($_POST['password']);
        
        // $options = array("cost"=>4);
        // $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        // $date = date('Y-m-d H:i:s');
 
    //     if(filter_var($email, FILTER_VALIDATE_EMAIL))
		// {
    //         $sql = 'select * from members where email = :email';
    //         $stmt = $pdo->prepare($sql);
    //         $p = ['email'=>$email];
    //         $stmt->execute($p);
            
    //         if($stmt->rowCount() == 0)
    //         {
                $sql = "insert into members (surname, othernames, gender) values(:surname,:othernames,:gmail)";
            
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':surname'=>$surname,
                        ':othernames'=>$othernames,
                        ':gmail'=>$email
                    ];
                    
                    $handle->execute($params);
                    
                    $success = 'User has been created successfully';
                    header("location:index.php");
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
// $con = con();
// echo "gjfhhdgg";
// if (isset($_POST['signup'])) {
//   extract($_POST);
//   echo $surname;
   
//     // $query->$con->prepare($str);
//     // $query->bindParam("username", $username, PDO::PARAM_STR);
//     // $query->bindParam("othernames", $othernames, PDO::PARAM_STR);
//     // $query->bindParam("gender", $gender, PDO::PARAM_STR);
//     // $query->execute();
//     // $lastInserdId = $con->lastInsertId();
//     try{
//       $str = "INSERT INTO members (surname,othernames,gender)VALUES(:surname,:othernames,:gender)";
//       $handle = $con->prepare($str);
//       $params = [
//           ':surname'=>$surname,
//           ':othernames'=>$othernames,
//           ':gender'=>$gender,
//       ];
//       $handle->execute($params);
//       $success = 'User has been created successfully';
//     }
//       catch(PDOException $e){
//         $errors[] = $e->getMessage();
//     }
//   //   if ($success!="") {
//   //     header("location:register.php?success");
//   //   }
//   // // } catch (Exception $th) {
//   // //   echo $th;
//   //   header("location:register.php?Error");
//   // // }
}