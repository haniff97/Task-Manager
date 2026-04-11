<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Projects</h2>
            <a href="{{ route('projects.create') }}"
               class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md hover:bg-gray-700 dark:hover:bg-white text-sm transition-colors">
                + New Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($projects->isEmpty())
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 text-gray-500 dark:text-gray-400">
                    No projects yet. <a href="{{ route('projects.create') }}" class="text-blue-500 dark:text-blue-400 underline">Create one.</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 border border-transparent dark:border-gray-700">
                            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-2">{{ $project->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                {{ $project->tasks_count ?? $project->tasks->count() }} tasks
                                &bull; Created {{ $project->created_at->diffForHumans() }}
                            </p>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('projects.show', $project) }}"
                                   class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View</a>
                                <a href="{{ route('projects.edit', $project) }}"
                                   class="text-sm text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                      class="flex"
                                      onsubmit="return confirm('Delete this project and all its tasks?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>