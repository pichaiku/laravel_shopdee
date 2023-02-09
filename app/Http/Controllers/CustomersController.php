<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Exception;

class CustomersController extends Controller
{

    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::paginate(25);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('customers.create');
    }

    /**
     * Store a new customer in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Customer::create($data);

            return redirect()->route('customers.customer.index')
                ->with('success_message', 'Customer was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified customer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $customer = Customer::findOrFail($id);
            $customer->update($data);

            return redirect()->route('customers.customer.index')
                ->with('success_message', 'Customer was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified customer from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()->route('customers.customer.index')
                ->with('success_message', 'Customer was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'firstName' => 'required|string|min:1|max:100',
            'lastName' => 'required|string|min:1|max:100',
            'address' => 'nullable|string|min:0|max:200',
            'subdistrictID' => 'nullable|string|min:0|max:6',
            'zipcode' => 'nullable|string|min:0|max:5',
            'mobilePhone' => 'nullable|string|min:0|max:10',
            'homePhone' => 'nullable|string|min:0|max:9',
            'birthdate' => 'nullable|date_format:j/n/Y g:i A',
            'gender' => 'nullable|string|min:0',
            'email' => 'nullable|string|min:0|max:200',
            'username' => 'required|string|min:1|max:100',
            'password' => 'required|string|min:1|max:100',
            'imageFile' => 'nullable|numeric|string|min:0|max:200',
            'isActive' => 'boolean', 
        ];

        
        $data = $request->validate($rules);


        $data['isActive'] = $request->has('isActive');


        return $data;
    }

}