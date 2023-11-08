<div>
    <table class="table table-hover table-striped" id="prices">
        <thead>
            <tr>
                <td>Estudio</td>
                <td>Precio de lista</td>
                <td>Precio {{ $client->name }}</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($prices as $index => $price)
                <tr>
                    <td>{{ $price->name }}</td>
                    <td>{{ $price->list }}</td>
                    @if($editedPriceIndex !== $index)
                        <td>$ {{ $price->price }}</td>
                    @else
                    <td><input type="text" wire:model.defer="price">
                        @error('price') <span class="error">El precio debe ser numérico y es obligatorio</span> @enderror
                    </td>
                    @endif
                    @if($editedPriceIndex !== $index)
                        <td>
                            <button class="btn btn-warning btn-xs" wire:click.prevent="editar({{ $index }})"><i class="fa fa-edit"></i></button>
                        </td>
                    @else
                        <td><button class="btn btn-success btn-xs" wire:click.prevent="guardar({{ $price->id }})"><i class="fa fa-save"></i></button></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
