{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

{{-- CDN: Datatable --}}
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

{{-- Datatable: Responsive --}}
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js" type="text/javascript"></script>

{{-- CDN: Flatpickr (date picker) --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- Loads Compiled JS via Vite based on ENV. --}}
@vite('resources/js/app.js')