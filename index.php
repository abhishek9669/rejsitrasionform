
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Form Design 2</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body{
                background-color: #f3e0e2;
                margin: 0px;
                font-family: Arial, Helvetica, sans-serif;
            }
            .a_formbox{
                width: 767px;
                min-height: 480px;
                margin: 120px auto;
                border-radius: 10px;
                box-shadow: 0px 10px 40px 10px rgba(0,0,0,0.2);
                overflow: hidden;
            }
            .a_formbox > div:first-child{
                width: 50%;
                height: 100%;
                background-color: #fff;
                float: left;
            }
            .a_formbox > div:first-child form{
                width: 80%;
                margin: 38px auto;
                clear: both;
                text-align: center;
            }
            .a_formbox>div:last-child{
                text-align: center;
                color:#fff;
                width: 50%;
                height: 100%;
                background-image: -webkit-linear-gradient(left,#ff464c,#ff416b);
                float: right;
                
            }
            
            .a_formbox > div:last-child *{
                width: 70%;
                margin: auto;
            }
            .a_formbox form input{
                border:none;
                display: block;
                height: 39px;
                width: 95%;
                background-color:#eee;
                margin-bottom: 10px;
                margin-top: 10px;
                padding-left: 15px;
            }
            input[type="password"]{ 
                width: 100%;
                float: left;
            }
            button[type="submit"]{
                width: 138px;
                height: 41px;
                background-color:#ff4b2b;
                border:none;
                border-radius: 50px;
                color:#fff;
                margin-top: 10px;;
            }
            a{
                color:#333;
                text-decoration: none;
            }
            .a_abhi a{
                display: inline-block;
                width: 40px;
                height: 40px;
                line-height: 45px;
                border-radius: 40px;
                border:1px solid #333;
            }
            .a_abhi a i{
                font-size: 1.6em;
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_GET['login'])){
            //echo 'yes';
            //1 db conaction open

           $cnn = mysqli_connect('localhost','root','','mynewform_db');


           $name =  mysqli_real_escape_string($cnn,$_GET['name']);
           $uname =  mysqli_real_escape_string($cnn,$_GET['uname']);
           $email =  mysqli_real_escape_string($cnn,$_GET['email']);
           $password =  mysqli_real_escape_string($cnn,$_GET['password']);
           $cpass =  mysqli_real_escape_string($cnn,$_GET['cpass']);
           $agree =  mysqli_real_escape_string($cnn,$_GET['agree']);
           
           if(isset($agree) && $agree == 'yes'){

            if($password == $cpass ) {
                $query = "SELECT * FROM users_tbl WHERE user_name = '$uname' ";

               $return= mysqli_query($cnn,$query);

              $count = mysqli_num_rows($return);

              if($count > 0) {
                echo '<script>toastr.error("Username Or Email already exits")</script>';

                  
              }else {

                // $sql = "IN";
                $password = SHA1($password);
                $sql = "INSERT INTo users_tbl(`name`,`user_name`,`email`,`password`)VALUE('$name','$uname','$email','$password')";

                mysqli_query($cnn,$sql);
                echo '<script> swal("Good job!", "User login successfully!", "success"); </script>';
                mysqli_close($cnn);
                  
              }

                
            }else {
                echo '<script> swal("Password and Confirm Not Match !", "Password and Confirm Not Match Not Match!", "error"); </script>';
        
            }

           }else{
            echo '<script> swal("Please accept the Terms and Conditions!", "Please accept!", "error"); </script>';

           }

        }

        
        
        
        ?>
        <div class="a_formbox">
            <div class="col-12">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
                    <h1>Login</h1>
                    <div class="a_abhi" >
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                    
                    <a href="#">Or Use your Account</a>
                    <div>
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div>
                        <input type="text" name="uname" placeholder="user Name " required>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div>
                        <input type="password" name="cpass" placeholder="confirm Password" required>
                    </div>
                    <div>
                    <input name="agree" value="yes" type="checkbox" class="">
                    <label class="form-check-label" for="exampleCheck1">Do yo agree to Terms and Condition?</label>
                        
                    </div>
                    <div>
                        <button type="submit" name="login">LOG IN</button>
                    </div>
                </form>
            </div>
            <div  class="col-12 h-100" style="min-height:600px;">
                <h1 style="margin-top:130px">HTML CSS Login Form</h1>
                <p style="margin-top:20px">
                    This login form is created using pure html and CSS . for social icons,fontawesome is Used.
                </p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>