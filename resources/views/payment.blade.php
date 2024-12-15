<x-layout>
    <x-navbar></x-navbar>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16 h-full">
        <br><br>
        @if (session()->has('success'))
        <x-success>{{ session('success') }}</x-success>
        @endif
        @if (session()->has('error'))
        <x-error>{{ session('error') }}</x-error>
        @endif

        @if (@$order_views)
        @foreach ($order_views as $order_request)
        @php
            $ongkir = 10000;
            $total_bayar = 0;
            $discount_val = 0;
            $pajak = 1.1; 
            $total_pajak = 0;
        @endphp
            <section class="p-2 max-w-5xl mx-auto">
                
                

                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    
                    @if (@$order_request['status'] == 'BELUM BAYAR')
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pembayaran</h2>
                        @elseif (@$order_request['status'] == 'LUNAS')
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">History</h2>
                        @else 
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Sedang Dalam Perjalanan</h2>

                    @endif
            
                    <div class="mt-6 sm:mt-8 lg:flex lg:items-start gap-12">
                        @php
                            if ($order_request['status'] == 'BELUM BAYAR') {
                                $display = 'block';
                            } else {
                                $display = 'hidden';
                            }
                        @endphp
                        <form action="{{ route('order_request.update') }}" method="POST" class="w-full {{ $display }} h-80 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                            @csrf
                            @method('PUT')
                
                                <div class="mb-6 grid grid-cols-2 gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                
                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Metode Pembayaran</label>
                                <select name="payment" id="countries" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500">
                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                    <option value="Bank BCA">Bank BCA</option>
                                    <option value="Bank BRI">Bank BRI</option>
                                    <option value="Bank Syariah Indonesia">Bank Syariah Indonesia</option>
                                    <option value="Bank Permata">Bank Permata</option>
                                    <option value="Bank Pembangunan Daerah">Bank Pembangunan Daerah</option>
                                    <option value="Dompet Digital">Dompet Digital (DANA/OVO/GOPAY)</option>
                                </select>
                
                            </div>

                                <div>
                                    <label for="rek-input" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Nomor Rekening
                                    <button data-tooltip-target="rek-desc" data-tooltip-trigger="hover" class="text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white">
                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div id="rek-desc" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        Masukkan Nomor rekening yang Valid
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    </label>
                                    <input type="text" id="rek-input" aria-describedby="helper-text-explanation" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-gray-500 dark:focus:ring-gray-500"
                                        inputmode="numeric"
                                        pattern="^\d{13,19}$|^(\d{4}[\s\-]?)?(\d{4}[\s\-]?)?(\d{4}[\s\-]?)?(\d{4}|\d{3})$"
                                        autocomplete="cc-number"
                                        maxlength="19"
                                        placeholder="1234-5678-9012-34" required />
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="rek-input" class="mb-4 text-sm font-medium text-gray-900 dark:text-white">
                                    Alamat Pengiriman </label>
                                <input type="text" id="address" name="address"  class="block w-full mt-2 items-center justify-center rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-gray-500 dark:focus:ring-gray-500" placeholder="Jalan Mana? Kota Mana? " required />
                            </div>
                
                            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-gray-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4  focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Pay now</button>
                        </form>
            
                        <div class="mt-6 grow sm:mt-8 lg:mt-0">
                            <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                                <h2 class="text-center text-2xl font-extrabold text-white mb-3 ">INVOICE</h2>
                            <div class="space-y-2">

                                @if ($order_request['status'] == 'MENUNGGU KONFIRMASI')
                                    <form action="{{ '/order/diterima/'.$order_request['user'] .'/'. $order_request['created_at'] }}" method="POST"
                                    onsubmit="return confirm('Pastikan anda telah menerima pesanan!');">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 p-2 px-7 text-center text-xl font-extrabold text-gray-200 hover:bg-yellow-800">BARANG DITERIMA</button>
                                    </form>
                                @endif

                                <div class="text-white">
                                    <div class="flex justify-between items-center align-middle border-b py-4">
                                        <div>
                                            <p>Name :</p>
                                            <h2 class="font-extrabold">{{ $order_request['user'] }}</h2>
                                        </div>
                                        <div class="text-right">
                                            <p>Order Date</p>
                                            <h2>{{ $order_request['created_at'] }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative overflow-x-auto">
                                    <table
                                    class="md:w-md m-auto w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                                    <thead
                                        class="bg-gray-800 text-xs uppercase text-white">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-end">
                                            Harga
                                        </th>
                                        </tr>
                                    </thead>
                        
                        
                                    @php
                                        $counter = 1;
                                        $discount_val = 0;
                                        $harga = 0;
                                    @endphp
                        
                                    <tbody>
                                        @foreach ($order_request['products_order'] as $products)
                                        <tr class="border-g bg-gray-700 text-gray-50 dark:border-gray-700">
                                        <th class="px-6 py-4 text-center">
                                            {{ $counter }}
                                            @php
                                                $counter++;  
                                            @endphp
                                        </th>
                                        <td class="px-6 py-4">
                                            <p class="text-bold text-white">{{ Str::limit($products['name'], 20, '...') }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $products['quantity'] }}
                                        </td>
                                        <td class="px-6 xl:w-1/5 py-4 text-end">
                                            




                                            @if ($products['discount'] == 'Y')
                                                @php
                                                
                                                    $discount_val = $products['price'] * ($products['discount_value'] / 100);   
                                                    $harga_setelah_diskon = $products['price'] - $discount_val;
                                        
                                                    $bayar = $harga_setelah_diskon;

                                                @endphp
                                                <span class="font-bold">Rp. {{ number_format($harga_setelah_diskon, 2) }},-</span>
                                                
                                                @else
                                                @php
                                                    $bayar = $products['price'];
                                                    
                                                @endphp
                                                    
                                                    <span class="font-bold">Rp. {{ number_format($products['price'], 2) }},</span>
                                            @endif
                                        </td>
                                        </tr>
                                        @php
                                            $total_bayar =  $total_bayar + $bayar;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    </table>

                                <dl class="flex items-center mb-2 mt-3 justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Harga Asli :</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total_bayar, 2) }},-</dd>
                                </dl>

                                <dl class="flex items-center mb-2 justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Ongkos Kirim :</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($ongkir, 2) }},-</dd>
                                </dl>
                                <dl class="flex items-center mb-2 justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak (11%) :</dt>
                                    @php
                                        $total_pajak = ($total_bayar*$pajak) - $total_bayar ;
                                    @endphp
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total_pajak, 2) }},-</dd>
                                </dl>
                            </div>
                
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-2xl font-extrabold  text-gray-900 dark:text-white">Total Bayar <span class="text-base font-extralight">@if ($products['discount'] == 'Y')(dengan diskon)@endif</span></dt>
                                <dd class="text-2xl font-extrabold  text-gray-900 dark:text-white">Rp. {{ number_format(($total_bayar * $pajak) + $ongkir, 2) }},-</dd>
                            </dl>
                           

                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </section>
        @endforeach
        @endif

    <x-footer></x-footer>
</x-layout>