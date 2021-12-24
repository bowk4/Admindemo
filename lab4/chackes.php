<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "admin";

$id_chacke = "";
$tarif_name = "";
$from_name = "";
$to_name = "";

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
    $posts[0] = filter_var($_POST['id_chacke'], FILTER_VALIDATE_INT);
    $posts[1] = filter_var($_POST['tarif_name'], FILTER_SANITIZE_STRING);
    $posts[2] = $_POST['from_name'];
    $posts[3] = $_POST['to_name'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM chackes WHERE id_chacke = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id_chacke = $row['id_chacke'];
                $tarif_name = $row['tarif_name'];
                $from_name = $row['from_name'];
                $to_name = $row['to_name'];
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
                $insert_Query = "INSERT INTO `chackes`(`tarif_name`, `from_name`, `to_name`) VALUES ('$data[1]','$data[2]','$data[3]')";
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
    $delete_Query = "DELETE FROM `chackes` WHERE `id_chacke` = $data[0]";
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
    $update_Query = "UPDATE `chackes` SET `tarif_name`='$data[1]',`from_name`='$data[2]',`to_name`= '$data[3]' WHERE `id_chacke` = $data[0]";
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
<h1>Chackes</h1>
<a href="roles.php">Roles</a>
<a href="chackes.php">Chackes</a>
<a href="users.php">Users</a></p>
        <form action="chackes.php" method="post">
            <p><label for="id_chacke">ID<br>
            <input type="number" name="id_chacke" placeholder="" value="<?php echo $id_chacke;?>"><br><br>
            <p><label for="tarif_name">Tarif name<br>
             <input type="text" name="tarif_name" placeholder="" value="<?php echo $tarif_name;?>"><br><br>
             <p><label for="from_name">From name<br>
            <input type="text" name="from_name" placeholder="" value="<?php echo $from_name;?>"><br><br>
            <p><label for="to_name">To name<br>
            <input type="text" name="to_name" placeholder="" value="<?php echo $to_name;?>"><br><br>
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