  <?php
  session_start();

  $page_title = "Registration Page";
  
  include('includes2/dashboard_header.php');
  include('includes2/db.php');
  include('includes2/function.php');
  


  $error = [];

  if(array_key_exists('reg', $_POST)){
      if(empty($_POST['fname'])){
        $error['fname'] = "Please enter your fistname";
      }
      if(empty($_POST['lname'])){
        $error['lname'] = "Please enter your lastname";
      }
      if(empty($_POST['email'])){
        $error['email'] = "Please enter your email";
      }
      if(empty($_POST['uname'])){
        $error['uname'] = "Please enter your username";
      }
      if(empty($_POST['password'])){
        $error['password'] = "Please enter your password";
      }
      if(empty($_POST['pword'])){
        $error['pword']= "Please confirm your password";
      }

      if(empty($error)){
        $clean = array_map('trim', $_POST);
        customerRegister($conn, $clean);
        header('location:registration.php?msg=, "Registration Successfull"');
      }


  }

?>
  <!-- main content starts here -->
  <div class="main">
    <div class="registration-form">
      <form action="" class="def-modal-form" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="registration-from" class="header"><h3>User Registration</h3></label>
        <?php 
          $data = displayErrors($error, 'fname');
          echo $data;
        ?>
        <input type="text" name="fname" class="text-field first-name" placeholder="Firstname">

        <?php 
          $data = displayErrors($error, 'lname');
          echo $data;
        ?>
        <input type="text" name="lname" class="text-field last-name" placeholder="Lastname">

        <?php 
        $data = displayErrors($error, 'email');
        echo $data;
        ?>
        <input type="email" name="email" class="text-field email" placeholder="Email">
        <?php 
        $data = displayErrors($error, 'uname');
        echo $data;
        ?>
        <input type="text" name="uname" class="text-field username" placeholder="Username">
        <?php 
        $data = displayErrors($error, 'password');
        echo $data;
        ?>
        <input type="password" name="password" class="text-field password" placeholder="Password">

        <?php 
        $data = displayErrors($error, 'pword');
        echo $data;
        ?>
        <input type="password" name="pword" class="text-field confirm-password" placeholder="Confirm Password">
        <input type="submit" name="reg" class="def-button" value="Register">
        <p class="login-option"><a href="login.php">Have an account already? Login</a></p>
      </form>
    </div>
  </div>
  <!-- footer starts here-->
 
<?php include('includes2/footer.php'); ?>
