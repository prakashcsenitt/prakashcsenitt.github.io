<?php
$servername = "localhost";
$username = "root";
$dbname = "DeltaDataBase5";
$current = 0;

$conn = new mysqli($servername, $username, "", $dbname);
if ($conn->connect_error) {
	
$conn1 = new mysqli($servername, $username, "");
if ($conn1->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "CREATE DATABASE DeltaDataBase5";
if ($conn1->query($sql) === TRUE) {
    
} else {
    echo "Error creating database: " . $conn->error;
}

$conn1->close();
$conn = new mysqli($servername, $username, "", $dbname);
    
} 

$sql = "SELECT MAX(uniqueno) as uniqueno FROM tabletask4";
if ($conn->query($sql)) {
	
	$max = $conn->query($sql);
	 $row = $max->fetch_assoc();
	 $last = $row["uniqueno"];
    for($i=$last+1;;$i++)
	{  
      
       $j=0;
       $num=0;
       $k=$i;
      while($k)
	  {
		  $j++;
		  $temp = $k%10;
		  $k=intval($k/10);
		  if($j%2)
		  {
			 $temp*=2;
             if($temp>=10)
              $temp=intval($temp/10) + $temp%10;				 
		  }
		  $mult=1;
		  for($z=1;$z<$j;$z++)
			  $mult*=10;
		  $temp*=$mult;
		  $num+=$temp;
	  }
	  $sum=0;
	  while($num)
	  {
		  $temp = $num%10;
		  $num=intval($num/10);
		  $sum+=$temp;
		  
	  }
	  if($sum%10==0)
	  {   global $current;
		  $current=$i;
		  
		  break;
		  
	  }
		
	}
} else {
    $sql = "CREATE TABLE tabletask4 (
rollno INT(10), 
name VARCHAR(30) ,
email VARCHAR(50),
dept VARCHAR(10),
year INT(5),
password VARCHAR(100),
uniqueno INT(10) 
)";

if ($conn->query($sql) === TRUE) {
	 global $current;
    $current=100000004;
	
	
	
} else {
    echo "Error creating table: " . $conn->error;
}
}
$stmt=$conn->prepare("Insert into tabletask4(rollno,name,email,dept,year,password,uniqueno) values (?,?,?,?,?,?,?)");
$stmt->bind_param("isssisi", $rollno, $name, $email,$dept,$year,$pass,$current);

$rollno = $_POST['roll'];
$name = $_POST['name'];
$email = $_POST['email'];
$year = $_POST['year'];
$dept = $_POST['dep'];
$pass = $_POST['pass1'];
$img = $_FILES['img'];
$query1 = "SELECT * FROM tabletask4 where rollno=".$rollno.";";
$result = $conn->query($query1);
if ($result->num_rows > 0) 
{
	 echo("ROLLNO Registered");
    exit;
}
else
{




if ($stmt->execute()=== TRUE) {
    echo "user added successfully";
	$target_file = $rollno.".";
	$imageFileType = pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
    
	if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
|| $imageFileType == "gif" ) {
	$target_file.=$imageFileType; 
	if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
    
}
else
{
	echo "file not an image";
}
} else {
    echo "Error adding to table " . $conn->error;
}
}
$stmt->close();
$conn->close();
?>
