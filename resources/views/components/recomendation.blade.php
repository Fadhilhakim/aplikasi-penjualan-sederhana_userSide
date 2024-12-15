<section class="pt-8 antialiased md:py-12" id="terlaris">
    <br><br><br><br>
    <div class="mx-auto max-w-screen-xl 2xl:px-0 bg-gray-800 rounded-lg p-5">
        <!-- Heading & Filters -->
        <h1 class="text-4xl font-semibold dark:text-gray-100 text-center py-6">Paling Banyak Dicari</h1>

        <div class="mt-4 m-2 grid gap-2 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-12">
            
            @foreach ($products as $product)
            
            <!-- TOP -->
            <div class="rounded-lg border border-gray-700 bg-gray-800 shadow-sm dark:border-gray-700 dark:bg-gray-800  overflow-hidden">
                <a href="/details/{{ $product->name }}">
                    <div class="bg-white flex">
                        <div class="items-center" style="
                        background-image: url({{ $product->image_path }});
                        object-fit: fill;
                        width: 100%;
                        height: 280px;
                        background-size: contain;
                        background-position: center;
                        background-blend-mode: overlay;
                        background-repeat: no-repeat;
                        ">
                        @if ($product->discount == 'Y')
                        <div class="mb-2 m-2 flex items-center justify-between gap-4">
                    
                            <span class="me-2 rounded bg-gray-900 px-2.5 py-0.5 text-xs font-medium text-white dark:bg-gray-50 dark:text-gray-300"> Up to {{ floatval($product->discount_value) }}% off </span>
        
                        </div>
                    @endif
                    </div>
                    </div>
                </a>

                <div class="p-2">     
                    <a href="/details/{{ $product->name }}" class="mb-2 lg:text-lg text-sm font-semibold leading-tight text-gray-200 hover:underline dark:text-white">{{ $product->name }}</a>
                    
                    <div class="flex items-center">
                    
                        <span class="mt-3 rounded-sm px-3 mr-2 bg-gray-100 text-sm font-medium text-white dark:text-gray-800">Terjual : {{ $product->sales_sum_quantity ?? 0 }}</span>
                        <span class="mt-3 text-sm font-medium text-white dark:text-gray-300">Stock : {{ $product->stock }}</span>
                        
                    </div>
                </div>
    

                @php
                    $discounted_price = $product->price - ($product->price * ($product->discount_value / 100));
                @endphp

                <div class="block md:flex items-center justify-between gap-4 p-2">
                    @if ($product->discount == "Y") 
                        <p class="text-xl font-extrabold leading-tight text-gray-200 dark:text-white">
                            <span class="font-extralight">
                                Rp.{{ number_format($product->price, 2) }},-

                            </span>
                            Rp.{{ number_format($discounted_price, 2) }},-
                        </p>
                        @else
                        <p class="text-xl font-extrabold leading-tight text-gray-200 dark:text-white">
                                Rp.{{ number_format($product->price, 2) }},-
                        </p>
                        
                    @endif
        
                    <a href="/details/{{ $product->name }}">
                        <button type="button" class="flex md:inline-flex md: mt-0 mx-auto w-full items-center rounded-lg bg-gray-700 min-w-xl px-5 py-2.5 text-xs font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4  focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                            Beli
                        </button>
                    </a>
                </div>
            </div>
            <!-- BOTTOM -->

            @endforeach

        </div>
    </div>  
  </section>