<?php
include"connection.php";

if(isset($_POST['sub']))
{
	$nm=$_POST['nme'];
	$mbn=$_POST['mbn'];
	$emil=$_POST['eml'];
	$gen=$_POST['gender'];
	$fl=$_FILES['file']['name'];
	$unm=$_POST['uname'];
	$pw=$_POST['pw'];
	if(isset($_POST['qua']))
	{
		$qualification=$_POST['qua'];
		$q=implode(',', $qualification);
	}
	if($fl!="")
	{
		$filearray=pathinfo($_FILES['file']['name']);
		$file1=rand();
		$file_ext=$filearray["extension"];
		if(check_ext($file_ext))

		{
			$filenew=$file1.".".$file_ext;
			move_uploaded_file($_FILES['file']['tmp_name'],"photos/".$filenew);
		}
		else
		{
			echo"<script>alert('check file extension')</script>";
		}
	}
	




mysqli_query($con,"INSERT INTO login_tb(username,password)VALUES('$unm','$pw')");
$last_login_id=mysqli_insert_id($con);
mysqli_query($con,"INSERT INTO registration_tb(login_id,name,mobilenumber,emilid,gender,qualification,file,username) VALUES('$last_login_id','$nm','$mbn','$emil','$gen','$q','$filenew','$unm')");

echo "<script>alert('registration completed')</script>";
}
function check_ext($f_ext)
{
	$allowed=array('jpg','png','jpeg','JPG');
	if(in_array($f_ext,$allowed))
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
	

	<table width="=300" border="1">
		<tr>
			<th>Name</th>
			<td><input type="text" name="nme" id="nme_id" placeholder="Enter your name"  onkeyup="clearmsg('sp1')">
                   <span id="sp1" style="color: red"></span></td>
		</tr>
		<tr>
			<th> Mobile No</th>
			<td><input type="text" name="mbn" id="mbn_id" placeholder="Mobile number"  onkeyup="clearmsg('sp2')">
                   <span id="sp2" style="color: red"></span></td></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><input type="Email" name="eml" id="eml_id" placeholder="mail id" onkeyup="clearmsg('sp3')">
                   <span id="sp3" style="color: red"></span></td> </td>
		</tr>
		<tr>
	  		 	<th>Gender</th>
	  		 	<td><input type="radio" name="gender" id="gndr1" value="male">male<br>
                <input type="radio" name="gender" id="gndr2"  value="female" onkeyup="clearmsg('spgen')">female
                   <span id="spgen" style="color: red"></span></td> </td><br>
	  		 	</td>
	  		 </tr>
	  		 <tr>
	  		 	<th>Qualification</th>
	  		 	<td>
	  		 		<input type="checkbox" name="qua[]"  value="sslc">SSLC
	  		 		<input type="checkbox" name="qua[]" value="plus2" onkeyup="clearmsg('spqua')">PLUSTWO
                   <span id="spqua" style="color: red"></span></td> </td> 
	  		 	
	  		 	</td>
	  		 </tr>
	  		 <tr>
	  		 	<th>Upload</th>
	  		 	<td>
	  		 		<input type="file" name="file">
	  		 	</td>
	  		 </tr>
	  		 <tr>
	  		 	<th>User name</th>
	  		 	<td><input type="text" name="uname" id="un_id"onkeyup="clearmsg('sp4')">
                   <span id="sp1" style="color: red"></span></td> ></td>
	  		 </tr>
	  		 <tr>
	  		 	<th>Password</th>
	  		 	<td><input type="Password" name="pw" id="pw_id" onkeyup="clearmsg('sp5')">
                   <span id="sp1" style="color: red"></span></td> ></td>
	  		 	</td>
	  		 </tr>
		
	</table>

	<input type="submit" name="sub" value="submit" onClick="return validate() >
	  		<input type="button" name="rest" value="reset">
	
</form>
</body>
<script>
	function validate()
		{
			var name=document.getElementById("nme_id").value;
			var mob=document.getElementById("mbn_id").value;
			 var email=document.getElementById("eml_id").value;
			 var ugen=document.getElementByName("gender").value;
			 var uqua=document.getElementByName("qua").value;
			 var uname=document.getElementById("un_id").value;
			 var pswd=document.getElementById("pw_id").value;
			 if(name=="")
			{
				document.getElementById("sp1").innerHTML="please enter your name";
			    return false;
			}
			 if(mob==""||mob.length<10)
			 {
			 	document.getElementById("sp2").innerHTML="please enter your mobile number";
				return false;
			}
			 if(email=="")
			 {
				document.getElementById("sp3").innerHTML="please enter youremail id";
				return false;

			 }
			 flag=0;
			 for (i = 0; i < ugen.length; i++)
			  {
			 	if (ugen[i].checked==true)
			 	 {
			 	 	flag=1;
			 	 	break;
			 	 }
			 }
			 if (flag==0) 
			 {
			  document.getElementById("spgen").innerHTML="select a gender";
			  return false;
		     }
		     flag=0;
			 for (i = 0; i < uqua.length; i++)
			  {
			 	if (uqua[i].checked==true)
			 	 {
			 	 	flag=1;
			 	 	break;
			 	 }
			 }
			 if (flag==0) 
			 {
			  document.getElementById("spqua").innerHTML="select a qualification";
			  return false;
		     }
			if (uname=="") 
			{
				document.getElementById("sp4").innerHTML="enter username";
				return false;
			}
			if (pswd=="")
			 {
			 	document.getElementById("sp5").innerHTML="enter password";
			 	return false;
			 }
		}
function clearmsg(sp)
		{
			document.getElementById(sp).innerHTML="";
		}

</script>>
</html>