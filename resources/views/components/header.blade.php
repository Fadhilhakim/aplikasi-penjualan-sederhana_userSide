<section class="py-8 antialiased md:py-16 dark" >
    @foreach ($dashboard as $display)
    <div style="
        background-image: url({{ $display->bg_url }});
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0.4;
        z-index: -100;
        object-fit: fill;
        background-size: cover;
        background-blend-mode: overlay;
        background-repeat: no-repeat;
    "></div>
    <br><br><br><br>
    <div class="mx-auto block md:grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0">
        <div class="content-center justify-self-start md:col-span-3 md:text-start md:flex">
            <div>
                <h1 class="mb-4 text-4xl text-gray-200 font-extrabold leading-none tracking-tight dark:text-white md:max-w-2xl md:text-5xl xl:text-6xl">{!! $display->title !!}</h1>
            <p class="max-w-2xl text-gray-200 dark:text-gray-400 md:mb-12 md:text-lg mb-3 lg:mb-5 lg:text-xl">{{ $display->description }}</p>
            </div>
            <br>
            <form class="w-1/2 mx-auto top-0 -z-50">  
                <br><br> 
                <label for="default-search" class="mb-2 w-full text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Cari Produk" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Search</button>
                </div>
            </form>
            
      </div>
    @endforeach
      
    <div class="flex dark">
        <div class="mb-0 max-w-screen-md gap-1 hidden lg:grid xl:grid-cols-4 grid-cols-4">
        
        @foreach (@$discount_products as $discount_product)
            <!-- TOP -->
            <div class="h-35 w-full rounded-lg border border-gray-700 bg-gray-800 p-3 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <a href="/details/{{ $discount_product->name }}">
                    <div class="bg-white flex">
                        <div class="items-center" style="
                        background-image: url({{ $discount_product->image_path }});
                        object-fit: fill;
                        width: 200px;
                        height: 200px;
                        background-size: contain;
                        background-position: center;
                        background-blend-mode: overlay;
                        background-repeat: no-repeat;
                        ">
                    </div>
                    </div>
                </a>
            <div class="pt-2">
                <div class="mb-2 flex items-center justify-between gap-4">
                   
                    <span class="me-2 rounded bg-gray-900 px-2.5 py-0.5 text-xs font-medium text-white dark:bg-gray-50 dark:text-gray-300"> Up to {{ floatval($discount_product->discount_value) }}% off </span>

                </div>
    
                <a href="/details/{{ $discount_product->name ?? 'No Name' }}" class="lg:text-lg text-sm font-semibold leading-tight text-gray-200 hover:underline dark:text-white">{{ Str::limit($discount_product->name, 17, '..' )}}</a>
                
                </div>
    
                <ul class="mt-0 flex items-center gap-4">
                </ul>
    
                <div class="mt-2 block">

                    @php
                        $discounted_price = $discount_product->price - ($discount_product->price * ($discount_product->discount_value / 100));
                    @endphp


                <p class="text-sm line mb-1 leading-tight text-gray-400 dark:text-gray-400">Rp. {{ number_format($discount_product->price, 2) }},-</p>
                <p class="text-md mb-2 font-extrabold leading-tight text-gray-200 dark:text-white">Rp. {{ number_format($discounted_price, 2) }},-</p>
    
                <a href="/details/{{ $discount_product->name }}">
                    <button type="button" class="inline-flex w-full items-center rounded-lg bg-gray-700 min-w-xl px-5 py-2.5 text-xs font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4  focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
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


        <div class="hidden xl:block mx-auto my-12 text-center text-white dark:text-gray-50">
            <svg class="w-52 h-52 text-gray-800 dark:text-white mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z" clip-rule="evenodd"/>
              </svg>                  
            <h1 class="text-5xl m-5 font-extrabold text-gray-50">Toko Online</h1>
            <p>By: 
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6 relative inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                      </svg>                      
                    <span class="my-5">Fadhil Hakim</span>
                </a>
            </p>
        </div>
    </div>

    </div>
</section>