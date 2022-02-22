@extends('layouts.cats')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Busca de gatos</div>

                <div class="card-body">
                    <form action="">
                        <label for="nome">Digite o nome da raça</label><br>
                        <input type="text" name="nome" id="nome" value="ame">
                        <input type="button" id="buscar" value="Buscar">
                    </form>
                    <div id="mensagem_erro"></div>
                    <div align="center">
                        <img id="breed_image" src=""/>
                    </div>
                    <div id="breed_data">
                        <table id="breed_data_table"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#buscar").click();
    });
</script>
@endsection


