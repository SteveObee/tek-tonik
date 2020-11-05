<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
</head>

<body>
  <div style="margin: 2rem;">
    <div style="width: 550px; margin: auto; ">
      <div style="padding: 2rem; background: #ccffdc; text-align: center">
        <h2 style="margin-bottom: 2rem;">Order Confirmation</h2>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">Dear {{ $order->user->name }}, thank you for your recent order, #{{$order->id}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">Placed at {{$order->created_at->format('h:i')}} on {{$order->created_at->format('d/m/Y')}}</p>
        <p style="margin-bottom: 1rem;">We will inform you once the item(s) have been shipped </p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">Please find the order details below</p>
      </div>

      <div style="margin: 3rem 0;">
        @foreach ($order->orderItems as $item)
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$item->quantity}} x {{ $item->name }} @ £{{$item->price_then}}</p>
        @endforeach

        <p style="margin: 2rem 0;">Total (inc VAT @ 20%): £{{$order->price_total}}</p>
      </div>

      <div style="margin: 2rem 0;">
        <h4 style="margin: 2rem 0;">Delivering to:</h4>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$order->user->name}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$order->shippingAddress->address_line_1}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$order->shippingAddress->address_line_2}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$order->shippingAddress->city}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;"> {{$order->shippingAddress->county}}</p>
        <p style="margin: 0; padding: 0; line-height: 1.5rem;">{{$order->shippingAddress->postcode}}</p>
      </div>
    </div>
  </div>
</body>

</html>