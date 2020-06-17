<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('views/shared/head.php');?>

    <title>status</title>
</head>

<body>

    <body>
        <?php include_once('views/shared/header.php');?>
        <main class="home">
            <div class="container">
                <h3 class='py-5'>Liste de votre congé demandé: </h3>
                <?php if(isset($this->demandeList)): ?>
                <table class="table text-white bg-info">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Date de emande</th>
                            <th scope="col">date de début</th>
                            <th scope="col">date de fin</th>
                            <th scope="col">type</th>
                            <th scope="col">décision</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                foreach($this->demandeList as $row) {
                                    $className = "btn-primary";
                                    if ($row['decision'] == "refusé") {
                                        $className = "btn-danger";
                                    }elseif($row['decision'] == "accepté") {
                                        $className = "btn-success";
                                    }
                                    echo "
                                    <tr>
                                        <td>".explode(" ",$row['demande_date'])[0]."</td>
                                        <td>".$row['date_debut']."</td>
                                        <td>".$row['date_retour']."</td>
                                        <td>".$row['type']."</td>
                                        <td><button class='btn ".$className."'>".$row['decision']."</button></td>
                                    </tr>
                                    ";
                                }
                            ?>
                    </tbody>
                </table>
                <?php endif;?>
            </div>
        </main>
        <?php include_once('views/shared/footer.php');?>
    </body>

</html>