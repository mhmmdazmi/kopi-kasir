<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class KaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.index', [
            'karyawan' => Karyawan::latest()->get()
        ]);
    }
    public function store(StoreKaryawanRequest $request)
    {
        try {
            DB::beginTransaction();
            Karyawan::create($request->all());

            DB::commit();
            return redirect('karyawan')->with('success', "Input data barang berhasil");
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }
    public function destroy(Karyawan $karyawan)
    { {
            try {
                $karyawan->delete();
                return redirect('karyawan')->with('success', 'Data berhasil dihapus!');
            } catch (QueryException | Exception | PDOException $error) {
                $this->failResponse($error->getMessage(), $error->getCode());
            }
        }
    }
}
