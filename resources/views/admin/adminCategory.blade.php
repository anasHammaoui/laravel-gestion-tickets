@extends("layouts.template")
@section("content")
<main class="flex-1 overflow-y-auto p-6 bg-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Categories</h1>
                </div>

                <div class="grid  gap-6">
                    <!-- Add Category Form -->
                    <div class="bg-white rounded-lg shadow-md p-6 ">
                        <h2 class="text-lg font-medium text-gray-800 mb-4">Add New Category</h2>
                        <form action="categories/add" method="GET">
                            @csrf
                            <div class="mb-4">
                                <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                                <input type="text" id="categoryName" name="categoryName" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter category name">
                            </div>
                            
                            
                            <div class="flex items-center justify-between mt-6">
                              
                                <button type="submit" name="addCat" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Categories Table -->
                    <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-gray-800">All Categories</h2>
                           
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category Name
                                        </th>
                                    
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Category Row 1 -->
                                @foreach ($categories as $category )
                                <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$category -> id}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                              
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{$category -> category_name}}</div>
                                                </div>
                                            </div>
                                        </td>
                                      
                                       
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-indigo-600 hover:text-indigo-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                    
                        
                                    
                                
                                </tbody>
                            </table>
                        </div>
                
                    </div>
                </div>
            </main>
@endsection