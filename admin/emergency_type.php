<?php include 'includes/head.php'; ?>
<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
           
            <div class="page-wrapper">
                <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Emergency Category</h4>
                    </div>
                </div>
                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> <?php echo htmlspecialchars($_GET['success']); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                                    
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="save_type.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="description" class="form-control"></textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">All Emergency Categories</h4>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                $result = $db->prepare("SELECT * FROM emergency_type ");
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){ 
               
               ?> 
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['name']; ?></td>
										<td><?php echo $row['description']; ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="edit_emergency_type.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department_<?php echo $row['id']; ?>">
                                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
        
        <?php
        // Re-execute the query to show modals after the table
        $result = $db->prepare("SELECT * FROM emergency_type");
        $result->execute();
        while($row = $result->fetch()):
        ?>
        <div id="delete_department_<?php echo $row['id']; ?>" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="../assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Emergency type?</h3>
						<div class="m-t-20"> 
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <a href="delete_type.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endwhile; ?>
        
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>