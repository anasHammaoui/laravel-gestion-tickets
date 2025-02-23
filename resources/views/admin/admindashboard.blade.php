@extends("layouts.template")
@section("role","Admin Page")
@section("content")
<main>
<div class="p-6 bg-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Total Users Card -->
          <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 bg-opacity-10">
                    <i class="fa-solid fa-spinner text-2xl text-purple-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm uppercase">Pending Tickets</h3>
                    <div class="flex items-center">
                        <span class="text-2xl font-semibold text-gray-800">{{$pending}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Tickets Card -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                    <i class="fas fa-ticket-alt text-2xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm uppercase">Total Tickets</h3>
                    <div class="flex items-center">
                        <span class="text-2xl font-semibold text-gray-800">{{ $tickets }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resolved Tickets Card -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                    <i class="fas fa-check-circle text-2xl text-green-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm uppercase">Resolved Tickets</h3>
                    <div class="flex items-center">
                        <span class="text-2xl font-semibold text-gray-800">{{ $resolved }}</span>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
</div>
</main>
@endsection