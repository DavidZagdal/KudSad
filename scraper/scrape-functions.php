<?php

function scrapeAndStoreDataMojPosao($keyword) {
    $modifiedKeyword = preg_replace('/\s+/', '+', $keyword);
    $url = 'https://www.moj-posao.net/Pretraga-Poslova/?keyword='.$modifiedKeyword;
    

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
            $aTags = $jobListing->getElementsByTagName('a');
            foreach ($aTags as $aTag) {
                $aTag->setAttribute('class', 'effect-underline');
            }
            $jobListing->setAttribute('class', 'job-data card m-3 border-success p-3 hover-custom');
            $jobs[] = $dom->saveHTML($jobListing);
        }
    }

    return $jobs;
}
//scrapeAndStoreDataMojPosao('grafički dizajner');

function doLogicBehindScrapingPosaoHr($keyword, $stranica){
    $url = 'https://www.posao.hr/poslovi/izraz/'.urlencode($keyword).$stranica;
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
    
    $anchors = [];
    $jobListings = $dom->getElementsByTagName('div');
    foreach ($jobListings as $jobListing) {
        if ($jobListing->getAttribute('class') === 'list box') {
            $anchorNodes = $jobListing->getElementsByTagName('a');
            foreach ($anchorNodes as $anchorNode) {
                $textContent = trim($anchorNode->textContent);
                if (strlen($textContent) >= 20) { 
                    $anchorNode->setAttribute('class', 'card m-3 border-success p-3 hover-custom');
                    $anchors[] = $dom->saveHTML($anchorNode);
                }
            }
        }
    }

    return $anchors;
}

function scrapeAndStoreDataPosaoHr($keyword) {

    $anchors = [];
    $anchors = doLogicBehindScrapingPosaoHr($keyword,'');
    
    $url = 'https://www.posao.hr/poslovi/izraz/'.urlencode($keyword);

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
    
    

    $pages = $dom->getElementsByTagName('span');
    $countPages = 0;
    foreach ($pages as $page) {
        if ($page->getAttribute('class') === 'pages') {
            $anchorNodes = $page->getElementsByTagName('a');
            foreach ($anchorNodes as $anchorNode) {
                $countPages += 1;
            }
        }
    }
    $countPages -= 5;
    $index = 2;
    for($countPages; $countPages > 0; $countPages--){
        $anchors = array_merge($anchors, doLogicBehindScrapingPosaoHr($keyword, '/stranica/'.$index));
        $index+=1;
    }


    return $anchors;
}



scrapeAndStoreDataPosaoHr('Grafički dizajner');

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