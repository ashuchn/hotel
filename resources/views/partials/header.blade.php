<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

   
    <ul class="navbar-nav ml-auto">
      <!-- Login Modal -->
      <li class="nav-item dropdown">
        <div class="btn-light btn-sm btn btn-outline-primary">Login/Signup</div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('assets/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Hotel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <a href="#" class="d-block">Welcome Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
			<li class="nav-item">
			  <a href="{{url('dashboard')}}" class="nav-link">
			   <p>Dashboard</p>
			  </a>
			</li>
			<li class="nav-item">
			  <a href="{{url('quiz-dashboard')}}" class="nav-link">
			   <p>Create Quiz</p>
			  </a>
			</li>
			<li class="nav-item">
			  <a href="{{url('Players')}}" class="nav-link">
			   <p>Players</p>
			  </a>
			</li>
			
			
			
         
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>