@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Promjena lozinke</div>
                <div class="card-body">
                    <form action="{{ route('bde_passwordChange') }}" method="post" id="changePassword">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nova loznika') }}</label>
    
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Ponovi lozinku') }}</label>
    
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-center">
                            <button class="btn btn-success" style="width: 150px" onclick="event.preventDefault();
                            document.getElementById('changePassword').submit();">PROMJENI</button>
                        </div>
                        
                    </form>

                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection