<link rel="stylesheet" href="style.css">
<?php 
$connect = mysqli_connect("localhost", "root", "", "blog_db");
$select_roles_query = "SELECT * FROM categorys WHERE deleted_at is NULL";
$roles_res = mysqli_query($connect,$select_roles_query);
$data_of_roles_res = mysqli_fetch_all($roles_res);
?>
 <?php
 if(isset($_GET['drop']))
    {
        $id = (int)$_GET['drop'];

        $delete_query = "UPDATE categorys SET deleted_at=NOW() WHERE id=$id";
        mysqli_query($connect,$delete_query);
    }
 ?>
 <?php
if(isset($_POST['name'], $_POST['id']))
    {
        $name = trim($_POST['name']);
        $id = $_POST['id'];

        $update_query = "UPDATE categorys SET name='$name' WHERE id=$id";
        mysqli_query($connect,$update_query);

        header("Location: categorys_update_drop.php");
    }

if(isset($_GET['id']))
{
    $id = (int) $_GET['id'];

    $select_role = "SELECT * FROM categorys WHERE id=$id";
    $result = mysqli_query($connect,$select_role);
    $row_role_by_id = mysqli_fetch_assoc($result);
?>

<form method="post">
    <h3>Update Form</h3>    
    Role:
    <input type="text" name="name" value="<?=$row_role_by_id['name']?>">
    <input type="hidden" name="id" value="<?=$row_role_by_id['id']?>">
    <br><br>
    <button type="submit" name="update">Edit Role</button>
</form>
<?php
}
?>

<table>
 <?php
    foreach($data_of_roles_res as $row)
        {
 ?>   
    <tr>
        <td><?= $row[0]?></td>
        <td><?= $row[1]?></td>
        <td><a href="?id=<?= $row[0]?>">EDIT</a></td>
        <td><a href="?drop=<?= $row[0]?>">DROP</a></td>
    </tr>
 <?php
        }
 ?>
</table>