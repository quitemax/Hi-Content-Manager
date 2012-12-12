<?php
/**
 * PHP 5.3.0
 */
if (version_compare(phpversion(), '5.3.3', '<')===true) {
    $wrongVersionMsg = <<< MSG
<div style="margin: 0 auto; min-width: 960px; width: 960px;">
    <div style="font:12px/1.35em verdana, helvetica, sans-serif; border: 1px solid grey;">
        <div style="margin:0 0 10px 0; border-bottom:1px solid #ccc; padding-bottom: 4px;">
            <h3 style="margin:0; font-size:1.7em; font-weight:normal; text-transform:none; text-align:left; color:#2f2f2f;">
                Whoops, it looks like you have an invalid PHP version.
            </h3>
        </div>
        <div style="padding: 4px;">
            <p>HiApp supports PHP 5.3.2 or newer.</p>
        </div>
    </div>
</div>
MSG;
    echo  $wrongVersionMsg;
    exit;
}

/**
 * date_default_timezone_set()
 */
date_default_timezone_set('Europe/Paris');


/**
 * maintenance flag
 */
$maintenanceFilename = 'maintenance.flag';

if (file_exists($maintenanceFilename)) {
    include_once dirname(__FILE__) . '/errors/maintenance.php';
    exit;
}

/**
 * under construction
 */
$constructionFilename = 'construction.flag';

if (file_exists($constructionFilename)) {
    include_once dirname(__FILE__) . '/errors/construction.php';
    exit;
}