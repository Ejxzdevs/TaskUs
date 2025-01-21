@extends('layout.app')
@section('pages')
    <div class="p-0 flex-grow h-100" >
        <div class="flex flex-col h-100">
            <div class="border w-100 d-flex justify-between items-center px-4" style="height: 90px" >
                <p class="Smooch text-gray-800  font-bold fs-4" >Dashboard</p>
            </div>
            <div class="border" style="height: 400px">
                <p>s</p>
            </div>
        </div>
        <script>
            @if(session('success'))
              alert("{{ session('success') }}");
            @endif
        </script>
    </div>
@endsection