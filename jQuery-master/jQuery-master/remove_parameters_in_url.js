var oldURL = window.location.href;
var index = 0;
var newURL = oldURL;
index = oldURL.indexOf('?');
if(index == -1){
    index = oldURL.indexOf('#');
}
if(index != -1){
    newURL = oldURL.substring(0, index);
}
console.log(newURL);
