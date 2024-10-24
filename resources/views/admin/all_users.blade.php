@extends('admin.layout')
@section('title', 'All Users')
@section('content')


<div class="pagetitle">
      <h1>General Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>

              @if (session('success'))
                  <div class="alert alert-success">
                      <ul>
                          <li>{{ session('success') }}</li>
                      </ul>
                  </div>
              @endif

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <img style="max-width: 30px" class="img-fluid" src="{{ asset($user->profile_photo_path) }}">
                    </td>
                    <td>
                      <a class="btn btn-link btn-sm" href="{{ route('user.edit', $user->id) }}">Edit</a>

                      <form method="POST" action="{{ route('user.destroy', $user->id) }}" accept-charset="UTF-8" style="display:inline">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-link btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

          
      </div>
    </section>

@endsection