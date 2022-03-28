<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

          All Category           

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
                        <h5>All Category</h5>
                    </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Si. No</th>
                            <th>Category Name</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th>{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->user->name}}</td>
                                <td>
                                    @if($category->created_at == NULL)
                                        <span class="text-danger">No date set</span>
                                    @else    
                                    {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                    @endif
                                </td>   
                                <td><a href="{{url('/category/edit/'.$category->id)}}" class="btn btn-info">Edit</a> </td>
                                <td><a href="{{url('/category/softdelete/'.$category->id)}}" class="btn btn-danger">Delete</a> </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{$categories->links()}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.category')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category">Category name</label>
                                <input type="text" name="category_name" class="form-control" id="category">

                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Add category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- trashCategory start-->

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Trash Category</h5>
                    </div>                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Si. No</th>
                            <th>Category Name</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashCategory as $category)
                            <tr>
                                <th>{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->user->name}}</td>
                                <td>
                                    @if($category->created_at == NULL)
                                        <span class="text-danger">No date set</span>
                                    @else    
                                    {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                    @endif
                                </td>   
                                <td><a href="{{url('/category/restore/'.$category->id)}}" class="btn btn-info">Restore</a> </td>
                                <td><a href="{{url('/category/p-delete/'.$category->id)}}" class="btn btn-danger">P-Delete</a> </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{$trashCategory->links()}}
                </div>
            </div>
            <div class="col-md-4">
                
            </div>

        </div>
    </div>
    <!-- end trash category -->







    </div>
</x-app-layout>
