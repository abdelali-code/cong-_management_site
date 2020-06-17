<?php 
    if (!isset($_SESSION['type'])) {
        header('Location:'.BASE_URL);
    }elseif ($_SESSION['type'] == 'AD') {
        header('Location:'.BASE_URL.'/admin');
    }elseif ($_SESSION['type'] == 'RH') {
        header('Location:'.BASE_URL.'/rhumain');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('views/shared/head.php');?>
    <title>acceuil</title>
</head>

<body>

    <body>
        <?php include_once('views/shared/header.php');?>
        <main class="home">
            <div class="container">
                imprimer
            </div>
        </main>
        <?php include_once('views/shared/footer.php');?>
    </body>

</html>