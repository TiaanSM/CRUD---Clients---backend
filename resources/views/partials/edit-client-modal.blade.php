<div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
            </div>

            <form id="editClientForm">

                <div class="modal-body">
                    <input type="hidden" id="clientId" name="uuid">

                    <div class="mb-3">
                        <label for="first_name">First Name</label>
                        <input 
                            type="text" 
                            class="form-control"  
                            id="first_name" 
                            name="first_name" 
                            required
                            minlength="2"
                            maxlength="100"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="last_name">Last Name</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="last_name" 
                            name="last_name" 
                            required
                            minlength="2"
                            max-length="100"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email" 
                            name="email" 
                            required
                            minlength="5"
                            maxlegnth="191"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="telephone">Telephone</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="telephone" 
                            name="telephone" 
                            required
                            minlegnth="8"
                            maxlength="15"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="id_number">ID Number</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="id_number" 
                            name="id_number" 
                            required
                            minlength="10"
                            maxlength="15"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth">Date of Birth</label>
                        <input 
                            type="text" 
                            class="form-control dob-range" 
                            id="date_of_birth" 
                            name="date_of_birth" 
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select 
                            class="form-control" 
                            id="status" 
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
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>