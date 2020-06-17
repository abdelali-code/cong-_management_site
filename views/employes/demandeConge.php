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
    <title>demande conger</title>
</head>

<body>

    <body>
        <?php include_once('views/shared/header.php');?>
        <main class="home d-flex">
            <div class="card bg-white mt-5 text-dark demandeCongeCard" style="width: 30rem; margin: 0px auto;">
                <div class="card-header text-center text-white bg-primary">
                    Demander un Congé
                </div>
                <div class="card-body">
                    <?php 
                        if (isset($this->errMess)) {
                            foreach($this->errMess as $err) {
                                echo "<div class='alert bg-danger text-white mb-3 p-2'>$err</div>";
                            }
                        }
                    ?>
                    <form name="demandeConge" method="POST">
                        <div class="form-group">
                            <label for="demandeType">chose type</label>
                            <select class="form-control" id="demandeType" name="demandeType">
                                <option value='1'>Congé annuel</option>
                                <option value='2'>permissions d’absence</option>
                                <option value='3'>Congé de maladie</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateb">date de début</label>
                            <input type="date" class="form-control" name="dateb" id="dateb" />
                        </div>
                        <div class="form-group">
                            <label for="datef">date de fin</label>
                            <input type="date" class="form-control" name="datef" id="datef" />
                        </div>
                        <button class="btn btn-primary" name="demandeConge" id="demandeConge"
                            style="margin-left:40%">Submit</button>
                    </form>
                </div>
            </div>
        </main>
        <?php include_once('views/shared/footer.php');?>
    </body>

</html>