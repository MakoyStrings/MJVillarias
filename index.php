<!DOCTYPE html>
<html>
  <head>
    <title>CRUD Application</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <?php require_once "process.php";?>

  <?php if(isset($_SESSION["message"])): ?>
  <div>
      <div class="<?php echo $_SESSION['alert_type'];?>"> 
        <?php
        echo $_SESSION["message"];
          // remove all session variables
          session_unset();

          // destroy the session
          session_destroy();
        ?>
      </div>
      <?php endif;?> 
      <?php
        $mysqli->open();
        $sql = "SELECT * FROM person";
        $result = $mysqli->open()->query($sql);
        ?>

      <table>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th colspan="2">Action</th>
        </tr>
        <?php  while($row = $result->fetch_array()): ?>

          <tr>
            <td><?php echo $row['first_name'];?></td>
            <td><?php echo $row['last_name'];?></td>
            <td><a href="index.php?edit=<?php echo $row['id'];?>">Edit</a>
            <a href="process.php?delete=<?php echo $row['id'];?>">Delete</a></td>
          </tr>
          <?php endwhile; ?>
      </table>
      <?php $mysqli->close(); ?>

      <form method="post" action="process.php">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" placeholder="Enter your First Name:" value="<?php echo $fname;?>">

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" placeholder="Enter your Last Name:" value="<?php echo $lname;?>">
          <?php
            if ($update == true):
          ?>
            <button type="submit" value="update" name="update">UPDATE</button>

          <?php else: ?>

          <button type="submit" value="save" name="save">SAVE</button>
          <?php endif; ?>
      </form>
    </div>
  </body>
</html>
