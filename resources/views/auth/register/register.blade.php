@extends('auth.layouts.app')
@section('title', 'Register')
@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Kamu Bisa Register Dulu Ya </h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('post-register') }}" method="POST" id="registerForm">
                        {{-- <form action="{{ route('post-login') }}" method="POST" > --}}
                        @csrf
                        <label>Nama Perusahaan : </label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan"  required class="form-control"
                        placeholder="Nama Perusahaan">
                        <label>Email : </label>
                        <input type="text" id="email" name="email"  required class="form-control" placeholder="Email">
                        <label>No Telpon/Wa : </label>
                        <input type="text" id="no_telp" name="no_telp"  required class="form-control"
                        placeholder="No Telepon">
                        <label>Alamat : </label>
                        <input type="text" id="alamat" name="alamat"  required class="form-control" placeholder="Alamat">

                        <label>Deskripsi : </label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" style="margin-bottom:16px;" class="form-control"></textarea>
                        <label>Username : </label>
                        <input type="text" id="username" name="username"  required class="form-control" placeholder="Username">
                        <label>password : </label>
                        <input type="password" id="password" name="password"  required class="form-control"
                            placeholder="Password">
                        <label for="password_confirmation">Konfirmasi Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                        required class="form-control" placeholder="Konfirmasi Passwrod">

                        <label for="level">Patner :</label>
                        <select name="level" id="level" class="form-control">
                            <option value="-- Pilih Status Anda --">-- Pilih Status Anda --</option>
                            <option value="merchant">Merchant</option>
                            <option value="kantor">Kantor</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span>
                            &nbsp;Register&nbsp;</button>
                        <h3>Sudah Punya Akun?<a href="{{ url('/') }}"> Login Yuk</a></h3>


                    </form>
                    <div id="message"></div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.redirect_url) {
                            window.location.href = response
                                .redirect_url; // Redirect to the appropriate dashboard
                        } else {
                            $('#message').html('<p>' + response.message + '</p>');
                        }
                    },
                    error: function(xhr) {
                        var message = '';
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                message += value.join('<br>') + '<br>';
                            });
                        } else {
                            message = xhr.responseJSON.message;
                        }
                        $('#message').html('<p>' + message + '</p>');
                    }
                });
            });
        });
    </script>
@endsection
