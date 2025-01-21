@extends('layout.app')
@php
    use App\Services\AssignApi;
    use Carbon\Carbon;

    $reviews = AssignApi::viewCompletedTask();
    $userRole = Session::get('user_role');
    $userId = Session::get('user_id');
@endphp

@section('pages')
    <div class="container px-4">
        <h2 class="py-4 text-gray-800  font-bold fs-4" >Task Review</h2>
        <table class="table table-striped rounded-3 text-center"  style="background-color: #F1F2F4; font-size: 12px;">
            <thead>
                <tr>
                    <th scope="col">Task Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Priority Level</th>
                    <th scope="col">Started - Ended</th>
                    <th scope="col">Time Spent</th>
                    <th scope="col">Date</th>
                    <th scope="col" >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    @if($review->task_status === 'Completed')
                    @php
                        $startTime = Carbon::parse($review->task_started_at);
                        $endTime = Carbon::parse($review->task_ended_at);
                        $diffInMinutes = $startTime->diffInMinutes($endTime);
                        $hours = floor($diffInMinutes / 60);
                        $minutes = $diffInMinutes % 60;
                        $timeSpent = "{$hours} hours {$minutes} minutes";
                        $formattedStartTime = $startTime->format('g:i A'); 
                        $formattedEndTime = $endTime->format('g:i A');
                        $formattedCreatedAt = Carbon::parse($review->created_at)->format('m/d/y');
                        $formattedEndedAt = Carbon::parse($review->task_ended_at)->format('m/d/y');
                    @endphp
                    <tr>
                        <td>{{ $review->task_name }}</td>
                        <td>{{ $review->email }}</td>
                        <td>{{ $review->task_priority_level }}</td>
                        <td>{{ $formattedStartTime }} - {{ $formattedEndTime }}</td>
                        <td>{{ $timeSpent }}</td>
                        <td>{{ $formattedCreatedAt }} - {{ $formattedEndedAt }}</td>
                        <td class="d-flex flex-row gap-2" >
                            <form action="{{ route('tasks.update', $review->task_id ) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="task_status" value="Approved" hidden>
                                <button type="submit" class="btn btn-success d-flex items-center justify-center" style="height: 30px; font-size: 12px;" >Approved</button>
                            </form>
                            <a onclick="openRevise( {{ json_encode($review) }});" class="btn btn-warning d-flex items-center justify-center text-white" style="height: 30px; font-size: 12px;" >Revise</a>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div id="revise" class="justify-center items-center translate-x-1" style="transition: opacity 0.5s ease; display: none; position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-color: rgba(0, 0, 0, 0.5);">
            <div id="containerViewTask" class="bg-white py-2 px-3 rounded-lg shadow-lg relative mb-2 w-72">
                <button onclick="closeRevise();" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <p id="title" class="text-center fw-bold py-2" style="font-size: 12px" ></p>
                <form action="" method="POST" id="update-form" style="font-size: 12px">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="view_task_name" class="form-label">Revise Description</label>
                        <textarea name="task_description" rows="5" class="form-control w-100 border border-secondary"></textarea>
                        <input type="text" name="task_status" value="Revise" hidden>
                    </div>
                    <div class="mb-2 d-flex justify-center items-center">
                        <button type="submit" style="height: 30px; width: 150px; font-size: 12px" class="d-flex justify-center items-center btn btn-primary text-white ">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <script>
            const openRevise = (data) => {
                document.getElementById('revise').style.display = 'flex';
                document.getElementById('title').textContent = data.task_name;

                const updateForm = document.getElementById('update-form');
                updateForm.action = `/tasks/${data.task_id}`;
                console.log(data);
                
            }

            const closeRevise = () => document.getElementById('revise').style.display = 'none';
        </script>
    </div>
@endsection
