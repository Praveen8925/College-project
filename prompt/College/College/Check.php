<?php
  session_start();	 
  if(! isset($_SESSION['AU']) ) 
    {
      header("location:index.php");
    }	
?>