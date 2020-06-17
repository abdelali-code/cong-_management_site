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
                <!-- first row -->
                <div class="row mx-auto">
                    <div class="col-md-6 mt-5">
                        <div class="card" style="max-width: 24rem">
                            <a href=<?php echo BASE_URL."/home/demandeConge";?>>
                                <h5 class="card-header text-center title">Demande Congé</h5>
                                <div class="card-body">
                                    <p class="card-text">vous pouvez demandez un congé ....</p>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="card" style="max-width: 24rem">
                            <a href=<?php echo BASE_URL."/home/imprimer";?>>
                                <h5 class="card-header text-center title">Imprimer Document</h5>
                                <div class="card-body">
                                    <p class="card-text">vous pouvez imprimer tous fichies ....</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- second row -->
                <div class="row mx-auto">
                    <div class="col-md-6 mt-5">
                        <div class="card" style="max-width: 24rem">
                            <a href=<?php echo BASE_URL."/home/demandeStatus";?>>
                                <h5 class="card-header text-center title">List De Demande</h5>
                                <div class="card-body">
                                    <p class="card-text">vous trouvez une liste de congé demandé.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 mt-5">
                        <div class="card" style="max-width: 24rem">
                            <h5 class="card-header text-center title">Featured</h5>
                            <div class="card-body">
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

        </main>
        <?php include_once('views/shared/footer.php');?>
    </body>

</html>