<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content=""/>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>Register - SB Admin</title>
    <link href="{{asset('asset/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('asset/fontawesome-all.min.css')}}" rel="stylesheet" />
    <script src="{{asset('asset/jquery3.js')}}"></script>
    <script src="{{asset('asset/bootstrap.min.js')}}"></script>
    <style>
        .body-background{
            background-image: linear-gradient(rgba(23,123,122,0.5) ,rgba(23,223,122,0.4)) , url('{{asset('asset/assets/img/portfolio/6.jpg')}}') ;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right;
        }
    </style>
{{--    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>--}}
</head>
<body class="body-background">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row ">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4"><i class="fas fa-user"></i>Create Account</h3></div>
                            <ul id="errormessage">

                            </ul>
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="first_name" id="first_name" type="text" placeholder="Enter your first name" />
                                                <label for="inputFirstName">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" name="last_name" id="last_name" type="text" placeholder="Enter your last name" />
                                                <label for="inputLastName">Last name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" id="role" name="graphic_designer_role" type="text" placeholder="sdfdsfs" >
                                            <option disabled="disabled" selected> Please select reason for being here</option>
                                            <option value="graphic_designer" >Graphic Designer</option>
                                            <option value="Ui_Ux" >Ui / Ux designer</option>
                                            <option value="photographer"> Photographer</option>
                                        </select>
{{--                                        <label for="inputEmail">Reason for being here</label>--}}
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="phone"name="phone" type="text" placeholder="Enter your first name" />
                                                <label for="inputFirstName">Phone</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="location"name="location" type="text" placeholder="Enter your last name" />
                                                <label for="inputLastName">Location</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="password" id="password" type="password" placeholder="Create a password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="Confirm password" />
                                                <label for="inputPasswordConfirm">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button class="btn btn-primary btn-block" type="submit" id="submit" >Create Account</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{url('/')}}">Have an account? Go to home and log in</a></div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </main>
    </div>

</div>


<script>
    $('#submit').on('click' , function(e){
        e.preventDefault();
        let firstname = $('#first_name').val();
        let lastname = $('#last_name').val();
        let phone = $('#phone').val();
        let location = $('#location').val();
        let email = $('#email').val();
        let graphic_designer_role = $('#role').val();
        let password = $('#password').val();
        let confirm_password = $('#confirm_password').val();



       $.ajaxSetup({
           headers:{
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
           }
       })

        $.ajax({
            url:"{{route('store')}}",
            data:{
                firstname,
                lastname,
                email,
                password,
                location,
                phone,
                confirm_password,
                graphic_designer_role

            },
            type:"POST",
            success:function(data){
                $('#first_name').html(firstname);
                $('#last_name').html(lastname);
                $('#phone').html(phone);
                $('#location').html(location);
                $('#email').html(email);


                console.log(data);
                if(data.status == 403){

                    $.each(data.data , function(index , value){
                        $('#errormessage').append('<li>'+ value + '</li>');
                    })
                }
                if(data.status ==200){

                    window.location = "{{route('home')}}" ;
                }
            },
            error:function(data){
                console.log(data);
            }

        })
    })
</script>
</body>
</html>
