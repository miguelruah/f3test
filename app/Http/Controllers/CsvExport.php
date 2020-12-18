<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class CsvExport extends Controller {
    /**
     * Converts the user input into a CSV file and streams the file back to the user
     */
    public function convert()
    {
        return ['success' => false];
    }
}
