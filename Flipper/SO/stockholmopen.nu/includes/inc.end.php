<?php
// this file should be included at the end of each file
$oLogFile = new LogFile();
$sTimeStart = PAGE_LOAD_START;
$sTimeEnd = microtime(true);
$sTime = $sTimeEnd - $sTimeStart;
$sMemoryUsagePeak = memory_get_peak_usage();
$sMemoryUsage = memory_get_usage();

$oLogFile->writePageData(LOG_FILE_PAGE_DATA, $sTime, $sMemoryUsagePeak, $sMemoryUsage);
?>