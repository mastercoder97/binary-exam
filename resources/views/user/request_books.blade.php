@extends('layouts.master')

@section('title', 'Request Books')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Request Books</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Request Books</li>
            </ol>
            <a href="{{ url('/request/books/add') }}" class="btn btn-success">Request Books <i class="fa fa-plus"></i></a>
            <br>
            <br>
            <div class="card mb-4">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if(session('danger'))
                        <div class="alert alert-danger">
                            {!! session('danger') !!}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <table class="table table-bordered table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>Book Code</th>
                                <th>Approver Name</th>
                                <th>Date Requested</th>
                                <th>Date Approved</th>
                                <th>Date to Return</th>
                                <th>Date Returned</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $key => $request)
                                <tr>
                                    <td>{{ $request->book->book_code }}</td>
                                    <td>@if(!empty($request->approved_by)) {{ $request->approved->name }} @endif</td>
                                    <td>{{ date('F d, Y', strtotime($request->date_request)) }}</td>
                                    <td>@if(!empty($request->date_approved)) {{ date('F d, Y', strtotime($request->date_approved)) }} @endif</td>
                                    <td>@if(!empty($request->date_return)) {{ date('F d, Y', strtotime($request->date_return)) }} @endif</td>
                                    <td>@if(!empty($request->returned)) {{ date('F d, Y', strtotime($request->returned)) }} @endif</td>
                                    <td>
                                        @if($request->status == 0)
                                            <div class="alert alert-info text-center" role="alert" style="margin: 0px; padding: 5px;">
                                                Pending
                                            </div>
                                        @endif

                                        @if($request->status == 1)
                                            <div class="alert alert-success text-center" role="alert" style="margin: 0px; padding: 5px;">  
                                                Approved
                                            </div>
                                        @endif

                                        @if($request->status == 2)
                                            <div class="alert alert-warning text-center" role="alert" style="margin: 0px; padding: 5px;">  
                                                Return
                                            </div>
                                        @endif

                                        @if($request->status == 3)
                                            <div class="alert alert-danger text-center" role="alert" style="margin: 0px; padding: 5px;">  
                                                Decline
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->status != 0 && $request->status != 3 && $request->status != 2)
                                            <a href="{{ url('/books/return/request/'.$request->request_code) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Return</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
