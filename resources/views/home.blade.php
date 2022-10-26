@extends('layouts.master')
@section('content')
    <div>
        <div class="row">
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
            @endif
            @if (Auth::user()->role == 'user')
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Product</h4>
                            @foreach ($product as $item)
                                @php
                                    $price = $item->price - ($item->price * $item->discount) / 100;
                                @endphp
                                <div class="card mb-3">
                                    <div class="card-body d-flex flex-row justify-content-between align-items-center">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#productDetail-{{ $item->id }}" class="d-flex flex-row"
                                            style="text-decoration: none;color:black">
                                            <div class="dummy-image"></div>
                                            <div class="f-flex flex-col">
                                                <div>{{ $item->product_name }}</div>
                                                @if ($item->discount > 0)
                                                    <div><i><s>Rp {{ number_format($item->price, 0, '', '.') }}</s></i>
                                                    </div>
                                                @endif
                                                <div>Rp {{ number_format($price, 0, '', '.') }}</div>

                                            </div>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="productDetail-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="productDetailLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="productDetailLabel">Product Detail</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex flex-row"
                                                            style="text-decoration: none;color:black">
                                                            <div class="dummy-image-detail"></div>
                                                            <div class="f-flex flex-col">
                                                                <h5>{{ $item->product_name }}</h5>
                                                                @if ($item->discount > 0)
                                                                    <div><i><s>Rp
                                                                                {{ number_format($item->price, 0, '', '.') }}</s></i>
                                                                    </div>
                                                                @endif
                                                                <div>Rp {{ number_format($price, 0, '', '.') }}</div>
                                                                <div>Dimension : {{ $item->dimensions }}</div>
                                                                <div>Price Unit : {{ $item->unit }}</div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="button" data-id="{{ $item->id }}"
                                                data-name="{{ $item->product_name }}"
                                                data-code="{{ $item->product_code }}" data-price="{{ $price }}"
                                                data-price-d={{ number_format($price, 0, '', '.') }}
                                                class="btn btn-info rounded text-white addCard">Buy</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <h4>Report Penjualan</h4>
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr>
                                        <td>{{ $item->document_code }} - {{ $item->document_number }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>Rp {{ number_format($item->total, 0, '', '.') }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                                        <td>
                                            @foreach ($item->transactionDetail as $val)
                                                <p>{{ $val->product->product_name }}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$product->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            @endif
        </div>
    @endsection
    {{-- @push('js') --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            let product = [];
            $('.addCard').click(function() {
                let data = {
                    id: $(this).data("id"),
                    name: $(this).data("name"),
                    qty: 1,
                    price: $(this).data("price"),
                    priceD: $(this).data("price-d"),
                    code: $(this).data("code")
                }

                product.push(data)

                localStorage.setItem("products", JSON.stringify(product));
                alert('add to cart ')
                let getProduct = JSON.parse(localStorage.getItem("products"))
                $('.cart').html(getProduct.length)
            });
        });
    </script>
    {{-- @endpush --}}
