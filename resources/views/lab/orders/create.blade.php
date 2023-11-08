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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Alta de pacientes</h3>
                            </div>
                        </div>
                    </div>
                    @livewire('order-store')
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