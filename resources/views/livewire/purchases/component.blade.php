<div>
    @if (!$form)
    <div class="intro-y col-span-12">
        <div class="intro-y box">
        <h2 class="text-lg font-medium text-center text-theme-1 py-4">LISTA DE COMPRAS</h2>
        <x-search />
        <div class="p-5">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead class="text-xs" style="height: 10px;">
                            <tr class="text-theme-1">                            
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">FECHA</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">REFERENCIA</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">PROVEEDOR</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ESTADO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">TOTAL</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">PAGADO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">BALANCE</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ESTADO DE PAGO</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap h-3.5">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $p)
                            <tr class="text-xs dark:bg-dark-1 {{$loop->index % 2 >0 ? 'bg bg-gray-200' : ''}}" style="line-height: 0rem;">                            
                                <td style="padding: 0.4rem 0.75rem;">{{$p->created_at}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->references}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->provider}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="{{ ($p->status === 'Recibido') ? 'text-theme-9' : 'text-theme-6'}}"> {{ $p->status }}</td>                            
                                <td style="padding: 0.4rem 0.75rem;">{{$p->total}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->payment}}</td>
                                <td style="padding: 0.4rem 0.75rem;">{{$p->total - $p->payment}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="{{ ($p->payment === 'Pagado') ? 'text-theme-6' : 'text-theme-9'}}">{{$p->pay_status}}</td>
                                <td style="padding: 0.4rem 0.75rem;" class="dark:border-dark-5 text-center">
                                    <div class="d-flex justify-content-center">                                    
                                        <button class="btn btn-danger text-white border-0" onclick="destroy('purchase','Destroy',{{$p->id}})" type="button">
                                            Acciones
                                        </button>                                    
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <td colspan="2">
                                    <h6 class="text-center">NO HAY CATEGORIAS REGISTRADAS</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-span-12 p-5">
            {{$purchases->links()}}
        </div>        
    </div>
    @else
        @include('livewire.purchases.form')
    @endif
        @include('livewire.sales.keyboard')
        @include('livewire.purchases.addmodalprovider')
    <script>
        function openModalAddProvider() {
        var modal = document.getElementById("modalAddProvider")
        modal.classList.add("overflow-y-auto", "show")
        modal.style.cssText = "margin-top: 0px; margin-left: -100px;  z-index: 1000;"
        }
        function closeModalAddProvider() {
            var modal = document.getElementById("modalAddProvider")
            modal.classList.remove("overflow-y-auto", "show")
            modal.style.cssText = ""             
        }
        window.addEventListener('closeModalAddProvider', event => {
			closeModalAddProvider()
         })
    </script>
</div>