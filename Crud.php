<?php session_start();

include_once 'CrudInterface.php';

class SalesForceCrud implements CRUD
{
    public function getBetweenDates(string $start, string $end)
    {
        $startdt = new \DateTime($start);
        $enddt = new \DateTime($end);
        $start_format = $start."T".$startdt->format('H:i:s').".000+0000";
        $end_format = $end."T".$enddt->format('H:i:s').".000+0000";

        $access_token = $_SESSION['access_token'];
        $query2 = "SELECT Id, Subject, Priority, Description, CreatedDate from Task Where (CreatedDate > ".$start_format." AND CreatedDate < ".$end_format.") LIMIT 100";
        $url = $_SESSION['instance_url'].'/services/data/v37.0/query?q='. urlencode($query2);

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_HEADER , false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Authorization: OAuth $access_token"));
        $response = curl_exec($handle);
        curl_close($handle);
        $response = json_decode($response, true);
        return $response['records'];
    }

    public function create(array $attributes)
    {
        $access_token = $_SESSION['access_token'];
        $url = $_SESSION['instance_url'].'/services/data/v37.0/sobjects/Account';
        $content = json_encode($attributes);

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_HEADER , false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Authorization: OAuth $access_token", "Content-type: application/json"));
        $response = curl_exec($handle);
        curl_close($handle);
        $response = json_decode($response, true);
        return $response;
    }

    public function update(string $id, array $attributes)
    {
        $access_token = $_SESSION['access_token'];
        $url = $_SESSION['instance_url'].'/services/data/v37.0/sobjects/Account/'.$id;
        $content = json_encode($attributes);

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_HEADER , false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Authorization: OAuth $access_token", "Content-type: application/json"));
        $response = curl_exec($handle);
        curl_close($handle);
        $response = json_decode($response, true);
        return $response;
    }
}