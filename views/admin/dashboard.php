<!DOCTYPE html>
<html lang="en">

<?php 
    $randoms = rand(1, 100);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/main.css?hfhfhfhhhhhhh">
    <script src="https://kit.fontawesome.com/8bfa5eb2d0.js" crossorigin="anonymous"></script>
    <script src="public/js/async.js?dddddd" type="text/javascript"></script>

    <title>dashboard</title>
</head>

<body>

    <body>
        <?php include_once('views/shared/header.php');
        //   <!<?php include_once('views/shared/footer.php');> 
        ?>
        <!-- main conent of the dashbord -->
        <div>

            <main class="container">
                <!-- add user form -->
                <div class="addUser mt-5">
                    <button class="btn btn-primary" onclick="showHideForm()"><i class="fas fa-plus"></i></button>

                    <form class="my-5 hide" name="addUserForm" id="addUserForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="addfirstname">FirstName</label>
                                <input type="text" class="form-control" id="addfirstname" name="addfirstname"
                                    placeholder="first name" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="addlastname">Password</label>
                                <input type="text" class="form-control" id="addlastname" name="addlastname"
                                    placeholder="last name" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="addtelnum">Tel number</label>
                                <input type="text" class="form-control" id="addtelnum" name="addtelnum"
                                    placeholder="tél number" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="addcin">CIN</label>
                                <input type="text" class="form-control" id="addcin"
                                    placeholder="carte d'identité number" name="addcin" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="addemail">Email</label>
                            <input type="email" class="form-control" id="addemail" placeholder="email"
                                name="addemail" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="addservice">Service</label>
                                <input type="text" class="form-control" id="addsevice" placeholder="service"
                                    name="addsevice" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="addgrade">Grade</label>
                                <input type="text" class="form-control" id="addgrade" placeholder="grade"
                                    name="addgrade" />
                            </div>
                        </div>

                        <button class="btn btn-success" name="submituser" id="submitadduser"
                            onclick="addUsers(event)">Add
                            User</button>
                    </form>
                </div>
                <!-- end add user form -->
                <!-- the searsh form in the table **************************************    -->
                <div class="container d-flex justify-content-end">
                    <div class="col-md-6 row">
                        <label class="col-sm-2">search:</label>
                        <input class="form-control col-sm-10" type="text" placeholder="CIN" id="searchintable" />
                    </div>
                </div>
                <!-- the searsh form in the table *****************************************   -->
                <table class="table mt-5 table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col" id="first">FirstName</th>
                            <th scope="col">LastName</th>
                            <th scope="col">CIN</th>
                            <th scope="col">Email</th>
                            <th scope="col">Service</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id='tableData'>
                        <?php 
                        if ($this->users) {
                            
                            foreach($this->users as $user) {
                                echo "
                                <tr class='user' id='user".$user['CIN']."'>
                                    <td >
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' onclick='openUpdate(this, \"".$user['CIN']."\")'>
                                        </div>
                                    </td>
                                    <td class='filter'>
                                        <input type='text' value='".$user['firstName']."' class='form-control' name = 'upfirstname' disabled/>
                                    </td>
                                    <td class='filter'>
                                        <input type='text' value='".$user['lastName']."' class='form-control' name = 'uplastname' disabled>
                                    </td>
                                    <td  class='usercin filter'>
                                        <input type='text' value='".$user['CIN']."' class='form-control' disabled>
                                    </td>
                                    <td>
                                        <input type='text' value='".htmlentities($user['email'])."' name = 'upemail' class='form-control' disabled>
                                    </td>
                                    <td>
                                        <input type='text' value='".$user['service']."' class='form-control' name = 'upservice' disabled>
                                    </td>
                                    <td>
                                        <input type='text' value='".$user['grade']."' class='form-control' name = 'upgrade' disabled>
                                    </td>
                                    <td>
                                    <button type='button' class='btn bg-warning text-white' id='".$user['CIN']."' disabled onclick='updateUser(this, \"".$user['CIN']."\")'>
                                        <i class='fas fa-pen'></i>
                                    </button>
                                    </td>
                                    <td class='del' onclick='deleteUser(this)'>
                                        <button class='btn btn-danger'>
                                    <i class='fas fa-trash-alt'></i>
                                        </button>
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>

        <!-- <div class="text-center load" id="spinner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->

        <!-- -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="public/js/main.js?dddddddfff" type="text/javascript"></script>

    </body>

</html>