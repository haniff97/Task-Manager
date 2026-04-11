<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Tasks</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $totalTasks }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">To Do</p>
                    <p class="text-3xl font-bold text-yellow-500 dark:text-yellow-400">{{ $tasksByStatus['todo'] ?? 0 }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">In Progress</p>
                    <p class="text-3xl font-bold text-blue-500 dark:text-blue-400">{{ $tasksByStatus['in_progress'] ?? 0 }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Done</p>
                    <p class="text-3xl font-bold text-green-500 dark:text-green-400">{{ $tasksByStatus['done'] ?? 0 }}</p>
                </div>
            </div>

            {{-- Quick link --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                <p class="text-gray-600 dark:text-gray-400 mb-4">Manage your projects and tasks.</p>
                <a href="{{ route('projects.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md hover:bg-gray-700 dark:hover:bg-white transition-colors">
                    View Projects
                </a>
            </div>

        </div>
    </div>
</x-app-layout>