<!--Start Ghi nguon bai viet-->
    <script type="text/javascript">
        function addLink() {
            var body_element = document.getElementsByTagName('body')[0];
            var selection;
            selection = window.getSelection();
            var titleh1 = document.getElementsByTagName('h1')[0];
            var pagelink = "<br /><br /> Nguồn bài viết: <a href='"+document.location.href+"'>"+titleh1.innerHTML+"</a><br />"; // change this if you want
            var copytext = selection + pagelink;
            var newdiv = document.createElement('div');
            body_element.appendChild(newdiv);
            newdiv.innerHTML = copytext;
            selection.selectAllChildren(newdiv);
            window.setTimeout(function() {
                body_element.removeChild(newdiv);
            },0);
        }
        document.oncopy = addLink;
    </script>
    <!--End Ghi nguon bai viet-->
