<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - hidden on mobile, visible on md screens and up -->
        <aside class="w-0 md:w-64 flex-shrink-0">
            <div class="flex flex-col w-64 bg-gray-800 h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 bg-gray-900">
                    <span class="text-white font-semibold text-lg">Admin Panel</span>
                </div>
                <!-- Sidebar Navigation -->
                <nav class="mt-5 flex-1 px-2 bg-gray-800 space-y-1">
                    <a href="admindashboard" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-tachometer-alt mr-3 text-gray-300"></i>
                        Dashboard
                    </a>
                    <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-users mr-3 text-gray-400"></i>
                        Manage Users
                    </a>
                    <a href="admincategory"  class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-th-large mr-3 text-gray-400"></i>
                        Manage Categories
                    </a>
                    <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-ticket-alt mr-3 text-gray-400"></i>
                        Manage Tickets
                    </a>
                   
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navbar -->
          @include("layouts.navigation")
          @yield("content")
        </div>
    </div>

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</body>
</html>