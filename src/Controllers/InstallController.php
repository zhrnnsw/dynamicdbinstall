<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class InstallController extends Controller
{
    public function index()
    {
        print_r('test');
        return view('dynamicdbinstall::install');
    }
    public function process(Request $request)
    {
        $request->validate([
            'DB_HOST' => 'required|string',
            'DB_PORT' => 'required|numeric',
            'DB_DATABASE' => 'required|string',
            'DB_USERNAME' => 'required|string',
            'DB_PASSWORD' => 'nullable|string',

        ]);

        $config = $request->only(['DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

        // Set koneksi database sementara
        config([
            'database.connections.temp' => [
                'driver' => 'mysql',
                'host' => $config['DB_HOST'],
                'port' => $config['DB_PORT'],
                'database' => $config['DB_DATABASE'],
                'username' => $config['DB_USERNAME'],
                'password' => $config['DB_PASSWORD'],
                'charset' => 'utf8',
                'prefix' => '',
                'schema' => $config['DB_SCHEMA'] ?? 'public',
                'sslmode' => 'prefer',
            ]
        ]);

        try {
            // Cek koneksi
            DB::connection('temp')->getPdo();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database connection failed: ' . $e->getMessage());
        }

        // Cek apakah tabel sudah ada
        if (!Schema::connection('temp')->hasTable('users')) {
            // Jika tabel tidak ada, buat tabel menggunakan skrip SQL
            DB::connection('temp')->unprepared(file_get_contents(database_path('migrations/init.sql')));
        } else {
            return redirect()->back()->with('error', 'Database already initialized.');
        }

        // Buat file install.lock
        File::put(storage_path('install.lock'), 'Installation completed.');

        // Hapus view/form instalasi
        File::delete(resource_path('views/form.blade.php'));
        File::delete(resource_path('migrations/init.sql'));
        return redirect('/')->with('success', 'Installation completed successfully.');
    }
}

