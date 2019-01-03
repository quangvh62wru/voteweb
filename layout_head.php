<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>Live Poll System in PHP Mysql using Ajax</title> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>

<!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />

<!-- admin custom CSS -->
    <link href="<?php echo $home_url . "libs/css/customer.css" ?>" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <style type="text/css">
    .container{
        margin: 0px;
    }
    .candidates{
        border: 1px solid green;
        padding: 2px;
        width: 300px;
        height: 180px;
    }
    </style> 
</head>
<body>

    <!-- include the navigation bar -->
    <?php include_once 'navigation.php'; ?>
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->

    <!-- container -->
    <div class="container">

        <?php
        // if given page title is 'Login', do not display the title
        if($page_title!="Login"){
            ?>
            <div class='col-md-12'>
                <div class="page-header">
                    <h1><?php echo isset($page_title) ? $page_title : "The Code of a Ninja"; ?></h1>
                </div>
            </div>
            <?php
        }
        ?>
