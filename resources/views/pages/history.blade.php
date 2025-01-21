@extends('layout.app')
@php
    use App\Services\AssignApi;
    use Carbon\Carbon;
    $reviews = AssignApi::viewCompletedTask();
@endphp

@section('pages')
    <div class="container px-4">
        <h2 class="py-4 text-gray-800 font-bold fs-4" >Approved Tasks Record</h2>
        <table class="table table-striped rounded-3 text-center" style="background-color: #F1F2F4; font-size: 12px;">
            <thead>
                <tr>
                    <th scope="col">Task Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Priority Level</th>
                    <th scope="col">Started - Ended</th>
                    <th scope="col">Time Spent</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                @if($review->task_status === 'Approved')
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
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
