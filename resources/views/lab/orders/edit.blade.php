@extends('layouts.app')

@section('title', 'Registros')

@section('content')
    @if(session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>{{ session('info') }}</strong>
        </div>    
    @endif
    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 mt-3">
                @livewire('order-edit', ['order_id' => $order->id])
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Estudios solicitados
                    </div>
                    <div class="card-body">
                        <table id="selected" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Estudio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedStudies as $st)
                                        <tr>
                                            <td>
                                                @can('Borrar estudio')
                                                    <a href="javascript:void(0)" id="delete-study" data-url="{{ route('orders.deleteStudy', $st['order_detail_id']) }}" class="btn btn-danger">X</a>
                                                @endcan
                                            </td>
                                            <td>{{ $st['name'] }}</td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_css')
@endsection

@section('page_scripts')
    <script>
        (function () {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
        
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '#delete-study', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if(confirm("Are you sure you want to remove this user?") == true){
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data) {
                            alert(data.success);
                            trObj.parents("tr").remove();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function calcularEdad(birthday) {
            console.log(birthday)
            var today = new Date();
            var birthDate = new Date(birthday);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if( m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age --;
            }
            return $('#age').val(age);
        }
        function calcularBirthday(edad) {
            var today = new Date();
            var age = edad;
            var nuevaFecha = new Date(today.setYear(today.getFullYear() - age));
            var conformato = nuevaFecha.getFullYear() + "-" + (("0"+(nuevaFecha.getMonth()+1)).slice(-2)) + "-" + ("0" + nuevaFecha.getDate()).slice(-2);
            return $('#birthdate').val(conformato);
        }
        var cont = 0;
        var detalles = 0;
        function agregarEstudio(id,name,price) {
            var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="hidden" name="study_id[]" value="'+id+'">'+name+'</td>'+
            '<td><input type="hidden" name="price[]" value="'+id+'">'+price+'</td>'+
            '</tr>';
            cont++;
            detalles++;
            $('#detalles').append(fila);
        }
        function eliminarDetalle(indice) {
            $("#fila" + indice).remove();
            detalles = detalles - 1;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#estos').DataTable({
                dom: '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
    </script>
@endsection