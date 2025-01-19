@extends('layout.app')
@section('pages')
    <div class="p-0 flex-grow-1 " >
        @php
            $userEmail = Session::get('user_email');
            $userId = Session::get('user_id');
            $userStatus = Session::get('user_status');
        @endphp
          <p>User Email: {{$userEmail}}</p>
          <p>User ID: {{$userId}}</p>
          <p>User Status: {{$userStatus}}</p>
        <script>
            @if(session('success'))
              alert("{{ session('success') }}");
            @endif
        </script>
    </div>
@endsection