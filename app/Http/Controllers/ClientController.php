<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    // Reusable validation method
    protected function validateClient(Request $request, $uuid = null)
    {
        $rules = [
            'id_number' => 'required|string|min:10|max:15',
            'date_of_birth' => 'required|date',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => [
                'required',
                'string',
                'email',
                'min:5',
                'max:191',
                Rule::unique('clients')->ignore($uuid, 'uuid'),
            ],
            'telephone' => 'required|string|min:8|max:15',
            'status' => 'required|integer|between:0,50',
        ];

        return $request->validate($rules);
    }

    public function index()
    {
        $user = Auth::user();

        return view('clients', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateClient($request);

        $client = Client::create([
            'uuid' => (string) Str::uuid(),
            'id_number' => $validated['id_number'],
            'date_of_birth' => $validated['date_of_birth'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'status' => $validated['status'],
        ]);

        return response()->json(['data' => $client], 201);
    }

    public function show($uuid)
    {
        $client = Client::findByUuid($uuid);

        if ($client) {

            return response()->json(['data' => $client]);
        }

        return response()->json(['error' => 'Client not found.'], 404);
    }

    public function update(Request $request, $uuid)
    {
        $validated = $this->validateClient($request, $uuid);
    
        $client = Client::findByUuid($uuid);
    
        if ($client) {

            $client->update($validated);
    
            return response()->json(['data' => $client]);
        }
    
        return response()->json(['message' => 'Client not found.'], 404);
    }

    public function destroy($uuid)
    {
        $client = Client::findByUuid($uuid);

        if ($client) {

            $client->delete();

            return response()->json(['success' => 'Client deleted successfully!'], 200);
        } 

        return response()->json(['message' => 'Client not found.'], 404);
    }

    public function getClientsAjax(Request $request)
    {
        $query = Client::query();

        // Apply filter based on the "only_deleted" parameter
        if ($request->has('only_deleted') && $request->input('only_deleted') == "true") {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }

        // Searching, filtering, and ordering logic...
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            
            $query->where(function($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('id_number', 'like', "%{$search}%")
                    ->orWhere('date_of_birth', 'like', "%{$search}%");
            });
        }

        // Column ordering/filtering...
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');
        $columns = ['id_number', 'date_of_birth', 'first_name', 'last_name', 'email', 'telephone'];

        if ($orderColumnIndex !== null && isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDirection);
        }

        if (is_null($orderColumnIndex)) {
            $query->orderBy('updated_at', 'desc');
        }

        // Paginate the results
        $length = $request->input('length', 10);
        $start = $request->input('start', 0);

        $totalRecords = Client::count();
        $totalFiltered = $query->count();

        // Get paginated clients
        $clients = $query->skip($start)->take($length)->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $clients
        ]);
    }

    public function restore($uuid)
    {
        $client = Client::withTrashed()->where('uuid', $uuid)->first();

        if ($client) {

            $client->restore();

            return response()->json(['status' => 'success', 'message' => 'Client restored successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Client not found.'], 404);
    }
}