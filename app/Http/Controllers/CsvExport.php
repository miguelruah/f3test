<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class CsvExport extends Controller {
    /**
     * Converts the user input into a CSV file and streams the file back to the user
     */
    public function convert()
    {
      // retrieve posted data
      $input = file_get_contents("php://input");
      $input = json_decode($input);

      // check missing input
      if (!isset($input->columns) || ! isset($input->data))
        return response()->json(["response" => "Error - missing columns or data in input, cannot proceed"], 200);

      $columns = $input->columns;
      $data    = $input->data;

      // check length mismatch between columns and properties in data rows
      foreach($input->data AS $key => $value) {
      if (count($input->columns) != count(json_decode(json_encode($value), true)))
        return response()->json(["response" => "Error - mismatch between number of columns and items in row ".($key+1)." of data, cannot proceed"], 200);
      }

      // $output will contain the CSV string to be returned
      $output = '';

      // if we need to include CSV headers in the CSV file => set to true
      $getHeaders = true;

      $headers = '';
      if ($getHeaders) {
        $separator = "";
        foreach($columns as $key => $value)
        {
          $headers .= $separator . $value->key;
          $separator = ",";
        }

        $output .= $headers . PHP_EOL;
      }

      foreach($data as $row)
      {
        // convert row from object to array
        // then add commas to format the CSV line
        $output .= implode(",", json_decode(json_encode($row), true)) . PHP_EOL;
      }

      // remove unnecessary PHP_EOL from last_line
      return response()->json(["response" => "Success", "csvstring" => substr($output, 0, -2)], 200);
    }
}
