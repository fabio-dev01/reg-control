@extends('layouts.main')

@section('title', 'Ver encargo')
@section('content')
	
	<style>
		#linha_btn a{
			margin-right: 52px;
		}

		#linha_btn button{
			margin-right: 52px;
		}
		#linha_btn input{
			margin-right: 52px;
		}
	</style>

	<div class="container">

		<div class="row float-right" id="linha_btn">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
				<i class="fas fa-edit"></i>Editar
			</button>

			<form action="/encargo/{{$encargo->id}}" method="POST">
			@csrf
			@method('DELETE')
				<input type="submit" value="Apagar" class="btn btn-outline-danger">
			</form>
			
			<a onclick="window.print()" class="btn btn-outline-dark"> 
				<i class="fas fa-print"></i>
			Imprimir
			</a>
			<a href="/encargos" class="btn btn-outline-info">
				<i class="fas fa-undo"></i>
			voltar
			</a>
		</div>


		<table class="table">
			<tr>
				<th>Nome do Encargo</th>
				<td>{{$encargo->nome}}</td>
			</tr>
			<tr>
				<th>Descrição</th>
				<td>{{$encargo->descricao}}</td>
			</tr>
			<tr>
				<th>Valor</th>
				<td> R$ {{number_format($encargo->valor, 2, ',', '') }} </td>
			</tr>
			<tr>
				<th>Data da Compra</th>
				<td>{{date('d/m/Y', strtotime($encargo->data_compra))}}</td>
			</tr>
			@if($encargo->data_pagto != 0)
			<tr class="table-success">
				<th>Data do Pagamento</th>
				<td>{{date('d/m/Y', strtotime($encargo->data_pagto))}}</td>
			</tr>
			@else
			<tr class="table-danger">
				<th>Data do Pagamento</th>
				<td> PENDENTE</td>
			</tr>
			@endif
			<tr>
				<th>Usuário</th>
				<td>{{$encargoCad['name']}}</td>
			</tr>
		</table>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cadastro de Encargo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="/encargo/editar/{{$encargo->id}}" method="POST" autocomplete="off">
						@csrf
						@method('PUT')
						<input type="text" name="nome" class="form-control" value="{{$encargo->nome}}"> <br>
						<input type="text" name="descricao" class="form-control" value="{{$encargo->descricao}}"><br>
						<input type="text" name="valor" class="form-control" value="{{$encargo->valor}}">
						<label>Data da Compra</label>
						<input type="date" name="data_compra" class="form-control" value="{{$encargo->data_compra}}">
						<label>Data do Pagamento</label>
						<input type="date" name="data_pagto" class="form-control" value="{{$encargo->data_pagto}}">
						<label>Forma de Pagamento</label>
						<select name="forma_pagto" class="form-control" required>
							<option value="{{$encargo->forma_pagto}}">{{$encargo->forma_pagto}}</option>
							<option value="TED">TED</option>
							<option value="PIX">PIX</option>
							<option value="Boleto">Boleto</option>
							<option value="Espécie">Espécie</option>
							<option value="Cartão">Cartão</option>
						</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Editar</button>
				</div>
					</form>
			</div>
		</div>


@endsection