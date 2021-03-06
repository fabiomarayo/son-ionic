@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Pedido</h3>
        @include('errors._check')
        {!! Form::open(['route'=>'customer.order.store','class'=>'form']) !!}
        <div class="form-group">
            <label for="">Total</label>
            <p id="total"></p>
            <a href="#" class="btn btn-default" id="btnNewItem">Novo Item</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][product_id]" id="" class="form-control">
                            @foreach($products as $p)
                                <option value="{{ $p->id  }}" data-price="{{ $p->price }}">{{ $p->name }} - {{ $p->price }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        {!! Form::text('items[0][qtd]', 1, ['class'=>'form-control']) !!}
                    </td>
                </tr>
            </tbody>
        </table>

        {!! Form::submit('Criar Pedido', ['class'=>'btn btn-default']) !!}

        {!! Form::close() !!}
    </div>

@endsection


@section('post-script')
    <script type="text/javascript">
        $("#btnNewItem").on('click', function () {
            var row = $("table tbody > tr:last"), newRow = row.clone(), length = $("table tbody > tr").length;

            newRow.find('td').each(function(){
                var td = $(this), input = td.find(':input'), name = input.attr('name');
                input.attr('name', name.replace((length-1) + "", length + ""));
            });

            newRow.find('input').val(1);
            newRow.insertAfter(row);
            calculateTotal();
        });

        $(document.body).on('click','select', function() {
            calculateTotal();
        });

        $(document.body).on('blur','input', function() {
           calculateTotal();
        });


        function calculateTotal()
        {
            var total = 0, trLength = $("table tbody > tr").length, tr = null, price, qtd;

            for(var i = 0; i < trLength; i++) {
                tr      = $("table tbody tr").eq(i);
                price   = tr.find(':selected').data('price');
                qtd     = tr.find('input').val();

                total += price * qtd;
            }

            $("#total").html(total);
        };


    </script>

@endsection