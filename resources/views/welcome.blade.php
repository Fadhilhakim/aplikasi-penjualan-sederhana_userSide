<x-layout>
    <x-navbar></x-navbar>
    <x-header :discount-products="$discount_products" :dashboard="$dashboard"></x-header>
    <x-recomendation :products="$recomends" />
    <x-products :products="$products"></x-products>
</x-layout> 