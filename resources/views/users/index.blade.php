@extends('layouts.app')

@section('wrapper')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Index</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('user.index')}}">Users Index</a></li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">Users List </h4>
                        <a href="{{route('user.create')}}" class="pull-right btn-sm btn btn-info" type="button">create user</a>
                    </div><br>
                    @if($data->isNotEmpty())
                        <div class="col-md-12">
                            <form action="{{route('user.index')}}" method="get">
                                <div class="input-group">
                                    <input type="search" class="form-control typehead" name="name" placeholder="Name" id="search" value="{{request('name')}}">
                                    <input type="search" class="form-control" name="email" placeholder="Email" id="search"  value="{{request('email')}}" >
                                    <span class="input-group-prepend">
                                                      <button type="submit" class="btn btn-info">Search</button>
                                                        <a href="{{ route('user.index') }}" class="btn btn-danger">Reset</a>
                                                  </span>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card-body">

                        @if ($data->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>No user</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-nowrap text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-nowrap text-center">
                                                <a href="{{route('user.edit', $user->id)}}"
                                                   data-toggle="tooltip" data-original-title="Edit">Edit | </a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $user->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="Delete">Delete</a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="user-{{ $user->id }}"
                                                      action="{{route('user.destroy', $user->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No User</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {!! $data->appends(request()->toArray())->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @push('head')
        <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

    @endpush
    @push('script')
        <!-- Sweet-Alert  -->
        <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>


        <script>

            $(document).ready(function() {
                $( "#search" ).autocomplete({

                    source: function(request, response) {
                        $.ajax({
                            url: "{{url('search')}}",
                            data: {
                                name : request.name
                            },
                            dataType: "json",
                            success: function(data){
                                var resp = $.map(data,function(obj){
                                    //console.log(obj.city_name);
                                    return obj.name;
                                });

                                response(resp);
                            }
                        });
                    },
                    minLength: 1
                });
            });


            //Warning Message
            !function ($) {
                "use strict";

                var SweetAlert = function () {
                };
                //examples
                SweetAlert.prototype.init = function () {
                    //Warning Message
                    $('.sa-warning').click(function () {
                        var that = $(this);
                        swal({
                            title: "Are You Sure ?!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes Delete User",
                            closeOnConfirm: false
                        }, function () {
                            console.log(that);
                            var userId = that.data('id');
                            $('#user-' + userId).submit();
                        });
                    });
                },
                    //init
                    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
            }(window.jQuery),

//initializing
                function ($) {
                    "use strict";
                    $.SweetAlert.init()
                }(window.jQuery);
        </script>
    @endpush
@endsection
