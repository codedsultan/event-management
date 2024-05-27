<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/invoice.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">

    <title>Invoice</title>
</head>
<body>
    <!-- <table class="w-third margin-auto">
        <tr>
            <td class="w-half">
                <img src="{{ asset('logo.png') }}" alt="laravel daily"  />
            </td>
            <td class="w-half">
                <h2>Invoice ID: 834847473</h2>
            </td>
        </tr>
    </table> -->

    <!-- <div class="margin-top ">
        <table class="w-third margin-auto">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>John Doe</div>
                    <div>123 Acme Str.</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>Smoke Box</div>
                    <div>USA</div>
                </td>
            </tr>
        </table>
    </div> -->

    <!-- <div class="margin-top w-third margin-auto">
        <table class="products ">
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Price</th>
            </tr>

            @foreach($invoice->items as $item)
            <tr class="items">

                    <td>
                        {{ $item->quantity}}
                    </td>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->price }}
                    </td>

            </tr>
            @endforeach
        </table>
    </div> -->

    <!-- <div class="total w-third margin-auto">
        Total: $129.00 USD
    </div> -->

    <!-- <div class="footer margin-top"> -->
        <!-- <div>Thank you</div> -->
    <!-- </div> -->
    <div class="w-50 mt-20 mx-auto">
    <table class="">
        <tr>
            <td class="w-half">
                <img src="{{ asset('logo.png') }}" alt="laravel daily"  />
            </td>
            <td class="w-half">
                <h4>Invoice #: {{$invoice->number}}</h4>
            </td>
        </tr>
    </table>
    <div class="margin-top ">
        <table class="">
            <tr>
                <td class="w-half">
                    <div><h5>To:</h5></div>
                    <div>{{$invoice->vendor->name}}</div>
                    <!-- <div>123 Acme Str.</div> -->
                </td>
                <td class="w-half">
                    <div><h5>From:</h5></div>
                    <div>Smoke Box</div>
                    <div>USA</div>
                </td>
            </tr>
        </table>
    </div>
    <table class="table table-striped mt-10">
    <thead>
    <tr>

      <th scope="col">Qty</th>
      <!-- <th scope="col">Qty</th> -->
      <th scope="col">Description</th>
      <th scope="col">Price ($)</th>
      <th scope="col">Total ($)</th>
    </tr>
  </thead>
  <tbody>
  @foreach($invoice->items as $item)
    <tr >
      <th scope="row">{{$item->quantity}}</th>
      <!-- <td>Mark</td> -->
    <td class="w-third">
        {{ $item->description}}
    </td>
    <td>
        {{ $item->price }}
    </td>
    <td>
        {{ $item->price }}
    </td>
    </tr>
 @endforeach
    <tr>
        <td></td>
        <td></td>
        <td>Total</td>
        <td>${{number_format(Helper::totalInvoicePrice($invoice->id),2)}}</td>
    </tr>
  </tbody>
</table>
<div class="text-end">
    <a class="btn btn-primary" href="{{ route('vendor.pay.invoice',$invoice->id) }}" onclick="event.preventDefault();document.getElementById('payment-form').submit();">Pay Invoice</a>
    <form action="{{ route('vendor.pay.invoice',$invoice->id) }}" id="payment-form" method="post">@csrf</form>
    <!-- <button class="btn btn-primary">
        Pay Invoice
    </button> -->
       <!-- Total: ${{number_format(Helper::totalInvoicePrice($invoice->id),2)}} -->


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

