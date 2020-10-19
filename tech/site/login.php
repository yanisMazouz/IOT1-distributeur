<?php session_start();
  if(isset($_POST['login']) && isset($_POST['mdp']) && $_POST['login']=="root" && $_POST['mdp']=="root"){
    $_SESSION['connect']=true;
    header("Location: pageAdmin.php");
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mes distributeurs</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <img src=img/veg.jpg id=fondecran class=fondecran alt=/>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <h2>administrateur</h2>
                <form action="login.php" method="post">
                    <input type="text" id="login" class="fadeIn second" name="login" placeholder="pseudo">
                    <input type="password" id="password" class="fadeIn third" name="mdp" placeholder="mot de passe">
                    <input type="submit" class="fadeIn fourth" value="connexion">
                </form>
                <div id="formFooter">
                    <a class="underlineHover" href="login.php">retour</a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>            
    </body>
</html>