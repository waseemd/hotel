<?php
session_start();
require '../config/config.php';
require '../functions/functions.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
   <link rel="stylesheet" type="text/css" href="../../css/default.css" />
   <link rel="stylesheet" type="text/css" href="../../css/fonts.css" />
   <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
   </head>
<body>
    <div id="wrapper">
     <div id="header" class="container">
            <div id="logo">
                <h1><a href="#">Hotel Booking</a></h1>
            </div>
     </div>
     <div id="menu" class="container">
            <ul>
                <li><a href="/" title="">Home</a></li>
                <li><a href="rooms.php"  title="">View Rooms</a></li>
                <li><a href="booking.php"  title="">Make Booking</a></li>
                <li><a href="aboutus.php" title="">About Us</a></li>
            </ul>
      </div>    