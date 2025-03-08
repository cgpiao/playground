<?php
interface DownloaderInterface
{
   public function download($url): string;
}

class SimpleDownloader implements DownloaderInterface
{
   public function download($url): string
   {
      echo 'simple download: '.$url . PHP_EOL;
      return 'resp '.$url;
   }
}
class CachingDownloader implements DownloaderInterface
{

   private $cache = [];

   public function __construct(private SimpleDownloader $downloader)
   {
   }

   public function download($url): string
   {
      if (!isset($this->cache[$url])) {
         echo "CacheProxy MISS. ";
         $result = $this->downloader->download($url);
         $this->cache[$url] = $result;
      } else {
         echo "CacheProxy HIT. Retrieving result from cache.\n";
      }
      return $this->cache[$url];
   }
}
$realSubject = new SimpleDownloader();
$resp = $realSubject->download("http://example.com/");
echo $resp.PHP_EOL;
$proxy = new CachingDownloader($realSubject);
$resp = $proxy->download("http://example.com/");
echo $resp.PHP_EOL;
$resp = $proxy->download("http://example.com/");
echo $resp.PHP_EOL;