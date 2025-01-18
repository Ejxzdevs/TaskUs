@extends('layout.app')

@section('pages')
    <div x-data="{ open: false }" class="d-flex flex-col" style="height: 100%" >
        <div class="w-100 flex justify-end items-center pe-3" style="height: 15%">
            <button type="button" class="btn btn-light border h-9 shadow-md d-flex flex-row gap-2 items-center" @click="$dispatch('toggle-open')">
                <i class="fas fa-plus"></i><span>Add Task</span>
            </button>
        </div>
        <div class="d-flex justify-evenly py-3"  style="height: 85%">
           
            <div class="card overflow-y-auto" style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">To Do</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'Todo') <!-- Check if task status is 'Todo' -->
                            <li class="list-group-item shadow-md rounded border-1 border-secondary-subtle">
                                <p class="Smooch">{{ $task->task_name }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            

            <div class="card overflow-y-auto" style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">In Progress</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'In Progress') <!-- Check if task status is 'Todo' -->
                            <li class="list-group-item shadow-md rounded border-1 border-secondary-subtle">
                                <p class="Smooch">{{ $task->task_name }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="card overflow-y-auto" style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">Completed</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'Completed') <!-- Check if task status is 'Todo' -->
                            <li class="list-group-item shadow-md rounded border-1 border-secondary-subtle">
                                <p class="Smooch">{{ $task->task_name }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>


        </div>
    </div>

    {{-- MODAL ADD TASK --}}
    <div @toggle-open.window="open = !open" x-data="{ open: false }">
        <div x-show="open" x-transition @click.away="open = false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                <h3 class="text-xl font-semibold mb-4">Task Form</h3>
                <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="task-name" class="block text-sm font-medium text-gray-700">Task Name</label>
                        <input type="text" id="task_name" name="task_name" class="mt-1 p-2 w-full border rounded" placeholder="Enter task name">
                    </div>
                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority Level</label>
                        <select id="task_priority_level" name="task_priority_level"  class="mt-1 p-2 w-full border rounded">
                            <option value="low">Low Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="high">High Priority</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
