@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

           
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
              <li class="breadcrumb-item">
              <a href="{{route('dashboard.users.index')}}">@lang('site.users')</a>
              </li>
              <li class="breadcrumb-item active">@lang('site.add')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->


        </section>

        <section class="content">

            @include('partials._errors')
           
            <div class="card card-primary">

                <div class="card-header">
                  <h3 class="card-title">@lang('site.reg')</h3>
                </div>
                 
                <!-- form start -->
              <form role="form" action="{{ route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('site.name')</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('site.email')</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{old('email')}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('site.password')</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('site.cpass')</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
                  </div>

                  <br>
                 

                  <div class="form-group">
                    <label for="f">@lang('site.chooseimage')</label>
                    <input type="file" class="form-control image" id="f" name="image">
                  </div>
                </div>

                
                <div class="form-group">
                  <img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
              </div>
                     
                         
                {{-- DRY DONT REAPET YOUSELF TEKNIK --}}
                @php
                // DRY
                $models = ['users', 'categories', 'products', 'clients', 'orders'];
                $maps = ['create', 'read', 'update', 'delete'];
            @endphp
             
            <ul class="nav nav-pills ml-auto p-2">
              @foreach ($models as $index=>$model)

                <li class="nav-item">
                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" href="#{{$model}}" data-toggle="tab">
                    @lang('site.' . $model)
                  </a>
                </li>
                
               @endforeach
              </ul>

              <div class="card-body">
              <div class="tab-content">

               
                    
                @foreach ($models as $index=>$model)

              <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{$model}}">
  
                @foreach ($maps as $map)
                  <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                @endforeach
                      
              </div> 
              @endforeach
             
            </div>
            <!-- /.tab-content -->
              </div>
              
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">@lang('site.add')</button>
              </div>

              </div>
                <!-- /.card-body -->
             
           
                
               

              </form>
            </div>
            <!-- /.card -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
