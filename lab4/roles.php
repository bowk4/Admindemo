<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "admin";

$id = "";
$name = "";
$description = "";

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
    $posts[0] = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $posts[1] = $_POST['name'];
    $posts[2] = $_POST['description'];
    
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM roles WHERE id = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id = $row['id'];
                $name = $row['name'];
                $description = $row['description'];
               
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
                $insert_Query = "INSERT INTO `roles`(`name`, `description`) VALUES ('$data[1]','$data[2]')";
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
    $delete_Query = "DELETE FROM `roles` WHERE `id` = $data[0]";
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
    $update_Query = "UPDATE `roles` SET `name`='$data[1]',`description`='$data[2]' WHERE `id` = $data[0]";
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
<h1>Roles</h1>
<a href="products.php">Products</a>
<a href="chackes.php">Chackes</a>
<a href="users.php">Users</a></p>
        <form action="roles.php" method="post">
            <p><label for="id">ID<br>
            <input type="number" name="id" placeholder="" value="<?php echo $id;?>"><br><br>
            <p><label for="name">Name<br>
             <input type="text" name="name" placeholder="" value="<?php echo $name;?>"><br><br>
             <p><label for="Description">ID<br>
            <input type="text" name="description" placeholder="" value="<?php echo $description;?>"><br><br>
            
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
        </form>
    </body>
</html>