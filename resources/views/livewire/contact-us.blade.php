<div>
    {!! Form::open(['route' => 'incidents.storecontact', 'class' => "php-email-form"]) !!}
        <div class="row">
            <div class="col-md-6 form-group">
                {!! Form::text('name', null, ['wire:model' => 'name', 'class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                @error('name') <span class="error">El nombre es necesario para enviar el mensaje</span> @enderror
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
                {!! Form::email('email', null, ['wire:model' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required']) !!}
                @error('email') <span class="error">El correo electrónico es necesario para enviar el mensaje</span> @enderror
            </div>
        </div>
        <div class="form-group mt-3">
            {!! Form::text('subject', null, ['wire:model' => 'subject', 'class' => 'form-control', 'placeholder' => 'Asunto', 'required']) !!}
            @error('subject') <span class="error">El asunto es necesario para enviar el mensaje</span> @enderror
        </div>
        <div class="form-group mt-3">
            {!! Form::textarea('message', null, ['wire:model' => 'message', 'class' => 'form-control', 'placeholder' => 'Mensaje', 'required', 'rows' => '5']) !!}
            @error('message') <span class="error">El mensaje es necesario para enviar el mensaje</span> @enderror
        </div>
        <div class="my-3">
            <div class="
                @if($mostrar == 0) sent-message @else sent-message d-block @endif">Mensaje enviado. Gracias por contactarnos!</div>
        </div>
        <div class="text-center">
            <button class="btn btn-block enviar" wire:click.prevent="enviar()">Enviar mensaje</button>    
        </div>
    </form>
</div>
