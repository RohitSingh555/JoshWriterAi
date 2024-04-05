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
                // Move uploaded file to public/csv directory with a random filename
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move(public_path('csv'), $fileName);
            } else {
                throw new Exception('No file uploaded.');
            }

            $csvFile = public_path('csv/' . $fileName);
            $csv = Reader::createFromPath($csvFile, 'r');
            $csvData = $csv->getRecords();

            foreach ($csvData as $record) {
                $name = $record[0]; // Assuming name is the first column in the CSV
                $email = $record[1]; // Assuming email is the second column in the CSV

                // Generate a random 8-digit password
                $password = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

                // Create a new user in the 'users' table
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'User',
                    'password_status' => 'Temporary',
                ]);

                // Create or update the email in the 'allowed_users' table
                AllowedUsers::updateOrCreate(
                    ['email' => $email],
                );

                // Send email to the newly created user with the random password
                Mail::to($email)->send(new NewUserWelcome($password));
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
