<!DOCTYPE html>
<html>
   <head>
      <title>PHP CRUD APP</title>
      <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
     </script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   </head>
   <body>
      <?php require_once 'process.php'; ?>

      <?php
      if (isset($_SESSION['message'])): ?>
      <div class="alert alert-<?=$_SESSION['msg_type']?>">
         <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
       </div>
    <?php endif ?>
      <div class="container">
      <?php
         $mysqli = new mysqli('127.0.0.1','dustin','Dubu123@','crud');
         $result = $mysqli->query("SELECT * FROM data");
         //pre_r($result);
         //pre_r($result->fetch_assoc());

      ?>

      <div class="row justify-content-center">
         <table class="table">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th colspan="2">Action</th>
               </tr>
            </thead>
      <?php
         while ($row = $result->fetch_assoc()): ?>
            <tr>
               <td><?php echo $row['name'];?></td>
               <td><?php echo $row['location'];?></td>
               <td>
                  <a href="index.php?edit=<?php echo $row['id']; ?>"
                     class="btn btn-info">Edit</a>
                  <a href="process.php?delete=<?php echo $row['id']?>"
                     class="btn btn-danger">Delete</a>
               </td>
            </tr>
         <?php endwhile; ?>
         </table>
      </div>

      <?php
         function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
         }
      ?>
      <div class="row justify-content-center">
         <form class="" action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
               <label class="form-label">NAME</label>
               <input type="text" name="name" class="form-control" value="<?php echo $name?>" placeholder="Enter your name">
            </div>
            <div class="mb-3">
               <label class="form-label">LOCATION</label>
               <input type="text" name="location" class="form-control" value="<?php echo $location ?>" placeholder="Enter your location">
            </div>
            <div class="mb-3">
               <?php
               if ($update == true):
               ?>
               <button type="submit" class="btn btn-primary" name="update">Update</button>
            <?php else: ?>
               <button type="submit" class="btn btn-primary" name="save">SAVE</button>
            <?php endif; ?>
            </div>
         </form>
      </div>
      <div>
   </body>
</html>
