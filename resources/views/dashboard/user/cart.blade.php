
@extends('layouts.base')
@section('content')
<div class="w-50 mx-auto col-12">
				<!-- Shopping Summery -->
					<table class="table">
						<thead>
							<tr class="">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="">UNIT PRICE</th>
								<th class="">QUANTITY</th>
								<th class="">TOTAL</th>
								<th class=""><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="{{route('cart.update')}}" method="POST">
								@csrf
								@if(Helper::getAllProductFromCart())
									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
										<tr>

											<td class="" data-title="No"> <img src="/retina.webp" width="50" height="50" class=""></td>
											<td class="" data-title="Description">
												<p class=""><a href="#" target="_blank">{{$cart->ticket['title']}}</a></p>
												<!-- <p class="">{!!($cart['summary']) !!}</p> -->
											</td>
											<td class="" data-title="Price"><span>${{number_format($cart['price'],2)}}</span></td>
											<td class="" data-title="Qty"><!-- Input Order -->
												<div class="input-group">

													<input type="number" name="qty[{{$key}}]" class="input-number"  data-min="1" data-max="100" value="{{$cart->quantity}}">
													<input type="hidden" name="qty_id[]" value="{{$cart->id}}">

												</div>
												<!--/ End Input Order -->
											</td>
											<td class="" data-title="Total"><span class="money">${{$cart['amount']}}</span></td>

											<td class="" data-title="Remove"><a href="{{route('cart-delete',$cart->id)}}"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="float-right">
											<button class="btn float-right" type="submit">Update</button>
										</td>
									</track>
								@else
										<tr>
											<td class="text-center">
												There are no any cart items available. <a href="{{route('home')}}" style="color:blue;">Continue shopping</a>

											</td>
										</tr>
								@endif

							</form>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->



            <div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">


							<div class=" col-12">
								<div class="right">
									<!-- <ul> -->
										<p class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Subtotal<span class="px-">${{number_format(Helper::totalCartPrice(),2)}}</span></p>
									<!-- </ul> -->
									<div class="button5">
										<a href="{{route('checkout')}}" class="btn">Checkout</a>
										<a href="{{route('home')}}" class="btn">Continue </a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
            </div>
            @endsection


@push('styles')
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endpush
