@extends('app')

@section('content')
    <div class="container">
        <h3>Clientes</h3>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo Cliente</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{{ $client->city }}</td>
                    <td>
                        <a href="{{ route('admin.clients.edit', ['id' => $client->id]) }}" class="btn btn-sm btn-default">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>
@endsection