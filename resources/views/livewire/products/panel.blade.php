<div wire:ignore.self id="panelProduct" class="modal modal-slide-over" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <a href="javascript:;" data-dismiss="modal">
                <i class="fas fa-times w-8 h-8 text-gray-500"></i>
            </a>
            <div class="modal-header p-5">
                <h2 class="font-medium text-base mr-auto">Gestion de Productos</h2>
                <x-save class="mt-4 mr-5"/>
            </div>
            <div class="modal-body mr-5">
                <div class="">
                    <div class="input-group">
                        <div class="input-group-text">Nombre:</div>
                        <input type="text" wire:model="name" id="name" class="form-control form-control-lg kioskboard" placeholder="Cerveza">
                    </div>
                    @error('name')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="input-group">
                            <div class="input-group-text">Costo:</div>
                            <input type="number" name="" id="cost" wire:model="cost" class="form-control form-control-lg kioskboard" data-kioskboard-type="numpad" placeholder="eje: 100">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">Codigo:</div>
                            <input type="text" name="" id="code" wire:model="code" class="form-control form-control-lg kioskboard" placeholder="eje: 10RS0">
                        </div>
                        @error('cost')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                        @error('code')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <div class="input-group-text">Precio1</div>
                    <input type="number" id="price" wire:model="price" class="form-control form-control-lg kisokboard" data-kioskboard-type="numpad" placeholder="eje: 500">
                </div>
                    @error('code')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                <div class="mt-4">
                    <div class="input-group-text">Precio2</div>
                    <input type="number" id="price" wire:model="price2" class="form-control form-control-lg kisokboard" data-kioskboard-type="numpad" placeholder="eje: 500">
                </div>
                    @error('code')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                <div class="mt-4">
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="input-group">
                            <div class="input-group-text">Stock:</div>
                            <input type="number" name="" id="stock" wire:model="stock" class="form-control form-control-lg kioskboard" data-kioskboard-type="numpad" placeholder="eje: 500">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">Minimos:</div>
                            <input type="text" name="" id="minstock" wire:model="minstock" class="form-control form-control-lg kioskboard" placeholder="eje: 10RS0">
                        </div>
                        @error('stock')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                        @error('minstock')
                            <x-alert msg="{{$message}}"/>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <div class="input-group">
                        <div class="input-group-text">Categoria</div>
                        <select name="" wire:model="category_id" class="form-select form-select-lg sm:mr-2" id="">
                            <option value="Elegir">Elegir</option>
                            @foreach ( $categories  as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <x-alert msg="{{$message}}"/>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="grid grid-flow-col auto-cols-max md:auto-cols-min grap-2">
                        <div>
                            <label for="">Imagenes</label>
                            <input type="file" id="" class="form-control" wire:model.defer="gallery" accept="imagex-png, image/jpeg" multiple>
                            @error('gallery')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div wire:loading wire:target="gallery">Subiendo imagenes...</div>
                    </div>
                    @if(!empty($gallery))
                        <div class="sm:grid-cols-12 md:grid-cols-2 grid grid-cols-3 gap-2 pt-2 overflow-y-auto">
                            @foreach ($gallery as $photo)
                                <div>
                                    <img src="{{$photo->temporaryUrl() }}" alt="" class="rounded-lg" alt="image">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>            
        </div>
    </div>
</div>