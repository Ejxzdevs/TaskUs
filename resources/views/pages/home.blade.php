@extends('layout.app')
@php
    use App\Services\UsersApi;
    use App\Services\TaskApi;
    use App\Services\AssignApi;
        use Carbon\Carbon;
        $recentApproved = AssignApi::viewCompletedTask();
        $recentApproved = $recentApproved->sortByDesc('task_ended_at');
        $users = UsersApi::show();
        $totalUsers = count($users);
        $tasks = TaskApi::show();
        $totaltasks = count($tasks);
        $approvedTasks = $tasks->where('task_status', 'Approved');
        // Group tasks by month and year based on 'task_ended_at'
        $tasksPerMonth = $approvedTasks->groupBy(function($task) {
            return Carbon::parse($task->task_ended_at)->format('Y-m');
        });
        $tasksCount = $tasksPerMonth->map(function($tasks) {
            return $tasks->count();
        });
        $months = $tasksCount->keys();
        $counts = $tasksCount->values();
@endphp
@section('pages')
    <div class="p-0 flex-grow h-100" >
        <div class="flex flex-col h-100">
            <div class="w-100 d-flex justify-between items-center px-4" style="height: 150px" >
                <p class="serif text-gray-800 font-bold fs-4" >Dashboard</p>
                <div class="input-group" style="width: 300px">
                    <!-- Search Icon and Input Field -->
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search:" aria-label="Search">
                  </div>
            </div>
            <div style="overflow-y: scroll" >
            <div class="d-flex flex-row px-3" >
                <div class="d-flex flex-row gap-2 w-100" >
                    <div class=" d-flex flex-col items-center gap-3" style="width: 25%;" >

                        <div class="shadow-md d-flex flex-col" style="height: 140px; width: 220px; 
                        background-color: rgba(187, 243, 176, 0.658); 
                        backdrop-filter: blur(10px); ">
                            <div class="smooch h-25 d-flex flex-row items-center gap-2">
                                <i style="font-size: 12px" class="fas fa-tasks ms-3"></i>
                                <p style="font-size: 12px" class="text-primary font-bold">Number of Tasks</p>
                            </div>
                            <div class="h-75 d-flex flex-col items-center ">
                                <p class="text-gray-700" style="font-size: 55px" >{{$totaltasks}}</p> 
                             </div>
                        </div> 

                        <div class="shadow-md d-flex flex-col" style="height: 140px; width: 220px; 
                        background-color: rgba(186, 176, 243, 0.658); 
                        backdrop-filter: blur(10px); ">
                            <div class="smooch h-25 d-flex flex-row items-center gap-2">
                                <i style="font-size: 12px" class="fas fa-tasks ms-3"></i>
                                <p style="font-size: 12px" class="text-primary font-bold">Number of Members</p>
                            </div>
                            <div class="h-75 d-flex flex-col items-center ">
                                <p class="text-gray-700" style="font-size: 55px" >{{$totalUsers}}</p> 
                             </div>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-start py-1" style="width: 45%; height: 300px; " >
                        <div class="shadow-sm d-flex justify-center items-center" style="width: 100%; background-color: #F3F2F9;" >
                                <canvas id="myBar"></canvas>
                        </div>
                    </div>
                    <div class="d-flex py-1 " style="width: 30%; height: 300px;  " >
                        <div class="shadow-sm d-flex justify-center items-center" style="width: 100%; background-color: #F3F2F9;
                        " >
                            <canvas id="myPie"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    <div class="border px-4" style="width: 100%; height: auto;  " >
        <p class="smooch py-3 text-gray-600 font-bold" >Recent Approved Tasks</p>
        <table class="table table-striped rounded-3 text-center" style="background-color: #F1F2F4; font-size: 12px;">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Priority Level</th>
                    <th scope="col">Started - Ended</th>
                    <th scope="col">Time Spent</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentApproved as $review)
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
                        <td>{{ $review->email }}</td>
                        <td>{{ $review->task_name }}</td>
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
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // PIE GRAPH
        const pie = document.getElementById('myPie');
        new Chart(pie, {
        type: 'polarArea',
            data: {
            labels: ['Todo', 'In Progress', 'Completed'],
            datasets: [{
            label: 'Tasks ',
            data: [12, 19, 40],
            borderWidth: 1,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: ['rgba(186, 176, 243, 0.658)', 'rgba(246, 250, 20, 0.658)', 'rgba(187, 243, 176, 0.658)'],
            }]
            },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            datalabels: {
                display: true,
                color: 'black',
                formatter: (value, context) => {
                    let total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                    let percentage = ((value / total) * 100).toFixed(1); 
                    return `${value} (${percentage}%)`;
                    }
                 }
                    }
                }
            });

            var months = @json($months);
            var taskCounts = @json($counts); 
            const bar = document.getElementById('myBar');
            new Chart(bar, {
              type: 'bar',
              data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                  label: months,
                  data: taskCounts,
                  borderWidth: 1,
                  borderColor: 'rgb(175, 122, 92)',
                  backgroundColor: 'rgba(85, 165, 227, 0.658)'
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          </script>
    </div>
@endsection