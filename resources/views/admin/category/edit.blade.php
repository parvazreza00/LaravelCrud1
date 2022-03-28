<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

          Edit Category           

        </h2>
    </x-slot>

    <div class="py-12">
        
    <div class="container">
        <div class="row">
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Category
                    </div>
                    <div class="card-body">
                        <form action="{{url('/category/update/'.$categories->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category">Update Category name</label>
                                <input type="text" name="category_name" class="form-control" id="category" value="{{$categories->category_name}}">

                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Update category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>






    </div>
</x-app-layout>
