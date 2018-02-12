<?php session_start();

include_once 'CrudInterface.php';

class SalesForceCrud implements CRUD
{
    public function getBetweenDates(string $start, string $end)
    {
        $access_token = $_SESSION['access_token'];
//        $query = "SELECT Account.Name, Account.Office__c, Name, Start_Date__c, End_Date__c, Estimated_Production_Revenue_Won__c FROM Opportunity WHERE Start_Date__c <= $start AND End_Date__c >= $end";
//        $url = $_SESSION['instance_url']."/services/data/v20.0/query?q=".urlencode($query);
        $url = $_SESSION['instance_url'].'/services/data/v37.0/limits/';

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_HEADER , false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Authorization: Bearer token"));
        $response = curl_exec($handle);
        curl_close($handle);
        $response = json_decode($response, true);
        die(print_r($response));
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    public function update(string $id, array $attributes)
    {
        // TODO: Implement update() method.
    }
}