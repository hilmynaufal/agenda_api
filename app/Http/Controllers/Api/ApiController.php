<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\MUser;
use App\Models\MAgenda;
use App\Models\MSiswaUser;
use App\Models\MAgendaSiswa;
use App\Models\MAbsensi;
use App\Models\MPendamping;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiController extends Controller
{


    public function Test(Request $request)
    {
        $bidang = DB::table('m_role')
            ->get();

        $BidangToArray = $bidang->toArray();

        if ($BidangToArray !== []) {
            return response()->json([
                'code' => 200,
                'dataUsers' => $BidangToArray
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data user, silahkan periksa username dan password anda'
            ], 200);
        }

    }

    public function Login(Request $request)
    {
        //$base_url = "https://hilmyblaze.icu/siagan_api/api/Login";
        $base_url = "https://hirumi.xyz/agenda_api/api/Login";

        $username = $request->input("username");
        $password = $request->input("password");
        $firebase_token = $request->input("firebase_token");




        if ($username == "bupati" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 1,
                        "username" => "BUPATI",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 1,
                        "level" => 1,
                        "nm_lengkap" => "H.M. DADANG SUPRIATNA, S.IP., M.Si.",
                        "nip" => "1",
                        "nik" => "BUPATI",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "BUPATI",
                        "jabatan_id" => 1,
                        "id_skpd_master" => 1,
                        "skpdnama" => "BUPATI"
                    ]
                )
            ], 200);
        } else if ($username == "asisten bupati" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 109332,
                        "username" => "asisten bupati",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => null,
                        "id_pegawai" => 5,
                        "level" => 5,
                        "nm_lengkap" => "ASISTEN BUPATI",
                        "nip" => "3",
                        "nik" => null,
                        "email" => null,
                        "jabatan" => "ASISTEN BUPATI",
                        "jabatan_id" => 5,
                        "id_skpd_master" => 1,
                        "skpdnama" => "Pemerintah Kabupaten Bandung"
                    ]
                )
            ], 200);
        } else if ($username == "bagian prokopim" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 8717,
                        "username" => "BAGIAN PROKOPIM",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 38547,
                        "level" => 5,
                        "nm_lengkap" => "BAGIAN PROKOPIM",
                        "nip" => "bagian prokopim",
                        "nik" => "BAGIAN PROKOPIM",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "TENAGA AHLI",
                        "jabatan_id" => 38547,
                        "id_skpd_master" => 146,
                        "skpdnama" => "BAGIAN PROKOPIM"
                    ]
                )
            ], 200);
        } else if ($username == "inspektorat" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 8717,
                        "username" => "BAGIAN PROKOPIM",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 38547,
                        "level" => 5,
                        "nm_lengkap" => "INSPEKTORAT",
                        "nip" => "bagian prokopim",
                        "nik" => "INSPEKTORAT",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "TENAGA AHLI",
                        "jabatan_id" => 38547,
                        "id_skpd_master" => 146,
                        "skpdnama" => "BAGIAN PROKOPIM"
                    ]
                )
            ], 200);

        } else if ($username == "198704042019032004" && $password == "081312229386") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 14216,
                        "username" => "198704042019032004",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 43933,
                        "level" => 5,
                        "nm_lengkap" => "NOVITA NOVIANA PRIATNA S.I.Kom",
                        "nip" => "198704042019032004",
                        "nik" => null,
                        "email" => "novitanpriatna@yahoo.com",
                        "jabatan" => "PENELAAH TEKNIS KEBIJAKAN",
                        "jabatan_id" => 43933,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else if ($username == "200304042025101005" && $password == "081312229386") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 14216,
                        "username" => "200304042025101005",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 54298,
                        "level" => 5,
                        "nm_lengkap" => "THEOFILUS IMANUEL TAMASURA GINTING, S.Tr.I.P.",
                        "nip" => "200304042025101005",
                        "nik" => null,
                        "email" => "theofilusimanuel2003@gmail.com",
                        "jabatan" => "PENATA KEPROTOKOLAN",
                        "jabatan_id" => 12958,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else if ($username == "199601062025051002" && $password == "Bedas2025") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 52944,
                        "username" => "199601062025051002",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 52944,
                        "level" => 5,
                        "nm_lengkap" => "GELAR ALDI SUGIARA S.I.Kom",
                        "nip" => "198704042019032004",
                        "nik" => null,
                        "email" => "gelaaraldis@gmail.com",
                        "jabatan" => "PENATA KEPROTOKOLAN",
                        "jabatan_id" => 12958,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else {
            $response = Http::post($base_url, [
                'username' => $username,
                'password' => $password,
            ]);
            return json_decode($response);
        }
    }


    public function InsertPermohonanAgendaOPD(Request $request)
    {
        $surat = null;
        $surat2 = null;
        $surat3 = null;

        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $surat = $file->getClientOriginalName();
        }

        if ($request->hasFile('surat2')) {
            $file2 = $request->file('surat2');
            $destinationPath = 'uploads';
            $file2->move($destinationPath, $file2->getClientOriginalName());
            $surat2 = $file2->getClientOriginalName();
        }

        if ($request->hasFile('surat3')) {
            $file3 = $request->file('surat3');
            $destinationPath = 'uploads';
            $file3->move($destinationPath, $file3->getClientOriginalName());
            $surat3 = $file3->getClientOriginalName();
        }

        $id_pegawai = $request->input("id_pegawai");
        $nip = $request->input("nip");
        $skpdnama = $request->input("skpdnama");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $tanggal_selesai = $request->input("tanggal_selesai");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $leading_sektor = $request->input("leading_sektor");
        $pendamping = $request->input("pendamping");
        $penugasan = $request->input("penugasan");
        $no_hp = $request->input("no_hp");
        $pakaian = $request->input("pakaian");
        $keterangan_tambahan = $request->input("keterangan_tambahan"); // Tambahkan variabel untuk field keterangan_tambahan
        $status_agenda = 0;

        $mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";

        $agenda = new MAgenda;
        $agenda->id_pegawai = $id_pegawai;
        $agenda->nip = $nip;
        $agenda->skpdnama = $skpdnama;
        $agenda->waktu_mulai = $waktu_mulai == null ? null : $mulai;
        $agenda->waktu_selesai = $waktu_selesai == null ? null : $selesai;
        $agenda->tanggal_mulai = $tanggal_mulai;
        $agenda->tanggal_selesai = $tanggal_selesai == null ? $tanggal_mulai : $tanggal_selesai;
        $agenda->acara = $acara;
        $agenda->tempat = $tempat;
        $agenda->leading_sektor = $leading_sektor;
        $agenda->pendamping = $pendamping;
        $agenda->penugasan = $penugasan;
        $agenda->surat = $surat;
        $agenda->surat2 = $surat2;
        $agenda->surat3 = $surat3;
        $agenda->status_agenda = $status_agenda;
        $agenda->no_hp = $no_hp;
        $agenda->pakaian = $pakaian;
        $agenda->keterangan_tambahan = $keterangan_tambahan; // Tambahkan field keterangan_tambahan ke dalam model

        //cek agenda jika waktu ditentukan
        $cek_agenda = null;
        if ($waktu_mulai != null) {
            $timeMulai = Carbon::parse($mulai);
            $timeMulai->addMinutes(-29);
            $timeAkhir = Carbon::parse($mulai);
            $timeAkhir->addMinutes(29);

            $cek_agenda = DB::select(DB::raw("SELECT id, waktu_mulai, waktu_selesai 
                        FROM t_agenda
                        WHERE 
                        tanggal_mulai = '" . $tanggal_mulai . "'
                        AND ((waktu_mulai BETWEEN '" . $timeMulai . "' AND '" . $timeAkhir . "'))
                        ORDER BY waktu_mulai ASC
                        "));
        }


        if ($cek_agenda != null) {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda bupati sudah ada pada waktu tersebut'
            ], 200);
        } else {
            $agenda->save();

            if ($agenda != null) {
                return response()->json([
                    'code' => 200,
                    'id' => $agenda->id,
                    'message' => 'Berhasil membuat agenda'
                ], 200);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Gagal membuat agenda'
                ], 200);
            }
        }

    }



    public function GetSurat(Request $request)
    {
        $filename = $request->input("filename");

        $file = public_path() . "/uploads/" . $filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $filename, $headers);
    }

    public function InsertAgendaAjudan(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id_pegawai' => 'required',
            'nip' => 'required',
            'skpdnama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tanggal_mulai' => 'required',
            'acara' => 'required',
            'tempat' => 'required',
            'leading_sektor' => 'required',
            'pendamping' => 'pendamping',
            'penugasan' => 'penugasan',
            'no_hp' => 'no_hp'
        ]);

        $id_pegawai = $request->input("id_pegawai");
        $nip = $request->input("nip");
        $skpdnama = $request->input("skpdnama");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $leading_sektor = $request->input("leading_sektor");
        $pendamping = $request->input("pendamping");
        $penugasan = $request->input("penugasan");
        $surat = $request->input("surat");
        $status_agenda = 1;
        $no_hp = $request->input("no_hp");

        $mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";

        $agenda = new MAgenda;
        $agenda->id_pegawai = $id_pegawai;
        $agenda->nip = $nip;
        $agenda->skpdnama = $skpdnama;
        $agenda->waktu_mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $agenda->waktu_selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";
        $agenda->tanggal_mulai = $tanggal_mulai;
        $agenda->acara = $acara;
        $agenda->tempat = $tempat;
        $agenda->leading_sektor = $leading_sektor;
        $agenda->pendamping = $pendamping;
        $agenda->penugasan = $penugasan;
        $agenda->surat = $surat;
        $agenda->status_agenda = $status_agenda;
        $agenda->no_hp = $no_hp;

        $cek_agenda = DB::select(DB::raw("SELECT id, waktu_mulai, waktu_selesai 
                        FROM t_agenda
                        WHERE 
                        tanggal_mulai = '" . $tanggal_mulai . "'
                        AND ((waktu_mulai BETWEEN '" . $mulai . "' AND '" . $selesai . "') OR (waktu_selesai BETWEEN '" . $mulai . "' AND '" . $selesai . "'))
                        AND status_agenda = 1
                        ORDER BY waktu_mulai ASC
                        "));

        if ($cek_agenda != null) {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda bupati sudah ada pada waktu tersebut'
            ], 200);
        } else {
            $agenda->save();

            if ($agenda != null) {
                return response()->json([
                    'code' => 200,
                    'id' => $agenda->id,
                    'message' => 'Berhasil membuat agenda'
                ], 200);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Gagal membuat agenda'
                ], 200);
            }
        }
    }


    public function KonfirmasiAgenda(Request $request)
    {
        $id = $request->input("id");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_selesai = $request->input("tanggal_selesai"); // Tambahkan field tanggal_selesai
        $pakaian = $request->input("pakaian"); // Tambahkan field pakaian
        $keterangan = $request->input("keterangan");
        $status_agenda = $request->input("status_agenda");
        // Dipakai hanya untuk trigger notifikasi WA di bawah -- KonfirmasiAgenda
        // tidak menulis pendamping ke t_agenda, itu tanggung jawab UpdateAgenda.
        $pendamping = $request->input("pendamping");

        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->update([
                'tanggal_mulai' => $tanggal_mulai,
                'waktu_mulai' => $waktu_mulai == null ? null : $tanggal_mulai . " " . $waktu_mulai . ":00.000000",
                'waktu_selesai' => $waktu_selesai == null ? null : $tanggal_mulai . " " . $waktu_selesai . ":00.000000",
                'tanggal_selesai' => $tanggal_selesai == null ? $tanggal_mulai : $tanggal_selesai, // Tambahkan update untuk field tanggal_selesai
                'pakaian' => $pakaian, // Tambahkan update untuk field pakaian
                'keterangan' => $keterangan,
                'status_agenda' => $status_agenda,
            ]);

        if ($status_update !== []) {
            if ($status_agenda == 2 && !empty($pendamping)) {
                $this->kirimWhatsappPerwakilan($id, $pendamping);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Konfirmasi agenda berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Konfirmasi agenda gagal'
            ], 200);
        }
    }

    public function GetPendamping(Request $request)
    {
        $pendamping = MPendamping::orderBy('nama', 'ASC')->get();

        if ($pendamping->toArray() !== []) {
            return response()->json([
                'code' => 200,
                'data' => $pendamping
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data pendamping'
            ], 200);
        }
    }

    protected function kirimWhatsappPerwakilan($agendaId, $pendamping)
    {
        try {
            $master = MPendamping::whereRaw('LOWER(nama) = ?', [strtolower(trim($pendamping))])
                ->where('aktif', true)
                ->first();

            if ($master === null || empty($master->no_hp)) {
                return;
            }

            $agenda = DB::table('t_agenda')->where('id', $agendaId)->first();

            if ($agenda === null) {
                return;
            }

            $message = $this->buatPesanPerwakilan($master->nama, $agenda);

            (new FonnteService())->send($master->no_hp, $message, [
                'agenda_id' => $agendaId,
                'pendamping_id' => $master->id,
                'nama_pendamping' => $master->nama,
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim notifikasi WhatsApp perwakilan', [
                'pendamping' => $pendamping,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Format pesan mengikuti gaya "Share Agenda" ke WhatsApp di aplikasi
     * Flutter (lihat shareAgenda() di catatan_harian_page.dart), supaya
     * pendamping menerima detail selengkap yang biasa dibagikan manual.
     */
    protected function buatPesanPerwakilan(string $namaPendamping, $agenda): string
    {
        $tanggal = $agenda->tanggal_mulai
            ? Carbon::parse($agenda->tanggal_mulai)->locale('id')->translatedFormat('l, j M Y')
            : '-';
        $waktu = $agenda->waktu_mulai
            ? Carbon::parse($agenda->waktu_mulai)->locale('id')->translatedFormat('H:i')
            : null;

        $baris = [
            "Yth. {$namaPendamping}",
            "",
            "Anda ditunjuk sebagai perwakilan untuk menghadiri agenda berikut:",
            "",
            $tanggal,
        ];

        if ($waktu) {
            $baris[] = $waktu;
        }

        $baris[] = $agenda->acara ?? '-';
        $baris[] = "di " . ($agenda->tempat ?? '-');

        if (!empty($agenda->leading_sektor)) {
            $baris[] = "LS: {$agenda->leading_sektor}";
        }

        $baris[] = "Pendamping:";
        $baris[] = $namaPendamping;

        if (!empty($agenda->pakaian)) {
            $baris[] = "Pakaian:";
            $baris[] = $agenda->pakaian;
        }

        if (!empty($agenda->keterangan_tambahan)) {
            $baris[] = "Catatan:";
            $baris[] = $agenda->keterangan_tambahan;
        }

        $baris[] = "";
        $baris[] = "Mohon konfirmasi kehadiran. Terima kasih.";

        return implode("\n", $baris);
    }

    public function UpdateAgenda(Request $request)
    {
        $id = $request->input("id");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_selesai = $request->input("tanggal_selesai"); // Tambahkan field tanggal_selesai
        $no_hp = $request->input("no_hp");
        $leading_sektor = $request->input("leading_sektor");
        $pendamping = $request->input("pendamping");
        $penugasan = $request->input("penugasan");
        $hapusFileFlag = $request->input("hapusFileFlag");
        $hapusFileFlag2 = $request->input("hapusFileFlag2");
        $hapusFileFlag3 = $request->input("hapusFileFlag3");
        $pakaian = $request->input("pakaian"); // Tambahkan field pakaian
        $keterangan_tambahan = $request->input("keterangan_tambahan"); // Tambahkan field keterangan_tambahan
        // $surat = $request->input("surat");



        $surat = null;
        $surat2 = null;
        $surat3 = null;

        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $surat = $file->getClientOriginalName();
        }

        if ($request->hasFile('surat2')) {
            $file2 = $request->file('surat2');
            $destinationPath = 'uploads';
            $file2->move($destinationPath, $file2->getClientOriginalName());
            $surat2 = $file2->getClientOriginalName();
        }

        if ($request->hasFile('surat3')) {
            $file3 = $request->file('surat3');
            $destinationPath = 'uploads';
            $file3->move($destinationPath, $file3->getClientOriginalName());
            $surat3 = $file3->getClientOriginalName();
        }

        $updateMap = [
            'acara' => $acara,
            'tempat' => $tempat,
            'tanggal_mulai' => $tanggal_mulai,
            'waktu_mulai' => ($waktu_mulai == null || $waktu_mulai == "") ? null : $tanggal_mulai . " " . $waktu_mulai . ":00.000000",
            'waktu_selesai' => ($waktu_selesai == null || $waktu_selesai == "") ? null : $tanggal_mulai . " " . $waktu_selesai . ":00.000000",
            'tanggal_selesai' => $tanggal_selesai == null ? $tanggal_mulai : $tanggal_selesai,
            'no_hp' => $no_hp,
            'leading_sektor' => $leading_sektor,
            'pendamping' => $pendamping,
            'penugasan' => $penugasan,
            'pakaian' => $pakaian, // Tambahkan update untuk field pakaian
            'keterangan_tambahan' => $keterangan_tambahan, // Tambahkan update untuk field keterangan_tambahan
        ];

        if ($surat != null) {
            $updateMap['surat'] = $surat;
        }

        if ($surat2 != null) {
            $updateMap['surat2'] = $surat2;
        }

        if ($surat3 != null) {
            $updateMap['surat3'] = $surat3;
        }


        if ($hapusFileFlag == "true") {
            $updateMap['surat'] = null;
        }

        if ($hapusFileFlag2 == "true") {
            $updateMap['surat2'] = null;
        }

        if ($hapusFileFlag3 == "true") {
            $updateMap['surat3'] = null;
        }

        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->update($updateMap);


        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Acc Agenda berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Acc Agenda gagal'
            ], 200);
        }
    }


    // public function UpdateAgenda(Request $request)
    // {
    //     $id = $request->input("id");
    //     $status_agenda = $request->input("status_agenda");

    //     $status_update = DB::table('t_agenda')
    //         ->where('id', $id)
    //         ->update(['status_agenda' => $status_agenda]);

    //     if ($status_update !== []) {
    //         return response()->json([
    //             'code' => 200,
    //             'message' => 'Update Agenda berhasil'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'code' => 201,
    //             'message' => 'Update Agenda gagal'
    //         ], 200);
    //     }
    // }

    public function HapusAgenda(Request $request)
    {
        $id = $request->input("id");

        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->delete();

        // $status_hapus  = DB::table('m_inbox')
        // ->where('id_agenda', $id)
        // ->delete();

        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Agenda berhasil di hapus'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda baca gagal di hapus'
            ], 200);
        }
    }

    public function DashboardPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $now = date("Y-m-d");


        $dashboardPegawai = DB::select(DB::raw('SELECT
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_ditolak,
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_diacc,
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_konfirmasi,
        (select count(id) as total_kecamatan from t_agenda WHERE skpdnama LIKE "%kecamatan%" AND tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_kecamatan'));

        return response()->json([
            'code' => 200,
            'data' => $dashboardPegawai
        ], 200);
    }

    public function DashboardAjudan(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $now = date("Y-m-d");

        // $dashboardAjudan = DB::select(DB::raw("SELECT
        // (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 2 ) as total_ditolak,
        // (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 1 ) as total_diacc,
        // (select count(id) as total_konfirmasi from t_agenda WHERE (status_agenda = 0) ) as total_konfirmasi"));

        $dashboardAjudan = DB::select(DB::raw('SELECT
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_ditolak,
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_diacc,
        (select count(id) as total_konfirmasi from t_agenda WHERE tanggal_mulai <= "' . $now . '" AND tanggal_selesai >= "' . $now . '") as total_konfirmasi'));

        return response()->json([
            'code' => 200,
            'data' => $dashboardAjudan
        ], 200);
    }

    public function GetAgendaByPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $status = $request->input("status");
        $limit = $request->input("limit");
        $index = $request->input("index");

        $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp'
                )
                ->where('id_pegawai', '=', $id_pegawai)
                // ->where('surat.status_surat', '=', 1)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->orWhere('status_agenda', '=', 3)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }
        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAgendaByPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $status = $request->input("status");
        $limit = $request->input("limit");
        $index = $request->input("index");

        // $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'keterangan_tambahan',
                    'no_hp'
                )
                ->where('id_pegawai', '=', $id_pegawai)
                ->where('tanggal_mulai', '>=', $tanggal_mulai)
                // ->where('surat.status_surat', '=', 1)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'keterangan_tambahan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '>=', $tanggal_mulai)
                    // ->orWhere('status_agenda', '=', 3)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'keterangan_tambahan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '>=', $tanggal_mulai)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }
        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetCatatanBulanan(Request $request)
    {
        $status = $request->input("status");
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian', // Field pakaian sudah ada
                'keterangan_tambahan' // Tambahkan field baru keterangan_tambahan
            )
            // ->where('status_agenda', '=', $status)
            ->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalAkhir])
            // ->limit($limit)
            // ->offset($index)
            ->orderBy('tanggal_mulai', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        //fungsi untuk memisahkan response berdasarkan tanggal
        $items = [];
        $currentTanggal = '';
        foreach ($agendaToArray as $key => $a) {
            if ($currentTanggal == $a->tanggal_mulai) {
                continue;
            }
            $currentTanggal = $a->tanggal_mulai;

            $perTanggalItems = [];
            foreach ($agendaToArray as $key2 => $a2) {
                if ($a2->tanggal_mulai == $currentTanggal) {
                    $perTanggalItems[] = $a2;

                }
            }

            $items[] = ['tanggal' => $currentTanggal, 'agendas' => $perTanggalItems];
        }

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $items
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }


    public function GetSingleAgenda(Request $request)
    {
        $id = $request->input("id");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('id', '=', $id)
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAjudan(Request $request)
    {
        $limit = $request->input("limit");
        $index = $request->input("index");
        $status = $request->input("status");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $pakaian = $request->input("pakaian");

        $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp',
                    'pakaian'
                )
                ->where('status_agenda', '!=', 2)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp',
                        'pakaian'
                    )
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '=', $tanggal_mulai)
                    // ->orWhere('status_agenda', '=', 3)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp',
                        'pakaian'
                    )
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '=', $tanggal_mulai)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }



        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaForAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian'
            )
            ->where('status_agenda', '=', 1)
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaPerwakilanForAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian'
            )
            ->where('status_agenda', '=', 2)
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaBupati(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->where('status_agenda', '=', 1)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaKonfirmasiBupati(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->where('status_agenda', '=', 0)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAgendaAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $status_agenda = $request->input("status_agenda");
        $limit = $request->input("limit");
        $index = $request->input("index");
        $akan_datang = $request->input("akan_datang");
        $pakaian = $request->input("pakaian");

        // $agenda;

        if ($status_agenda != null && $tanggal_mulai != null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'tanggal_selesai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp',
                    'pakaian',
                    'keterangan_tambahan' // Tambahkan field keterangan_tambahan
                )
                ->where('status_agenda', '=', $status_agenda)
                ->where('tanggal_mulai', $akan_datang == null ? "=" : ">=", $tanggal_mulai)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();


        } else {
            if ($status_agenda != null) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'tanggal_selesai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp',
                        'pakaian',
                        'keterangan_tambahan' // Tambahkan field keterangan_tambahan
                    )
                    ->where('status_agenda', '=', $status_agenda)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            } else {
                if ($tanggal_mulai != null) {
                    $agenda = DB::table('t_agenda')
                        ->select(
                            'id',
                            'id_pegawai',
                            'nip',
                            'skpdnama',
                            'waktu_mulai',
                            'waktu_selesai',
                            'tanggal_mulai',
                            'tanggal_selesai',
                            'acara',
                            'tempat',
                            'leading_sektor',
                            'pendamping',
                            'penugasan',
                            'surat',
                            'status_agenda',
                            'keterangan',
                            'no_hp',
                            'pakaian',
                            'keterangan_tambahan' // Tambahkan field keterangan_tambahan
                        )
                        // ->where('tanggal_mulai', '=', $tanggal_mulai)
                        ->where('tanggal_mulai', '<=', $tanggal_mulai)
                        ->where('tanggal_selesai', '>=', $tanggal_mulai)
                        ->limit($limit)
                        ->offset($index)
                        ->orderBy('tanggal_mulai', 'DESC')
                        ->orderBy('waktu_mulai', 'ASC')
                        ->get();
                } else {
                    $agenda = DB::table('t_agenda')
                        ->select(
                            'id',
                            'id_pegawai',
                            'nip',
                            'skpdnama',
                            'waktu_mulai',
                            'waktu_selesai',
                            'tanggal_mulai',
                            'tanggal_selesai',
                            'acara',
                            'tempat',
                            'leading_sektor',
                            'pendamping',
                            'penugasan',
                            'surat',
                            'status_agenda',
                            'keterangan',
                            'no_hp',
                            'pakaian',
                            'keterangan_tambahan' // Tambahkan field keterangan_tambahan
                        )
                        // ->where('tanggal_mulai', '=', $tanggal_mulai)
                        ->where('status_agenda', '=', $status_agenda)
                        ->limit($limit)
                        ->offset($index)
                        ->orderBy('tanggal_mulai', 'DESC')
                        ->orderBy('waktu_mulai', 'ASC')
                        ->get();
                }
            }
        }



        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetJadwalBupati(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        // $status_agenda = $request->input("status_agenda");
        $limit = $request->input("limit");
        $index = $request->input("index");
        // $akan_datang = $request->input("akan_datang");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'tanggal_selesai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'surat2',
                'surat3',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian',
                'keterangan_tambahan' // Tambahkan field keterangan_tambahan
            )
            ->where('tanggal_mulai', '<=', $tanggal_mulai)
            ->where('tanggal_selesai', '>=', $tanggal_mulai)
            ->where(function ($query) {
                $query->where('status_agenda', '=', 1)->orWhere('status_agenda', '=', 2)->orWhere('status_agenda', '=', 0);
            })
            ->where('skpdnama', 'NOT LIKE', '%kecamatan%')
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetJadwalKecamatan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        // $status_agenda = $request->input("status_agenda");
        $limit = $request->input("limit");
        $index = $request->input("index");
        // $akan_datang = $request->input("akan_datang");
        $pakaian = $request->input("pakaian");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'tanggal_selesai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'surat2',
                'surat3',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian',
                'keterangan_tambahan' // Tambahkan field keterangan_tambahan
            )
            ->where('skpdnama', 'like', '%kecamatan%')
            ->where('tanggal_mulai', '<=', $tanggal_mulai)
            ->where('tanggal_selesai', '>=', $tanggal_mulai)
            ->where(function ($query) {
                $query->where('status_agenda', '=', 1)->orWhere('status_agenda', '=', 2)->orWhere('status_agenda', '=', 0);
            })
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetJadwalBupatiHariIni(Request $request)
    {

        $tanggal_mulai = date('Y-m-d');

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'tanggal_selesai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'surat2',
                'surat3',
                'status_agenda',
                'keterangan',
                'no_hp',
                'pakaian',
                'keterangan_tambahan' // Tambahkan field keterangan_tambahan
            )
            // ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->where('tanggal_mulai', '<=', $tanggal_mulai)
            ->where('tanggal_selesai', '>=', $tanggal_mulai)
            ->where(function ($query) {
                $query->where('status_agenda', '=', 1)->orWhere('status_agenda', '=', 2)->orWhere('status_agenda', '=', 0);
            })
            // ->limit($limit)
            // ->offset($index)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }



    public function PrintAgenda(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

}
