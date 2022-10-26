@extends('layouts.master')
@section('content')
    <div>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Cart</h4>
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <div class="mt-3 product-cart">

                            </div>
                            <div class="card p-2 mb-2 d-flex flex-row">
                                Total : <b style="margin: 0px 4px 0px 4px">Rp </b> <b class="total"></b>
                            </div>
                            <input type="submit" value="Confirm" class="btn btn-info rounded confirm">
                        </form>

                    </div>
                </div>
            </div>

        </div>
    @endsection
    {{-- @push('js') --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {

            function formatPrice(value) {
                if (value) {
                    let val = value.toString()
                    var number_string = val.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi value ribuan
                    if (ribuan) {
                        let separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return rupiah;
                } else {
                    return false;
                }
            }

            let getProduct = JSON.parse(localStorage.getItem("products"))

            let html = ''
            let total = 0
            // console.log(getProduct);
            for (let i = 0; i < getProduct.length; ++i) {
                html += `<div class="d-flex flex-row mb-4">
                <div class="dummy-image-cart"></div>
                <input type="hidden" name="id[]" value=${getProduct[i].id}>
                <input type="hidden" name="price[]" value=${getProduct[i].price}>

                <div>
                    <h5>${getProduct[i].name}</h5>
                    <div class="mb-2 d-flex align-items-center">
                        <input type="number" name="qty[]" value=${getProduct[i].qty} style="width:50px">
                        <div style='margin-left:10px'>PCS</div>
                    </div>
                    <div class="d-flex">
                        <div class="mr-1">Sub total :</div>
                        <div> Rp ${getProduct[i].priceD}</div>
                    </div>
                </div>
            </div>`;

                total += getProduct[i].price

            }
            $('.product-cart').append(html)
            $('.total').html(formatPrice(total))

            $('.confirm').click(function() {
                localStorage.removeItem("products");
            })
        });
    </script>
    {{-- @endpush --}}
