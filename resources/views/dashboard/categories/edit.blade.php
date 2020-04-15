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
              <a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a>
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
              <form role="form" action="{{ route('dashboard.categories.update',$categ->id) }}" method="POST">
                @csrf
                  
                @method('put')

                <div class="card-body">
                  @foreach (config('translatable.locales') as $locale)
                  
                  <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $categ->translate($locale)->name}}">
                 </div>

                  @endforeach
              </div>
              
            
                  
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                </div>
               

              </form>
            </div>
            <!-- /.card -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
