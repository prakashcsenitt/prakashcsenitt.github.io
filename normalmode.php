<html>
<head>
<title> register </title>
</head>
<body>
<h3> registration form</h3>
<form action="" method="POST" enctype="multipart/form-data">
rollno:<input type="text" name="rollno"><br>
username: <input type="text" name="username"<br>
password:<input type="password" name="password"><br>
year of study:<input type="text" name="yearofstudy"><br>
email:<input type="text" name="email"><br>
image:<input type="file" name="file"><br>
<input type="submit" value="upload"><br>
unique number:<input type="text" name="uninumber"><br>
<input type="submit" value="login" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{$rollno=$_POST['rollno'];
$users=$_POST['username'];
 $pass=$_POST['password'];
$yearofstudy=$_POST['yearofstudy'];
$email=$_POST['email'];
$uniquenumber=$_POST['uninumber'];
$name= $_FILES['file']['name'];
$extension=strtolower(substr($name,strpos($name,'.')+1));
$type=$_FILES['file']['type']; 
$size=$_FILES['file']['size']; 
$maxsize=500000; 
$tmpname=$_FILES['file']['tmp_name'];
if(isset($name))
{if(!empty($name))
{ if(($extension=='jpg'||$extension=='jpeg')&&$type=='image/jpeg'&&$size<=$maxsize)
{ $location='uploads';
if(move_uploaded_file($tmpname,$location.$name))
{echo 'uploaded';
}else {echo 'error';}}
else {echo 'file must  be jpg or jpeg or 500kb less';}}}

$conn=new mysqli("localhost","root","","prakash");
if(!empty($rollno)&&!empty($users)&&!empty($pass)&&!empty($yearofstudy)&&!empty($email)&&!empty($uniquenumber)){
if($conn->connect_error)
{die("connection failed:".$conn->connect_error);}
$sql="SELECT * FROM login WHERE rollno=$rollno";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)== 0)
{ $sql1="INSERT INTO login(rollno,username,password,yearofstudy,email,uniquenumber,image) VALUES('$rollno','$users','$pass','$yearofstudy','$email','$uniquenumber','$name')";
if($conn->query($sql1)==TRUE)
{echo 'success';}
else
{ echo 'failure';
}}}}
?>
</body> 
</html>

