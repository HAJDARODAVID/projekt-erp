@extends('layouts.mainAdminLayout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Popis radnika:</h1>
  </div>
  
  <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <br>
    <button class="btn btn-success btn-sm">NOVI RADNIK</button>
    <a class="btn btn-dark btn-sm" style = "width: 50px" href="javascript: w=window.open('{{ route('payrollLabels') }}');">
      <i class="bi bi-printer"></i>
    </a>
    <div class="row">
      
      <table class="table table-sm" style ="width: 350px">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($workers as $worker)
            <tr>
              <th class="col-md-1" scope="row">{{ $worker->id }}</th>
              <td class="col-md-2">{{ $worker->firstName }}</td>
              <td class="col-md-2">{{ $worker->lastName }}</td>
            </tr>
          @endforeach
          

        </tbody>
      </table>
      {{ $workers->links() }}
    </div>
  </div>
@endsection
