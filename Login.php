  <?php
  //session_start();
  $page_title = "User Login";

  include('includes2/dashboard_header.php');
  include('includes2/db.php');
  include('includes2/function.php');

  $error = [];

  if(array_key_exists('login', $_POST)){

        if(empty($_POST['email'])){
          $error['email'] = "Please enter your email address";
        }
        if(empty($_POST['password'])){
          $error['password'] = "Please enter your password";
        }
        if(empty($error)){
          $clean = array_map('trim', $_POST);
          $data = custLogin($conn, $clean);

          if($data[0]){
            $details = $data[1];
            $_SESSION['customer_id'] = $details[customer_id];
            $_SESSION['name'] = $details['firstName'].' '.$details['lastName'];
           redirect("index.php?msg=","Login sucessful");
          }else{
            header('location:login.php?msg="Invalid email/password"');
          }
        }
  }



?>
  <!-- main content starts here -->
  
  <div class="main">
    <div class="login-form">
      
      <form action="" class="def-modal-form"  method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        
          
        <?php $data = displayErrors($error, 'email'); 
          echo $data;
        ?>
        <input type="text" class="text-field email" name="email" placeholder="Email">
        
        
        <?php $data = displayErrors($error, 'password'); 
          echo $data;
        ?>
        <input type="password" class="text-field password" name="password"  placeholder="Password">
      
        
        <input type="submit" class="def-button login" name="login" value="Login">
      </form>
    </div>
  </div>
  <!-- footer starts here-->
<?php include('includes2/footer.php'); ?>
