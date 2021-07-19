<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Response;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_penyakit()
    {
        try{
            $data = Penyakit::select('nama','id_penyakit')->get();

            return response()->json([
                'status'        => array('code' => 200, 'message' => 'Success'),
                'results'       => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'    => array('code'=> 500,'message'=> $th->getMessage())], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_penyakit_by_id($id)
    {
        $findPenyakit = Penyakit::find($id);

        $findPenyakit->gambar = base64_decode($findPenyakit->gambar);

        if($findPenyakit){
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success get findPenyakit'),
            'results' => $findPenyakit
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_penyakit(Request $request)
    {
        $dataPenyakit = new Penyakit;

        // $foto1 = $request->foto_penyakit; 
        // $hasil = Image::make($foto1);
        // Response::make($hasil->encode('jpeg'));

        $dataPenyakit->nama = $request->nama_penyakit;
        $dataPenyakit->desc_penyakit = $request->desc_penyakit;
        $dataPenyakit->desc_pengobatan = $request->desc_pengobatan;
        $dataPenyakit->gambar = base64_encode($request->foto_penyakit;);
        $dataPenyakit->save();

        return response()->json(['status' => array('code' => 200, 'message' => 'Success'),], 200);
    }

    public function delete_penyakit(Penyakit $penyakit,$id)
    {
        $findPenyakit = Penyakit::where('id_penyakit', $id)->first();
        if($findPenyakit){
            Penyakit::where('id_penyakit',$id)->delete();
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
            ], 200);
        }
        return response()->json([
            'status' => array('code' => 400, 'message' => 'data doesnt exist'),
        ], 400);
    }

    public function update_penyakit(Request $request)
    {
        // pake foto
        $findPenyakit = Penyakit::where('id_penyakit', $request->id_penyakit)->first();
            // $foto1 = $request->foto_penyakit; 
            // $hasil = Image::make($foto1);
            // Response::make($hasil->encode('jpeg'));

            if($findPenyakit){
                $dataPenyakit = [
                    'nama' => $request->nama_penyakit,
                    'desc_penyakit' => $request->desc_penyakit,
                    'desc_pengobatan' => $request->desc_pengobatan,
                    'foto_penyakit' => base64_encode($request->foto_penyakit),
                ];

                Penyakit::where('id_penyakit',$request->id_penyakit)->update($dataPenyakit);

                return response()->json([
                    'status'        => array('code' => 200, 'message' => 'Success update new Jenis Event.'),
                ], 200);
            }
    }

    public function update_penyakit2(Request $request)
    {
        // gak pake foto
        $findPenyakit = Penyakit::where('id_penyakit', $request->id_penyakit)->first();

            if($findPenyakit){
                $dataPenyakit = [
                    'nama' => $request->nama_penyakit,
                    'desc_penyakit' => $request->desc_penyakit,
                    'desc_pengobatan' => $request->desc_pengobatan,
                ];

                Penyakit::where('id_penyakit',$request->id_penyakit)->update($dataPenyakit);

                return response()->json([
                    'status'        => array('code' => 200, 'message' => 'Success update new Jenis Event.'),
                ], 200);
            }
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyakit $penyakit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    
}
