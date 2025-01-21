@extends('layout.app')
@php
    use App\Services\UsersApi;
    use Carbon\Carbon;

    $users = UsersApi::show();
    $userId = Session::get('user_id');
@endphp

@section('pages')
    <div class="container px-4">
        <h2 class="py-4 text-white font-bold fs-4" >Member List</h2>
        <table class="table table-striped rounded-3 " style="background-color: #F1F2F4; font-size: 12px;">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col" >Date Joined</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @php
                    $formattedDateJoined = Carbon::parse($user->created_at)->format('m/d/y');
                @endphp
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $formattedDateJoined }}</td>
                        <td>{{ $user->user_status }}</td>
                        <td>
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn {{ $user->user_status === 'Active' ? 'btn-success' : 'btn-danger' }} d-flex items-center justify-center" style="height: 30px; font-size: 12px;">
                                    {{ $user->user_status === 'Active' ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
