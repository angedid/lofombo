@extends('layouts.email-template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $data['subject'] }} <br></h3>
                    </div>

                    <div class="card-body">
                        <div>
                            {{ $data['message'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


