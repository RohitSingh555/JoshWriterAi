<?php

namespace App\Http\Controllers;

use App\Models\AllowedUsers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class CSVController extends Controller
{
    public function readCsvFile(Request $request)
    {
        $request->validate([
            'file' => 'mimes:csv,txt',
        ], [
            'file.mimes' => 'The file must be a CSV (Comma-Separated Values) file.',
        ]);
        try {
            $randStr = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            if ($request->hasfile('file')) {
                $fileName = $randStr . '.csv';
                $request->file->move(public_path('csv'), $fileName);
            }
            $csvFile = public_path('csv/' . $fileName);
            $csv = Reader::createFromPath($csvFile, 'r');
            $csvEmails = [];
            foreach ($csv->getRecords() as $record) {
                $csvEmails[] = $record[0];
            }
            $usersInDatabase = AllowedUsers::all();
            foreach ($usersInDatabase as $user) {
                $userEmail = $user->email;
                if (!in_array($userEmail, $csvEmails)) {
                    $user->delete();
                }
            }
            foreach ($csv->getRecords() as $record) {
                $email = $record[0];
                $emailCount = AllowedUsers::where('email', $email)->count();
                if ($emailCount == 0) {
                    AllowedUsers::create(['email' => $email]);
                }
            }
            if (File::exists($csvFile)) {
                File::delete($csvFile);
            }
            return redirect()->back()->with('success', 'File updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
