<div id="content">
  
  <div>
     <img  src="images/sign.jpg" style="float:left;margin-left:-100px;"/>
  </div>
  
    <div>
	
	   <form method="post" action="" id="form2">
	   <h2><font color="white">Sign Up Here</font></h2>
	   <table>
  
           <tr>
		    <td align="right"><font color="white" size="5px">Name:</font></td>
			<td><input type="text" name="u_name" placeholder="Enter your name" required="required"/></td>
		   
		   </tr>
		              <tr>
		    <td align="right"><font color="white" size="5px">Password:</font></td>
			<td><input type="password" name="u_pass" placeholder="Enter your password" required="required"/></td>
		   
		   </tr>
		              <tr>
		    <td align="right"><font color="white" size="5px">Email:</font></td>
			<td><input type="email" name="u_mail" placeholder="Enter your Email" required="required"/></td>
		   
		   </tr>
		              <tr>
		    <td align="right"><font color="white" size="5px">Country:</font></td>
			<td>
			  <select name="u_country" required="required">
	              <option>Select a Country</option> 
                  <option>India</option>
 					 <option>US</option>
					 <option>England</option>
					 <option>Australia</option>
			  </select>
			</td>
		   
		   </tr>
		              <tr>
		    <td align="right"><font color="white" size="5px">Gender:</font></td>
			<td>
			 <select name="u_gender" required="required">
	              <option>Select a Gender</option> 
                  <option>Male</option>
 					 <option>Female</option>
					 
			  </select></td>
		   
		   </tr>
		   <tr>
		    <td align="right"><font color="white" size="5px">Date of Birth:</font></td>
			<td><input type="date" name="u_birth"/></td>
		   
		   </tr>
		   <tr>

			<td colspan="6"><button name="u_sub">Sign Up</button></td>
		   
		   </tr>
  
  </table>
        </form>
		<?php
		include("user_insert.php");
		
		?>
		
		
		
  </div>
 </div>