<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management System</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            function validateForm() {
                var password = document.getElementById("password").value;
                var rePassword = document.getElementById("re_password").value;

                if (password !== rePassword) {
                    alert("Passwords do not match!");
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <div class="login-container" style="background-image: url('{{ asset('storage/images/TaskUs.jpg') }}');">
            <div class="login-form col-12 col-md-6 col-lg-4">
              <h3 class="text-center mb-4 fw-bold">Register Account</h3>
                <form onsubmit="return validateForm()" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="Email" class="form-label text-gray-700">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label text-gray-700">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                </div>
                <div class="mb-3">
                    <label for="re_password" class="form-label text-gray-700">Re Password</label>
                    <input type="password" class="form-control" id="re_password" placeholder="Re-Enter Password" required>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="my-1">
                  <a class="text-gray-700 text-decoration-underline" href="{{ route('login')}}">Login Account?</a>
                </div>
              </form>
            </div>
        </div>
    </body>
</html>
