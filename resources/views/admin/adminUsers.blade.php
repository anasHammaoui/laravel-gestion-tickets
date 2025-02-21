@extends("layouts.template")
@section("role","Admin Page")
@section("content")
<main class="flex-1 p-6 flex flex-col">
    @if (session("success"))
    <script>
           alert("{{session('success')}}")
            </script>
            @endif
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
        </div>
        
        <!-- Table Container -->
        <div class="flex-1 bg-white rounded-lg shadow flex flex-col">
            <!-- Table wrapper with scrolling -->
            <div class="table-container flex-1 max-h-screen  overflow-y-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User ID
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (count($users) < 2)
                            <h2 class="text-center p-2">No users yet</h2>
                        @else
                      @foreach ( $users as $user)
                          @if ($user -> role -> name === "admin")
                              @continue
                          @endif
                         <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                   
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user -> name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user -> email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $user -> id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $user -> role -> name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <button type="button" class="editBtn px-4 py-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-white rounded-md transition" data-role="{{$user -> role -> name}}" data-id="{{ $user -> id}}" data-toggle="modal" data-target="#exampleModal">
                                        Change Role
                                    </button>
                                    <form action="{{route('deleteUser',$user->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" name="deleteUser" class="px-4 py-2 bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-white rounded-md transition">
                                        Delete
                                    </button>
                                </form>
                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
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
        <form  id="updateRole" action="" method="post">
            @csrf
            @method("PUT")
            <h1 for="selectRole" class="block text-sm font-medium text-gray-700 mb-1">Current Role: <strong id="roleInput"></strong></h1>
            <label for="selectRole" class="block text-sm font-medium text-gray-700 mb-1">New Role</label>
<select name="roles" id="selectRole" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <option value="2">Agent</option>
    <option value="3">Client</option>
</select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Role</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    let button = document.querySelectorAll(".editBtn") ;
    let form = document.getElementById("updateRole");
    button.forEach(btn =>{
     btn.addEventListener("click",()=>{
        let id = btn.getAttribute("data-id");
        let role = btn.getAttribute("data-role");
        form.action = `/users/update/${id}`;
        document.getElementById("roleInput").innerText = role;
     })
    })
</script>
</main>
@endsection
