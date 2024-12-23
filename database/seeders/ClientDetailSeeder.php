<?php

namespace Database\Seeders;

use App\Models\ClientDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientDetailSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve all users with the 'client' role
        $clients = User::where('role', 'client')->get();

        // Check if we have any clients
        if ($clients->count() > 0) {
            foreach ($clients as $client) {
                // Create or update the client details for each client
                ClientDetail::updateOrCreate(
                    [
                        'user_id' => $client->id,  // Ensure the client is linked
                    ],
                    [
                        'id' => Str::uuid(),  // Generate a new UUID
                        'company_name' => $this->generateCompanyName($client->id), // Assign unique company name
                        'contact_number' => $this->generateContactNumber(), // Generate a realistic contact number
                    ]
                );
            }
        }
    }

    /**
     * Helper function to generate realistic company names.
     */
    private function generateCompanyName($clientId): string
    {
        // Convert the UUID to a hash, and then generate a number from it
        $clientIdHash = hexdec(substr(md5($clientId), 0, 8)); // Get the first 8 characters of the hash and convert to int

        $companyNames = [
            'Tech Solutions Ltd',
            'Global Enterprises Inc',
            'Innovative Designs Co',
            'Creative Ventures Group',
            'Future Technologies LLC',
        ];

        // Pick a unique company name based on the hash of the client ID
        return $companyNames[$clientIdHash % count($companyNames)];
    }

    /**
     * Helper function to generate realistic contact numbers.
     */
    private function generateContactNumber(): string
    {
        // Generate a random phone number
        return '555-' . rand(1000, 9999) . '-' . rand(1000, 9999);
    }
}
