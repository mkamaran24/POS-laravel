@extends('layouts.dashboard.app')



@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
          <div class="col-sm-12">
            @if (app()->getLocale() == 'en')
            <ol class="breadcrumb float-sm-right">
            @endif
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <i class="fa fa-tachometer"></i>
              <a href="/dashboard/index">
                  @lang('site.dashboard')
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      
     
        <h1>dashboard</h1>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->




@endsection