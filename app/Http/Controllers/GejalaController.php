<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_gejala()
    {
        try{
            $data = Gejala::all();

            return response()->json([
                'status'        => array('code' => 200, 'message' => 'Success'),
                'results'       => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'    => array('code'=> 500,'message'=> $th->getMessage())], 500);
        }
    }

    public function get_detail($id_penyakit)
    {
        $findPenyakit = Penyakit::find($id_penyakit);
        $gejalaJoin = Gejala::select(
            'gejala.id_gejala',
            'gejala.desc_gejala',
            'gejala.desc_kuesioner',
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')
         ->where('gejala.id_penyakit', $findPenyakit->id_penyakit)
         ->get();
        $findPenyakit->gambar = base64_decode($findPenyakit->gambar);
     
        if($findPenyakit){
            return response()->json([
            'status' => array('code' => 200, 'message' => 'Success get findGejala'),
            'results_penyakit' => $findPenyakit,
            'results_gejala' => $gejalaJoin,
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function get_gejala_by_id($id)
    {
        $findGejala = Gejala::select(
            'gejala.id_gejala',
            'gejala.id_penyakit',
            'gejala.desc_gejala',
            'gejala.desc_kuesioner',
            'penyakit.nama',
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')
         ->where('gejala.id_gejala', $id)->first();


        if($findGejala){
            return response()->json([
            'status' => array('code' => 200, 'message' => 'Success get findGejala'),
            'results' => $findGejala
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function get_gejala_join_by_id($id)
    {
        $gejalaJoin = Gejala::select(
            '*'
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')
         ->where('gejala.id_gejala', $id)
         ->first();

        if($gejalaJoin){
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
                'results' => $gejalaJoin,
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function get_gejala_join_by_id2($id)
    {
        $gejalaJoin = Gejala::select(
            '*'
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')
         ->where('gejala.id_penyakit', $id)
         ->first();

        if($gejalaJoin){
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
                'results' => $gejalaJoin,
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function get_kuesioner_order($id)
    {
        $gejalaJoin = Gejala::select(
            'gejala.id_gejala',
            'gejala.id_penyakit',
            'gejala.desc_kuesioner',
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')
         ->where('gejala.id_penyakit', $id)
         ->get();

        if($gejalaJoin){
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
                'results' => $gejalaJoin,
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function get_gejala_join()
    {
        $gejalaJoin = Gejala::select(
            'gejala.id_gejala',
            'gejala.id_penyakit',
            'gejala.desc_gejala',
            'gejala.desc_kuesioner',
            'penyakit.nama',
        )->join('penyakit', 'penyakit.id_penyakit', '=', 'gejala.id_penyakit')->get();

        if($gejalaJoin){
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
                'results' => $gejalaJoin,
            ], 200);
        }

        return response()->json([
            'status' => array('code' => 400, 'message' => 'Error'),
        ], 400);
    }

    public function create_gejala(Request $request)
    {
        $dataGejala = new Gejala;

        $dataGejala->id_penyakit = $request->id_penyakit;
        $dataGejala->desc_gejala = $request->desc_gejala;
        $dataGejala->desc_kuesioner = $request->desc_kuesioner;
        $dataGejala->save();

        return response()->json(['status' => array('code' => 200, 'message' => 'Success'),], 200);
    }

    public function update_gejala(Request $request, $id)
    {
        $findGejala = Gejala::where('id_gejala', $request->id_gejala)->first();

            if($findGejala){
                $dataGejala = [
                    'id_penyakit' => $request->id_penyakit,
                    'desc_gejala' => $request->desc_gejala,
                    'desc_kuesioner' => $request->desc_kuesioner,
                ];

                Gejala::where('id_gejala',$request->id_gejala)->update($dataGejala);

                return response()->json([
                    'status'        => array('code' => 200, 'message' => 'Success update new Jenis Event.'),
                ], 200);
            }
    }

    public function delete_gejala(Gejala $gejala,$id)
    {
        $findGejala = Gejala::where('id_gejala', $id)->first();
        if($findGejala){
            Gejala::where('id_gejala',$id)->delete();
            return response()->json([
                'status' => array('code' => 200, 'message' => 'Success'),
            ], 200);
        }
        return response()->json([
            'status' => array('code' => 400, 'message' => 'data doesnt exist'),
        ], 400);
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function show(Gejala $gejala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function edit(Gejala $gejala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    
}
