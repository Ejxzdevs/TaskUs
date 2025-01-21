@extends('layout.app')
    @php
        use App\Services\UsersApi;
        $users = UsersApi::show();
        $userRole = Session::get('user_role');
        $userId = Session::get('user_id');
    @endphp
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
                        @if($task->task_status === 'Todo')
                            <li class="list-group-item d-flex flex-col gap-1 justify-between px-2 shadow-md rounded border-1 border-secondary-subtle">
                                <div class="d-flex flex-row gap-1" >
                                    @php
                                        if($task->task_priority_level === 'High Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px' > 🟥🟥🟥🟥🟥 </p>";
                                        }elseif($task->task_priority_level === 'Medium Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟨🟨🟨🟨🟨 </p>";
                                        }else{
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟩🟩🟩🟩🟩 </p>";
                                        }
                                        if($userId === $task->user_id){
                                            echo "<p class='ms-1' style='font-size: 8px'> 📌 </p>";
                                        }
                                    @endphp
                                </div>
                                <div class="d-flex justify-between px-2">
                                <p class="Smooch" style='font-size: 14px'>{{ $task->task_name }}</p>
                                <div class="d-flex flex-row gap-2 ms-1 pb-3">
                                    <button onclick="editTask({{ json_encode($task) }},{{ json_encode( $userId)}},{{ json_encode( $userRole)}})">
                                        <i class="fas fa-pen text-secondary" style='font-size: 12px'></i>
                                    </button>
                                    @if($userRole === 'admin')
                                        <button onclick="openTask({{ json_encode($task) }} )">
                                                <i class="fas fa-user-plus text-primary" style="font-size: 12px;"></i>
                                        </button>
                                    @endif
                                </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- In Progress Tasks -->
            <div class="card " style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">In Progress</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2 overflow-y-auto py-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'In Progress')
                            <li class="list-group-item d-flex flex-col gap-1 justify-between px-2 shadow-md rounded border-1 border-secondary-subtle">
                                <div class="d-flex flex-row gap-1" >
                                    @php
                                        if($task->task_priority_level === 'High Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px' > 🟥🟥🟥🟥🟥 </p>";
                                        }elseif($task->task_priority_level === 'Medium Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟨🟨🟨🟨🟨 </p>";
                                        }else{
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟩🟩🟩🟩🟩 </p>";
                                        }
                                        if($userId === $task->user_id){
                                            echo "<p class='ms-1' style='font-size: 8px'> 📌 </p>";
                                        }
                                    @endphp
                                </div>
                                <div class="d-flex justify-between px-2">
                                <p class="Smooch" style='font-size: 14px'>{{ $task->task_name }}</p>
                                <div class="d-flex flex-row gap-2 ms-1">
                                    <button onclick="editTask({{ json_encode($task) }},{{ json_encode( $userId)}},{{ json_encode( $userRole)}})">
                                        <i class="fas fa-pen text-secondary" style='font-size: 12px'></i>
                                    </button>
                                    <button onclick="viewTask({{ json_encode($task) }},{{ json_encode( $userId)}},{{ json_encode( $userRole)}})">
                                        <i class="fa fa-eye text-primary" style='font-size: 12px'></i>
                                    </button>
                                </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Completed Tasks -->
            <div class="card " style="width: 18rem; background-color: #F1F2F4;">
                <h1 class="py-3 font-bold ms-2">Completed</h1>
                <ul class="list-group list-group-flush px-2 flex flex-col gap-2 pt-2 overflow-y-auto py-2">
                    @foreach($tasks as $task)
                        @if($task->task_status === 'Completed')
                            <li class="list-group-item d-flex flex-col gap-1 justify-between px-2 shadow-md rounded border-1 border-secondary-subtle">
                                <div class="d-flex flex-row gap-1" >
                                    @php
                                        if($task->task_priority_level === 'High Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px' > 🟥🟥🟥🟥🟥 </p>";
                                        }elseif($task->task_priority_level === 'Medium Priority'){
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟨🟨🟨🟨🟨 </p>";
                                        }else{
                                            echo "<p class='ms-2' style='font-size: 8px'> 🟩🟩🟩🟩🟩 </p>";
                                        }
                                        if($userId === $task->user_id){
                                            echo "<p class='ms-1' style='font-size: 8px'> 📌 </p>";
                                        }
                                    @endphp
                                </div>
                                <div class="d-flex justify-between px-2">
                                <p class="Smooch" style='font-size: 14px'>{{ $task->task_name }}</p>
                                <div class="d-flex flex-row gap-2 ms-1">
                                    <button onclick="viewTask({{ json_encode($task) }},{{ json_encode( $userId)}},{{ json_encode( $userRole)}})">
                                        <i class="fa fa-eye text-primary" style='font-size: 12px'></i>
                                    </button>
                                </div>
                                </div>
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
                        <select id="assign_user" name="user_id" class="mt-1 py-1 w-full border rounded" 
                        style="pointer-events: @php echo $userRole === 'user' ? 'none' : 'auto'; @endphp;" >
                            <option value="Not Assigned Yet" disabled selected>Choose User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input id="task_id" name="task_id" type="text" hidden>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary px-3 items-center justify-center" 
                        style="font-size: 12px; height: 25px; display: {{ $userRole === 'user' ? 'none' : 'flex' }}; "
                        >
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
                        <input id="edit_task_name" name="task_name" class="w-full border rounded p-1" 
                        style="font-size: 12px; pointer-events: @php echo $userRole === 'user' ? 'none' : 'auto'; @endphp;"
                        >
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_description" class="block font-medium text-gray-700">Task Description</label>
                        <textarea id="edit_task_description" name="task_description" rows="5" class="w-full border rounded p-1" 
                        style="font-size: 12px; 
                        pointer-events: @php echo $userRole === 'user' ? 'none' : 'auto'; @endphp; ">
                        </textarea>
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_priority_level" class="block font-medium text-gray-700">Priority Level</label>
                        <select id="edit_task_priority_level" name="task_priority_level" class="w-full border rounded p-1"
                        style="pointer-events: @php echo $userRole === 'user' ? 'none' : 'auto'; @endphp;"
                        >
                            <option value="Low Priority">Low Priority</option>
                            <option value="Medium Priority">Medium Priority</option>
                            <option value="High Priority">High Priority</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="edit_assign_user" class="block font-medium text-gray-700">Assign to</label>
                        <select id="edit_assign_user" name="user_id" class="w-full border rounded p-1" 
                        style="pointer-events: @php echo $userRole === 'user' ? 'none' : 'auto'; @endphp;" >
                            <option value="Not Assigned Yet" selected disabled>Not Assigned Yet</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="edit_task_status" class="block font-medium text-gray-700">Status</label>
                        <select id="edit_task_status" name="task_status" class="w-full border rounded p-1"
                        >
                          
                            <option value="Todo">Todo</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="d-flex flex-row justify-between my-3">
                        <button id="updateBtn" type="submit" class="items-center justify-center btn btn-primary px-3" 
                        style="font-size: 12px; height: 25px;
                        ">
                            Update
                        </button>
                    </form>
                    <form id="delete-form" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-3 items-center justify-center"
                            style="font-size: 12px; height: 25px; 
                            display: {{ $userRole === 'user' ? 'none' : 'flex' }};">
                        Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ViewTask --}}
        <div id="viewTask" class="justify-center items-center translate-x-1" style="transition: opacity 0.5s ease; display: none; position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-color: rgba(0, 0, 0, 0.5);">
            <div id="containerViewTask" class="bg-white py-2 px-3 rounded-lg shadow-lg relative mb-2 w-72">
                <button onclick="closeViewTask();" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h1 class="text-center fw-bold py-2">View Task</h1>
                <div style="font-size: 12px" >
                    <div class="mb-2">
                        <label for="view_task_name" class="block font-medium text-gray-700">Task Name</label>
                        <p id="view_task_name"></p>
                    </div>
                    <div class="mb-2">
                        <label for="view_task_description" class="block font-medium text-gray-700">Task Description</label>
                        <p id="view_task_description" ></p>
                    </div>
                    <div class="mb-2">
                        <label for="view_task_priority_level" class="block font-medium text-gray-700">Priority Level</label>
                        <p id="view_task_priority_level"></p>
                    </div>
                    <div class="mb-2">
                        <label for="view_assign_user" class="block font-medium text-gray-700">Assign to</label>
                        <p id="view_assign_user">
                    </div>
                    <div class="mb-2">
                        <label for="view_task_status" class="block font-medium text-gray-700">Status</label>
                        <p id="view_task_status" >
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const openTask = (data) => {
            console.log(data.t_id);
            console.log(data.task_id);
            const assign = document.getElementById('assign_user');
            assign.value = data.user_id || 'Not Assigned Yet';
            if(assign.value === 'Not Assigned Yet'){
                assign.disabled = false;
            }else{
                assign.disabled = true;
            }

            document.getElementById('assign_task_name').textContent = data.task_name;
            document.getElementById('assign_task_priority').textContent = data.task_priority_level;
            document.getElementById('assign_task_description').textContent = data.task_description;
            document.getElementById('task_id').value = data.t_id;
            document.getElementById('Assign').style.display = 'flex';
        }

        const closeTask = () => document.getElementById('Assign').style.display = 'none';

    const editTask = (data,user_logged_id,user_logged_role) => {
            console.log('user id logged ' + user_logged_id)
            console.log('user role logged ' + user_logged_role)
            console.log('user id assigned ' + data.user_id)
            
            document.getElementById('editTask').style.display = 'flex';
            document.getElementById('edit_task_name').value = data.task_name;
            document.getElementById('edit_task_priority_level').value = data.task_priority_level;
            document.getElementById('edit_task_description').textContent = data.task_description;

            const assign = document.getElementById('edit_assign_user');
          
            if(user_logged_role === 'user'){
                if(data.user_id === null){
                    assign.style.pointerEvents = 'none';
                    assign.value = 'Not Assigned Yet'
                }else{
                    assign.value = data.id;
                    assign.style.pointerEvents = 'none';
                }
            }else{
                if(data.user_id === null){
                    assign.style.pointerEvents = 'none';
                    assign.value = 'Not Assigned Yet'
                }else{
                    assign.value = data.id;
                    assign.style.pointerEvents = 'auto';
                }
            }

            const status = document.getElementById('edit_task_status')
            status.value = data.task_status;

            if(user_logged_role === 'user'){
                if (user_logged_id === data.user_id) {
                    status.style.pointerEvents = 'auto';
                    document.getElementById('updateBtn').classList.add('d-flex');
                } else {
                    document.getElementById('updateBtn').classList.add('d-none');
                    status.style.pointerEvents = 'none';
                }
            }

            if(user_logged_role === 'admin'){
                document.getElementById('updateBtn').classList.add('d-flex');
            }


            // Update the delete form action dynamically
            const updateForm = document.getElementById('update-form');
            updateForm.action = `/tasks/${data.t_id}`;

            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = `/tasks/${data.t_id}`;
        };

        const closeEditTask = () => {
            document.getElementById('editTask').style.display = 'none';
            document.getElementById('updateBtn').classList.remove('d-none');
            
    }

    const viewTask = (data,user_logged_id,user_logged_role) => {
            
            document.getElementById('viewTask').style.display = 'flex';
            document.getElementById('view_task_name').textContent = data.task_name;
            document.getElementById('view_task_priority_level').textContent = data.task_priority_level;
            document.getElementById('view_task_description').textContent = data.task_description;
            document.getElementById('view_assign_user').textContent = data.email;
            document.getElementById('view_task_status').textContent = data.task_status;
            const timeStart = new Date(data.task_started_at);  
            const timeEnded = new Date(data.task_ended_at);


            if(data.task_status === 'Completed'){
                function formatTo12Hour(dateInput) {
                    const timeStart = new Date(dateInput);
                
                    let hours = timeStart.getHours();
                    const minutes = timeStart.getMinutes();
                    const seconds = timeStart.getSeconds();

                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    
                    const minutesStr = minutes < 10 ? '0' + minutes : minutes;
                    const secondsStr = seconds < 10 ? '0' + seconds : seconds;
                    return `${hours}:${minutesStr}:${secondsStr} ${ampm}`;
            }
            const formattedTimeStarted = formatTo12Hour(timeStart);
            const formattedTimeEnded = formatTo12Hour(timeEnded);
            const timeDifference = timeEnded - timeStart;
            const totalMinutes = Math.abs(timeDifference) / (1000 * 60);
            const hours = Math.floor(totalMinutes / 60);
            const minutes = Math.round(totalMinutes % 60); 
            const addRow = `
            <div id="addedRow">
                <div class="mb-2" style="font-size: 12px;">
                    <label for="view_task_status" class="block font-medium text-gray-700">Time Started</label>
                    <p>${formattedTimeStarted}</p>
                </div>
                <div class="mb-2" style="font-size: 12px;">
                    <label for="view_task_status" class="block font-medium text-gray-700">Time Ended</label>
                    <p>${formattedTimeEnded}</p>
                </div>
                <div class="mb-2" style="font-size: 12px;">
                    <label for="view_task_status" class="block font-medium text-gray-700">Time Spent"</label>
                    <p>${hours} hours & ${minutes} minutes</p>
                </div>
            </div>
            `;

            const container = document.getElementById('containerViewTask');
            container.innerHTML += addRow;

            }

            if(data.task_status === 'In Progress'){
                function formatTo12Hour(dateInput) {
                    const timeStart = new Date(dateInput);
                
                    let hours = timeStart.getHours();
                    const minutes = timeStart.getMinutes();
                    const seconds = timeStart.getSeconds();

                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    
                    const minutesStr = minutes < 10 ? '0' + minutes : minutes;
                    const secondsStr = seconds < 10 ? '0' + seconds : seconds;
                    return `${hours}:${minutesStr}:${secondsStr} ${ampm}`;
                }
                const formattedTimeStarted = formatTo12Hour(timeStart);
                const addRow = `
                <div id="addedRow">
                    <div class="mb-2" style="font-size: 12px;">
                        <label for="view_task_status" class="block font-medium text-gray-700">Time Started</label>
                        <p>${formattedTimeStarted}</p>
                    </div>
                </div>
            `;

            const container = document.getElementById('containerViewTask');
            container.innerHTML += addRow;
                
            }
        };

        const closeViewTask = () => {
            document.getElementById('viewTask').style.display = 'none';
            const rowToRemove = document.getElementById('addedRow');
                if (rowToRemove) {
                rowToRemove.remove();
            }
        }
    </script>
@endsection
