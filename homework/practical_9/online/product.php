 <link rel="stylesheet" href="styles.css">
 <?php
 $connect = mysqli_connect("localhost","root","","online_sales");
 $select_query = "SELECT * FROM products WHERE deleted_at is NULL";
 $select_res = mysqli_query($connect,$select_query);
 $row_by_product_id = mysqli_fetch_all($select_res);
 ?>
 <?php
if(isset($_GET['drop']))
    {
        $id_drop = (int)$_GET['drop'];
        
        $update_drop_query = "UPDATE products SET deleted_at=NOW() WHERE id=$id_drop";
        mysqli_query($connect,$update_drop_query);
    }
?>
 <?php
 if(isset($_POST['name'],$_POST['content']))
    {
        $id = (int) $_POST['id'];
        $name = trim($_POST['name']);
        $content = trim($_POST['content']);

        $update_query = "UPDATE products SET name='$name',content='$content',updated_at=NOW() WHERE id=$id";
        mysqli_query($connect,$update_query);

        header("Location: product_update_drop.php");
    }
 ?>
<?php
if(isset($_GET['id']))
    {
         $id = (int)$_GET['id'];

         $select_query_1 = "SELECT * FROM products where id=$id";
         $res = mysqli_query($connect,$select_query_1);
         $row_by_role_id = mysqli_fetch_assoc($res);
?>
<form method='POST'>
    <h2>EDIT FORM</h2>
    
    <input type="hidden" name="id" value='<?= $row_by_role_id['id'] ?>'>
    
    <label>name : </label>
    <input type="text" name="name" value='<?= $row_by_role_id['name']?>'><br><br>

    <label>contenct : </label>
    <input type="text" name="content" value='<?= $row_by_role_id['content']?>'><br><br>

    <button type="submit" name="submit">SUBMIT</button>
</form>
<?php
    }
?>
<div>
    <a href="./product_update_drop.php">HOME</a>
</div>

 <table>
    <tr>
        <th>ID</th>
        <th>Category_ID</th>
        <th>Name</th>
        <th>Content</th>
        <th>Image</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>EDIT</th>
        <th>DROP</th>
    </tr>

<?php
foreach($row_by_product_id as $row)
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
    <td><a href="?id=<?= $row[0]?>">EDIT</a></td>
    <td><a href="?drop=<?= $row[0]?>">DROP</a></td>
</tr>
<?php
    }
?>
 </table>