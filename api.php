<?php


$GLOBALS['pageTitle'] = 'My Trading APP';

// Show our header.
include './templates/header.php';
?>

<p>
  Welcome to our
  <?php echo $GLOBALS['pageTitle']; ?>
  page!
</p>

<!--Stock data Request Form--> 

<h2>Get Stock Data Information</h2>
<form action="#" method="POST">
  <!-- <label for="amount">Enter the Amount of Facts:
  <input type="number" id="amount" name="amount" value="3"></label> -->
  <label for="company-symbol">Enter the Company Symbol:
    <select id="company-symbol" name="symbol">
      <option value="IBM">IBM</option>
      <option value="MSFT">Microsoft</option>
      <option value="AAPL">Apple</option>
      <option value="AMZN">Amazon</option>
      <option value="TSLA">Tesla</option>
    </select>
  </label>
  <input type="submit" value="Search!">
</form>






<?php // Show our footer.
include './templates/footer.php';