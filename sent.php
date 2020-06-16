<?php include('processes/server.php');

if(!isset($_SESSION['username'])){
  $_SESSION['msg']="You must login to view this page";
  header("location: login.php");
}

$link_address="eventstatus.php";
 ?>


 <!DOCTYPE html>
 <html>
   <head>

     <meta charset="utf-8">
     <title>Outbox</title>
     <link href="styles/dashboard.php" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css2?family=Yatra+One&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">


 </head>

   <body>

     <div class="sidenav">
       <a href="index.php">Home</a>
       <a href="newinvite.php">Create new Event</a>
       <a href="inbox.php">Received Invitations</a>
       <a href="sent.php">Sent Invitations</a>
     </div>


     <div class="main">
       <h1>Sent Invitations</h1>

       <?php

       $query="SELECT DISTINCT invite_id,header FROM invites WHERE from_user='".$_SESSION['username']."'";
       $result=mysqli_query($db,$query);

       $num=0;
       while($row=mysqli_fetch_array($result))
       { $num++;
         $eventname=htmlspecialchars_decode($row['header']);
         $eventname=str_replace("<h1>","",$eventname);
         $eventname=str_replace("</h1>","",$eventname);
         $status_id=$row['invite_id'];
         echo "<h3>".$num.".".$eventname."</h3>";
         echo "<p><a href='".$link_address."?status_id=$status_id'>View Status</a></p>";

       };

       if($num==0) echo "<h2>No sent invitations</h2>";




        ?>
