<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\SaveCustomerRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Get all customers from DB
        $user = Auth::user();
        $customers = $user->customers ?? null;

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        //
        return view('customers.create', [
            'customer' => new Customer
        ]);
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param SaveCustomerRequest $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function store(SaveCustomerRequest $request)
    {
        // Fields validations
        $fields = $request->validated();

        // Validation for existing user
        $user = Auth::user();

        if ($user) {
            $customer = Customer::create([
                'first_name'        => $fields['first_name'],
                'last_name'         => $fields['last_name'],
                'rfc'               => $fields['rfc'],
                'email'             => $fields['email'],
                'cell_phone_number' => $fields['cell_phone_number'],
                'slug'              => '',
                'user_id'           => $user->id,
            ]);

            // Slug creation
            $customer->createSlug();

            return view('customers.show', ['customer' => $customer]);
        }

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified customer.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer)
    {
        return \view('customers.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer)
    {
        //
        return \view('customers.edit',[
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param Customer $customer
     * @param SaveCustomerRequest $request
     * @return RedirectResponse
     */
    public function update(Customer $customer, SaveCustomerRequest $request): RedirectResponse
    {
        // Fields validations
        $fields = $request->validated();

        // Update customer info
        $customer->update([
            'first_name'        => $fields['first_name'],
            'last_name'         => $fields['last_name'],
            'rfc'               => $fields['rfc'],
            'email'             => $fields['email'],
            'cell_phone_number' => $fields['cell_phone_number'],
            'slug'              => '',
        ]);

        // Update Slug
        $customer->createSlug();

        return redirect()->route('customers.show', $customer);
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }

}
