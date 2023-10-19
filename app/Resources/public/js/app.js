window.onload = (event) => {
    const menu = document.querySelector('#blog-sidebar');

    let currentLinks = menu.querySelectorAll('a[href="' + window.location.pathname + '"]');
    currentLinks.forEach(link => link.className += ' bg-gray-300 text-violet-900 font-bold');

    let pathArray = window.location.pathname.split('/');
    let parentLinks = menu.querySelectorAll('a[href="/' + pathArray[1] + '"]');
    parentLinks.forEach(link => link.className += ' border-l-8 border-teal-600');

    var toc = "";
    var level = 0;

    document.getElementById("content").innerHTML =
        document.getElementById("content").innerHTML.replace(
            /<h([\d])>([^<]+)<\/h([\d])>/gi,
            function (str, openLevel, titleText, closeLevel) {
                if (openLevel != closeLevel) {
                    return str;
                }

                if (openLevel > level) {
                    toc += (new Array(openLevel - level + 1)).join("<ul>");
                } else if (openLevel < level) {
                    toc += (new Array(level - openLevel + 1)).join("</ul>");
                }

                level = parseInt(openLevel);

                var anchor = titleText.replace(/ /g, "_");
                toc += "<li><a href=\"#" + anchor + "\">" + titleText
                    + "</a></li>";

                return "<h" + openLevel + "><a name=\"" + anchor + "\">"
                    + titleText + "</a></h" + closeLevel + ">";
            }
        );

    if (level) {
        toc += (new Array(level + 1)).join("</ul>");
    }

    document.getElementById("article-toc").innerHTML += "<h3>Table of Contents</h3>" + toc;
    async function copyContent() {
        try {
            await navigator.clipboard.writeText('window.location.href');
            console.log('Content copied to clipboard');
            /* Resolved - text copied to clipboard successfully */
        } catch (err) {
            console.error('Failed to copy: ', err);
            /* Rejected - text failed to copy to the clipboard */
        }
    }

   /* const copyContent = async () => {
        try {
            await navigator.clipboard.writeText(window.location.href);
            console.log('Content copied to clipboard');
            document.getElementById('copyMessage').innerHTML = "URL copied to clipboard."
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }*/

}
