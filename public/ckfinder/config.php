<?php
session_start();

function CheckAuthentication() {

    if (isset($_SESSION['QuanTri_PGV'])) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// LicenseKey : Paste your license key here. If left blank, CKFinder will be
// fully functional, in demo mode.
$config['LicenseName'] = 'rubyads.com.vn';
$config['LicenseKey'] = 'AR3PUQWHYERX6FJS7S4KJ2LD183VAQET';

$baseUrl = '/public/img/'; //duong dan

$baseDir = resolveUrl($baseUrl);
$config['Thumbnails'] = Array(
    'url' => $baseUrl . '_thumbs',
    'directory' => $baseDir . '_thumbs',
    'enabled' => true,
    'directAccess' => false,
    'maxWidth' => 100,
    'maxHeight' => 100,
    'bmpSupported' => false,
    'quality' => 80);

$config['Images'] = Array(
    'maxWidth' => 1600,
    'maxHeight' => 1200,
    'quality' => 80);


$config['RoleSessionVar'] = 'CKFinder_UserRole';
//session_start();



$config['AccessControl'][] = Array(
    'role' => '*',
    'resourceType' => '*',
    'folder' => '/',
    'folderView' => true,
    'folderCreate' => true,
    'folderRename' => true,
    'folderDelete' => true,
    'fileView' => true,
    'fileUpload' => true,
    'fileRename' => true,
    'fileDelete' => true);

/*
  For example, if you want to restrict the upload, rename or delete of files in
  the "Logos" folder of the resource type "Images", you may uncomment the
  following definition, leaving the above one:

  $config['AccessControl'][] = Array(
  'role' => '*',
  'resourceType' => 'Images',
  'folder' => '/Logos',

  'folderView' => true,
  'folderCreate' => true,
  'folderRename' => true,
  'folderDelete' => true,

  'fileView' => true,
  'fileUpload' => false,
  'fileRename' => false,
  'fileDelete' => false);
 */


$config['DefaultResourceTypes'] = '';

$config['ResourceType'][] = Array(
    'name' => 'Files', // Single quotes not allowed
    'url' => $baseUrl . 'files',
    'directory' => $baseDir . 'files',
    'maxSize' => "200M",
    'allowedExtensions' => '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip',
    'deniedExtensions' => 'php');

$config['ResourceType'][] = Array(
    'name' => 'Images',
    'url' => $baseUrl . 'images',
    'directory' => $baseDir . 'images',
    'maxSize' => "200M",
    'allowedExtensions' => 'bmp,gif,svg,jpeg,jpg,png,mp4',
    'deniedExtensions' => '');

$config['ResourceType'][] = Array(
    'name' => 'Flash',
    'url' => $baseUrl . 'flash',
    'directory' => $baseDir . 'flash',
    'maxSize' => "200M",
    'allowedExtensions' => 'swf,flv,mp4',
    'deniedExtensions' => '');
$config['CheckDoubleExtension'] = true;
$config['DisallowUnsafeCharacters'] = false;
$config['FilesystemEncoding'] = 'UTF-8';
$config['SecureImageUploads'] = true;
$config['CheckSizeAfterScaling'] = true;
$config['HtmlExtensions'] = array('html', 'htm', 'xml', 'js');
$config['HideFolders'] = Array(".*", "CVS");
$config['HideFiles'] = Array(".*");
$config['ChmodFiles'] = 0777;
$config['ChmodFolders'] = 0777;

$config['ForceAscii'] = false;

$config['XSendfile'] = false;


include_once "plugins/imageresize/plugin.php";
include_once "plugins/fileeditor/plugin.php";
include_once "plugins/zip/plugin.php";

$config['plugin_imageresize']['smallThumb'] = '90x90';
$config['plugin_imageresize']['mediumThumb'] = '120x120';
$config['plugin_imageresize']['largeThumb'] = '180x180';
