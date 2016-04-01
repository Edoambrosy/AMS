  <?php
  if(!(isset($_SESSION['user'])))
  	header("Location: index.php?p=signup_signin");
   ?>
      <br />
      Expect delivery in two weeks after purchase.
      <form lang="en" >
		<table align="center">
			<tr>
				<th height="50" colspan="2">
					<font size = 3 color = "brown"> Mode of paymets</font>
				</th>
				
			</tr>
			<tr>
				<td height="53">
					<label><input type="radio" name="payment" value="airtel" checked> <b>Aiterl-Money</b></label>
				</td>	
				<td>
					+255 752 151 511
				</td>	
			</tr>
			<tr>
				<td height="53">
					<label><input type="radio" name="payment" value="zantel"> <b>Ezy-Pesa</b></label>
				</td>
				<td height="53">
					+255 644 543 553
				</td>
			</tr>
			<tr>
				<td height="53">
					<label><input type="radio" name="payment" value="vodacom"> <b>M-Pesa</b></label>
				</td>	
				<td height="53">
					+255 756 222 743
				</td>		
			</tr>
			<tr>
				<td height="53">
					<label><input type="radio" name="payment" value="tigo"> <b>TiGo-Pesa</b></label>
				</td>	
				<td height="53">
					+255 759 457 444
				</td>		
			</tr>
			<tr>
				<td height="53">
					<label><input type="radio" name="payment" value="paypal"> <b>Pay-Pal</b></label>
				</td>	
				<td>
					+255 683 123 511
				</td>		
			</tr>
            
            
			<tr>
				<td height="53" colspan="2">
					<center><input type="button"  align ="center" value="Pay Now" /></center>
				</td>	
			</tr>
                
		</table>	
         
       
	</form>
	<br /><br /><p><a href='index.php?p=cart' style='color:red;'>Close</a> &nbsp; <a href='index.php' style='color:darkgreen';>Go Back To Home Page</a></p>