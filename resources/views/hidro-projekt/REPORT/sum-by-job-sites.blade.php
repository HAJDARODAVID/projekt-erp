@extends('layouts.mainAdminLayout')

@section('content')
<div class="">
  <div class="rounded shadow border p-3">
      <div class="d-flex align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:45px">
          <div class="h5 px-4"><b>IZVJEŠTAJ GRADILIŠTA</b></div>
      </div>
      <div class="row">
        <div class="px-4 pt-3">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style ="position: sticky; left: 0; z-index: 1; background-color: #fff">Gradilište</th>
                  <th>Zalihe na stanju</th>
                  <th>Potrošnja</th>
                  <th>Radni sati</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jobSites as $jobSite)
                    <tr>
                      <td style ="position: sticky; left: 0; z-index: 1; background-color: #fff">{{ $jobSite['name'] }}</td>
                      <td>{{ number_format($jobSite['onStock'], 2, ',', '.') }}€</td>
                      <td>{{ number_format($jobSite['consumption'], 2, ',', '.') }}€</td>
                      <td>{{ $jobSite['work_hours'] }}h</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
          
      </div>
  </div>
</div>
@endsection