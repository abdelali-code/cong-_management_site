<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('views/shared/head.php');?>
    <script type="text/javascript" src=public/js/rhumain.js?jj></script>


    <title>acceuil</title>
</head>

<body>

    <body>
        <?php include_once('views/shared/header.php');?>
        <main class="home">
            <div class="container-fluid">
                <?php if (isset($this->demandes)):?>
                <h3 class="py-5">liste des employés qui demande un congé: </h3>
                <table class="table text-white bg-info">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">firstname</th>
                            <th scope="col">lastname</th>
                            <th scope="col">CIN</th>
                            <th scope="col">type de congé</th>
                            <th scope="col">date de début</th>
                            <th scope="col">date de reteur</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach($this->demandes as $row) {
                        echo "
                        <tr id='".$row['numero']."'>
                            <td>".$row['firstName']."</td>
                            <td>".$row['lastName']."</td>
                            <td>".$row['CIN']."</td>       
                            <td>".$row['type']."</td>                       
                            <td>".$row['date_debut']."</td>                       
                            <td>".$row['date_retour']."</td>                      
                            <td><button class='btn btn-success' onclick='acceptDemande(this)'>accepté</button></td>                       
                            <td><button class='btn btn-danger' onclick='refuseDemande(this)'>refusé</button></td>
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