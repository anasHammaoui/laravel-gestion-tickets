@extends("layouts.template")
@section("role","Admin Page")
@section("content")
<main class="flex-1 overflow-y-auto p-6 bg-gray-100">
    @if (session("success"))
    <div class=" text-center text-green-500 capitalize">
       <script>
        alert("{{session('success')}}");
       </script>
    </div>
    @endif
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manage Categories</h1>
    </div>

    <!-- Single row layout that works on all screen sizes -->
    <div class="flex gap-6">
        <!-- Add Category Form - Left side, narrower width -->
        <div class="bg-white rounded-lg shadow-md p-6 w-1/3 h-auto">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Add New Category</h2>
            <form action="{{ route('addCategory') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" id="categoryName" name="categoryName" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter category name">
                    @foreach ($errors -> all() as $error)
                        <p class="text-rose-700">{{$error}}</p>
                    @endforeach
                </div>
                
                <div class="flex items-center justify-end mt-6">
                    <button type="submit" name="addCat" class="px-4 py-2 border rounded-md shadow-sm text-sm font-medium">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
        
      @if(count($categories)> 0)
            <!-- Categories Table - Right side, takes more space -->
        <div class="bg-white rounded-lg shadow-md p-6 w-2/3">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-medium text-gray-800">All Categories</h2>
            </div>
            
            <div class="overflow-x-auto max-h-96">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                Category Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{$category->id}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{$category->category_name}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                <button class="text-indigo-600 hover:text-indigo-900 mr-3 editBtn" title="Edit" data-name="{{$category->category_name}}" data-id="{{$category -> id}}" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{route('deleteCategory',$category->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="updateCategory" action="" method="post">
            @csrf
            @method("PUT")
            <label for="categoryUpdate" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
            <input type="text" id="categoryUpdate"  name="categoryUpdate" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Category</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    let button = document.querySelectorAll(".editBtn") ;
    let form = document.getElementById("updateCategory");
    let input = document.getElementById("categoryUpdate");
    button.forEach(btn =>{
     btn.addEventListener("click",()=>{
        let id = btn.getAttribute("data-id");
        let name = btn.getAttribute("data-name");
        form.action = `/categories/delete/${id}`;
        input.value = name;
     })
    })
</script>
</main>
@endsection