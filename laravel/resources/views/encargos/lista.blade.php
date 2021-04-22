@extends('layouts.main')

@section('title', 'Lista de Encargos')
@section('content')
	
	<div class="container-fluid text-center">
		 @if(session('msg'))
              <p class="alert alert-primary">{{ session('msg') }}</p>
            @endif
		<table class="table table-hover">
			<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Valor R$</th>
				<th>Data da Compra</th>
				<th>Data de Pagamento</th>
				<th>Forma de Pagamento</th>
				<th>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						NOVO
					</button>
				</th>
			</tr>
			@foreach($encargos as $e)
			@if($e->data_pagto != 0)
			<tr class="table-success">
				<td> {{$e->nome}} </td>
				<td> {{$e->descricao}} </td>
				<td> R$ {{number_format($e->valor, 2, ',', '') }} </td>
				<td> {{date('d/m/Y', strtotime($e->data_compra))}} </td>
				<td> {{date('d/m/Y', strtotime($e->data_pagto))}} </td>
				<td> {{$e->forma_pagto}} </td>
				<td> 
					<a href="/encargo/ver/{{$e->id}}" class="btn btn-outline-dark">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
			@else
			<tr class="table-danger"> 
				<td> {{$e->nome}} </td>
				<td> {{$e->descricao}} </td>
				<td> R$ {{number_format($e->valor, 2, ',', '') }} </td>
				<td> {{date('d/m/Y', strtotime($e->data_compra))}} </td>
				<td> <strong>PENDENTE</strong> </td>
				<td> {{$e->forma_pagto}} </td>
				<td> 
					<a href="/encargo/ver/{{$e->id}}" class="btn btn-outline-dark">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
			@endif
			@endforeach
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
					<form action="/encargos/novo" method="POST" autocomplete="off">
						@csrf
						<input type="text" name="nome" class="form-control" placeholder="Nome do Encargo" required> <br>
						<input type="text" name="descricao" class="form-control" placeholder="Descrição (opcional)"><br>
						<input type="text" name="valor" class="form-control" placeholder="R$ (apenas valores)" required>
						<label>Data da Compra</label>
						<input type="date" name="data_compra" class="form-control" required>
						<label>Data do Pagamento</label>
						<input type="date" name="data_pagto" class="form-control">
						<label>Forma de Pagamento</label>
						<select name="forma_pagto" class="form-control" required>
							<option>Escolha:</option>
							<option value="TED">TED</option>
							<option value="PIX">PIX</option>
							<option value="Boleto">Boleto</option>
							<option value="Espécie">Espécie</option>
							<option value="Cartão">Cartão</option>
						</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div>
					</form>
			</div>
		</div>
	</div>

@endsection