@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')


    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Silahkan Kamu Login Dulu </h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <form id="loginForm">
                        @csrf
                        <label>Email : </label>
                        <input type="text" id="email" name="email" required placeholder="Email"
                            class="form-control" />
                        <label>Password : </label>
                        <input type="password" id="password" name="password" required placeholder="Password"
                            class="form-control" />
                        <hr />
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span>
                            &nbsp;Log
                            Me In &nbsp;</button>
                        <br>
                        <hr>
                        <h3>
                            Belum Punya Akun Ya?
                            <a href="{{ route('register_user') }}">Register Dulu Yuk</a>
                        </h3>
                    </form>
                    <div id="message"></div>
                </div>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                // let formData = form
                $.ajax({
                    url: "{{ route('post-login') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Response:', response);
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            $('#message').html('<p>' + response.message + '</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        var response = xhr.responseJSON;
                        $('#message').html('<p>' + response.message + '</p>');
                    }
                });
            });
        });
    </script>
@endsection
