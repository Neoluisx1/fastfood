<div>
    <div class="intro-y col-span-12">
        <div class="intro-y box">
            <h2 class="text-lg-font-medium text-center text-theme-1 py-4">
                PRODUCTOS
            </h2>
            <div class="intro-y col-span-12 flex flex-wrap col-span-12 sm:flex-nowrap items-center mt-2 p-4">\
                <button class="btn btn-primary shadow-md ml-2" onclick="openPanel()">Agregar</button>
                <div class="hidden md:block mx-auto text-gray-600">-</div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control w-56 pr-10 placeholder-theme-13 kioskboard" name="" id="search" wire:model="search" placeholder="Buscar por:">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 fas fa-search"></i>
                    </div>
                </div>
            </div>
            
            <div class="p-5">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="text-theme-1">
                                    <th></th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">DESCRIPCION</th>                                    
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">CATEGORIA</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">COSTO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">PRECIO</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">STOCK</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="dark:bg-dark-1 {{$loop->index % 2 > 0 ? 'bg-gray-200' : ''}}">
                                        <td class="text-center">
                                            <span>
                                                <img src="{{ asset('storage/products/' . $product->img) }}" alt="" heigth="70" width="80" class="rounded">
                                            </span>
                                        </td>
                                        <td class="dark:border-dar-5">
                                            <h6 class="mb-1 font-medium">{{$product->name}}</h6>
                                            <small class="font-normal">{{$product->sales->count()}} Ventas</small>
                                        </td>                                        
                                        <td>{{ strtoupper($product->category)}}</td>
                                        <td>{{ number_format($product->cost,2)}}</td>
                                        <td>{{ number_format($product->price,2)}}</td>
                                        <td>{{$product->stock}}</td>
                                        
                                        <td class="dark:border-dark-5 text-center">
                                            <div class="d-flex justify-content-center">
                                                @if($product->sales->count() < 1) 
                                                    <button href="javascript:void(0)" class="btn btn-danger text-white border-0" onclick="destroy('{{$product->id}}')"><i class="fas fa-trash fa-2x"></i>
                                                @else
                                                    <button href="javascript:void(0)" wire:click="Edit({{$product->id}})" class="btn btn-info btn-sm" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>   
                                                @endif                                             
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <td colspan="2">
                                            <h6 class="text-center">
                                                NO HAY PRODUCTOS REGISTRADOS
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse                               
                            </tbody>
                        </table>
                    </div>    
                </div>    
            </div>            
        </div>
    </div>
    @include('livewire.products.panel')    
<script>    
    function openPanel(action = ''){
        if(action = 'add'){
            @this.resetUI()
        }
        var modal = document.getElementById('panelProduct')
        modal.classList.add('overflow-y-auto','show')
        modal.style.cssText = "margin-top: 0px; margin-left:0px; padding-left:17px; z-index:100"
    }
    function closePanel(action = ''){
        modal = document.getElementById('panelProduct')
        modal.classList.add('overflow-y-auto','show')
        modal.style.cssText = ""
    }
    window.addEventListener('open-modal', event =>{
        openPanel()
    })
    window.addEventListener('noty', event =>{
        if(event.detail.acction == 'close-modal') closePanel()
    })
    KiosBoard.run('.kioskboard',{})

    document.querySelectorAll(".kioskboard").forEach(i => i.addEventListener("change", e =>{
        switch(e.currentTarget.id){
            case 'name':
                @this.name = e.target.value
                break
            case 'cost':
                @this.cost = e.target.value
                break
            case 'code':
                @this.code = e.target.value
                break
            case 'price':
                @this.price = e.target.value
                break
            case 'price2':
                @this.price2s = e.target.value
                break
            case 'stock':
                @this.stock = e.target.value
                break
            case 'minstock':
                @this.minstock = e.target.value
                break
            default:
        }
    }))
</script>
</div>