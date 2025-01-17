<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management System</title>
         @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="login-container" style="background-image: url('{{ asset('storage/images/TaskUs.jpg') }}');">
            <div class="login-form col-12 col-md-6 col-lg-4">
              <h3 class="text-center mb-4 fw-bold">Welcome to TaskUs</h3>
              <form>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
            </div>
          </div>
    </body>
</html>
