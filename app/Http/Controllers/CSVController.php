<?php

namespace App\Http\Controllers;

use App\Models\AllowedUsers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use League\Csv\Reader;
use App\Mail\NewUserWelcome;

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
            if ($request->hasfile('file')) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move(public_path('csv'), $fileName);
            } else {
                throw new Exception('No file uploaded.');
            }

            $csvFile = public_path('csv/' . $fileName);
            $csv = Reader::createFromPath($csvFile, 'r');
            $csvData = $csv->getRecords();

            $createdUserEmails = [];

            foreach ($csvData as $record) {
                $name = $record[0];
                $email = $record[1];

                $existingUser = User::where('email', $email)->first();

                if (!$existingUser) {
                    $password = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make($password),
                        'role' => 'User',
                        'password_status' => 'Temporary',
                    ]);
                    $createdUserEmails[] = $email;
                }
            }

            if (!empty($createdUserEmails)) {
                foreach ($createdUserEmails as $email) {
                    AllowedUsers::updateOrCreate(['email' => $email]);
                }

                foreach ($createdUserEmails as $email) {
                    Mail::to($email)->send(new NewUserWelcome($password));
                }

                return redirect()->back()->with('success', 'Users created and emails sent successfully!');
            } else {
                return redirect()->back()->with('info', 'No new users created.');
            }

            // Delete the uploaded CSV file after processing
            if (File::exists($csvFile)) {
                File::delete($csvFile);
            }

            return redirect()->back()->with('success', 'Users created and emails sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
