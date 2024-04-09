<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Manage Category</h1>
        <!-- Your main content goes here -->
        <?php 
            if(isset($_SESSION['add'])) //Check whether the session is set or not
            {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }
        ?>
        
        <div class="admin-btn">
            <a href="<?php echo SITEURL; ?>admin/add-category.php">Add Category</a>
        </div>
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table data will be populated here -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe</td>
                        <td><button>Edit</button><button>Delete</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
       

    </div>
    

<?php include('partials/footer.php'); ?>