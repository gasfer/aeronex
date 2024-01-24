@extends('adminlte::page')
@section('title', 'Profile')
@section('plugins.Pace', true)

@section('content_header') 
<h1></h1>
@stop

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row" style="background-color: #929797">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{$url_profile}}">
                <span class="font-weight-bold">{{ $user_data->name }}</span><span class="text-black-50">{{$user_data->email }}</span><span> </span></div>
        </div>
        <div class="col-md-9 ">
            <div class="p-4 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3" >
                    <h4 class="text-right">Mi Perfil</h4>
                </div>
               
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Nombre Completo</label><input type="text" class="form-control" placeholder="Su nombre completo" value="{{ $user_data->name }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Correo</label><input type="text" class="form-control" placeholder="Su correo" value="{{ $user_data->email }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Genero</label>
                        <select name="select" class="form-control" disabled>
                            @foreach ($genero as $value)
                            
                            @if ($user_data->genero == $value)
                            <option value="{{ $value }}" selected>{{ $value }}</option>
                            @else
                            <option value="{{ $value }}" >{{ $value }}</option>
                            @endif
                            
                            @endforeach
                      </select></div>
                    <div class="col-md-12"><label class="labels">Unida</label><input type="text" class="form-control" placeholder="Su unida" readonly value="{{ mb_strtoupper($user_data->ofice) }}"></div>
                </div>
               
                {{-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> --}}
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
@stop

@section('css')
   
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop