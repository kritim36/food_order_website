<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <h1>Manage Order</h1>
        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <!-- Your main content goes here -->
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $item = $row['item'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>

                            <tbody>
                                <!-- Table data will be populated here -->
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $item; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <button><a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Update Order</a></button>
                                        <button>Delete</button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>

                            <?php
                        }
                    }else{
                        echo "<tr><td colspan='12'>Order Not Available</tr></td>";
                    }
                ?>
                
            </table>
        </div>
       

    </div>
    

<?php 
include('partials/footer.php'); ?>