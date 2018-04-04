<!DOCTYPE html>
<html>
  <head>
    <title>Score</title>
    <?php include('./misc/head.php');?>
  </head>
  <body>
    <?php include('./misc/database_manager.php')?>
    <?php include('./misc/user.php')?>
    <?php include('./misc/header.php'); ?>
    <div class="container">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">DKPoint month</th>
              <th scope="col">DKPoint total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $characters = $databaseManager->getCharacterList();
              $i = 0;
              foreach($characters as $item) {
                $score = $databaseManager->getCharacterScore($item['id']);
                $i++;
                ?>
                <tr>
                  <th scope="row"><?php echo strval($i);?></th>
                  <td><a href="character.php?id=<?php echo strval($item['id'])?>"><?php echo $item["name"] ?></a></td>
                  <td><?php echo $score['month']?></td>
                  <td><?php echo $score['total']?></td>
                </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
    </div>
    <?php include('./misc/footer.php');?>
    </body>
</html>