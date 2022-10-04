@extends('layouts.app')

@section('content')
<Style>
    html,
body,
.intro {
  height: 100%;
}

table td,
table th {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

thead th,
tbody th {
  color: #fff;
}

tbody td {
  font-weight: 500;
  color: rgba(255,255,255,.65);
}

.card {
  border-radius: .5rem;
}
</Style>
<section class="intro mt-5">

    <div class="mask d-flex align-items-center h-100" >
    @if (session('found'))
    <div class="alert alert-success">
        {{ session('found') }}
    </div>
@endif
@if (session('NoFound'))
    <div class="alert alert-danger">
        {{ session('NoFound') }}
    </div>
@endif
    
      <div class="container">
      <div class="px-1 mb-3">
          <div class="search">
            <i class="fa fa-search"></i>
            <form action="{{ route('admin.usersSearch') }}" method="GET">
                <div class="row">
                    <div class="col-11">
                    <input type="search" name="search" class="form-control col-8" placeholder="you can search for any record">
                    </div>
                    <div class="col-1">
                    <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card bg-dark shadow-2-strong">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-dark table-borderless mb-0">
                    <thead>
                      <tr>
                      <th scope="col">#</th>
                        <th scope="col">EMPLOYEES</th>
                        <th scope="col">POSITION</th>
                        <th scope="col">Email</th>
                        <th scope="col">PHONE NUMBER</th>
                        
                      </tr>
                    </thead>
                    <tbody> 
              @if($Users->isNotEmpty())
                @foreach ($Users as $OneUser)

                <tr>
                    <td>{{ $OneUser->id }}</td>
                    <td>{{ $OneUser->Fname }} {{ $OneUser->Lname }}</td>
                    <td>@if($OneUser->role == 1) Admin  @elseif($OneUser->role == 3) carpenter @endif </td>
                    <td>{{ $OneUser->email }}</td>
                    <td>{{ $OneUser->phoneNumber }}</td>
                    
                </tr>
                @endforeach
                
                @else
                    <tr>
                    <h2>No record found</h2>
                    </tr>
                       
                    
            @endif
               
              </tbody>
                  </table>
                  {!! $Users->links() !!}

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
