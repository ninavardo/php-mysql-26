 <link rel="stylesheet" href="style.css">
 <?php
 $connect = mysqli_connect("localhost", "root", "", "blog_db");
 $select_roles_query = "SELECT * FROM users WHERE deleted_at is NULL";
 $roles_res =mysqli_query($connect,$select_roles_query);
 $data_of_roles_res = mysqli_fetch_all($roles_res);
 ?>
<?php
 if(isset($_GET['drop']))
    {
        $id = (int)$_GET['drop'];

        $delete_query = "UPDATE users SET deleted_at=NOW() WHERE id=$id";
        mysqli_query($connect,$delete_query);
    }
 ?>
<?php
if(isset($_POST['email'],$_POST['password'],$_POST['fname'],$_POST['lname'],$_POST['mobile'],$_POST['address'],))
    {
        $id = $_POST['id'];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);

        $update_query = "UPDATE users SET email = '$email', password = '$password', name = '$fname', lastname= '$lname',mobile = '$mobile', address = '$address', updated_at=NOW() WHERE id=$id";
        mysqli_query($connect,$update_query);

        header("Location: users_update_drop.php");
    }
if(isset($_GET['id']))
    {
        $id = (int) $_GET['id'];

        $select_role = "SELECT * FROM users WHERE id=$id";
        $res = mysqli_query($connect,$select_role);
        $row_role_by_id = mysqli_fetch_assoc($res);
?>
<form method="POST">
    <input type="hidden" name="id" value="<?= $row_role_by_id['id']?>">

    <label>Email : </label>
    <input type="text" name="email" value="<?=$row_role_by_id['email']?>"><br><br>

    <label>Password : </label>
    <input type="text" name="password" value="<?=$row_role_by_id['password']?>"><br><br>

    <label>Name : </label>
    <input type="text" name="fname" value="<?=$row_role_by_id['name']?>"><br><br>

    <label>LastName : </label>
    <input type="text" name="lname" value="<?=$row_role_by_id['lastname']?>"><br><br>

    <label>mobile : </label>
    <input type="text" name="mobile" value="<?=$row_role_by_id['mobile']?>"><br><br>

    <label>Address : </label>
    <input type="text" name="address" value="<?=$row_role_by_id['address']?>"><br><br>

    <button type="submit" name="update">EDIT</button>
</form>
<?php
    }
?>
 <table>
    <tr>
        <th>ID</th>
        <th>Role_ID</th>
        <th>email</th>
        <th>password</th>
        <th>name</th>
        <th>lastname</th>
        <th>mobile</th>
        <th>address</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
    </tr>

<?php
foreach($data_of_roles_res as $row)
    {
?>
    <tr>
        <td><?= $row[0]?></td>
        <td><?= $row[1]?></td>
        <td><?= $row[2]?></td>
        <td><?= $row[3]?></td>
        <td><?= $row[4]?></td>
        <td><?= $row[5]?></td>
        <td><?= $row[6]?></td>
        <td><?= $row[7]?></td>
        <td><?= $row[8]?></td>
        <td><?= $row[9]?></td>
        <td><?= $row[10]?></td>
        <td><a href="?id=<?= $row[0]?>">EDIT</a></td>
        <td><a href="?drop=<?= $row[0]?>">DROP</a></td>
    </tr>
<?php
    }
?>
 </table>