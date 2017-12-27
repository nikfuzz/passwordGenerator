<html>
    <head></head>
    <body>


<?php
error_reporting(0);//ignores non-required error messages
$servername="localhost";
$username="";//enter the username for your local host
$pass="";//enter the password for your local host
$dbname="passrec";//Enter the database name
$con =new mysqli($servername,$username,$pass,$dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
//function to generate a random password
function random_password( $sm,$capi,$numm,$spp ) {
    $charssmall = "abcdefghijklmnopqrstuvwxyz";
    $charscap="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charsnum="0123456789";
    $charssp="!@#$%^&*()_-=+;:,.?";
    $small=substr( str_shuffle( $charssmall ), 0, $sm );
    $large=substr( str_shuffle( $charscap ), 0, $capi);
    $num=substr( str_shuffle( $charsnum ), 0, $numm );
    $sp=substr( str_shuffle( $charssp ), 0, $spp );
    $passwordpre = "$small"."$large"."$num"."$sp";
    $password = substr( str_shuffle( $passwordpre ), 0, $sm+$capi+$numm+$spp );
    return $password;
}
//input form which takes in the parameters for function
?>
<form action="passgen.php" method="post"><br>
How many capital letters? <input type= "integer" name="lencap"><br>
How many small letters? <input type = "integer" name = "lensmall"><br>
How many numerical values?<input type = "integer" name="lennum"><br>
How many special characters?<input type="integer" name="lensp"><br>
<input type = "submit" value="submit">
</form>

<?php
$count=0;//the count acts as a flag
$password = random_password($_POST["lensmall"],$_POST["lencap"],$_POST["lennum"],$_POST["lensp"]);  
$sql_check="SELECT  FROM ";//enter column name after "SELECT" and table name after "FROM"
$result_check=mysqli_query($con,$sql_check);
while($rows=mysqli_fetch_assoc($result_check))
{
    if($password==$rows["passwords"])//CHECKS IF THE PASSWORD IS SAME
        $count=$count+1;
}
if($count==0)
    echo "Your password is: "."$password";//PRINTS THE PASSWORD
else
{
    header("Refresh:10");//refreshes the page in 10s(time can be changed)
    echo"This password is taken please enter again once the page refreshes";//if the password has been taken by someone else the page refreshes
}

//insert data
//database

if($count==0)
{//inserting the pass
$sql="INSERT INTO values('$password')";//INSERT INTO table_name(column_name(passwords)values('$password')"

$result=mysqli_query($con, $sql);
if($result)
{
    echo "<br>"."Password added to the database";
}
else{
    die(mysqli_error($con));
}
}
?>





</body>
</html>