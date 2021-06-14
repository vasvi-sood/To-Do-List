<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <H1>TO-DO LIST</H1>

        <?php
    include 'database.php';
    $sql="Select * from item order by id desc;";
    $result=mysqli_query($conn,$sql); ?>

        <?php if(mysqli_num_rows($result)>0) {?>
        <table>
            <th> DONE</th>
            <th> INDEX </th>
            <th> TO DO Items </th>
            <th> DATE </th>
            <?php    $i=1;
   while($row=mysqli_fetch_assoc($result))
    { if(!$row['checked']){?>
            <tr>
                <td>
                    <input type="checkbox" name="check" id=check<?php echo $row["id"]?> onclick="strike(this.id)">
                </td>
                <td id=sno<?php echo $row["id"]?>>
                    <?php echo $i; ?> </td>
                <td id=name<?php echo $row["id"]?>>
                    <?php echo $row["name"]; ?> </td>
                <td id=date<?php echo $row["id"]?>>
                    <?php echo $row["date"]; ?>
                </td>

                <td>
                    <button class="removeItem" id=<?php echo $row["id"]?> onclick="del(this.id)"> Delete</button>
                </td>
            </tr>

            <?php } else{?>
            <div>
                <tr>
                    <td>
                        <input type="checkbox" name="check" id=check<?php echo $row["id"]?> onclick="strike(this.id)"
                            checked>
                    </td>
                    <td class="striked" id=sno<?php echo $row["id"]?>>
                        <?php echo $i; ?>
                    </td>
                    <td class="striked" id=name<?php echo $row["id"]?>>
                        <?php echo $row["name"]; ?>
                    </td>
                    <td class="striked" id=date<?php echo $row["id"]?>>
                        <?php echo $row["date"]; ?>
                    </td>

                    <td>
                        <button id=<?php echo $row["id"]?> onclick="del(this.id)">Delete</button>
                    </td>
                </tr>
            </div>




            <?php }  $i++;  } ?>
        </table>
        <?php } else
     {
        echo "no item to show";
    } 
    ?>


    </div>