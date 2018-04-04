<!DOCTYPE html>
<html>
  <head>
    <title>dkpCalculator</title>
    <?php include('./misc/head.php');?>
  </head>
  <body>
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
                <h2><?php echo $character["name"] ?></h2>
                <h3>Month : <?php echo $score["month"]?></h3>
                <h3>Total : <?php echo $score["total"]?></h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">DKPoint</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
              <?php
              foreach ($activities as $item) {
                ?>
                <tr>
                  <th scope="row"><?php echo strval($i++);?></th>
                  <td><?php echo $item["name"] ?></td>
                  <td><?php echo $item["dkpEarn"]?></td>
                  <td><?php echo $item["dateTime"]?></td>
                </tr>
            <?php
              }
              if ($_COOKIE['connected'] == true) {
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
