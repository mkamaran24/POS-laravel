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
                  @lang('site.products')
                </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->


    <form action="{{route('dashboard.products.index')}}" method="get">

            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                </div>

                
                <div class="col-md-4">
                  <select name="category_id" class="form-control">
                      <option value="">@lang('site.all_categories')</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                      @endforeach
                  </select>
              </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        
                     

                    @if (auth()->user()->hasPermission('create_products'))
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @else
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                    @endif


                </div>

            </div>
        </form><!-- end of form -->

        
                   
      </section>




        <section class="content">

            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">@lang('site.products')</h3>
                </div>

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.productname')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.profit')</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>
                           
                        </tr>
                        </thead>

                        <tbody>


                            @foreach ($products as $index=>$product)

                            <tr>
                            <td>{{$index+1}}</td>
                            <td>{{ $product->name }}</td>
                            <td>{!! $product->description !!}</td>
                            <td><img src="{{ $product->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->profit_percent }} %</td>
                            <td>{{ $product->stock }}</td>
                            
                            <td>
                               @if (auth()->user()->hasPermission('update_products'))
                                   <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>  
                               @else
                               <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>  
 
                               @endif

                               @if (auth()->user()->hasPermission('delete_products'))

                                  <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">
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

                {{ $products->appends(request()->query())->links() }}

            </div>
            <!-- /.card -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
