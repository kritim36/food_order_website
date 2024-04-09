<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Dashboard</h1>
        <?php
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login']; //Displaying session message
                 unset($_SESSION['login']); //Removing session message
             }
        ?>
        <!-- Your main content goes here -->
        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <h3>Category 1</h3>
                <p>Description of category 1</p>
            </div>
            <div class="dashboard-box">
                <h3>Category 2</h3>
                <p>Description of category 2</p>
            </div>
            <div class="dashboard-box">
                <h3>Category 3</h3>
                <p>Description of category 3</p>
            </div>
            <div class="dashboard-box">
                <h3>Category 4</h3>
                <p>Description of category 4</p>
            </div>
        </div>

    </div>
    

<?php include('partials/footer.php'); ?>
