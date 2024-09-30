import './bootstrap';

let clientsTable = $('#clientsTable').DataTable({
    serverSide: true,
    processing: true,
    responsive: {
        details: true,
    },
    ajax: {
        url: getClientsURL,
        type: 'GET',
        data: function(d) {
            // Toggle to show deleted clients if the button is clicked
            if ($('#toggleClients').hasClass('showing-deleted')) {
                d.only_deleted = "true";
            } else {
                d.only_deleted = "false";
            }
        }
    },
    columns: [
        { data: 'id_number', orderable: true },
        { data: 'date_of_birth', orderable: true },
        { data: 'first_name', orderable: true },
        { data: 'last_name', orderable: true },
        { data: 'email', orderable: true },
        { data: 'telephone', orderable: true },
        { 
            data: 'status', 
            orderable: false,
            render: function(data, type, row) {
                return row.status === 1 ? 'Active' : 'Inactive';
            }
        },
        {
            data: null,
            orderable: false,
            render: function(data, type, row) {
                let buttons = '';

                // If the client is deleted, show the restore button
                if (row.deleted_at) { 
                    buttons += `
                        <button class="btn btn-success" onclick="restoreClient('${row.uuid}')">Restore</button>
                    `;
                } else {
                    buttons += `
                        <div class="dropdown">
                            <button class="btn btn-secondary d-flex align-items-center" type="button" id="dropdownMenuButton${row.uuid}" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="#fff" stroke="none">
                                    <g fill="#fff">
                                        <rect width="4" height="4" x="3" y="10" rx="2"/>
                                        <rect width="4" height="4" x="10" y="10" rx="2"/>
                                        <rect width="4" height="4" x="17" y="10" rx="2"/>
                                    </g>
                                </svg>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.uuid}">
                                <li><a class="dropdown-item" href="#" onclick="openEditModal(${JSON.stringify(row).replace(/"/g, '&quot;')})">Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="#" id="deleteClientBtn" data-id="${row.uuid}">Delete</a></li>
                            </ul>
                        </div>
                    `;
                }
                return buttons; // Return the buttons
            }
        }
    ],
    layout: {
        topStart: 'search',
        topEnd: 'info',
        bottomStart: 'pageLength'
    },
    lengthMenu: [5, 10, 25, 50, 100],
    pageLength: 10,
    order: []
});

// Toggle button event
$('#toggleClients').on('click', function() {
    if ($(this).hasClass('showing-deleted')) {
        $(this).removeClass('showing-deleted').text('Show Deleted Clients');
    } else {
        $(this).addClass('showing-deleted').text('Show Active Clients');
    }
    clientsTable.ajax.reload();
});

// Date picker for Client: DOB
flatpickr(".dob-range", {
    dateFormat: "Y-m-d"
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#createClientForm').on('submit', function(e) {
    e.preventDefault();

    let formData = {
        first_name: $('#create_first_name').val(),
        last_name: $('#create_last_name').val(),
        email: $('#create_email').val(),
        telephone: $('#create_telephone').val(),
        id_number: $('#create_id_number').val(),
        date_of_birth: $('#create_date_of_birth').val(),
        status: $('#create_status').val(),
    };

    // Make AJAX request to create the client
    $.ajax({
        url: createClientURL,
        method: 'POST',
        data: formData,
        success: function(response) {
            $('#createClientModal').modal('hide');

            $('#modalMessage').text(response.message || 'Client created successfully.');
            $('#responseModal').modal('show');

            // Reset the form fields
            $('#createClientForm')[0].reset();

            $('#clientsTable').DataTable().ajax.reload();
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});


window.openEditModal = function (client) {
        
    $('#clientId').val(client.uuid);
    $('#first_name').val(client.first_name);
    $('#last_name').val(client.last_name);
    $('#email').val(client.email);
    $('#telephone').val(client.telephone);
    $('#id_number').val(client.id_number);
    $('#date_of_birth').val(client.date_of_birth);
    $('#status').val(client.status);
    
    $('#editClientModal').modal('show');
}

// Edit Client AJAX
$('#editClientForm').on('submit', function(e) {
    e.preventDefault();
    let clientUuid = $('#clientId').val();

    let formData = {
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        email: $('#email').val(),
        telephone: $('#telephone').val(),
        id_number: $('#id_number').val(),
        date_of_birth: $('#date_of_birth').val(),
        status: $('#status').val(),
        _method: 'PUT'
    };

    $.ajax({
        url: `/clients/${clientUuid}`,
        type: 'POST',
        data: formData,
        success: function(response) {

            $('#editClientModal').modal('hide');
            $('#modalMessage').text(response.message || 'Client updated successfully.');
            $('#responseModal').modal('show');
            $('#clientsTable').DataTable().ajax.reload();
        },
        error: function(xhr) {

            $('#modalMessage').text(xhr.responseJSON.message || 'An error occurred while updating the client.');
            $('#responseModal').modal('show');
        }
    });
});


$(document).on('click', '#deleteClientBtn', function() {
    const clientId = $(this).data('id');
    deleteClient(clientId);
});

function deleteClient(clientId) {
    if (confirm('Are you sure you want to delete this client?')) {
        $.ajax({
            url: `/clients/${clientId}`,
            type: 'DELETE',
            success: function(response) {
                $('#modalMessage').text(response.message || 'Client deleted successfully.');
                $('#responseModal').modal('show');

                $('#clientsTable').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#modalMessage').text(xhr.responseJSON.message || 'An error occurred while deleting the client.');
                $('#responseModal').modal('show');
            }
        });
    }
}

window.restoreClient = function(uuid) {
    if (confirm('Are you sure you want to restore this client?')) {
        $.ajax({
            url: `/clients/restore/${uuid}`, 
            type: 'POST', 
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Client restored successfully.');
                    $('#clientsTable').DataTable().ajax.reload(); 
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Error restoring client: ' + xhr.responseJSON.message);
            }
        });
    }
};