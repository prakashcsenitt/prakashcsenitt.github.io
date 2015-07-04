<!DOCTYPE HTML> 
<html>
<head>
  <title>REGISTER!!!!</title>
  <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
  <style>
  input,select{
	  box-sizing: border-box;
	  height:30px;
	  width:200px;
	  border-radius:12px 12px 12px 12px;
	  margin-top:10px;
	  margin-bottom:10px;
	  padding-left:10px;
	  
  }
  
  body
  {
	background-color:rgb(200,200,200);  
  }


   

  </style>
</head>
<body>
<center>REGISTRATION FORM</center>
<form method="post" action="databaseconnect.php" enctype="multipart/form-data" > 
<center><input id="roll" type="number" placeholder="ROLL NO" name="roll" required></center>
<center><input id="name" type="text" placeholder="NAME" name="name" required></center>
<center><input id="email" type="email" placeholder="E-MAIL" name="email"required ></center>
<center>
<select id="dep" name="dep" required>
                    <option selected="selected">Dept.</option>
					<option value="ARCHI">ARCHI</option>
				    <option value="Chemical">Chemical</option>
					<option value="Civil">Civil</option>
                    <option value="CompSci">CompSci</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="ICE">ICE</option>
                    <option value="MECH">MECH</option>
                    <option value="PROD">PROD</option>
                    <option value="META">META</option>
</select>
</center>
<center><input id="year" type="number" placeholder="YEAR OF STUDY" name="year" value="2014" required></center>
<center><input id="pass1" class="password" type="password" placeholder="PASSWORD" name="pass1"  required>
<div id="passvis" style="height:30px; width:240px;box-sizing: border-box;background-color:rgb(6,7,38);color:white; border-radius:12px 12px 12px 12px; 
padding-top:5px;" onclick="passhandler(); cursor:pointer;">MAKE PASSWORDS VISIBLE</div>
</center>
<center><input id="pass2" class="password" type="password" placeholder="RE-TYPE PASSWORD" name="pass2"  required></center>
<center><input  id="img" type="file" name="img" >
<center><div id="captchabox" style=" height:30px;width:200px; text-align:center; box-sizing:border-box;
 background-color:rgb(60,134,81); color:white; font-size:200%; border-radius:12px 12px 12px 12px ">
</div><input id="captcha" type="text" placeholder="Enter Captcha" name="captcha"  required></center>
<center><input type="button" value="REGISTER" onclick="validation();"> </center>
<center><input type="submit" id="submit"  style="visibility:hidden;"> </center>

</form>
<script>
passhandle=0;
function passhandler()
{
	if(passhandle%2==0)
	{
		document.getElementById("pass1").type="text";
		document.getElementById("pass2").type="text";
		document.getElementById("passvis").innerHTML="MAKE PASSWORDS INVISIBLE";
		passhandle++;
	}
    else
	{
	    document.getElementById("pass1").type="password";
		document.getElementById("pass2").type="password";
		document.getElementById("passvis").innerHTML="MAKE PASSWORDS VISIBLE";
		passhandle++;
	}
}
function generate()
{  
     var array = "0123456789ABCEDFGHIJKLMNOPQRSTUVWXYZ"
	var captcha= new String("");
	for(var i=0;i<6;i++)
		captcha+=array[Math.floor(Math.random() * 36)];
	document.getElementById("captchabox").innerHTML=captcha;
}
generate();
function validation()
{   
    var name = document.getElementById("name").value;
	var roll = document.getElementById("roll").value;
	var email = document.getElementById("email").value;
	var dep = document.getElementById("dep").value;
	var year= document.getElementById("year").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	var captcha = document.getElementById("captcha").value;
	name = name.trim();
	document.getElementById("name").value=name;
	
	var errors=0;
	if(pass1.localeCompare(pass2))
	{
		errors++;
		window.alert("passords don't match");
	 	document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
	}
	if((!/^[a-zA-Z]*$/.test(name)))
		{    errors++;
		window.alert("Enter a valid name");
		document.getElementById("name").value="";
		document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
	}
	if(!(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email)))
		{    errors++;
		window.alert("Enter a valid email");
		document.getElementById("email").value="";
		document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
	}
	if(!dep.localeCompare("Dept."))
	{    errors++;
		window.alert("Select a dept.");
		document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
	}
	
	var orginal = document.getElementById("captchabox").innerHTML;
	if(orginal.localeCompare(captcha))
	{
		errors++;
		window.alert("CAPTCHAS DONT MATCH");
		document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
		
	}
	
	
	
	if(errors==0)
	{
			var hash1=CryptoJS.SHA1(pass1);
		document.getElementById("pass1").value=hash1;
		document.getElementById("pass2").value=hash1;
	
		var image = document.getElementById("img");

         if(image.files && image.files.length == 1)
        {
        if (image.files[0].size > 512000)
        {
            alert("The Image file must be less than 500 KB");
            errors++;
        }
    }
    
		if(!errors)
		document.getElementById("submit").click();
		
	}
	if(roll==""||name==""||email==""||pass1=="")
	{
		document.getElementById("pass1").value="";
		document.getElementById("pass2").value="";
		document.getElementById("captcha").value="";
		generate();
		
	}
	
	
	
}
</script>
</body>
</html>
