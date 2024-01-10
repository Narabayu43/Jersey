@php

    function rupiah($price)
    {
        $hasil_rupiah = "Rp " . number_format($price,2,',','.');
	      return $hasil_rupiah;
    }
    
    function checkImagePath($image)
    {
      if (substr($image, 0, 5) === 'https') {
        return url($image);
      }else {
        return url('assets/jersey/'.$image);
      }
    }

    function formatDescription($text)
    {
      return nl2br(e($text));
    }

@endphp
<section>
  <div class="w-full min-h-screen flex justify-center items-center flex-col">
    <div class="grid grid-col-1 lg:grid-cols-2 w-3/4 card bg-neutral-400/10 shadow-2xl mx-auto">
      <div>
        <img src="{{ checkImagePath($product->image) }}" alt="{{$product->name}}">
      </div>
      <div class="flex flex-col gap-6 p-6">
        <div class="flex flex-col gap-6">
          <h1 class="text-4xl text-white"><strong>{{$product->name}}</strong></h1>
          @if ($product->is_ready == 1)
          <div class="badge badge-accent text-md gap-1">
            <ion-icon name="checkmark-done-circle-outline"></ion-icon>
            Ready Stok
          </div>  
          @else
          <div class="badge badge-error text-md gap-2">
            Stock Habis
            <ion-icon name="close-circle-outline"></ion-icon>
          </div>    
          @endif
          <p class="text-lg text-white">{{rupiah($product->price)}}</p>
          <div class="divider"></div>
          <p class="text-white">{!! formatDescription($product->description) !!}</p>
        </div>
        <div class="divider"></div>

        @if (flash()->message)
          @if (flash()->class === 'success')
            <div role="alert" class="alert alert-success my-3 mx-auto lg:w-2/3">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ flash()->message}}</span>
            </div>              
          @endif
          @if (flash()->class === 'error')
            <div role="alert" class="alert alert-error my-3 mx-auto lg:w-2/3">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ flash()->message}}</span>
            </div> 
          @endif
          @if (flash()->class === 'info')
            <div role="alert" class="alert alert-info my-3 mx-auto lg:w-2/3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <span>{{ flash()->message}}</span>
            </div> 
          @endif
        @endif

        <div class="flex flex-col lg:w-2/3 mx-auto gap-4 justify-end lg:h-full">
          <button class="btn btn-primary rounded-2xl" @if (!$product->is_ready == 1) disabled @endif wire:click="addToWishlist()">Tambah ke Wishlist</button>
          <button class="btn btn-accent rounded-2xl" @if (!$product->is_ready == 1) disabled @endif wire:click="addToCart()">Tambah ke Keranjang</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  window.addEventListener('refresh-page', event => {
     window.location.reload(false); 
  })
</script>