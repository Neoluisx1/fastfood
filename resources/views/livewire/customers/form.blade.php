<dvi class="intro-y col-span-12">
    <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                {{$componentName}}|<span class="font-normal">{{$action}}</span>
                </h2>
            </div>
            <div class="p-5">
                <div class="preview">
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-3 gap-5">
                            <div>
                                <label class="form-label">Nombre</label>
                                <input wire:model="name" id="name" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="255" placeholder="Ej..Luis Miguel">
                                @error('name')
                                <x-alert msg="{{$message}}" />
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">Nit</label>
                                <input wire:model="nit" id="nit" type="text" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="11" placeholder="Ej..60457578">
                                @error('nit')
                                <x-alert msg="{{$message}}" />
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">Telefono</label>
                                <input wire:model="phone" id="phone" type="text" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="10" placeholder="Ej..60457578">
                                @error('phone')
                                <x-alert msg="{{$message}}" />
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-3 gap-5">
                            <div>
                                <label class="form-label">Ciudad</label>
                                <input wire:model="city" id="city" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="50" placeholder="Ej..Potosi">
                                @error('city')
                                <x-alert msg="{{$message}}" />
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">Correo</label>
                                <input wire:model="mail" id="mail" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="50" placeholder="Ej..infinity@gmail.com">
                                @error('mail')
                                <x-alert msg="{{$message}}" />
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <x-back />

                        <x-save />
                    </div>
                </div>
            </div>
    </div>
</dvi>
<script>
    KioskBoard.run('#kioskboard',{})
    document.querySelectorAll(".kioskboard").forEach(i=>i.addEventListener("change",e=>{
        switch(e.currentTarget.id){
            case 'name':
                @this.name = e.target.value
                break
                @this.nit = e.target.value
                break
                @this.phone = e.target.value
                break
                @this.city = e.target.value
                break
                @this.mail = e.target.value
                break
        }
    }))
</script>
