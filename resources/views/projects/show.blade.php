<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->name }}</h2>
            <a href="{{ route('projects.tasks.create', $project) }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm">
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
                   class="px-3 py-1 rounded-full text-sm {{ !request('status') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All
                </a>
                @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                    <a href="{{ route('projects.show', [$project, 'status' => $value]) }}"
                       class="px-3 py-1 rounded-full text-sm {{ request('status') === $value ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Task list --}}
            @if($tasks->isEmpty())
                <div class="bg-white shadow-sm rounded-lg p-6 text-gray-500">
                    No tasks found.
                    <a href="{{ route('projects.tasks.create', $project) }}" class="text-blue-500 underline">Add one.</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($tasks as $task)
                        <div class="bg-white shadow-sm rounded-lg p-5 flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $task->title }}</h4>
                                @if($task->description)
                                    <p class="text-sm text-gray-500 mt-1">{{ $task->description }}</p>
                                @endif
                                <div class="flex gap-3 mt-2 text-xs text-gray-400">
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
                                        'todo'        => 'bg-yellow-100 text-yellow-800',
                                        'in_progress' => 'bg-blue-100 text-blue-800',
                                        'done'        => 'bg-green-100 text-green-800',
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
                                   class="text-sm text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('Delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('projects.index') }}" class="text-sm text-gray-500 hover:underline">← Back to Projects</a>
            </div>

        </div>
    </div>
</x-app-layout>