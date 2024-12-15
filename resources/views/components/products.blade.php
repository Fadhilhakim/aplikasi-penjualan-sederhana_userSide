<!-- produk section -->

<section class="h-full max-w-4xl mx-auto px-6" id="produk"> 
    <br><br>
    <div class="my-4 grid gap-2 grid-cols-2 md:grid-cols-4">
            
    @foreach ($products as $product)

        <!-- TOP -->
        <div class="h-full flex flex-col rounded-lg border border-gray-700 bg-gray-800 shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
            <a href="/details/{{ $product->name }}">
                <div class="bg-white flex">
                    <div class="items-center" style="
                    background-image: url({{ $product->image_path }});
                    object-fit: fill;
                    width: 100%;
                    height: 200px;
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
            <div class="h-40">
                <div class="p-2 flex-grow">
                    <a href="/details/{{ $product->name }}" class="mb-2 lg:text-lg text-sm font-semibold leading-tight text-gray-200 hover:underline dark:text-white">{{ Str::limit($product->name, 20, '...' )}}</a>
                    <div class="flex items-center">
                        <span class="mt-3 rounded-sm px-3 mr-2 bg-gray-100 text-sm font-medium text-white dark:text-gray-800">Terjual : {{ $product->sales_sum_quantit ?? 0}}</span>
                        <span class="mt-3 text-sm font-medium text-white dark:text-gray-300">Stock : {{ $product->stock }}</span>
                    </div>
                </div>
                <div class="p-2">
                    <p class="text-xl font-extrabold leading-tight text-gray-200 dark:text-white">
                        @if ($product->discount == 'Y')
                            Rp.{{ number_format($product->discounted_price, 2) }},-
                            @else
                            Rp.{{ number_format($product->price, 2) }},-
                        @endif
                    </p>
                </div>
                <div class="mt-auto p-2 bottom-0 grid">
                    <a href="/details/{{ $product->name }}">
                        <button type="button" class="flex w-full items-center justify-center rounded-lg bg-gray-700 px-5 py-2.5 text-xs font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                            Beli
                        </button>
                    </a>
                </div>
            </div>
        </div>
        
        

        @endforeach
    </div>
    
    <br><br><br><br><br>
</section>