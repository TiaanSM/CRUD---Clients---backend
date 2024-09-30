{{-- Loads Compiled CSS via Vite based on ENV. --}}
@vite('resources/css/app.css')

{{-- CDN: Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

{{-- CDN: Datatables --}}
<link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css" rel="stylesheet">

{{-- CDN: Flatpickr (date picker) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">