<?php include ("../includes/admin_header.php");?>

<div class="py-5">
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="border:1px solid #212F3C">
                    <div class="card-header" style="background:#212F3C;color:white">
                        <h4>Don't Miss ( <b style="border-bottom:2px solid darkorange;border-radius:10px;padding:5px 5px">Sessions List</b> )</h4>
                    </div>
                    <div class="card-body">
                       <!-- Button trigger modal -->
                          <!-- Button trigger modal -->
                        <button type="button" id="product" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           New Session
                        </button>
                        <!-- ----------------------- form popup ----------------------------- -->
                            <div class="wrapper form">
                                <div class="wrapper-container">
                                    <i class="bx bxs-user"></i>
                                    <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                                        <div class="error">
                                            <p>Insert New Session</p>
                                        </div>
                                        <div class="inputs">
                                            <div class="label-box inside">
                                                <label for="">Session Title</label>
                                                <input type="text" name="s_title" placeholder="Enter title." required>
                                            </div>
                                            <div class="label-box inside image">
                                                <label for="">Thumbnail Image</label>
                                                <input type="file" name="s_image" required>
                                            </div>
                                            <div class="label-box inside image">
                                                <label for="">Session Video</label>
                                                <input type="file" name="s_video">
                                            </div>
                                            <div class="label-box inside">
                                                <label for="">Category Type</label>
                                                <select class="form-control" id="name" name="s_type" style="border:1px solid blue" required>
                                                    <option value="">Select Session type</option>
                                                    <option value="health">Health Services</option>
                                                    <option value="consultation">Consultation Services</option>
                                                    <option value="mediation">Mediation Services</option>
                                                </select>
                                            </div>
                                            <!-- -------------------- session type ---------------------- -->
                                            <div id="mediation" class="label-box inside data">
                                                <label for="">Mediation Services</label>
                                                <select class="form-control" name="s_categ1" style="border:1px solid blue">
                                                    <option value="">Select here...</option>
                                                    <?php
                                                      $sel = mysqli_query($con, "SELECT * FROM `category` WHERE category='mediation'");
                                                      $count = mysqli_num_rows($sel);
                                                      if($count > 0){
                                                       while($rows = mysqli_fetch_assoc($sel)){
                                                          ?><option value="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option><?php
                                                       }
                                                      }else{
                                                       ?><option value="">No Category Found.</option><?php
                                                      }
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="health" class="label-box inside data">
                                                <label for="">Health Services</label>
                                                <select class="form-control" name="s_categ2" style="border:1px solid blue">
                                                    <option value="">Select here...</option>
                                                    <?php
                                                      $sel = mysqli_query($con, "SELECT * FROM `category` WHERE category='health'");
                                                      $count = mysqli_num_rows($sel);
                                                      if($count > 0){
                                                       while($rows = mysqli_fetch_assoc($sel)){
                                                          ?><option value="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option><?php
                                                       }
                                                      }else{
                                                       ?><option value="">No Category Found.</option><?php
                                                      }
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="consultation" class="label-box inside data">
                                                <label for="">Consultation Services</label>
                                                <select class="form-control" name="s_categ3" style="border:1px solid blue">
                                                    <option value="">Select here...</option> 
                                                    <?php
                                                      $sel = mysqli_query($con, "SELECT * FROM `category` WHERE category='consultation'");
                                                      $count = mysqli_num_rows($sel);
                                                      if($count > 0){
                                                       while($rows = mysqli_fetch_assoc($sel)){
                                                          ?><option value="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option><?php
                                                       }
                                                      }else{
                                                       ?><option value="">No Category Found.</option><?php
                                                      }
                                                    ?>
                                                </select>
                                            </div>
                                             <!-- -------------------- session end ---------------------- -->
                                            </div>
                                            <div class="label-box">
                                                <label for="">Description</label>
                                                <textarea name="s_description" cols="30" rows="10" placeholder="Write Description here..." required></textarea>
                                            </div>
                                        <div class="btns">
                                            <div class="label-box btn">
                                                <input type="submit" name="save_session" value="Save">
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
                                $(document).ready(function(){
                                  $("#name").on('change', function(){
                                      $(".data").hide();
                                      $("#" + $(this).val()).fadeIn(700);//
                                  }).change();
                                });
                            </script>
                        <!-- ----------------------- form end ----------------------------- -->
                        <!-- Modal -->
                        <p style="margin-bottom:20px"><?php //echo $msg; ?></p>
                        <div class="table-responsive">
                            <table id="mydata" class="table table-striped table-bordered">  
                                <thead>  
                                    <tr>  
                                        <th scope="col">No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Session Title</th>
                                        <th scope="col">Session Image</th>
                                        <th scope="col">Session Type</th>
                                        <th scope="col">Session Catgory</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col">Edit</th>
                                    </tr>  
                                </thead>  
                                <?php   
                                  $query = mysqli_query($con, "SELECT * FROM `session` ORDER BY ID DESC");  
                                  $i = 0;
                                  while($row = mysqli_fetch_assoc($query))  
                                  {  
                                    $id = $row['id'];
                                    $i++;
                                    ?>
                                       <tr>  
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><img src="../images/<?php echo $row['image'] ?>" width="70" height="70"></td>
                                        <td><?php echo $row['type'] ?></td>
                                        <td><?php echo $row['category'] ?></td>
                                        <td class="desc" style="color:grey"><?php echo $row['content'] ?></td>
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