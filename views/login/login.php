<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/main.css?jj">
    <title>Home</title>
</head>

<body>

    <body>
        <?php include('views/shared/header.php'); ?>

        <main>

            <?php 
            if (isset($_GET['message']) == "error") {
                echo "<div class='alert text-danger text-center'> mot de passe or email is not correct</div>";
                }
            ?>
            <div class="card card_form" style="max-width: 24rem; margin: 48px auto">

                <div class="card-header text-center form_header">
                    Connect to your account
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="name">email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>

        <?php include('views/shared/footer.php');?>
    </body>

</html>