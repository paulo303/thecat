@extends('layouts.cats')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    BUSCA DE RAÇA DE GATOS
                </div>

                <div class="card-body">
                    <form action="{{ route('breeds') }}" method="GET">
                    <form action="">
                        {{-- @csrf --}}
                        <label for="name">Digite o nome da raça</label><br>
                        <input type="text" name="name" id="name" value="">
                        <button type="button" id="buscar">Buscar</button>
                    </form>
                    <div id="mensagem_erro"></div>
                    <div id="resultado" class="col-md-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on("keydown", "form", function(event) {
            if(event.key == "Enter") {
                $("#buscar").click();
                return event.key != "Enter";
            }
        });
    });
</script>
@endsection


