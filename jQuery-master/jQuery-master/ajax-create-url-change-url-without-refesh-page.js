var currentUrl = location.protocol + '//' + location.host + location.pathname;
var url = currentUrl + '?mabaohanh='+masp;
window.history.pushState("", "", url);
