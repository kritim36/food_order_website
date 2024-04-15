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
                <?php
                    $sql = "SELECT * FROM category";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                ?>
                <h3><?php echo $count; ?></h3>
                <p>Category</p>
            </div>
            <div class="dashboard-box">
                <?php
                    $sql2 = "SELECT * FROM item";
                    $res2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h3><?php echo $count2; ?></h3>
                <p>Foods</p>
            </div>
            <div class="dashboard-box">
                <?php
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = mysqli_query($conn,$sql3);
                    $count3 = mysqli_num_rows($res3);
                ?>
                <h3><?php echo $count3; ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="dashboard-box">
                <?php
                    //SQL Query to get total revenue generated
                    //aggregate function in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";
                    $res4 = mysqli_query($conn,$sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    $total_revenue = $row4['Total'];
                ?>
                <h3>RS. <?php echo $total_revenue; ?></h3>
                <p>Revenue Generated</p>
            </div>
        </div>

    </div>
    

<?php include('partials/footer.php'); ?>
