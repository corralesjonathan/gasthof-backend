<?php 
     require_once '../database.php';

     // Reference: https://medoo.in/api/select
     $sizes = $database->select("tb_dishes_sizes","*");

     // Reference: https://medoo.in/api/select
     $categories = $database->select("tb_dishes_categories","*");

     $message = "";

     if($_GET){
        $dish = $database->select("tb_dishes","*",[
            "id_dish" => $_GET["id"],
        ]);
        

        $category_name = $database->get("tb_dishes_categories", "dish_category_name", [
            "id_dish_category" => $dish[0]["id_dish_category"]
        ]);
     }

     if($_POST){

        $data = $database->select("tb_dishes","*",[
            "id_dish" => $_POST["id"],
        ]);

        if(isset($_FILES["dish_image"]) && $_FILES ["dish_image"]["name"] != ""){

            $errors = [];
            $file_name = $_FILES["dish_image"]["name"];
            $file_size = $_FILES["dish_image"]["size"];
            $file_tmp = $_FILES["dish_image"]["tmp_name"];
            $file_type = $_FILES["dish_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["dish_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpeg", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not valid";
                $message = "File type is not valid";
            }


            if(empty($errors)){
                $filename = strtolower($_POST["dish_name"]);
                $filename = str_replace(',', '', $filename);
                $filename = str_replace('.', '', $filename);
                $filename = str_replace(' ', '-', $filename);
                $img = "location-".$filename.".".$file_ext;
                //move_uploaded_file($file_tmp, "../imgs/".$img);
            }
        } else{
            $img = $data[0]["dish_image"]; //si no se carga una imagen nueva se queda la que ya estaba
        }
        $database->update("tb_dishes",[
            "id_dish_category" => $_POST["dish_category_name"],
            "id_dish_size" => $_POST["dish_size_name"],
            "dish_name" => $_POST["dish_name"],
            "dish_name_de" => $_POST["dish_name_de"],
            "dish_description"=> $_POST["dish_description"],
            "dish_description_de"=> $_POST["dish_description_de"],
            "dish_image"=> $img,
            "dish_price"=> $_POST["dish_price"],
            "featured" => $_POST["featured"],
        ],[
            "id_dish" => $_POST["id"]
        ]);

        if($_POST["dish_category_name"]==1){
            move_uploaded_file($file_tmp, "../imgs/dishes/Starters/".$img);
        } else if($_POST["dish_category_name"]==2){
            move_uploaded_file($file_tmp, "../imgs/dishes/Main Courses/".$img);
        } else if($_POST["dish_category_name"]==3){
            move_uploaded_file($file_tmp, "../imgs/dishes/Desserts/".$img);
        } else {
            move_uploaded_file($file_tmp, "../imgs/dishes/Drinks/".$img);
        }

        header ("location: list-dishes.php");
     }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasthof-Edit Dish</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<header>
        <?php include 'navigation-admin.php'; ?>
    </header>

<body>
    <div class="main-container">
        <h2>Edit Dish</h2>
        <?php 
            echo $message;
        ?>
        <div class="container">     
            
            <div class="column">
                    <form method="post" action="edit-dish.php" enctype="multipart/form-data">
                    <div class="form-items-admin"> <!---Dish Name--->
                        <label for="dish_name">Dish Name</label>
                        <input id="dish_name" class="textfield" name="dish_name" type="text"
                            value="<?php echo $dish[0]["dish_name"] ?>">
                    </div>
                    <div class="form-items-admin"> <!---Dish Name - DE--->
                        <label for="dish_name_de">Dish Name - DE</label>
                        <input id="dish_name_de" class="textfield" name="dish_name_de" type="text"
                            value="<?php echo $dish[0]["dish_name_de"] ?>">
                    </div>
                    <div class="form-items-admin"> <!---Dish Description--->
                        <label for="dish_description">Dish Description</label>
                        <textarea id="dish_description" name="dish_description" id="" cols="30"
                            rows="5"><?php echo $dish[0]["dish_description"]; ?></textarea>
                    </div>
                    <div class="form-items-admin"> <!---Dish Description - DE--->
                        <label for="dish_description_de">Dish Description - DE</label>
                        <textarea id="dish_description_de" name="dish_description_de" cols="30"
                            rows="5"><?php echo $dish[0]["dish_description_de"]; ?></textarea>
                    </div>
            </div>
            
            <div class="column">
                    <div class="form-items-admin"> <!---Dish Price--->
                        <label for="dish_price">Dish Price</label>
                        <div class="price-container">
                            <span style="margin-right: 1rem">$</span>
                            <input id="dish_price" class="textfield" name="dish_price" type="number" step="0.01"
                                value="<?php echo $dish[0]["dish_price"] ?>">
                        </div>
                    </div>
                    <div class="form-items-admin"> <!---Dish Category--->
                        <label for="dish_category_name">Dish Category</label>
                        <select name="dish_category_name" id="dish_category_name">
                            <?php 
                                foreach($categories as $category){
                                    if($dish[0]["id_dish_category"] == $category["id_dish_category"]){
                                        echo "<option value='".$category["id_dish_category"]."' selected>".$category["dish_category_name"]."</option>";
                                    }else{
                                        echo "<option value='".$category["id_dish_category"]."'>".$category["dish_category_name"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-items-admin"> <!---Dish Size--->
                        <label for="dish_size_name">Dish Size</label>
                        <select name="dish_size_name" id="dish_size_name">
                            <?php 
                                foreach($sizes as $size){
                                    if($dish[0]["id_dish_size"] == $size["id_dish_size"]){
                                        echo "<option value='".$size["id_dish_size"]."' selected>".$size["dish_size_name"]."</option>";
                                    }else{
                                        echo "<option value='".$size["id_dish_size"]."'>".$size["dish_size_name"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-items-admin"> <!---Featured--->
                    <div>
                        <label>"Is a featured dish?"</label>
                        <div class="radio-group">
                            <?php 
                                if($dish[0]["featured"] == 1){
                                    echo "<input id='featured-yes' type='radio' name='featured' value='1' checked>";
                                }else{
                                    echo "<input id='featured-yes' type='radio' name='featured' value='1'>";   
                                }
                            ?>
                            <label for="featured-yes">Yes</label>
                            <?php 
                                if($dish[0]["featured"] == 0){
                                    echo "<input id='featured-no' type='radio' name='featured' value='0' checked>"; 
                                }  else{
                                    echo "<input id='featured-no' type='radio' name='featured' value='0'>"; 
                                }
                            ?>
                            <label for="featured-no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="column"> 
                    <div class="form-items-admin"> <!---Dish Image--->
                        <label for="dish_image">Dish Image</label>
                        <img id="preview" src="../imgs/dishes/<?php echo $category_name . '/' . $dish[0]["dish_image"]; ?>" alt="Preview">
                        <input id="dish_image" type="file" name="dish_image" onchange="readURL(this)">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $dish[0]["id_dish"]; ?>">
                    <div class="form-items-admin">
                        <input class="submit-btn-admin" type="submit" value="Update Dish">
                    </div>
            </div>
            </form>
        </div>    
    </div>

    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                let preview = document.getElementById('preview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

</body>

</html>