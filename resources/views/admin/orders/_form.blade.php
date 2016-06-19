<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_deliveryman_id', 'Entregador:') !!}
    {!! Form::select('user_deliveryman_id', $deliverymen, null, ['class'=>'form-control']) !!}
</div>