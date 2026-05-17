<link rel="stylesheet" href="style.css">
<form method="POST" enctype="multipart/form-data">
    <label>title : </label>
    <input type="text" name="title"><br><br>

    <label>textarea</label><br>
    <textarea name="text"></textarea><br><br>

    <label>img/file : </label>
    <input type="file" name="img" accept=".png, .jpg, .txt"><br><br>

    <input type="hidden" name="category_id" value="1">
    <input type="hidden" name="user_id" value="1">

    <button type="submit" name='submit'>INSERT</button>
</form>

<?php
$connect = mysqli_connect("localhost", "root", "", "blog_db");

if(isset($_POST['submit']))
    {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);
        $category_id = $_POST['category_id'];
        $user_id = $_POST['user_id'];
        
        $file_name = $_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_size = $_FILES['img']['size'];


        $uploads_area = "uploads/";
        $file_path = $uploads_area . $file_name;

        move_uploaded_file($file_tmp, $file_path);

         $insert = "INSERT INTO posts (category_id, user_id, title, text, img_url) 
                    VALUES ($category_id, $user_id, '$title', '$text', '$file_path')";
        
        mysqli_query($connect,$insert);
         
        header("Location: posts_insert.php");
    }
?>


<?php
$select_query = "SELECT * FROM posts";
$selct_res = mysqli_query($connect, $select_query);
$row_by_id = mysqli_fetch_all($selct_res);
?>
<table>
    <tr>
        <th>ID</th>
        <th>Cat_ID</th>
        <th>User_ID</th>
        <th>Title</th>
        <th>text</th>
        <th>img_URL</th>
        <th>Created_at</th>
    </tr>
<?php
foreach($row_by_id as $row)
    {
?>
    <tr>
        <th><?= $row[0] ?></th>
        <th><?= $row[1] ?></th>
        <th><?= $row[2] ?></th>
        <th><?= $row[3] ?></th>
        <th><?= $row[4] ?></th>
        <th><?= $row[5] ?></th>
        <th><?= $row[6] ?></th>
    </tr>
<?php
    }
?>
</table>