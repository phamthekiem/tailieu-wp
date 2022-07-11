// JavaScript Document

/*
Lay biến GET trên URL

********
cách dùng: 
$_GET['biến'];

/////////
VD
URL: http://localhost/Toan/YoutubeListVideo/?page=CAMQAA
Ta có: pageID = $_GET['page']; //pageID = CAMQAA;

*/
var $_GET = [], hash;
var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
for(var i = 0; i < hashes.length; i++)
{
    hash = hashes[i].split('=');
    $_GET.push(hash[0]);
    $_GET[hash[0]] = hash[1];
}
