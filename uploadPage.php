<?php

if(isset($_FILES['image'])){
      $page_id = $_POST['pageid'];

      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $expensions= array("jpeg","jpg","png","gif","jfif");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="תמונה מסוג זה בלתי אפשרית אלא רק בפרומטים jpg, gif, png, jpeg";
      }

      if($file_size > 8097152){
         $errors[]='תמונה לא יכולה להיות מעל 8 מב';
      }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/pages/".$file_name);
         $newLogo = "uploads/pages/".$file_name;

         $query = "UPDATE pages SET imgFront = ? WHERE id = ?";

         $statement = $databaseConnection->prepare($query);
         $statement->bind_param('ss', $newLogo, $page_id);
         $statement->execute();
         $statement->store_result();

         if ($statement->error)
         {
             die('Database query failed: ' . $statement->error);
         }

         $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
         if ($creationWasSuccessful)
         {
           ?><script>alert('תמונה זה הועלתה בהצלחה');</script><?
         }
      }else{
         print_r($errors);
      }
   }
?>
