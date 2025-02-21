<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductLogo;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::where('creator_id', Auth::id())->get();
        return view('admin.products.index',[
            'products' => $product
        ]);
        
    }

    public function dashboard()
    {
        $products = Product::all();  // Ambil semua produk
        $totalRevenue = Product::sum('price');  // Total revenue dari semua produk (jika ada field untuk itu)

        return view('dashboard', compact('products', 'totalRevenue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $logos = ProductLogo::all();
        return view('admin.products.create',[
            'categories' => $categories,
            'tags' => $tags,
            'logos' => $logos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'path_file' => ['required', 'file', 'mimes:zip,rar'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'integer', 'min:0'],
            'logos' => ['required', 'array'],
            'logos.*' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
            'tags' => ['nullable', 'array'], // Ubah ke array jika menerima banyak tags
            'tags.*' => ['nullable', 'string'] // Pastikan setiap tag berupa string
        ]);

        DB::beginTransaction();
        
        try {
            // Simpan Cover
            if ($request->hasFile('cover')) {
                $validated['cover'] = $request->file('cover')->store('product_covers', 'public');
            }

            // Simpan Path File
            if ($request->hasFile('path_file')) {
                $validated['path_file'] = $request->file('path_file')->store('product_files', 'public');
            }

            // Tambahkan Slug dan Creator ID
            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();

            // **Simpan Produk Dulu**
            $product = Product::create($validated);

            // Simpan Logos Jika Ada
            if ($request->hasFile('logos')) {
                foreach ($request->file('logos') as $logo) {
                    $path = $logo->store('product_logos', 'public');
                    $product->logos()->create([
                        'product_id' => $product->id, 
                        'logo_path' => $path
                    ]);
                }
                
            }
            
            // Simpan Tags Jika Ada
            if ($request->tags) {
                $tagIds = [];

                foreach ($request->tags as $tagValue) {
                    // Cek apakah input adalah angka (ID tag yang sudah ada)
                    if (is_numeric($tagValue)) {
                        $tagIds[] = (int) $tagValue; // Simpan ID langsung
                    } else {
                        // Jika bukan angka, asumsikan itu nama tag baru dan buat tag baru
                        $tag = Tag::firstOrCreate(['name' => trim($tagValue)]);
                        $tagIds[] = $tag->id;
                    }
                }

                // Sinkronisasi tag dengan produk
                $product->tags()->sync($tagIds);
            }


            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        } 
        catch (\Exception $e) {
            DB::rollBack();

            $error = ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.edit',[
            'product' => $product,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'path_file' => ['sometimes', 'file', 'mimes:zip,rar'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('cover')){
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            if($request->hasFile('path_file')){
                $path_filePath = $request->file('path_file')->store('product_files', 'public');
                $validated['path_file'] = $path_filePath;
            }
            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();

            $product->update($validated);
            
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        }
        catch(\Exception $e){
            DB::rollBack();
            
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
        }
        catch(\Exception $e){
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
