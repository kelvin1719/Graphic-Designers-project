<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Agency - Start Bootstrap Theme</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset("asset/assets/favicon.ico")}}" />
    <!-- Font Awesome icons (free version)-->
    <!-- <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> -->
    <!-- Google fonts-->
{{--    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />--}}
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset("asset/css/styles.css")}}" rel="stylesheet" />
    <link href="{{asset("asset/fontawesome-all.min.css")}}" rel="stylesheet" />
{{--    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>--}}
    <script src="{{asset('asset/jquery3.js')}}"></script>
    <script src="{{asset('asset/bootstrap.min.js')}}"></script>
    @yield('cssContent')
    <style>
        .loader,
        .loader:before,
        .loader:after {
            background: #ffffff;
            -webkit-animation: load1 1s infinite ease-in-out;
            animation: load1 1s infinite ease-in-out;
            width: 1em;
            height: 1em;
        }
        .loader {
            color: yellow;
            text-indent: -9999em;
            margin: 5px auto 0 auto;
            position: relative;
            font-size: 11px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
            position: absolute;
            top: 0;
            content: '';
        }
        .loader:before {
            left: -1.5em;
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }
        .loader:after {
            left: 1.5em;
        }
        @-webkit-keyframes load1 {
            0%,
            80%,
            100% {
                box-shadow: 0 0;
                height: 4em;
            }
            40% {
                box-shadow: 0 -2em;
                height: 1em;
            }
        }
        @keyframes load1 {
            0%,
            80%,
            100% {
                box-shadow: 0 0;
                height: 4em;
            }
            40% {
                box-shadow: 0 -2em;
                height: 5em;
            }
        }
    </style>
</head>
<body id="page-top">
<!-- Navigation-->
<nav style="width:100% !important ;" class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="{{asset("asset/assets/img/navbar-logo.vg")}}" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars ms-1"></i>
        </button>




        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="">About</a></li>
                <li class="nav-item"><a class="nav-link" href="">Designers</a></li>
                <li class="nav-item"><a class="nav-link" href="">Contact</a></li>
                @if(!(\Illuminate\Support\Facades\Session::has('Users')))
                <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#exampleModal" >Log in</a></li>
                @else
                    <li class="nav-item"><a id="logout" href="#" class="nav-link">Log Out</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Portfolio</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class=" text-center modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                <button type="button"  class=" btn btn-danger close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="">
                    @csrf
                    <div style="margin:2% auto;padding:3px; height:30px; border-radius: 4px;text-align:center;" class="errorMessage"></div>
                    <div class="form-outline">
                        <ul style="color:red" id="errorMessage">

                        </ul>
                        <input style="height:50px;  !important;" type="email" id="email" class="form-control" />
                        <label class="form-label" for="form2Example1">Email address</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input style="height:50px; margin-top:0" type="password" id="password" class="form-control" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <button style="width:40%;" type="button" id="login" class="btn btn-primary btn-block mb-4">Sign in</button>

                        <div   class="loader" style="display: none;">Loading...</div>
                        <p>Forgot your password ? <a href="#!">Click here</a></p>
                        <p>Not a member? <a href="{{route('signup')}}">Register</a></p>
                        <p>or sign up with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                          <a href=" {{url('google/sign-in')}} ">  <i class="fab fa-google"></i> </a>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <a href=" {{url('sign-in/github')}} ">  <i class="fab fa-github"></i> </a>
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Masthead-->


 @yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset("asset/js/scripts.js")}}"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>







<script>
    // $("window").ready(function(){


       $("#login").click(function(event){
           event.preventDefault();
           let email = $('#email').val();
           let password = $('#password').val();


              $('.loader').toggle();
           // Validation is done at the Backend
           // lets use Ajax
           setTimeout(function () {
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.ajax({
                   url:"/userlogin",
                   data:{
                       'email':email,
                       'password':password
                   },
                   type:"POST",
                   success:function(data) {
                       setInterval(function(){
                           $('.loader').hide();
                           $('#errorMessage').html('');
                           $('.errorMessage').removeClass('alert-danger');
                           $('.errorMessage').removeClass('alert-success');
                           $('.errorMessage').html('');
                           $('#email').removeClass('is-invalid');
                           $('#password').removeClass('is-invalid');

                       },5000);
                       if(data.status == 403){
                           if(data.data == null){
                               $('.loader').hide();
                               $('.errorMessage').addClass('alert-danger');
                               $('.errorMessage').html(data.msg);

                           }else{
                               $('.loader').hide();
                               $.each(data.data ,function (index , value){
                                   $('#errorMessage').append('<li>'+ value + '</li>');
                               });
                               if(data.data['email'] != null){
                                   $('#email').addClass('is-invalid');
                               }
                               if(data.data["password"] != null){
                                   $('#password').addClass("is-invalid");
                               }
                           }
                       }
                       else if(data.status == 200){
                           $('.errorMessage').addClass('alert-success');
                           $('.errorMessage').html(data.msg);
                           window.location = "{{route('home')}}";
                       }




                   }

               })
           }, 7000)



       });
    // });


    $('#logout').click(function(e){
        $.ajax({
            url:"/logout",
            type:"GET" ,

            success:function(data){
                if(data.status == 200){
                    console.log('hello World');
                    window.location = "{{route('home')}}";
                }
            },
            error:function(data){
                console.log(data)
            }
        })
    })

</script>
</body>
</html>
