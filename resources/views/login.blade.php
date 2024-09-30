<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('partials.css-imports')
        <title>Login</title>
    </head>

    <body style="width: 100vw; height: 100vh;" class="bg-secondary">
        <div class="d-flex justify-content-center align-items-center w-100 h-100">
            <form method="POST" action="{{ route('login.perform') }}" class="card p-5 w-25">
                @csrf
                
                <h3 class="mb-3 p-0">Login</h3>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        required 
                    >
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        required
                    >
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            
            </form>
        </div>
       
    </body>
</html>
