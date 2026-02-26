<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; // Tambahkan ini di paling atas

class CarController extends Controller
{
    public function index()
    {
        // Mengambil data mobil beserta kategorinya agar tidak boros query (Eager Loading)
        $cars = Car::with('category')->latest()->get();

        return view('Admin.Car.index', compact('cars'));
    }

    public function create()
    {
        $categories = Category::all(); // Mengambil semua merek untuk dropdown

        return view('Admin.Car.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:cars,name|max:255',
            'year' => 'required|numeric|digits:4',
            'price' => 'required|numeric',
            'mileage' => 'required|numeric',
            'color' => 'required|string|max:100',
            'transmission' => 'required|in:Automatic,Manual',
            'fuel_type' => 'required|in:Bensin,Diesel,Electric,Hybrid',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:Available,Sold,Booked',
        ]);

        // 1. Proses Thumbnail (Single File)
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time().'-thumb-'.Str::slug($request->name).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/thumbnails'), $thumbnailName);
        }

        // 2. Proses Galeri (Multiple Files)
        $galleryPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                // Pastikan kita mengecek apakah file valid
                if ($image->isValid()) {
                    $imageName = time().'-gal-'.$key.'-'.Str::slug($request->name).'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/gallery'), $imageName);
                    $galleryPaths[] = $imageName;
                }
            }
        }

        // 3. Simpan ke Database
        Car::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'year' => $request->year,
            'price' => $request->price,
            'mileage' => $request->mileage,
            'color' => $request->color,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'description' => $request->description,
            'thumbnail' => $thumbnailName, // Simpan nama filenya saja
            'images' => json_encode($galleryPaths), // Ubah array ke string JSON secara manual
            'status' => $request->status,
        ]);

        return redirect('/admin/cars')->with('success', 'Unit mobil berhasil ditambahkan ke showroom!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $slug)
    {
        return view('Customer.detail-car', [
            'car' => $slug
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $categories = Category::all();

        return view('Admin.Car.edit', compact('car', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|max:255|unique:cars,name,'.$car->id,
        'year' => 'required|numeric|digits:4',
        'price' => 'required|numeric',
        'mileage' => 'required|numeric',
        'color' => 'required|string',
        'transmission' => 'required|in:Automatic,Manual',
        'fuel_type' => 'required|in:Bensin,Diesel,Electric,Hybrid',
        'description' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'images.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'status' => 'required|in:Available,Sold,Booked',
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->name);

    // --- 1. HANDLE UPDATE THUMBNAIL ---
    if ($request->hasFile('thumbnail')) {
        if ($car->thumbnail && File::exists(public_path('uploads/thumbnails/'.$car->thumbnail))) {
            File::delete(public_path('uploads/thumbnails/'.$car->thumbnail));
        }

        $file = $request->file('thumbnail');
        $thumbnailName = time().'-thumb-'.Str::slug($request->name).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/thumbnails'), $thumbnailName);
        $data['thumbnail'] = $thumbnailName;
    }

    // --- 2. HANDLE UPDATE GALERI (ANTI-ERROR FOREACH) ---
    if ($request->hasFile('images')) {
        
        // Logika Pengaman: Pastikan $car->images diperlakukan sebagai array
        $oldImages = $car->images;
        if (is_string($oldImages)) {
            $oldImages = json_decode($oldImages, true) ?? [];
        }

        // Hapus file fisik galeri lama jika ada
        if (!empty($oldImages) && is_array($oldImages)) {
            foreach ($oldImages as $oldImage) {
                $oldPath = public_path('uploads/gallery/'.$oldImage);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
        }

        // Upload foto-foto baru
        $galleryPaths = [];
        foreach ($request->file('images') as $key => $image) {
            $imageName = time().'-gal-'.$key.'-'.Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $imageName);
            $galleryPaths[] = $imageName;
        }
        
        // Simpan array foto baru ke data update
        $data['images'] = $galleryPaths;
    } else {
        // Jika tidak upload foto baru, tetap gunakan foto yang sudah ada di DB
        // supaya tidak ter-reset jadi null jika tidak mengisi input images
        unset($data['images']); 
    }

    $car->update($data);

    return redirect('/admin/cars')->with('success', 'Data unit berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // 1. Hapus File Thumbnail dari folder
        if ($car->thumbnail) {
            $thumbnailPath = public_path('uploads/thumbnails/'.$car->thumbnail);
            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }
        }

        // 2. Hapus Semua File Galeri dari folder
        if ($car->images && is_array($car->images)) {
            foreach ($car->images as $image) {
                $galleryPath = public_path('uploads/gallery/'.$image);
                if (File::exists($galleryPath)) {
                    File::delete($galleryPath);
                }
            }
        }

        // 3. Hapus data dari database
        $car->delete();

        // 4. Redirect dengan pesan sukses
        return redirect('admin/cars')->with('success', 'Unit mobil dan semua datanya berhasil dihapus!');
    }

    public function deleteImage(Car $car, $imageName)
    {
        // 1. Cari file di folder dan hapus
        $filePath = public_path('uploads/gallery/'.$imageName);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // 2. Update Array di Database
        $currentImages = $car->images;
        // Filter array untuk membuang image yang dipilih
        $updatedImages = array_filter($currentImages, function ($img) use ($imageName) {
            return $img !== $imageName;
        });

        // Simpan kembali sebagai array (Laravel akan otomatis convert ke JSON karena casts)
        $car->update([
            'images' => array_values($updatedImages), // array_values untuk me-reset index
        ]);

        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }
}
