@extends('layouts.dashboard.app')

@section('content')

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
                <li class="breadcrumb-item active">
                  @lang('site.categories')
                </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->


    <form action="{{route('dashboard.categories.index')}}" method="get">

            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        
                     

                    @if (auth()->user()->hasPermission('create_categories'))
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @else
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @endif


                </div>

            </div>
        </form><!-- end of form -->

        
                   
      </section>




        <section class="content">

            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">@lang('site.categories')</h3>
                </div>

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.categname')</th>
                            <th>@lang('site.productnum')</th>
                            <th>@lang('site.getproduct')</th>
                            <th>@lang('site.action')</th>
                           
                        </tr>
                        </thead>

                        <tbody>


                            @foreach ($categories as $index=>$categ)

                            <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$categ->name}}</td>
                            <td>{{$categ->product->count()}}</td>
                            <td><a href="{{ route('dashboard.products.index', ['category_id' => $categ->id]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                            <td></td>
                            <td>
                               @if (auth()->user()->hasPermission('update_categories'))
                                   <a href="{{ route('dashboard.categories.edit', $categ->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>  
                               @else
                               <a href="{{ route('dashboard.categories.edit', $categ->id) }}" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>  
 
                               @endif

                               @if (auth()->user()->hasPermission('delete_categories'))

                                  <form action="{{ route('dashboard.categories.destroy', $categ->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                     @method('delete')
                                    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                    </form><!-- end of form -->
                               @else
                               <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                               @endif



                            </td>

                            </tr>

                            @endforeach

                        </tbody>

                </table>

                {{ $categories->appends(request()->query())->links() }}

            </div>
            <!-- /.card -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
