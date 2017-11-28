<?php
  session_start();

  $page_title = "Checkout";

  include('includes2/dashboard_header.php');
  include('includes2/db.php');



?>
  <!-- main content starts here -->
  <div class="main">
    <div class="checkout-form">
      <form class="def-modal-form">
        <div class="total-cost">
          <h3>$2000 Total Purchase</h3>
        </div>
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Checkout</h3></label>
        <input type="text"  class="text-field phone" placeholder="Phone Number">
        <input type="text" name="addy" class="text-field address" placeholder="Address">
        <input type="text" name="code" class="text-field post-code" placeholder="Post Code">
        <input type="submit" name="chkt" class="def-button checkout" value="Checkout">
      </form>
    </div>
  </div>
  <!-- footer starts here-->
  <?php include('includes2/footer.php'); ?>
