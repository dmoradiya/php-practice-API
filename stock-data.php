<?php


$GLOBALS['pageTitle'] = 'My Trading APP';

// Show our header.
include './templates/header.php';
?>

<p>
  Welcome to 
  <?php echo $GLOBALS['pageTitle']; ?>!
  
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
  <label for="date">Enter Date:
    <input type="date" id="date" name="date">  
  </label>
  <input type="submit" value="Search!">
</form>

<?php 
if ( isset( $_POST['symbol'] ) )
{
  // Let's modify our request to include a QUERY PARAMETER STRING.
  $stockDataResponse = file_get_contents(
    "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol={$_POST['symbol']}&apikey=E5X4N35GP2NJ6VB2"
  ); 
  // Test the response via var_dump()
   //var_dump( $stockDataResponse );
  if( $stockDataResponse )
  {
    $stockData = json_decode( $stockDataResponse );
     ?>
      <!--Check weather current date is less than the input date-->
      <?php if(  date("Y-m-d") < $_POST['date'] ) : ?>
        <p><?php echo 'Please Enter Valid Past Date!' ?></p>

      <!--Check the weekend date-->
      <?php elseif( $stockData->{'Time Series (Daily)'}->{$_POST['date']} === NULL ) : ?>
      <p><?php echo 'Trading closed for the day!' ?></p>
      
      <!--Check the object is not empty-->
      <?php elseif( !empty($stockData) ) : ?>     
       <!--var_dump($stockData->{'Time Series (Daily)'}->{'2020-10-05'}->{'4. close'});-->
       <h2>Stock Data </h2>
        <table >
          <tr>
            <th><?php echo $_POST['symbol'] ?></th>
            <th><?php echo $_POST['date'] ?></th>    
          </tr>
          <tr>
            <td>Open:</td>
            <td>$ <?php echo $stockData->{'Time Series (Daily)'}->{$_POST['date']}->{'1. open'} ?></td>            
          </tr>
          <tr>
            <td>High:</td>
            <td>$ <?php echo $stockData->{'Time Series (Daily)'}->{$_POST['date']}->{'2. high'} ?></td>           
          </tr>
          <tr>
            <td>Low:</td>
            <td>$ <?php echo $stockData->{'Time Series (Daily)'}->{$_POST['date']}->{'3. low'} ?></td>            
          </tr>
          <tr>
            <td>Close:</td>
            <td>$ <?php echo $stockData->{'Time Series (Daily)'}->{$_POST['date']}->{'4. close'} ?></td>            
          </tr>
          <tr>
            <td>Volume:</td>
            <td><?php echo $stockData->{'Time Series (Daily)'}->{$_POST['date']}->{'6. volume'} ?></td>         
          </tr>          
        </table>
      <?php else : ?>
        <p>Trading was closed.</p>
      <?php endif; ?>
    <?php
  }
}
//  var_dump(  date("Y-m-d") > $_POST['date'] ); 
//  var_dump(  $stockData->{'Time Series (Daily)'}->{$_POST['date']} ); 


 // Show our footer.
include './templates/footer.php';