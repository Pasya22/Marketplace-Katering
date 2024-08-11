@extends('layout.tmps')
@section('title', 'Dashboard-Kantor')
@section('content')
    <style>
        .headings {
            display: flex;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 20px;
            text-transform: uppercase;
            stroke: aqua;
            stroke-width: 2px;
            justify-content: center;
            margin-bottom: 41%;
            margin-top:2%;
            letter-spacing: 20px;
        }
    </style>
    <h1 class="headings">Selamat Datang {{Auth::user()->username}}</h1>


@endsection
