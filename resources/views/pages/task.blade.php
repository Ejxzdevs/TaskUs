@extends('layout.app')

@section('pages')
    <div x-data="{ open: false }" class="d-flex flex-col" style="height: 100%" >
        <div class="w-100 flex justify-end items-center pe-3" style="height: 15%">
            <button type="button" class="btn btn-light border h-9 shadow-md d-flex flex-row gap-2 items-center" @click="$dispatch('toggle-open')">
                <i class="fas fa-plus"></i><span>Add Task</span>
            </button>
        </div>
        <div class="d-flex justify-evenly py-3"  style="height: 85%">
            <!-- Todo Tasks -->
            <div class="card " style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">Todo</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2 overflow-y-auto py-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'Todo') <!-- Check if task status is 'Todo' -->
                            <li class="list-group-item d-flex justify-between px-2 shadow-md rounded border-1 border-secondary-subtle">
                                <p class="Smooch">{{ $task->task_name }}</p>
                                <div class="d-flex flex-row gap-2">
                                    <button onclick="editTask({{ json_encode($task) }})">
                                        <i class="fas fa-pen fs-6"></i>
                                    </button>
                                    <button onclick="openTask({{ json_encode($task) }});">
                                        <i class="fas fa-user-plus fs-6 text-primary"></i>
                                    </button>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- In Progress Tasks -->
            <div class="card overflow-y-auto" style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">In Progress</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'In Progress') <!-- Check if task status is 'In Progress' -->
                            <li class="list-group-item shadow-md rounded border-1 border-secondary-subtle">
                                <p class="Smooch">{{ $task->task_name }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- Completed Tasks -->
            <div class="card overflow-y-auto" style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">Completed</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'Completed') <!-- Check if task status is 'Completed' -->
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
                    <div>
                        <label for="task-description" class="block text-sm font-medium text-gray-700">Task Description</label>
                        <textarea name="task_description" id="task-description" rows="5" class="mt-1 p-1 w-full border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority Level</label>
                        <select id="task_priority_level" name="task_priority_level" class="mt-1 p-2 w-full border rounded">
                            <option value="Low Priority">Low Priority</option>
                            <option value="Medium Priority">Medium Priority</option>
                            <option value="High Priority">High Priority</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- AssignTask --}}
        @php
        use App\Services\UsersApi;
        $users = UsersApi::show();
        @endphp
        <div id="Assign" class="justify-center items-center translate-x-1" style="transition: opacity 0.5s ease; display: none; position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white py-2 px-3 rounded-lg shadow-lg relative mb-2 w-72">
                <button onclick="closeTask();" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h1 class="text-center fw-bold py-1">Assign Task</h1>
                <form action="{{ route('assign.store') }}" method="POST" style="font-size: 12px">
                    @csrf
                    <div class="mb-3">
                        <label for="assign_task_name" class="block font-medium text-gray-700">Task Name:</label>
                        <p id="assign_task_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="assign_task_description" class="block font-medium text-gray-700">Task description:</label>
                        <p id="assign_task_description"></p>
                    </div>
                    <div class="mb-3">
                        <label for="assign_task_priority" class="block font-medium text-gray-700">Priority Level:</label>
                        <p id="assign_task_priority"></p>
                    </div>
                    <div class="mb-3">
                        <label for="assign_user" class="block font-medium text-gray-700">Assign to</label>
                        <select id="assign_user" name="user_id" class="mt-1 py-1 w-full border rounded">
                            <option disabled selected>Choose User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input id="task_id" name="task_id" type="text" hidden>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary px-3 d-flex items-center justify-center" style="font-size: 12px; height: 25px;">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Task Modal --}}
        <div id="editTask" class="justify-center items-center translate-x-1" style="transition: opacity 0.5s ease; display: none; position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white py-2 px-3 rounded-lg shadow-lg relative mb-2 w-72">
                <button onclick="closeEditTask();" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h1 class="text-center fw-bold py-2">Update Task</h1>
                <form action="" method="POST"  style="font-size: 12px" id="update-form">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="edit_task_name" class="block font-medium text-gray-700">Task Name</label>
                        <input id="edit_task_name" name="task_name" class="w-full border rounded p-1" style="font-size: 12px">
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_description" class="block font-medium text-gray-700">Task Description</label>
                        <textarea id="edit_task_description" name="task_description" rows="5" class="w-full border rounded p-1" style="font-size: 12px"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_priority_level" class="block font-medium text-gray-700">Priority Level</label>
                        <select id="edit_task_priority_level" name="task_priority_level" class="w-full border rounded p-1">
                            <option value="Low Priority">Low Priority</option>
                            <option value="Medium Priority">Medium Priority</option>
                            <option value="High Priority">High Priority</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="edit_assign_user" class="block font-medium text-gray-700">Assign to</label>
                        <select id="edit_assign_user" name="user_id" class="w-full border rounded p-1">
                            <option value="Not Assigned Yet">Not Assigned Yet</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_status" class="block font-medium text-gray-700">Status</label>
                        <select id="edit_task_status" name="task_status" class="w-full border rounded p-1">
                            <option value="Todo">Todo</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="d-flex flex-row justify-between my-3">
                        <button type="submit" class="btn btn-primary px-3 d-flex items-center justify-center" style="font-size: 12px; height: 25px;">
                            Update
                        </button>
                    </form>
                    <form id="delete-form" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-3 d-flex items-center justify-center" style="font-size: 12px; height: 25px;">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const openTask = (data) => {
            console.log(data.task_name);
            console.log(data.id);
            document.getElementById('assign_task_name').textContent = data.task_name;
            document.getElementById('assign_task_priority').textContent = data.task_priority_level;
            document.getElementById('assign_task_description').textContent = data.task_description;
            document.getElementById('task_id').value = data.t_id;
            document.getElementById('Assign').style.display = 'flex';
        }

        const closeTask = () => document.getElementById('Assign').style.display = 'none';

        const editTask = (data) => {
            document.getElementById('editTask').style.display = 'flex';
            document.getElementById('edit_task_name').value = data.task_name;
            document.getElementById('edit_task_priority_level').value = data.task_priority_level;
            document.getElementById('edit_task_description').textContent = data.task_description;
            document.getElementById('edit_task_status').value = data.task_status;
            document.getElementById('edit_assign_user').value = data.id || 'Not Assigned Yet';
            // Update the delete form action dynamically
            const updateForm = document.getElementById('update-form');
            updateForm.action = `/tasks/${data.t_id}`;

            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = `/tasks/${data.t_id}`;
        };

        const closeEditTask = () => document.getElementById('editTask').style.display = 'none';
    </script>
@endsection
