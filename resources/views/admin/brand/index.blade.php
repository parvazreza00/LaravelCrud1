<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

          All Brand           

        </h2>
    </x-slot>

    <div class="py-12">
        
    <div class="container">
        <div class="row">
            <div class="col-md-8">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

                <div class="card">
                    <div class="card-header">
                        <h5>All Brand</h5>
                    </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Si. No</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <th>{{$brands->firstItem()+$loop->index}}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td> <img src="{{asset($brand->brand_image)}}" style="width:40px; height:40px" alt=""></td>
                                <td>
                                    @if($brand->created_at == NULL)
                                        <span class="text-danger">No date set</span>
                                    @else    
                                    {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                    @endif
                                </td>   
                                <td><a href="{{url('/brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a> </td>
                                <td><a href="{{url('/brand/delete/'.$brand->id)}}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a> </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{$brands->links()}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Brand
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.brand')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="brand">Brand name</label>
                                <input type="text" name="brand_name" class="form-control" id="brand">

                                @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="brand">Brand image</label>
                                <input type="file" name="brand_image" class="form-control" id="brand">

                                @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="mt-3 btn btn-primary">Add brand</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    







    </div>
</x-app-layout>
