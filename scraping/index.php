<?php
    require_once '../database.php';
    
    include('simple_html_dom.php');
    /*
    GERMANY


    FOR STARTERS AND SALADS -> https://www.allrecipes.com/search?q=german+salads

    FOR DESSERTS -> https://www.allrecipes.com/recipes/16220/bread/yeast-bread/pretzels/
                    https://www.allrecipes.com/search?german%20desserts=german%20desserts&offset=24&q=german%20desserts
                    https://www.allrecipes.com/search?german%20desserts=german%20desserts&offset=96&q=german%20desserts
                    https://www.allrecipes.com/search?german%20desserts=german%20desserts&offset=0&q=german%20desserts

    FOR DRINKS -> https://www.allrecipes.com/recipes/77/drinks/
                  https://www.allrecipes.com/recipes/136/drinks/punch
                  https://www.allrecipes.com/recipes/1822/drinks/mocktails/

    FOR MAIN COURSES -> https://www.allrecipes.com/search?q=german+spaghettini
                        https://www.allrecipes.com/recipes/722/world-cuisine/european/german/
                        https://www.allrecipes.com/search?q=beer+brats
                        https://www.allrecipes.com/search?q=BBQ+BEER+BRAT
                        https://www.allrecipes.com/search?q=Wiener+Schnitzel
                        https://www.allrecipes.com/search?q=Jaeger+Schnitzel
                        https://www.allrecipes.com/search?q=Fried+Cabbage+and+Egg+Noodles
                        https://www.allrecipes.com/search?q=Beer+Glazed+Brats+and+Sauerkraut

    */

    //link
    $link = "https://www.allrecipes.com/search?q=Beer+Glazed+Brats+and+Sauerkraut";

    $filenames = [];
    $menu_item_names = [];
    $menu_item_descriptions = [];
    $image_urls = [];

    $menu_items = 1;

    $items = file_get_html($link);

    //save meals info and filenames for the images
    foreach ($items->find('.card--no-image') as $item){
        
        $title = $item->find('.card__title-text');
        
        $details = file_get_html($item->href);
        $description = $details->find('.article-subheading');
        $image = $details->find('.primary-image__image');

        if(count($image) > 0){
            $image_urls[] = $image[0]->src;
        }else{
            $replace_img = $item->find('.universal-image__image');
            if(count($replace_img) > 0){
                $image_urls[] = $replace_img[0]->{'data-src'};
            }
        }
       
        if(count($description) > 0){
            if($menu_items == 0) break;

            $menu_item_names[] = trim($title[0]->plaintext);
            $menu_item_descriptions[] = $description[0]->plaintext;
            
            $filename = strtolower(trim($title[0]->plaintext));
            $filename = str_replace(' ', '-', $filename);
            $filenames[] = $filename;

            $menu_items--;
        }

    }

    foreach($filenames as $index=>$item){
        echo "******************";
        echo "<br>";
        echo $item;
        echo "<br>";
        echo $menu_item_names[$index];
        echo "<br>";
        echo $menu_item_descriptions[$index];
        echo "<br>";
        echo $image_urls[$index];
        echo "<br>";
        echo rand (1*10, 10*15)/10;
        echo "<br>";
        //$menu_items--;
        //if($menu_items == 0) break;

        $isFeatured = ($index < 2);
        
        $database->insert("tb_dishes",[
            "dish_name"=> $menu_item_names[$index],
            "id_dish_size"=> 1,
            "id_dish_category"=> 2,
            "featured" => $isFeatured ? 1 : 0,
            "dish_description"=> $menu_item_descriptions[$index],
            "dish_price"=> rand (1*10, 10*15)/10,
            "dish_image"=> $item.'.jpg'
        ]);
    }

    //get and download images
   foreach ($filenames as $index=>$image){
        //route to save Starters
        //file_put_contents("../imgs/dishes/Starters/".$image.".jpg", file_get_contents($image_urls[$index]));
        //route to save Main Courses
        file_put_contents("../imgs/dishes/Main Courses/".$image.".jpg", file_get_contents($image_urls[$index]));
        //route to save Drinks
        //file_put_contents("../imgs/dishes/Drinks/".$image.".jpg", file_get_contents($image_urls[$index]));
        //route to save Desserts
        //file_put_contents("../imgs/dishes/Desserts/".$image.".jpg", file_get_contents($image_urls[$index]));
    }

    //insert info
    // Reference: https://medoo.in/api/insert
    /*$database->insert("tb_name",[
        "field"=> value,
        "field"=> value
    ]);*/
    

?>