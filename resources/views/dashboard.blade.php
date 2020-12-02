<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>
        Dashboard
    </title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous"
          rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link href="{{ asset('css/jquery-ui.min.css') }}"
          rel="stylesheet">
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <link href="{{ asset('css/style.css') }}"
          rel="stylesheet">
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">
                            {{ \Auth::user()->first_name }}
                            {{ \Auth::user()->last_name }}
                        </h4>
                        <p class="text-muted">
                            {{ \Auth::user()->email }}
                            <br>
                            {{ \Auth::user()->gender }}
                            .
                            {{ \Auth::user()->date_of_birth->diffInYears() }} years old
                            <br>
                            Yearly Income:
                            {{ \Auth::user()->annual_income }}/-
                            <br>
                            Employement:
                            {{ \Auth::user()->occupation }}
                            <br>
                            @if(\Auth::user()->family_type)
                            Lives in a {{ strtolower(\Auth::user()->family_type) }}
                            @endif
                        </p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Action</h4>
                        <ul class="list-unstyled">
                            {{-- <li><a href="#" class="text-white">Update Basic Details</a></li>
                            <li><a href="#" class="text-white">Update Partner Details</a></li> --}}
                            <li><a href="/logout" class="text-white">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Dashboard</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1>Selected Details</h1>
                <p class="lead text-muted">
                    <strong>Expected Income: </strong>
                    {{ \Auth::user()->expected_income === null ? '-' : (\Auth::user()->expected_income[0] . '-' . \Auth::user()->expected_income[1]) }}
                    <br>
                    <strong>Expected Family Type: </strong>
                    {{ \Auth::user()->expected_family_type === null ? '-' : implode(',', \Auth::user()->expected_family_type) }}
                    <br>
                    <strong>Manglik: </strong>
                    {{ \Auth::user()->expected_manglik === null ? '-' : \Auth::user()->expected_manglik }}
                </p>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @if($potentialPartners->count() > 0)
                        @foreach($potentialPartners as $potentialPartner)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                    <title>
                                        {{ $potentialPartner->first_name }}
                                        {{ $potentialPartner->last_name }}
                                    </title>
                                    <rect width="100%" height="100%" fill="#55595c"/>
                                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                        {{ $potentialPartner->first_name }}
                                        {{ $potentialPartner->last_name }}
                                    </text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $potentialPartner->email }}
                                        <br>
                                        {{ $potentialPartner->gender }}
                                        .
                                        {{ $potentialPartner->date_of_birth->diffInYears() }} years old
                                        <br>
                                        Yearly Income:
                                        {{ $potentialPartner->annual_income }}/-
                                        <br>
                                        Employement:
                                        {{ $potentialPartner->occupation }}
                                        <br>
                                        Lives in a {{ strtolower($potentialPartner->family_type) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-12 text-center">
                        <h4>No potential parter at the moment.</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Task done by Yogesh Panghaal</p>
      </div>
    </footer>
</body>
</html>