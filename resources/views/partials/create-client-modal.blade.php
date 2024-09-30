<div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="createClientModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createClientModalLabel">Create Client</h5>
            </div>

            <form id="createClientForm">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_first_name">First Name</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="create_first_name" 
                            name="first_name" 
                            required
                            minlength="2"
                            maxlength="100"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_last_name">Last Name</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="create_last_name" 
                            name="last_name" 
                            required
                            minlength="2"
                            maxlength="100"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_email">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="create_email" 
                            name="email" 
                            required
                            minlength="5"
                            maxlength="191"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_telephone">Telephone</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="create_telephone" 
                            name="telephone" 
                            required
                            minlength="8"
                            maxlength="15"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_id_number">ID Number</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="create_id_number" 
                            name="id_number" 
                            required
                            minlength="10"
                            maxlength="15"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_date_of_birth">Date of Birth</label>
                        <input 
                            type="text" 
                            class="form-control dob-range" 
                            id="create_date_of_birth" 
                            name="date_of_birth" 
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="create_status">Status</label>
                        <select 
                            class="form-control" 
                            id="create_status" 
                            name="status" 
                            required
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Client</button>
                </div>

            </form>
        </div>
    </div>
</div>