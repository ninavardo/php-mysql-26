<?php
$connect = mysqli_connect("localhost", "root", "", "culinary_portal");
if (!$connect) {
    die("Database connection failed");
}

function sync_recipe_images($connect)
{
    $photos_dir = __DIR__ . "/photos/";
    if (!is_dir($photos_dir)) {
        return;
    }

    $select = "SELECT id, title, image FROM recipes WHERE deleted_at IS NULL";
    $result = mysqli_query($connect, $select);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['image'] != null && $row['image'] != "") {
            $full_path = __DIR__ . "/" . $row['image'];
            if (file_exists($full_path)) {
                continue;
            }
        }

        $title = strtolower(trim($row['title']));
        $id = (int) $row['id'];
        $extensions = array("jpg", "jpeg", "png", "gif", "webp");

        foreach ($extensions as $ext) {
            $names = array(
                $title . "." . $ext,
                $id . "." . $ext,
                str_replace(" ", "_", $title) . "." . $ext
            );

            foreach ($names as $file_name) {
                $file_path = $photos_dir . $file_name;
                if (file_exists($file_path)) {
                    $db_path = "photos/" . $file_name;
                    $update = "UPDATE recipes SET image = '$db_path' WHERE id = $id";
                    mysqli_query($connect, $update);
                    break 2;
                }
            }
        }

        $folder_files = scandir($photos_dir);
        foreach ($folder_files as $file_name) {
            if ($file_name == "." || $file_name == "..") {
                continue;
            }
            $file_title = strtolower(pathinfo($file_name, PATHINFO_FILENAME));
            if ($file_title == $title || $file_title == (string) $id) {
                $db_path = "photos/" . $file_name;
                $update = "UPDATE recipes SET image = '$db_path' WHERE id = $id";
                mysqli_query($connect, $update);
                break;
            }
        }
    }
}

sync_recipe_images($connect);
?>
