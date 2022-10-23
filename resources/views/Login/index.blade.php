<!DOCTYPE html>
<html>

<head>
    <title> Sion WKO | Login </title>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image" href="{{asset('/img/Gereja WKO.jpg')}}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('/css/fontawesome-5.14/all.css')}}">
</head>

<body>
    <div class="container">
        <div class="row" style="border:1px solid #c4c4c4;box-shadow: 5px 10px #888888;margin-top:120px;color:white">
            <div class="col-4" style="padding:100px;">                  
                <center>
                    <img src="{{asset('/img/Gereja SION WKO.png')}}" alt="Gereja Sion WKO">
                </center>   
            </div>
            <div class="col-8" style="border-left: 120px solid transparent;border-bottom: 450px solid #1c53a0;">
                <form action="<?= url('/cekLogin') ?>" method="POST" style="position: absolute;padding:100px;" class="col-lg-12">
                    @csrf
                    <label for="email"> Your Email </label>
                    <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
                    <label for="email"> Your Password </label>
                    <input type="password" class="form-control" placeholder="************" name="password">
                    <div class="float-left col-6">
                        <input type="checkbox" name="remember_me" id="remember_me"> Remember Me
                    </div>
                    <div class="float-left col-6">
                        <a href="#" class="float-right"> Recovery Password </a>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary p-2 w-100"> SIGN IN </button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= asset('/js/jquery-3.5.1.js') ?>"></script>
<script src="<?= asset('/js/bootstrap.js') ?>"></script>
<script src="{{asset('/js/font-awesome.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?= asset('/js/autoNumeric.min.js') ?>"></script>
<script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
<script>
    @if(session()->has('status'))
        Swal.fire({
            icon: '{{session()->has("icon") ? session("icon") : "success"}}',
            title: '{{session("judul_alert")}}',
            text : '{{session("status")}}',
            showConfirmButton: false,
            timer: 1500
        })
    @endif 
</script>
</html>
