@extends('layouts.appAdmin')

@section('content')
    <div class="container   ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-secondary py-2 px-1">
                        <h4>Add user</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('office.store') }}" method="post" autocomplete="off">
                        @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                                
                                <div class="col-md-6">
                                    @if($message = Session::get('registerError'))
                                                    
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Office name')}}</label>
                                
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $name='') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="division" class="col-md-4 col-form-label text-md-right">{{__('Division')}}</label>
                                
                                <div class="col-md-6">
                                    <input type="text" name="division" id="division" class="form-control @error('division') is-invalid @enderror" value="{{ old('division') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right text-no-">{{__('Username')}}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right text-no-">{{__('Password')}}</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary btn-block">
                                        <i class="fa fa-check" aria-hidden="true"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection