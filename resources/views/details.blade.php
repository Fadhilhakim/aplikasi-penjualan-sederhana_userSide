<x-layout>
  <x-navbar></x-navbar>
  <section class="md:pt-16 antialiased mb-10">
        <div class="rounded-lg" style="
            background-image: url(https://i.pinimg.com/736x/fe/bc/bb/febcbb34fcead6b3ac7894baea63b1a9.jpg);
            position: absolute;
            width: 100%;
            height:70vh;
            opacity: 0.4;
            z-index: -100;
            object-fit: fill;
            background-size: cover;
            background-blend-mode: overlay;
            background-repeat: no-repeat;
        "></div>



<br><br><br><br>
@if (session()->has('success'))
    <x-success>{{ session('success') }}</x-success>
@endif

        <div class="p-6 max-w-4xl mx-auto 2xl:px-0">
          <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto bg-white">
              <div alt="img"
                style="
                    width: 300px;
                    height: 300px;
                    background-image: url({{ $details->image_path }});
                    object-fit: fill;
                    background-size: cover;
                    background-position:center;
                    background-blend-mode: overlay;
                    background-repeat: no-repeat;
                "></div>
              
            </div>
    
            <div class="mt-6 sm:mt-8 lg:mt-0">
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
              >
                {{ $details->name }}
              </h1>
              <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                @php
                    $discounted_price = $details->price - ($details->price * ($details->discount_value / 100));
                @endphp

                @if ($details->discount == 'Y') 
                  <div class="block">
                    <p class="text-xl text-gray-700 sm:text-3xl dark:text-gray-500">
                      Rp.{{ number_format($details->price, 2) }},-
                    </p>
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                      Rp.{{ number_format($discounted_price, 2) }},- <span class="text-gray-500 font-extralight">({{ $details->discount_value }}% Off)</span>
                    </p>
                  </div>
                  @else
                  <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                    Rp.{{ number_format($details->price, 2) }},-
                  </p>
                @endif

              </div>
              <p class="text-gray-500 dark:text-gray-400">
                Stock: {{ $details->stock }} | Terjual: {{ $details->sold_out }}
              </p>
              <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                <form action="{{ route('cart.store', $details->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                      <svg
                          class="w-5 h-5 -ms-2 me-2"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          fill="none"
                          viewBox="0 0 24 24" >
                      <path
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                          />
                      </svg>
                      Masukkan Ke keranjang
                    </button>
                </form>
              </div>
    
              <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
    
              <p class="text-gray-500 dark:text-gray-400">
                {{ $details->description }}
              </p>
            </div>
          </div>
        </div>
      </section>

      <x-products :products="$products" ></x-products>

      <x-footer></x-footer>
</x-layout>