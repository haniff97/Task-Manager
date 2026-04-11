<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $project->name }}</h2>
            <a href="{{ route('projects.tasks.create', $project) }}"
               class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md hover:bg-gray-700 dark:hover:bg-white text-sm transition-colors">
                + New Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Status filter --}}
            <div class="mb-6 flex gap-2 flex-wrap">
                <a href="{{ route('projects.show', $project) }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ !request('status') ? 'bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-900 border border-transparent shadow-md' : 'bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 shadow-sm hover:bg-gray-300 dark:hover:bg-gray-700' }}">
                    All
                </a>
                @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                    <a href="{{ route('projects.show', [$project, 'status' => $value]) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ request('status') === $value ? 'bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-900 border border-transparent shadow-md' : 'bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 shadow-sm hover:bg-gray-300 dark:hover:bg-gray-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Task list --}}
            @if($tasks->isEmpty())
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 text-gray-500 dark:text-gray-400">
                    No tasks found.
                    <a href="{{ route('projects.tasks.create', $project) }}" class="text-blue-500 dark:text-blue-400 underline">Add one.</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($tasks as $task)
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 flex justify-between items-start border border-transparent dark:border-gray-700">
                            <div>
                                <h4 class="font-medium text-gray-800 dark:text-gray-200">{{ $task->title }}</h4>
                                @if($task->description)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $task->description }}</p>
                                @endif
                                <div class="flex gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                    @if($task->due_date)
                                        <span>Due: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span>
                                    @endif
                                    <span>Created: {{ $task->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 ml-4">
                                {{-- Status badge --}}
                                @php
                                    $colors = [
                                        'todo'        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                        'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                        'done'        => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    ];
                                    $labels = [
                                        'todo'        => 'To Do',
                                        'in_progress' => 'In Progress',
                                        'done'        => 'Done',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $colors[$task->status] }}">
                                    {{ $labels[$task->status] }}
                                </span>
                                <a href="{{ route('tasks.edit', $task) }}"
                                   class="text-sm text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('Delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('projects.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline">← Back to Projects</a>
            </div>

        </div>
    </div>
</x-app-layout>