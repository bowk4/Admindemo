<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "admin";

$user_id = "";
$username = "";
$login = "";
$products_id = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Could not connect to MySQL server!';
}

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);                                                        
    $posts[1] = $_POST['username'];                                                          
    $posts[2] = $_POST['login'];                          
 $posts[3] = filter_var($_POST['products_id'], FILTER_SANITIZE_NUMBER_INT);
    return $posts;
}

  


// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM users WHERE user_id = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $login = $row['login'];
                $products_id = $row['products_id'];
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `users`(`user_id` ,`username`, `login`, `products_id`) VALUES ('$data[0]','$data[1]','$data[2]', '$data[3]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `users` WHERE `user_id` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `users` SET `username`='$data[1]',`login`='$data[2]',`products_id`=$data[3] WHERE `user_id` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}




?>


<!DOCTYPE Html>
<html>
    <head>
        <title>PHP INSERT UPDATE DELETE SEARCH</title>
         <link href="style.css" media="screen" rel="stylesheet">
        <link href= 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    
<body>
<div class="container mlogin">
<div id="login">
<h1>Users</h1>
<a href="products.php">Products</a>
<a href="chackes.php">Chackes</a>
<a href="roles.php">Roles</a></p>
        <form action="users.php" method="post">
            <p><label for="user_id">ID<br>
            <input type="number" name="user_id" placeholder="" value="<?php echo $user_id;?>"><br><br>
            <p><label for="username">Username<br>
             <input type="text" name="username" placeholder="" value="<?php echo $username;?>"><br><br>
             <p><label for="login">Login<br>
            <input type="text" name="login" placeholder="" value="<?php echo $login;?>"><br><br>
            <p><label for="products_id">Products id<br>
            <input type="number" name="products_id" placeholder="" value="<?php echo $products_id;?>"><br><br>

            <div>

<p class="submit"><input class="button" name="search"type= "submit" value="Find"></p>

<p class="submit"><input class="button" name="delete"type= "submit" value="Delete"></p>

<p class="submit"><input class="button" name="update"type= "submit" value="Update"></p>

<p class="submit"><input class="button" name="insert"type= "submit" value="Add"></p>

&nbsp;

<p class="submit"><input class="button" name="guruweba_example_reset "type= "reset" value="Clear fields"></p>
&nbsp;

<p><a href="logout.php">Выйти</a> из системы</p>

</div>
</div>
<footer>
</footer>
</body>
       

<html>









 