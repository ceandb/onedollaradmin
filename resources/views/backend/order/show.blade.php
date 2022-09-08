@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
<h5 class="card-header">Orden       <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generar PDF</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>ID</th>
            <th>Orden No.</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Cantidad</th>
            <th>Cargo</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acccion</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>${{$order->shipping->price}}</td>
            <td>${{number_format($order->total_amount,2)}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">{{$order->status}}</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">{{$order->status}}</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">{{$order->status}}</span>
                @else
                  <span class="badge badge-danger">{{$order->status}}</span>
                @endif
            </td>
            <td>
                <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMACION ORDEN</h4>
              <table class="table">
                    <tr class="">
                        <td>ORDEN NO.</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>FECHA ORDEN </td>
                        <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                    </tr>
                    <tr>
                        <td>CANTIDAD</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>ESTADO ORDEN</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    <tr>
                        <td>CARGO DE ENVIO</td>
                        <td> : $ {{$order->shipping->price}}</td>
                    </tr>
                    <tr>
                      <td>CUPON</td>
                      <td> : $ {{number_format($order->coupon,2)}}</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td> : $ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                        <td>METODO DE PAGO</td>
                        <td> : @if($order->payment_method=='cod') Efectivo / deposito @else Tarjeta TD / TC @endif</td>
                    </tr>
                    <tr>
                        <td>ESTAOO DE PAGO</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr>
              </table>
                <h4 class="text-center pb-4">INFORMACION PRODUCTO</h4>
                @foreach($data["items"] as $product)

                    <p>PRODUCTO: {{ $product["name"] }}</p>
                  <p>PRECIO: $. {{ $product["price"] }}</p>
                  <p>CANTIDAD: {{ $product["qty"] }}</p>
                    <hr>
                @endforeach

            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">INFORMACION DE ENVIO</h4>
              <table class="table">
                    <tr class="">
                        <td>NOMBRE</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>TELEFONO.</td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>DIRECCION</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                    <tr>
                        <td>PAIS</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>CODIGO POSTAL</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
              </table>
            </div>
          </div>


        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
