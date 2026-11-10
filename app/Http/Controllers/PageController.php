<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // In-memory data store for animatronic units
    private function getUnits(): array
    {
        return [
            'Atrium' => [
                [
                    'kode' => 'GF-01',
                    'nama' => 'Glamrock Freddy',
                    'peran' => 'Lead Vocalist',
                    'baterai' => 95,
                    'status' => 'Active',
                    'servis' => '2026-10-15',
                ],
                [
                    'kode' => 'GC-02',
                    'nama' => 'Glamrock Chica',
                    'peran' => 'Guitarist',
                    'baterai' => 15,
                    'status' => 'Glitch',
                    'servis' => '2026-10-20',
                ],
            ],
            'Roxy Raceway' => [
                [
                    'kode' => 'RW-03',
                    'nama' => 'Roxanne Wolf',
                    'peran' => 'Keytarist & Racer',
                    'baterai' => 45,
                    'status' => 'Charging',
                    'servis' => '2026-10-18',
                ],
            ],
            'Monty Golf' => [
                [
                    'kode' => 'MG-04',
                    'nama' => 'Montgomery Gator',
                    'peran' => 'Bassist & Golf Mascot',
                    'baterai' => 78,
                    'status' => 'Active',
                    'servis' => '2026-10-12',
                ],
            ],
            'Bonnie Bowl' => [
                [
                    'kode' => 'GB-05',
                    'nama' => 'Glamrock Bonnie',
                    'peran' => 'Bowling Specialist',
                    'baterai' => 10,
                    'status' => 'Maintenance',
                    'servis' => '2026-09-30',
                ],
            ],
            'Daycare' => [
                [
                    'kode' => 'DC-06',
                    'nama' => 'Sun',
                    'peran' => 'Daycare Attendant (Light)',
                    'baterai' => 88,
                    'status' => 'Active',
                    'servis' => '2026-10-25',
                ],
                [
                    'kode' => 'DC-07',
                    'nama' => 'Moon',
                    'peran' => 'Daycare Attendant (Night)',
                    'baterai' => 18,
                    'status' => 'Glitch',
                    'servis' => '2026-10-22',
                ],
            ],
            'Parts & Service' => [
                [
                    'kode' => 'DJ-08',
                    'nama' => 'DJ Music Man',
                    'peran' => 'Sound & Dance Host',
                    'baterai' => 60,
                    'status' => 'Active',
                    'servis' => '2026-10-05',
                ],
                [
                    'kode' => 'MH-09',
                    'nama' => 'Mr. Hippo',
                    'peran' => 'Guest Storyteller',
                    'baterai' => 35,
                    'status' => 'Charging',
                    'servis' => '2026-10-10',
                ],
                [
                    'kode' => 'HF-10',
                    'nama' => 'Happy Frog',
                    'peran' => 'Backup Performer',
                    'baterai' => 5,
                    'status' => 'Maintenance',
                    'servis' => '2026-09-15',
                ],
            ],
        ];
    }

    // Technician login view
    public function login(Request $request)
    {
        return view('login');
    }

    // Authenticate credentials
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:4',
        ], [
            'username.required' => 'Operator ID is required.',
            'username.min' => 'Operator ID must be at least 3 characters.',
            'password.required' => 'Passcode is required.',
            'password.min' => 'Passcode must be at least 4 characters.',
        ]);

        session(['username' => $request->username]);

        return redirect()->route('dashboard', ['username' => $request->username]);
    }

    // Surveillance dashboard view
    public function dashboard(Request $request)
    {
        $username = $request->query('username', session('username'));
        if (empty($username)) {
            return redirect()->route('login');
        }
        session(['username' => $username]);

        $allUnits = $this->getUnits();

        $kritis = [];

        foreach ($allUnits as $zona => $units) {
            foreach ($units as $unit) {
                if ($unit['baterai'] < 20) {
                    $unitWithZona = $unit;
                    $unitWithZona['zona'] = $zona;
                    $kritis[] = $unitWithZona;
                }
            }
        }

        // Single CCTV Channel (YouTube Live Playback Feed)
        $cctvCamera = [
            'id' => 'CAM-01',
            'name' => 'MAIN SECURITY FEED',
            'youtube_id' => 'EMuas6U1xa8',
            'youtube_url' => 'https://youtu.be/EMuas6U1xa8',
            'status' => 'ONLINE',
            'zone' => 'Mega Pizzaplex Sector',
            'units' => 'Glamrock Units Telemetry',
        ];

        return view('dashboard', compact('username', 'kritis', 'cctvCamera'));
    }

    // Unit inventory management view
    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', session('username'));
        if (empty($username)) {
            return redirect()->route('login');
        }
        session(['username' => $username]);

        $units = $this->getUnits();

        return view('pengelolaan', compact('username', 'units'));
    }

    // Technician profile view
    public function profile(Request $request)
    {
        $username = $request->query('username', session('username'));
        if (empty($username)) {
            return redirect()->route('login');
        }
        session(['username' => $username]);

        $totalUnit = 0;
        foreach ($this->getUnits() as $list) {
            $totalUnit += count($list);
        }

        $info = [
            'role' => 'Night Technician (Lead)',
            'shift' => '12:00 AM - 06:00 AM',
            'zona' => 'Mega Pizzaplex (All Sectors)',
            'unit_ditangani' => $totalUnit,
        ];

        return view('profile', compact('username', 'info'));
    }
}
