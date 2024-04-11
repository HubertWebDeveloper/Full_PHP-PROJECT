<?php include ("../includes/admin_header.php");?>

<div class="py-5">
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="border:1px solid #212F3C">
                    <div class="card-header" style="background:#212F3C;color:white">
                        <h4>Don't Miss ( <b style="border-bottom:2px solid darkorange;border-radius:10px;padding:5px 5px">Product List</b> )</h4>
                    </div>
                    <div class="card-body">
                       <!-- Button trigger modal -->
                          <!-- Button trigger modal -->
                        <button type="button" id="product" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           New Product
                        </button>
                        <!-- ----------------------- form popup ----------------------------- -->
                            <div class="wrapper form">
                                <div class="wrapper-container">
                                    <i class="bx bxs-user"></i>
                                    <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                                        <div class="error">
                                            <p>Insert New Product</p>
                                        </div>
                                        <div class="inputs">
                                            <div class="label-box inside">
                                                <label for="">Product Title</label>
                                                <input type="text" name="p_title" placeholder="Enter title." required>
                                            </div>
                                            <div class="label-box inside image">
                                                <label for="">Profile</label>
                                                <input type="file" name="p_image" required>
                                            </div>
                                            <div class="label-box inside">
                                                <label for="">Price</label>
                                                <input type="number" name="p_price" placeholder="Enter price." required>
                                            </div>
                                            <div class="label-box inside">
                                                <label for="">Category</label>
                                                <select class="form-control" name="p_categ" style="border:1px solid blue" required>
                                                <?php
                                                    $select = mysqli_query($con, "SELECT * FROM category WHERE category='shopping'");
                                                    $counts = mysqli_num_rows($select);
                                                    if($counts > 0){
                                                      while($rows = mysqli_fetch_assoc($select)){
                                                       ?><option value="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option><?php
                                                      }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="label-box">
                                                <label for="">Description</label>
                                                <textarea name="p_description" cols="30" rows="10" placeholder="Write Description here..." required></textarea>
                                            </div>
                                        <div class="btns">
                                            <div class="label-box btn">
                                                <input type="submit" name="save_product" value="Save">
                                            </div>
                                            <div id="close" class="label-box btn cancel">
                                                <p style="color: white;font-weight:bold">Close</p>
                                            </div>
                                        </div>
                                        
                                        
                                    </form>
                                </div>
                            </div>
                            <script>
                                document.getElementById("product").addEventListener("click", function(){
                                    document.querySelector(".form").style.display = "block";
                                })
                                document.getElementById("close").addEventListener("click", function(){
                                    document.querySelector(".form").style.display = "none";
                                })
                            </script>
                        <!-- ----------------------- form end ----------------------------- -->
                        <!-- Modal -->
                        <p style="margin-bottom:20px"><?php //echo $msg; ?></p>
                        <div class="table-responsive">
                            <table id="mydata" class="table table-striped table-bordered">  
                                <thead>  
                                    <tr>  
                                        <th scope="col">No</th>
                                        <th scope="col">Product Title</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product Catgory</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col">Edit</th>
                                    </tr>  
                                </thead>  
                                <?php   
                                  $query = mysqli_query($con, "SELECT * FROM `product` ORDER BY ID DESC");  
                                  $i = 0;
                                  while($row = mysqli_fetch_assoc($query))  
                                  {  
                                    $id = $row['id'];
                                    $i++;
                                    ?>
                                       <tr>  
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><img src="../images/<?php echo $row['image'] ?>" width="70" height="70"></td>
                                        <td class="price"><?php echo $row['price'] ?> Ksh</td>
                                        <td class="desc" style="color:grey"><?php echo $row['description'] ?></td>
                                        <td><a href="Delete.php?id=<?php echo $id; ?>" style="text-decoration:none;background:red;color:white;border-radius:10px;padding:5px 5px">
                                        <i style="padding:10px 10px" class="fas fa-trash"></i></a></td>
                                        <td><a href="Edit.php?id=<?php echo $id; ?> && num=product" style="text-decoration:none;background:green;color:white;border-radius:10px;padding:5px 5px">
                                        <i style="padding:10px 10px" class="fas fa-check"></i></a></td>
                                       </tr> 
                                    <?php
                                  }  
                                ?>  
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/admin_footer.php");?>