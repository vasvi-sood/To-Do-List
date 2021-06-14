<?php
$error="";
$success="";
$time=time(); //current timestamp
echo date("D,d-M-Y H:i:s",$time); //date in this format. 2nd argument is optional
$now= new DateTime(); //date-time object
echo "<BR>";
echo $now->format('D,d-m-Y H:i:s');
if(isset($_POST['submit'])&& $_POST['submit']=='submit')
{
require "database.php";
$name=$_POST['itemname'];

if(empty($name))
{
$error="Item name is a required field";
header("Location:index.php");
exit();
}

else{
    $sql="Insert into item (name) values (?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
       exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    $success="TO-DO added";
    header("Location:index.php");
    exit();
}
echo $_POST["submit"];
}

?>
<?php
include 'items.php';
?>
<?php
if(isset($_GET["done"]) && ($_GET["done"]==true || $_GET["done"]==false) && (isset($_GET["id"])))
{
    include 'database.php';
   $id=$_GET["id"];
   $check=$_GET["done"]=="true"?0:1;
   
    $sql="Update `item` SET `checked` = (?) Where `id`= (?)";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
       echo "Error";
        exit();
    }
    echo mysqli_stmt_bind_param($stmt,"si",$check,$id);
    mysqli_stmt_execute($stmt);
    echo "done";
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

<form action="index.php" method="POST">
    <!-- autocomplete is a non standard feature -->
    <input type="text" name="itemname" id="itemname" placeholder="Add todo here.." autocomplete="off">
    <input type="submit" name="submit" value="submit"></button>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function strike(id) {
    let ans = document.getElementById(id).hasAttribute("checked");
    console.log(ans);
    id = id.substr(5);
    console.log(id);

    let data = {
        id: id,
        done: ans
    }
    fetch(`./index.php?done=${ans}&id=${id}`, {
            mode: 'cors'
        })
        .then(response => {
            return response.text();
        }).then(response => {
            // console.log(response);
        });
    location.reload();
}


function del(id) {
    console.log(id);

    fetch(`./delete.php?id=${id}`)
        .then(response => {
            return response.text();
        }).then(response => {
            console.log(response);
        });
    location.reload();
}
</script>
</body>

</html>