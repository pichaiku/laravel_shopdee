<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Exception;

class ProductsController extends Controller
{

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = product::paginate(25);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('products.create');
    }

    /**
     * Store a new product in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            product::create($data);

            return redirect()->route('products.product.index')
                ->with('success_message', 'Product was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = product::findOrFail($id);
        

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in the storage.
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
            
            $product = product::findOrFail($id);
            $product->update($data);

            return redirect()->route('products.product.index')
                ->with('success_message', 'Product was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified product from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $product = product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.product.index')
                ->with('success_message', 'Product was successfully deleted.');
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
                'productName' => 'required|string|min:1|max:200',
            'productDetail' => 'nullable|string|min:0|max:500',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'quantity' => 'required',
            'imageFile' => 'required|numeric|string|min:1|max:100',
            'typeID' => 'required|string|min:1', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
