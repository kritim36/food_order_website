<?php include('partials/menu.php'); ?>

<div class="main-content">
        <h1>Update Order</h1>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $item = $row['item'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_email = $row['customer_email'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                }else{
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }else{
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <div class="add-admin-form">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="item">Food Name:</label>
                    <input type="text" id="item" name="item" value="<?php echo $item; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
                </div>
                <div class="form-group">
                    <label for="qty">Qty:</label>
                    <input type="number" id="qty" name="qty" value="<?php echo $qty; ?>" required>
                </div>
                <div class="form-group">
                    <label for="qty">Status:</label>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_name">Customer Name:</label>
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="customer_email">Customer Email:</label>
                    <input type="text" id="customer_email" name="customer_email" value="<?php echo $customer_email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="customer_contact">Customer Contact:</label>
                    <input type="text" id="customer_contact" name="customer_contact" value="<?php echo $customer_contact; ?>" required>
                </div>
                <div class="form-group">
                    <label for="customer_address">Customer Address:</label>
                    <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <button type="submit" name="submit">Update Order</button>
                </div>
            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $status = $_POST['status'];
                    $customer_address = $_POST['customer_address'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_name = $_POST['customer_name'];

                    $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        customer_contact = '$customer_contact'
                        WHERE id=$id
                        ";

                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==TRUE)
                    {
                        $_SESSION['update'] = "Order Updated Successfully";
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }else{
                        $_SESSION['update'] = "Failed To Updat Order";
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }

                }
            ?>
        </div>
    </div>