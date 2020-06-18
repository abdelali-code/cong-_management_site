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
                <h3 class="py-5">click on télécharger button : </h3>
                <div class="row bg-info py-4">
                    <div class="col-10">
                        bulletein de paie
                    </div>
                    <div class="col-2 text-right">
                        <a href=<?php echo BASE_URL."/home/imprimer/1";?> class="text-white"><i
                                class="fas fa-download fa-2x"></i></a>
                    </div>
                </div>
                <div class="row bg-info py-4 mt-5">
                    <div class="col-10">
                        another thing
                    </div>
                    <div class="col-2 text-right">
                        <a href=<?php echo BASE_URL."/home/imprimer/2";?> class="text-white"><i
                                class="fas fa-download fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once('views/shared/footer.php');?>
    </body>

</html>