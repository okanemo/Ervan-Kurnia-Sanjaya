@extends('layouts.app')

@section('title', 'User Management')

@section('content')
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">User Management - <span id="roleName"></span></h1>
    </div>
    <div class="container">
      <table class="table text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="userList">
          
        </tbody>
      </table>
    </div>
  </main>
@endsection

@section('script')
  <script src="{{ url('js/user.js') }}"></script>
@endsection