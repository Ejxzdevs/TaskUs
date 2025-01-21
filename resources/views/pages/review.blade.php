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
        <h2 class="py-4 text-white font-bold fs-4" >Completed Tasks</h2>
        <table class="table table-striped rounded-3" style="background-color: #F1F2F4; font-size: 12px;">
            <thead>
                <tr>
                    <th scope="col">Task Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Priority Level</th>
                    <th scope="col">Started - Ended</th>
                    <th scope="col">Time Spent</th>
                    <th scope="col">Created at</th>
                    <th scope="col" class="text-center" >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
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
                    @endphp
                    <tr>
                        <td>{{ $review->task_id }}</td>
                        <td>{{ $review->email }}</td>
                        <td>{{ $review->user_id }}</td>
                        <td>{{ $formattedStartTime }} - {{ $formattedEndTime }}</td>
                        <td>{{ $timeSpent }}</td>
                        <td>{{ $formattedCreatedAt }}</td>
                        <td class="d-flex flex-row gap-2" >
                            <form action="{{ route('tasks.update', $review->task_id ) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- <input type="text" name="user_id" value="{{ $review->user_id }}" > --}}
                                {{-- <input type="text" name="user_id" value="{{ $review->task_id }}" > --}}
                                <input type="text" name="task_status" value="Approved" >
                                <button type="submit" class="btn btn-success d-flex items-center justify-center" style="height: 30px; font-size: 12px;" >Approved</button>
                            </form>
                            <form action="">
                                <button class="btn btn-warning d-flex items-center justify-center text-white" style="height: 30px; font-size: 12px;" >Revise</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
