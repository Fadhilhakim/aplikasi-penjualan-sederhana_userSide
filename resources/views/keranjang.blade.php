<x-layout>
    <x-navbar></x-navbar>

    <section>

        <br><br><br><br>       

        @if (count($keranjang) > 0)
            <div class="mx-auto max-w-screen-xl px-4">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang Belanja</h2>
              
              
              <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8 ">
                <div class="mx-auto w-full xl:flex-initial ">
                  <div class="space-y-6">
                    
                    @php
                      $num = 1;
                      $total_harga = 0;
                      $discount_val = 0;
                    @endphp
                    
                    @foreach ($keranjang as $item)

                    @php
                      $discounted_price = $item->product->price - ($item->product->price * ($item->product->discount_value / 100));
                    @endphp

                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                      <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="/details/{{ $item->product->name }}" class="shrink-0 md:order-1">
                          <div class="h-20 w-20" style="
                            background-image: url({{ $item->product->image_path }});
                            background-position: center;
                            background-size:cover;
                            object-fit: cover;
                          "></div>
                        </a>
          
                        <label for="counter-input" class="sr-only">Pilih Jumlah :</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                          <div class="flex items-center">
                            <form action="/keranjang/{{ $item->shopping_cart_id }}" method="POST"> 
                              @csrf
                              <button type="submit" id="decrement-button{{ $num }}" data-input-counter-decrement="counter-input{{ $num }}" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                </svg>
                              </button>
                            </form>
                            <input type="text" id="counter-input{{ $num }}" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{ $item->total_quantity }}" required />
                            <form action="{{ route('cart.store', $item->product->id) }}" method="POST">
                              @csrf
                              <button type="submit" id="increment-button{{ $num }}" data-input-counter-increment="counter-input{{ $num }}" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                              </button>
                            </form>
                            @php
                              $num++;

                              if ($item->product->discount == 'Y') {
                                  $harga = $discounted_price * $item->total_quantity; // Harga dengan diskon
                              } else {
                                  $harga = $item->product->price * $item->total_quantity; // Harga tanpa diskon
                              }
                          
                              $total_harga = $total_harga + $harga; // Menambahkan harga asli dan harga total

                            @endphp
                          </div>
                          <div class="text-end md:p-5 md:order-4 md:w-32">
                            <p class="text-base font-bold text-gray-900 dark:text-white w-96">Rp {{ number_format($harga, 0, ',', '.') }}</p>
                          </div>
                        </div>
          
                        <div class="w-full flex-3 md:order-2 md:max-w-md">
                          @if ($item->product->discount == 'Y')
                            <p class="text-sm mb-0  text-gray-500"><span class="text-sm mb-2 font-medium text-gray-500">Harga Asli : {{ number_format($item->product->price * $item->total_quantity, 2) }}</span> Discount : {{ floatval($item->product->discount_value) }}% Off</p>
                            
                          @endif
                          <a href="#" class="text-base mb-4 font-medium text-gray-900 hover:underline dark:text-white">
                            {{ Str::limit($item->product->name, 60, '...') }}
                          </a>

                          
                          <div class="mt-5">
                            <form action="/keranjang/{{ $item->shopping_cart_id }}" method="post">
                              @csrf
                              <button type="submit" class="inline-flex z-50 items-center text-sm font-medium p-2 rounded-lg bg-gray-800 text-red-600 hover:bg-gray-900 dark:text-red-500">
                                <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                                Hapus
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                
                <div class="mx-auto mt-6 flex-none lg:mt-0 lg:w-full">
                  <div class="space-y-4 px-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white px-6 border-b border-gray-200 pb-3 text-center dark:border-gray-700">Rincian</p>
          
                    <div class="space-y-4">
                      <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Harga</dt>
                          <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($total_harga, 2) }},-</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Ongkos Kirim</dt>
                          <dd class="text-base font-medium text-gray-900 dark:text-white">Rp 10.000,-</dd>
                        </dl>
          
                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak <span class="text-extralight text-gray-500">(11%)</span></dt>
                          @php
                            $ongkir = 10000;
                            $pajak = $total_harga * 1.1;
                            $pajak_total = $pajak - $total_harga;
                            $total = $total_harga  + $ongkir + $pajak_total;
                          @endphp
                          <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($pajak_total, 2) }},-</dd>
                        </dl>
                      </div>
          
                      <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($total, 2) }},</dd>
                      </dl>
                    </div>
          
                    <form action="/payment/checkout" method="POST">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                      <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-gray-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Checkout
                      </button>
                    </form>
          
                    <div class="flex items-center justify-center gap-2">
                      <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                      <a href="/" title="" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 underline hover:no-underline dark:text-gray-500">
                        Lanjut berbelanja
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              
              
            </div>
            @else
              <h2 class="text-3xl text-center font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang Belanja Anda Kosong );</h2>
              <h2 class="text-xl text-center font-semibold text-gray-900 dark:text-gray-300 sm:text-2xl">Silahkan Cek Produk Dibawah</h2>
            @endif  
            <br><br><br><br><br>
          </section>
    
    <x-products :products="$products"></x-products>
    <x-footer></x-footer>
</x-layout>