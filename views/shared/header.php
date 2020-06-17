<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/final_pr2">Conge Management</a>
    <?php if (isset($_SESSION['type'])){
        if($_SESSION['type'] == 'EM'){
            echo "
            <ul class='navbar-nav'>
                <li class='nav-item'><a class='nav-link' href=".BASE_URL."/home/>Home</a></li>
            </ul>
            ";
            
        }
       

        echo " <ul class='navbar-nav ml-auto'>";
        if($_SESSION['type'] == 'EM') {
            echo "<li class='nav-item mr-5'><a class='nav-link'>Welcome ".$_SESSION['username']."</a></li>";
        }

        echo "
            <li class='nav-item logout'>
                <a class='nav-link' href=".BASE_URL."/auth/logout>logout</a>
            </li>";
        echo "</ul>";
    }
    ?>
</nav>