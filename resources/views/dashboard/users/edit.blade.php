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
                <li class="breadcrumb-item active">@lang('site.edit')</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->

        </section>

        <section class="content">

            @include('partials._errors')
           
            <div class="card card-primary">

                <div class="card-header">
                  <h3 class="card-title">@lang('site.editform')</h3>
                </div>
                 
                <!-- form start -->
              <form role="form" action="{{ route('dashboard.users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('site.name')</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$user->name}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('site.email')</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{$user->email}}">
                 
                
                  <br>
                   
                  <div class="form-group">
                    <label for="f">@lang('site.chooseimage')</label>
                    <input type="file" class="form-control image" id="f" name="image">
                  </div>
                </div>

                
                <div class="form-group">
                <img src="{{ $user->image_path }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
              </div>
                
                </div>
                <!-- /.card-body -->
                 
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
                      <label><input type="checkbox" name="permissions[]" {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }} value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                    @endforeach
                          
                  </div> 
                  @endforeach
                 
                </div>
                <!-- /.tab-content -->
                  </div>
           
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                  </div>

              </form>
            </div>
            <!-- /.card -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
