
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 text-secondary">Dashboard</a></li>
          </ul>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


          <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      @auth

      <li class="nav-item">
        <a class="nav-link" href="{{url('register-user')}}">Create User</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
            {{auth()->user()->name}}
            </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout.perform') }}" class="btn  me-2">Logout</a>
      </li>
      @endauth

      @guest 
      <div class="text-end">
      <li class="nav-item">
          <a class="btn btn-warning me-2" href="{{ route('login.perform') }}">Login</a>
        </li>
      </div>
       
      @endguest

        


  </div>

    

      </div>
      


</header>