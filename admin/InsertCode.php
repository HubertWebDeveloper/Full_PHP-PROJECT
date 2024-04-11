<?php
$con = mysqli_connect("localhost","root","","dontmiss");

if(isset($_POST['save_product'])){
        $title = $_POST['p_title'];
        $price = $_POST['p_price'];
        $desc = $_POST['p_description'];
        $imgs = $_FILES['p_image']['name'];
        $temp_name = $_FILES['p_image']['tmp_name'];
        move_uploaded_file($temp_name, "../images/$imgs");

        $insert = mysqli_query($con, "INSERT INTO `product`(`title`, `description`, `image`, `price`) 
        VALUES ('$title','$desc','$imgs','$price')");
        if($insert){
            echo "<script>window.open('product.php','_self')</script>";
        }else{
            echo "<script>window.open('product.php','_self')</script>";
        }
}
if(isset($_POST['save_session'])){
        $title = $_POST['s_title'];
        $desc = $_POST['s_description'];
        $type = $_POST['s_type'];
        $date = date('Y-m-d');
        $category1 = $_POST['s_categ1'];
        $category2 = $_POST['s_categ2'];
        $category3 = $_POST['s_categ3'];

        if($category3 !=""){
            $categ = $_POST['s_categ3'];
        }else if($category1 !=""){
            $categ = $_POST['s_categ1'];
        }else if($category2 !=""){
            $categ = $_POST['s_categ2'];
        }

        $imgs_session = $_FILES['s_image']['name'];
        $video = $_FILES['s_video']['name'];

        $insert2 = mysqli_query($con, "INSERT INTO `session`(`title`, `date`, `image`, `video`, `type`, `category`, `content`) 
        VALUES ('$title','$date','$imgs_session','$video','$type','$categ','$desc')");
        if($insert2){
            $imgs_session = $_FILES['s_image']['name'];
            $temp_name = $_FILES['s_image']['tmp_name'];
            move_uploaded_file($temp_name, "../images/$imgs_session");

            $video = $_FILES['s_video']['name'];
            $temp_name = $_FILES['s_video']['tmp_name'];
            move_uploaded_file($temp_name, "../videos/$video");

            echo "<script>window.open('session.php','_self')</script>";
        }else{
            echo "<script>window.open('session.php','_self')</script>";
        }
}
?>