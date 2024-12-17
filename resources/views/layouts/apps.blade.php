<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Alpine.js for Dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="flex items-center justify-between flex-wrap bg-gray-800 p-6">

        <!-- Left Side: Navigation Links -->
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="/task" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                    Tasks
                </a>
                <a href="/task/create" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                    Add Task
                </a>
                <a href="/post" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                    Posts
                </a>
                <a href="/post/create" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white">
                    Add Post
                </a>
            </div>
        </div>

        <!-- Right Side: User Dropdown -->
        <div class="relative inline-block text-left" x-data="{ open: false }">
            <!-- Trigger Button -->
            <span @click="open = !open"
                class="block cursor-pointer mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                {{ Auth::user()->name }}
                <!-- Dropdown Icon -->
                <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </span>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">

                <div class="py-1" role="menu" aria-orientation="vertical">
                    <!-- Profile Option -->
                    <a href="/profile"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem">
                        Profile
                    </a>
                    <!-- Logout Option -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                            role="menuitem">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        @yield('content')
    </div>

</body>

</html>
