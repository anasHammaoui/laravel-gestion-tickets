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
            <h1 class="text-2xl font-bold text-gray-800">Tickets Management</h1>
        </div>
        @error("assignTicket")
                                <div class="text-rose-600">{{$message}}</div>
                            @enderror
        
        <!-- Table Container -->
        <div class="flex-1 bg-white rounded-lg shadow flex flex-col">
            <!-- Table wrapper with scrolling -->
            <div class="table-container flex-1 max-h-screen  overflow-y-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ticket Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ticket description
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At 
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asigned To
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (count($tickets) < 1)
                            <h2 class="text-center p-2">No Tickets yet</h2>
                        @else
                      @foreach ( $tickets as $ticket)
                         <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                   
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $ticket -> ticket_name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $ticket -> ticket_description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                               
                                <div class="text-sm text-gray-500">{{ $ticket -> category -> category_name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <div class="flex space-x-3">
                                {{ $ticket -> status }}
                                </div>
                                </span>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                               
                               <div class="text-sm text-gray-500">{{ $ticket -> created_at}}</div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                               
                          <form action="{{route('assignedto')}}" method="POST">
                            @csrf
        
                            <input type="text" name="ticketId" class="hidden" value="{{$ticket -> id}}">
                           
                          <select name="assignTicket" id="roleSelect" onchange="this.form.submit()"
        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-700">
        <option  selected>Select an item</option>
        @foreach ($users as $user)
            @if ($user -> role -> name === "agent" )
            @if ($ticket -> assigned_to !== null)
            <option value="{{$user -> id}}" selected>{{ $user -> name }}</option>
            @else
            <option value="{{$user -> id}}">{{ $user -> name }}</option>
            @endif
            @endif
        @endforeach
    </select>
                          </form>
                           </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

</main>
@endsection
