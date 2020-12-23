<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test the success case
     *
     * @return void
     */
    public function testSuccess()
    {
      // prepare input and expected output (including headers and HTTP status)
      $columns         = array(
                            (object)["key"=>"first_name"],
                            (object)["key"=>"last_name"],
                            (object)["key"=>"emailAddress"]
                         );
      $data            = array(
                            (object)["first_name"=>"John","last_name"=>"Doe","emailAddress"=>"john.doe@example.com"],
                            (object)["first_name"=>"Mary","last_name"=>"Smith","emailAddress"=>"mary.smith@example.com"]
                         );
      $postedInput     = ["columns" => $columns, "data" => $data];
      $expectedOutput  = 'first_name,last_name,emailAddress\r\n';
      $expectedOutput .= 'John,Doe,john.doe@example.com\r\n';
      $expectedOutput .= 'Mary,Smith,mary.smith@example.com';
      $expectedOutput  = '{"response":"Success","csvstring":"'.$expectedOutput.'"}';
      $expectedHeader  = 'Content-Type';
      $expectedValue   = 'application/json';
      $expectedStatus  = '200';

//      I probably have an installation or configuration problem which I couldn't resolve
//      and the API would not receive any input
//      after 2 long days, I decided to test manually with curl
//      (at least I know the API is ready for PHPUnit and that the test will work)
      $response = $this->postJson('/api/csv-export', $postedInput);

      // setup curl as an alternative
//      $url = 'http:///localhost:8085/api/csv-export';
//      $curl = curl_init($url);
//      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($curl, CURLOPT_POST, true);
//      curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postedInput));
//      curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//
//      $output      = curl_exec($curl);
//      
//      // extract HTTP status code and header from curl output
//      $statusCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//      $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);


//      confirm output is as expected
      $response
        ->assertStatus($expectedStatus)
        ->assertHeader($expectedHeader, $expectedValue)
        ->assertExactJson($expectedOutput);             
    }
    /**
     * Test when array columns or array data is missing
     *
     * @return void
     */
    public function testMissingColumnsData()
    {
      // prepare input and expected output (including headers and HTTP status)
      $columns         = array(
                            (object)["key"=>"first_name"],
                            (object)["key"=>"last_name"],
                            (object)["key"=>"emailAddress"]
                         );
      $data            = array(
                            (object)["first_name"=>"John","last_name"=>"Doe","emailAddress"=>"john.doe@example.com"],
                            (object)["first_name"=>"Mary","last_name"=>"Smith"]
                         );
      // this should be «columns» (not «column») and it should be «data» (not «datas»)
      $postedInput     = ["column" => $columns, "datas" => $data];
      $expectedOutput  = '{"response":"Error - missing columns or data in input, cannot proceed"}';
      $expectedHeader  = 'Content-Type';
      $expectedValue   = 'application/json';
      $expectedStatus  = '200';

//      I probably have an installation or configuration problem which I couldn't resolve
//      and the API would not receive any input
//      after 2 long days, I decided to test manually with curl
//      (at least I know the API is ready for PHPUnit and that the test will work)
//      $response = $this->postJson('/api/csv-export', $postedInput);

      // setup curl as an alternative
//      $url = 'http:///localhost:8085/api/csv-export';
//      $curl = curl_init($url);
//      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($curl, CURLOPT_POST, true);
//      curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postedInput));
//      curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//
//      $output      = curl_exec($curl);
//      
//      // extract HTTP status code and header from curl output
//      $statusCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//      $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

//      confirm output is as expected
      $response
        ->assertStatus($expectedStatus)
        ->assertHeader($expectedHeader, $expectedValue)
        ->assertExactJson($expectedOutput);             
    }
    /**
     * Test when columns has different length from one of the rows in array data
     *
     * @return void
     */
    public function testColumnsDataLengthMismatch()
    {
      // prepare input and expected output (including headers and HTTP status)
      $columns         = array(
                            (object)["key"=>"first_name"],
                            (object)["key"=>"last_name"],
                            (object)["key"=>"emailAddress"]
                         );
      $data            = array(
                            (object)["first_name"=>"John","last_name"=>"Doe","emailAddress"=>"john.doe@example.com"],
                            (object)["first_name"=>"Mary","last_name"=>"Smith"]
                         );
      $postedInput     = ["columns" => $columns, "data" => $data];
      $expectedOutput  = '{"response":"Error - mismatch between number of columns and items in row 2 of data, cannot proceed"}';
      $expectedHeader  = 'Content-Type';
      $expectedValue   = 'application/json';
      $expectedStatus  = '200';

//      I probably have an installation or configuration problem which I couldn't resolve
//      and the API would not receive any input
//      after 2 long days, I decided to test manually with curl
//      (at least I know the API is ready for PHPUnit and that the test will work)
//      $response = $this->postJson('/api/csv-export', $postedInput);

      // setup curl as an alternative
//      $url = 'http:///localhost:8085/api/csv-export';
//      $curl = curl_init($url);
//      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//      curl_setopt($curl, CURLOPT_POST, true);
//      curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postedInput));
//      curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//
//      $output      = curl_exec($curl);
//      
//      // extract HTTP status code and header from curl output
//      $statusCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//      $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

//      confirm output is as expected
      $response
        ->assertStatus($expectedStatus)
        ->assertHeader($expectedHeader, $expectedValue)
        ->assertExactJson($expectedOutput);             
    }
}
