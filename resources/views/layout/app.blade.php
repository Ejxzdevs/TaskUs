<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management System</title>
         @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
       <div class="main-container d-flex flex-row">
            <div class="d-flex flex-col border-right border-1 h-100" style="background-color:#7D2650" >
                @include('components.sidebar')
            </div>
            <div class="flex-1 flex-col"> 
                @include('components.header')
                <div style="background-color: #CD5A91" >
                    @yield('pages')
                </div>
            </div>
        </div>
    </body>
</html>
