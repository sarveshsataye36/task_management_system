<x-layout>
  <x-slot name="title">Login</x-slot>
  {{-- login view start here --}}
  
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <main class="form-signin w-25">
      <form method="post" action="{{route('login')}}">
        @csrf
        {{-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
        <h1 class="h3 mb-3 fw-normal">Sign In</h1>
    
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
          @error('email')
            <div class="error-msg">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
          @error('password')
            <div class="error-msg">{{ $message }}</div>
          @enderror
        </div>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" name="remember" value="remember"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </main>
  </div>
  {{-- login view end here --}}


</x-layout>