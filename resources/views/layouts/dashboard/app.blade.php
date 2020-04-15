<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>کۆمپانیای ئازاد</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  
  <link href="http://services.webchin.org/web-fonts/web-font?font=UbuntuKurdish0-81met" rel="stylesheet" type="text/css">


  @if (app()->getLocale() == 'ku' or app()->getLocale() == 'ar')
  <!-- bootstrap rtl -->
<link rel="stylesheet" href="{{asset('dist/css/bootstrap-rtl.min.css')}}">
  <!-- template rtl version -->
<link rel="stylesheet" href="{{asset('dist/css/custom-style.css')}}">

@else


<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

@endif

{{--noty--}}
<link rel="stylesheet" href="{{ asset('plugins/noty/noty.css') }}">
<script src="{{ asset('plugins/noty/noty.min.js') }}"></script>



</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

      <li class="nav-item">
        
        <a href="{{ route('logout') }}" class="nav-link"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
       
        <span>@lang('site.logout')</span>
       
     </a>

     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
     </form>
      </li>
     
     
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">تماس</a>
      </li> --}}
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">

    
        <!-- Lang Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-globe"></i>
        
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
              <span class="dropdown-item dropdown-header">
                  <h5>@lang('site.lang')</h5>
              </span>

              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              
                  <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      {{ $properties['native'] }}
                  </a>
                  <div class="dropdown-divider"></div>
              @endforeach
            </div>
              
          
          </li>


         

{{-- 
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fa fa-th-large"></i></a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
          <img src="{{Auth::user()->image_path}}" alt="User Image">
          </div>
          <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            
            <li class="nav-item">
              <a href="/dashboard/index" class="nav-link">
                <i class="nav-icon fa fa-tachometer">
                    <span>@lang('site.dashboard')</span>
                </i>
              </a>
            </li>

            @if (auth()->user()->hasPermission('read_users'))
              <li class="nav-item">
                <a href="/dashboard/users" class="nav-link">
                  <i class="nav-icon fa fa-users">
                      <span>@lang('site.users')</span>
                  </i>
                </a>
              </li>
            @endif


            @if (auth()->user()->hasPermission('read_categories'))
              <li class="nav-item">
                <a href="/dashboard/categories" class="nav-link">
                  <i class="nav-icon fa fa-cubes">
                      <span>@lang('site.categories')</span>
                  </i>
                </a>
              </li>
            @endif

            @if (auth()->user()->hasPermission('read_products'))
            <li class="nav-item">
              <a href="/dashboard/products" class="nav-link">
                <i class="nav-icon fa fa-shopping-cart">
                    <span>@lang('site.products')</span>
                </i>
              </a>
            </li>
          @endif

            
            <li class="nav-item">
        
              <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
             <i class="nav-icon fa fa-sign-out">
              <span>@lang('site.logout')</span>
             </i>
           </a>
      
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>
            </li>
           
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>



  @yield('content')

  @include('partials._session')
  
  <footer class="main-footer">
    <strong>CopyLeft &copy; 2020 <a href="https://mohamaddev.netlify.com/">Mohamad Dev</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->






<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
{{--ckeditor standard--}}
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>




<script>
  $(document).ready(function () {

     

      //delete
      $('.delete').click(function (e) {

          var that = $(this)

          e.preventDefault();

          var n = new Noty({
              text: "@lang('site.confirm_delete')",
              type: "error",
              killer: true,
              buttons: [
                  Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                      that.closest('form').submit();
                  }),

                  Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                      n.close();
                  })
              ]
          });

          n.show();

      });//end of delete

      // image preview
      $(".image").change(function () {
      
          if (this.files && this.files[0]) {
              var reader = new FileReader();
      
              reader.onload = function (e) {
                  $('.image-preview').attr('src', e.target.result);
              }
      
              reader.readAsDataURL(this.files[0]);
          }
      
      });

      CKEDITOR.config.language =  "{{ app()->getLocale() }}";

  });//end of ready
  
</script>


</body>
</html>
