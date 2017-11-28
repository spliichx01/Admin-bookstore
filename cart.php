<?php
  session_start();

  include('includes2/dashboard_header.php');
  include('includes2/db.php');
  include('includes2/function.php');



?>
  <!-- main content starts here -->
  <div class="main">
    <table class="cart-table">
      <thead>
        <tr>
          <th><h3>Item</h3></th>
          <th><h3>Price</h3></th>
          <th><h3>Quantity</h3></th>
          <th><h3>Total</h3></th>
          <th><h3>Update</h3></th>
          <th><h3>Remove</h3></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><div class="book-cover b1"></div></td>
          <td><p class="book-price">$200</p></td>
          <td><p class="quantity">3</p></td>
          <td><p class="total">$600</p></td>
          <td>
            <form class="update">
              <input type="number" class="text-field qty">
              <input type="submit" class="def-button change-qty" value="Change Qty">
            </form>
          </td>
          <td>
            <a href class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
        <tr>
          <td><div class="book-cover b2"></div></td>
          <td><p class="book-price">$150</p></td>
          <td><p class="quantity">2</p></td>
          <td><p class="total">$300</p></td>
          <td>
            <form class="update">
              <input type="number" class="text-field qty">
              <input type="submit" class="def-button change-qty" value="Change Qty">
            </form>
          </td>
          <td>
            <a href="#" class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
        <tr>
          <td><div class="book-cover b3"></div></td>
          <td><p class="book-price">$300</p></td>
          <td><p class="quantity">2</p></td>
          <td><p class="total">$600</p></td>
          <td>
            <form class="update">
              <input type="number" class="text-field qty">
              <input type="submit" class="def-button change-qty" value="Change Qty">
            </form>
          </td>
          <td>
            <a href="#" class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
        <tr>
          <td><div class="book-cover" style="background: url('img/4.jpg');background-size: contain;background-position: center;background-repeat: no-repeat;"></div></td>
          <td><p class="book-price">$50</p></td>
          <td><p class="quantity">5</p></td>
          <td><p class="total">$250</p></td>
          <td>
            <form class="update">
              <input type="number" class="text-field qty">
              <input type="submit" class="def-button change-qty" value="Change Qty">
            </form>
          </td>
          <td>
            <a href="#" class="def-button remove-item">Remove Item</a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="cart-table-actions">
      <button class="def-button previous">previous</button>
      <button class="def-button next">next</button>
      <div class="index">
        <a href="#"><p>1</p></a>
        <a href="#"><p>2</p></a>
        <a href="#"><p>3</p></a>
      </div>
      <a href="checkout.html"><button class="def-button checkout">Checkout</button></a>
    </div>
    
  </div>
  <!-- footer starts here -->
<?php include('includes2/footer.php'); ?>




 