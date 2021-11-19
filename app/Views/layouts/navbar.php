 <!-- Navbar -->
 <!--<div class="preloader flex-column justify-content-center dark-mode align-items-center">
   <div class="spinner-grow text-warning spinner-border-xl" style="width: 3rem; height: 3rem;" role="status">
     <span class="sr-only">Loading...</span>
   </div>
 </div> -->
 <div class="preloader flex-column justify-content-center dark-mode align-items-center" id="preloader">
   <div class="spinner-grow text-warning spinner-border-xl" style="width: 3rem; height: 3rem;" role="status">
     <span class="sr-only">Loading...</span>
   </div>
 </div>
 <nav class="main-header navbar navbar-expand navbar-primary navbar-light" id="mynav">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <!-- <li class="nav-item d-none d-sm-inline-block">
       <a href="index3.html" class="nav-link">Home</a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
       <a href="#" class="nav-link">Contact</a>
     </li> -->
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
     <!-- Navbar Search -->
     <!-- <li class="nav-item">
       <a class="nav-link" data-widget="navbar-search" href="#" role="button">
         <i class="fas fa-search"></i>
       </a>
       <div class="navbar-search-block">
         <form class="form-inline">
           <div class="input-group input-group-sm">
             <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
               <button class="btn btn-navbar" type="submit">
                 <i class="fas fa-search"></i>
               </button>
               <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                 <i class="fas fa-times"></i>
               </button>
             </div>
           </div>
         </form>
       </div>
     </li> -->


     <!-- Notifications Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#">
         <i class=" far fa-bell"></i>
         <span class="badge badge-warning navbar-badge"></span>
       </a>
       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <span class="dropdown-header">0 Notifications</span>
         <div class="dropdown-divider"></div>
         <a href="<?= site_url('view_notification') ?>" class="dropdown-item notif_seen" id="">
           <i class=" fas fa-envelope mr-3"></i> <strong id="num">0</strong> New Submitted
           <span class="float-right text-muted text-sm timesTamp"></span>
         </a>
         <!--   <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <i class="fas fa-users mr-2"></i> 8 friend requests
           <span class="float-right text-muted text-sm">12 hours</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
           <i class="fas fa-file mr-2"></i> 1 new Dumpsite Submitted
           <span class="float-right text-muted text-sm">2 days</span>
         </a> -->
         <div class="dropdown-divider"></div>
         <a href="<?= site_url('view_notification') ?>" class="dropdown-item dropdown-footer notif_seen">See All Notifications</a>
       </div>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="fullscreen" href="#" role="button">
         <i class="fas fa-expand-arrows-alt"></i>
       </a>
     </li>

   </ul>
 </nav>
 <!-- /.navbar -->