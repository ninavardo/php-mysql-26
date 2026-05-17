 <link rel="stylesheet" href="styles.css">
 <?php
 $connect = mysqli_connect("localhost","root","","online_sales");
 $select = "SELECT * FROM users WHERE deleted_at is NULL";
 $select_res = mysqli_query($connect,$select);
 $users_by_rows = mysqli_fetch_all($select_res);
 ?>
 <?php
 if(isset($_GET['drop']))
    {
        $id = (int)$_GET['drop'];
        $drop_query = "UPDATE users SET deleted_at=NOW() WHERE id=$id";
        mysqli_query($connect,$drop_query);
    }
 ?>
<?php
if(isset($_POST['Fname'],$_POST['Lname'],$_POST['Email'],$_POST['Password'],$_POST['Address'],))
    {
        $id = (int)($_POST['id']);
        $Fname = trim($_POST['Fname']);
        $Lname = trim($_POST['Lname']);
        $Email = trim($_POST['Email']);
        $Password = trim($_POST['Password']);
        $Address = trim($_POST['Address']);

        $update_query = "UPDATE users SET name='$Fname', lastname ='$Lname',email='$Email',password='$Password',address='$Address',updated_at=NOW() WHERE id=$id";
        mysqli_query($connect,$update_query);

        header("Location: users_update_drop.php");
    }
if(isset($_GET['id']))
    {
        $id = (int) $_GET['id'];
        $select_by_id = "SELECT * FROM users WHERE id=$id";
        $res = mysqli_query($connect,$select_by_id);
        $row_by_role =mysqli_fetch_assoc($res);
?>
<form method="POST">
    <input type="hidden" name="id" value='<?= $row_by_role['id'] ?>'>

    <h3>EDIT FORM</h3>
    <label>Name : </label>
    <input type="text" name="Fname" value='<?= $row_by_role['name'] ?>'><br><br>

    <label>LastName : </label>
    <input type="text" name="Lname" value='<?= $row_by_role['lastname'] ?>'><br><br>

    <label>Email : </label>
    <input type="email" name="Email" value='<?= $row_by_role['email'] ?>'><br><br>

    <label>Password : </label>
    <input type="text" name="Password" value='<?= $row_by_role['password'] ?>'><br><br>

    <label>Address : </label>
    <input type="text" name="Address" value='<?= $row_by_role['address'] ?>'><br><br>

    <button name="submit" type="submit">SUBMIT</button>
</form>
<?php
    }
?>

<div>
    <a href="./users_update_drop.php">HOME</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Role_ID</th>
        <th>Name</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Password</th>
        <th>Address</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>EDIT</th>
        <th>DROP</th>
    </tr>
<?php
foreach($users_by_rows as $row)
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
    <td><a href="?id=<?= $row[0]?>">EDIT</a></td>
    <td><a href="?drop=<?= $row[0]?>">DROP</a></td>
</tr>
<?php
    }
?>
 </table>