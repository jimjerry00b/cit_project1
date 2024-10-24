@extends('admin.layout')
@section('title', 'Edit user')
@section('content')

<div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit User</h5>

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              @if (session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
              @endif

              <!-- General Form Elements -->
              <form action="{{ route('user.update', $user->id ) }}" method="post" enctype="multipart/form-data">

                {!! csrf_field() !!}
                {{ method_field('PUT') }}

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"/>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="old_password" class="form-control" autocomplete="new-password">
                  </div>
                </div>


                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                  </div>
                </div>
                

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <img style="max-width: 100px;" class="img-fluid" src="{{ asset($user->profile_photo_path) }}">
                    <br>
                    <input class="form-control" name="profile_photo_path" type="file" id="formFile">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Button</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>

        
      </div>
    </section>

@endsection