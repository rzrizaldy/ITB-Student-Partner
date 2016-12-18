<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ITB Project Hub</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        @yield('head')
    </head>
    <body>

    <nav class="navbar navbar-default" style="padding-top: 7% !important">
      <div class="container-fluid" style="background-color:#50a3a2">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('home') }}" style="color:#fff">ITB Project Hub</a>
        </div>
        <div class="nav navbar-nav navbar-right">
            <li><a href="{{ route('home') }}" style="color:#fff">Home</a></li>
            <li><a href="{{ route('project.create') }}" style="color:#fff">Post a project</a></li>
            <li><a href="{{ action('WebController@about') }}" style="color:#fff">About</a></li>
            <form action="{{ action('WebController@search') }}" method="POST" class="navbar-form navbar-left" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for project...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
      </div>
    </nav>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>


    </body>
</html>



