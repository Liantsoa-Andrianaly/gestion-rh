<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listes des configurations</title>
 <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"-->
 <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
 <!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script-->
 <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
*{
    font-family: 'poppins', 'sans-serif';
    margin:0;
    padding:0;
    box-sizing:border-box;
}
</style>

</head>
<body>
    @extends('layouts.template')
@section('content')
    <div class="container text-center">
        <div class="row" >
            <h2 class="page-title" style="color:#227BFF; font-size:40px">Configurations</h2>
            <hr class="sidebar-divider my-0">
            <a style="width:250px" href="{{route('configurations.create')}}" class="btn btn-primary">Nouvelle configuration</a>
            
            <br>
            <hr>

            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message')}}
                </div>
            @endif

            @if (!empty($paymentNotification))
                <div class="alert alert-danger">
                    {{ $paymentNotification }}
                </div>
            @endif


        
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $ide = 1;
                    @endphp

                @foreach($allConfigurations as $config)
                    <tr>
                        <td>{{ $ide }}</td>
                        <td>

                            @if ($config->type === 'PAYMENT_DATE')
                                Date mensuel de paiement
                                
                            @endif

                            @if ($config->type === 'APP_NAME')
                                Nom de l'appplication
                               
                            @endif
                            
                            @if ($config->type === 'DEVELOPPER_NAME')
                                Equipe de dévéloppement
                            @endif

                            @if ($config->type === 'ANOTHER')
                                Autre option
                             @endif

                            

                        </td>
                        <td>{{ $config->value }}
                            @if ($config->type === 'PAYMENT_DATE')
                                De chaque mois
                            @endif
                        </td>

                        <td>
                            <a href="javascript:void(0);" 
                               onclick="confirmDeleteConfiguration({{ $config->id }})" 
                               style="font-size: 10px" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        
                        
                    
                    </tr>
                    

                    @php
                        $ide += 1;
                    @endphp

                    
                @endforeach
                </tbody>
            </table>
            {{ $allConfigurations->links()}}
        

        </div>
    </div>
   
    <script>
        function confirmDeleteConfiguration(configId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Rediriger vers l'URL de suppression après confirmation
                    window.location.href = `/configurations/delete/${configId}`;
                }
            })
        }
        </script>
        
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script-->
<script src="{{asset('asset/bootstrap/bootstrap.bundle.min.js')}}"></script>
@endsection
</body>
</html>