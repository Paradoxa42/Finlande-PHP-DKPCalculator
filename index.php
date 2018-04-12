<?php
  // Start the session
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>DKPTable</title>
    <?php include('./misc/head.php');?>
  </head>
  <body>
  <?php include('./misc/database_manager.php')?>
  <?php include('./misc/activity.php')?>
    <?php include('./misc/user.php')?>
    <?php include('./misc/header.php'); ?>
    <div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Action</th>
            <th scope="col">DKPoint earning</th>
            <?php if ($_SESSION['connected'] == true) {?>
              <th scope="col">Delete</th>
            <?php }?>
          </tr>
        </thead>
        <tbody>
        <?php
          $activities = $databaseManager->getActivityList();
          $i = 0;
          foreach($activities as $item) {
            ?>
            <tr>
              <th scope="row"><?php echo strval($i++);?></th>
              <td><?php echo $item['name'];?></td>
              <td><?php echo $item['dkpEarn'];?></td>
              <?php if ($_SESSION['connected'] == true) {?>
                    <td>
                      <form method="post">
                        <input type="hidden" value="<?php echo $item["id"]?>" name="deleteActivity">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                <?php }?>
            </tr>
          <?php    
          }
          if ($_SESSION['connected'] == true) {
            ?>
            <form method="post">
              <tr>
                <th scope="row"><?php echo strval($i);?></th>
                <td><input type="text" class="form-control" id="nameActivity" name="nameActivity" aria-describedby="emailHelp" placeholder="Enter activity name"></td>
                <td><input type="number" class="form-control" id="earnActivity" name="earnActivity" aria-describedby="emailHelp" placeholder="Enter activity earning"></td>
                <td><button type="submit" class="btn btn-primary">Create activity</button></td>
              </tr>
            </form><?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php include('./misc/footer.php');?>
    </body>
</html>
