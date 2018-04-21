<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>dkpCalculator</title>
    <?php include('./misc/head.php');?>
  </head>
  <body>
    <?php include('./misc/validanitizor.php')?>
    <?php include('./misc/database_manager.php')?>
    <?php include('./misc/characterAction.php')?>
    <?php include('./misc/user.php')?>
    <?php include('./misc/header.php'); ?>
    <div class="container">
      <?php
        $character = $databaseManager->getCharacter($_GET['id']);
        $activities = $databaseManager->getActivityCharacterList($_GET['id']);
        $score = $databaseManager->getCharacterScore($_GET['id']);
        $activityModels = $databaseManager->getActivityList();
        $i = 0;
      ?>
                <h2>
                  <form method="post">
                    <input type="text" value="<?php echo $character["name"] ?>" name="putNameCharacter">
                    <button type="submit" class="btn btn-success">Rename Character</button>
                  </form>
                </h2>
                <h3>Month : <?php echo $score["month"]?></h3>
                <h3>Total : <?php echo $score["total"]?></h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">DKPoint</th>
              <th scope="col">Date</th>
              <?php if ($_SESSION['connected'] == true) {?>
              <th scope="col">Delete</th>
              <?php }?>
            </tr>
          </thead>
          <tbody>
              <?php
              foreach ($activities as $item) {
                ?>
                <tr>
                  <th scope="row"><?php echo strval($i++);?></th>
                  <td><form><?php echo $item["name"] ?></td>
                  <td><?php echo $item["dkpEarn"]?></td>
                  <td><?php echo $item["dateTime"]?></td>
                  <?php if ($_SESSION['connected'] == true) {?>
                    <td>
                    <?php echo $_GET['id']?>
                      <form method="post" action="character.php">
                        <input type="hidden" value="<?php echo $item["id"]?>" name="deleteActivityCharacter">
                        <input type="hidden" value="<?php echo $_GET["id"]?>" name="id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  <?php }?>
                </tr>
            <?php
              }
              if ($_SESSION['connected'] == true) {
                ?>
                <form method="post" action="character.php?id=<?php echo $_GET['id']?>">
                  <tr>
                    <th scope="row"><?php echo strval($i);?></th>
                    <th>
                      <select class="form-control" id="activity" name="activity">
                        <?php 
                          foreach ($activityModels as $item) {
                            ?><option value="<?php echo $item['id']?>"><?php echo $item['name'] ?></option><?php
                          }
                          ?>
                      </select>
                      </th>
                    <td><button type="submit" class="btn btn-primary">Add Activity</button></td>
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
