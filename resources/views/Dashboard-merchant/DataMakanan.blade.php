@extends('layout.tmps')
@section('title','Data Makanan')
@section('content')


<div class="content-wrapper">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Data Menu Makanan</h1>
                </div>
            </div>
            <div class="row">
            <div class="col-md">
              <!--   Kitchen Sink -->
                <div class="panel panel-default">
                    {{-- <div class="panel-heading">
                        Menu
                    </div> --}}
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <!-- End  Kitchen Sink -->
            </div>

        </div>

    </div>
</div>


@endsection
