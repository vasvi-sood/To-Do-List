<?php
if(isset($_GET["id"]))
{
    echo "I'm here";
require "database.php";
$id=$_GET["id"];
$sql="Select * from item where `id` = $id";
$result=mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);
if($row==0)
{
header("Location:index.php?error=noindex");
exit();
}
else
{



$sql="Delete from item where id=(?)";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql))
{
header("Location:index.php?error=Mysqlerror");
exit();
}
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location:index.php?success=index");
exit();
}


}
?>