<?php

function scrapeAndStoreDataMojPosao($keyword) {
    
    $url = 'https://www.moj-posao.net/Pretraga-Poslova/?keyword='.$keyword;

    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $html = curl_exec($curl);
    
    if(curl_error($curl)) {
        echo 'Error: ' . curl_error($curl);
        return;
    }
    
    curl_close($curl);
    
    $dom = new DOMDocument();
    
    @$dom->loadHTML($html);
    
    $jobs = [];
    
    $jobListings = $dom->getElementsByTagName('div');
    foreach ($jobListings as $jobListing) {
        
        if ($jobListing->getAttribute('class') === 'job-data') {
            $jobListing->setAttribute('class', 'job-data card m-3');
            $jobs[] = $dom->saveHTML($jobListing);
        }
    }

    return $jobs;
}



function checkMatch($string1, $string2) {
    
    $string1Lower = strtolower($string1);
    $string2Lower = strtolower($string2);

    
    $words = explode(' ', $string1Lower);

    
    foreach ($words as $word) {
        
        if (strpos($word, $string2Lower) !== false) {
            
            if (preg_match('/'.$string2Lower.'{5,}/', $word)) {
                return true; 
            }
        }
    }
    return false; 
}
?>