@extends("layouts.template")
@section("role","Client Page")
@section("content")
<main class="flex-1 overflow-y-auto  md:p-19 py-6 bg-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manage Tickets</h1>
    </div>
    @if(session('success'))
        <div class="text-green-500 text-center p-2">{{session('success')}}</div>
    @endif
    <!-- Single row layout that works on all screen sizes -->
    <div class="flex gap-6">
        <!-- Add ticket Form - Left side, narrower width -->
        <div class="bg-white rounded-lg shadow-md p-6 w-1/3">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Add New Ticket</h2>
            <form action="{{route('addTicket')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="ticketName" class="block text-sm font-medium text-gray-700 mb-1">Ticket Name</label>
                    <input type="text" id="ticketName" name="ticketName" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter ticket name">
                    @error("ticketName")
                    <p class="text-rose-700">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="ticketDescription" class="block text-sm font-medium text-gray-700 mb-1">Ticket Description</label>
                    <input type="text" id="ticketDescription" name="ticketDescription" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter ticket description">
                    @error("ticketDescription")
                    <p class="text-rose-700">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="ticketCategory" class="block text-sm font-medium text-gray-700 mb-1">Ticket Category</label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-3 py-2 pr-8 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-gray-700" name="ticketCat" id="ticketCategory">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error("ticketCat")
                    <p class="text-rose-700">{{$message}}</p>
                    @enderror
                       
                    </div>
                </div>
                
                <div class="flex items-center justify-end mt-6">
                    <button type="submit" name="addTicket" class="px-4 py-2 border rounded-md shadow-sm text-sm font-medium">
                        Add Ticket
                    </button>
                </div>
            </form>
        </div>
        <!-- Tickets Table - Right side, takes more space -->
        <div class="bg-white rounded-lg shadow-md p-6 w-2/3">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-medium text-gray-800">All Tickets</h2>
            </div>
            
            <div class="overflow-x-auto max-h-96">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                Ticket Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $ticket->ticket_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{$ticket -> status == 'resolved' ? 'bg-green-500 text-white' : ($ticket -> status == 'pending' ? 'bg-orange-500 text-white' : 'bg-rose-500 text-white') }}">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                              @if ($ticket -> status !== "resolved")
                              <form action="{{route('closeticket', $ticket -> id)}}" method="POST">
                                @csrf
                              <button type="submit" class="text-green-600 hover:text-green-900" title="Complete">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                              </form>
                              @else
                              <div>no action required</div>
                              @endif
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