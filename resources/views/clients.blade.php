<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Clients</title>
    
        @include('partials.css-imports')

    </head>

    <body>
        <section class="container py-5 d-flex justify-content-between align-items-center border-bottom">
            
            <h3 class="m-0">{{$user->name}} - {{$user->email}}</h3>

            <form id="logout-form" action="{{ route('logout.perform') }}" method="POST" style="display: none;">
                @csrf
            </form>
            
            <a href="#" class="btn btn-secondary mx-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </section>

        <div class="container py-5">

            <div class="toolbar d-flex justify-content-end gap-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClientModal">
                    Create Client
                </button>

                <!-- Button to toggle between active and deleted clients -->
                <button id="toggleClients" class="btn btn-danger">Show Deleted Clients</button>
            </div>

            <table id="clientsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Number</th>
                        <th>Date of Birth</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>

        </div>

        @include('partials.create-client-modal')

        @include('partials.edit-client-modal')

        @include('partials.response-modal')

        {{-- These URLS are used for Ajax in the app.js file --}}
        <script type="text/javascript">
            const getClientsURL = "{{ route('clients.data') }}";
            const createClientURL = "{{ route('clients.store') }}";
        </script>

        @include('partials.js-imports')
    </body>

</html>