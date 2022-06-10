<div>
    <div class="pos intro-y grid grid-cols-12 gap-5-mt-5">
        <div class="intro-y col-span-12 lg-col-span-9">
            <div class="pos intro-y overflow-hidden box">
                 <div class="post__tabs nav van-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">
                     
                    <a wire:click="setTabActive(tabProducts)" title="Productos Agregados" data-toogle="tab" data-target="#tabProducts" href="">
                         <i class="fas fa-list mr-2"></i> DETALLE DE VENTA
                     </a>
                     <a wire:click="setTabActive(tabCategories)" title="Productos Categorias" data-toogle="tab" data-target="#tabCategories" href="">
                        <i class="fas fa-th-large mr-2"></i> DETALLE DE VENTA
                    </a>

                 </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <div class="intro-y box p-5">
                <div>
                    <h2 class="text-2x1 text-center mb-3">RESUMEN DE VENTA</h2>
                    <button class="btn btn-outline-dark w-full mb-3">{{ $customerSelected }}</button>
                </div>
                <div class="mt-3">
                    <h1 class="text-2x1 font-bold">ARTICULOS</h1>
                    <h3 class="text-2x1 font-bold">{{$itemsCart}}</h3>
                </div>
                <div class="mt-3">
                    <h1 class="text-2x1 font-bold">TOTAL</h1>
                    <h3 class="text-2x1 font-bold">${{ number_format($totalCart,2)}}</h3>
                </div>
                <div class="mt-6">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <input wire:model="cash" id="cash" type="number" data-kioskboard-type="numpad" class="form-control form-control-lg kioskboard" placehoder="0.00">
                    </div>
                </div>
                <div class="mt-8">
                    <button wire:loading.attr="disabled" wire:click.prevent="storeSale" class="btn btn-primary w-full">
                        <i class="fas fa-database mr-2"></i>
                        Guardar Venta
                    </button>
                    <button wire:loading.attr="disabled" wire:click.prevent="storeSale(true)" class="btn btn-outline-primary w-full mt-5">
                        <i class="fas fa-receipt mr-2"></i>
                        Guardar Venta e Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.sales.modal-changes')
    @include('livewire.sales.modal-customers')
    @include('livewire.sales.script')

    @include('livewire.sales.keyboard')
</div>