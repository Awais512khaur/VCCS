<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stock | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	<?php 
		require_once("../classes/adminClass.php");
		session_start();
		if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])){
			header('Location: ./login.php');	
		}
		$admin = new admin($_SESSION['admin_id']);
	 ?>
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        stock
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">stock</li>
      </ol>
    </section>

	
	
    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">All products Information</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
						<div class="">

				
					  <div class="box-body  table-responsive">
						
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Service</th>
						<th>Outlet</th>
						<th>Unit</th>
						<th>Per/Unit</th>
						<th>Brand</th>
						<th>category</th>
						<th>Stock</th>
						
						  
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($admin->product as $product){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($product->id); ?></td>
                        <td><?php echo htmlspecialchars($product->name); ?></td>
                        <td><?php echo htmlspecialchars($product->getService()->name); ?></td>
                        <td><?php echo htmlspecialchars($product->getService()->getoutlite()->name); ?></td>
                        <td><?php echo htmlspecialchars($product->unit); ?></td>
						<td><?php echo htmlspecialchars($product->price_per_unit); ?></td>
						<td><?php echo htmlspecialchars($product->brand->name); ?></td>
						<td><?php echo htmlspecialchars($product->brand->category->name); ?></td>
						<td><span class="badge bg-blue"><b><?php echo htmlspecialchars($product->quantity."-".$product->unit); ?></b></span></td>
						  
                      </tr>
					  
                      <?php } ?>
					  
                    	</tbody>
                  	</table>
						  </div></div>
 					</div>
                  </div>
                
                </div>
                
            </div> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
