<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return response()->json($products, 200);
    }

    public function show($id) {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product, 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }

    }
    
    public function create(Request $request) {

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'active' => 'required|boolean'
        ];

        $messages = [
            'name.required' => 'O atributo name é obrigatório.',
            'description.required' => 'O atributo description é obrigatório.',
            'price.required' => 'O atributo price é obrigatório.',
            'price.numeric' => 'O atributo price é numérico.',
            'active.required' => 'O atributo active é obrigatório.',
            'active.boolean' => 'O atributo active é booleano.'
        ];

        $this->validate($request, $rules, $messages);

        $product = new Product();

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->active = $request->input('active');

        $product->save();

        return response()->json(['message' => 'Produto cadastrado com sucesso!'], 201);

    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'active' => 'required|boolean'
        ];

        $messages = [
            'name.required' => 'O atributo name é obrigatório.',
            'description.required' => 'O atributo description é obrigatório.',
            'price.required' => 'O atributo price é obrigatório.',
            'price.numeric' => 'O atributo price é numérico.',
            'active.required' => 'O atributo active é obrigatório.',
            'active.boolean' => 'O atributo active é booleano.'
        ];

        $this->validate($request, $rules, $messages);

        try{
            $product = Product::findOrFail($id);

            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->active = $request->input('active');
    
            $product->save();
    
            return response()->json(['message' => 'Produto atualizado com sucesso!'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
        
    }

    public function activate($id) {
        try{
            $product = Product::findOrFail($id);
            $product->active = true;
            $product->save();
            return response()->json(['message' => 'Produto marcado como ativo.'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
        
    }

    public function inactivate($id) {
        try{
            $product = Product::findOrFail($id);
            $product->active = false;
            $product->save();
            return response()->json(['message' => 'Produto marcado como inativo.'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
        
    }

    public function destroy($id) {
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Produto removido com sucesso!'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
        
    }
}
