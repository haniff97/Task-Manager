<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Tasks</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalTasks }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">To Do</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $tasksByStatus['todo'] ?? 0 }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">In Progress</p>
                    <p class="text-3xl font-bold text-blue-500">{{ $tasksByStatus['in_progress'] ?? 0 }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Done</p>
                    <p class="text-3xl font-bold text-green-500">{{ $tasksByStatus['done'] ?? 0 }}</p>
                </div>
            </div>

            {{-- Quick link --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                <p class="text-gray-600 mb-4">Manage your projects and tasks.</p>
                <a href="{{ route('projects.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                    View Projects
                </a>
            </div>

        </div>
    </div>
</x-app-layout>