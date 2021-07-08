// Loader startup page

 document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#ftco-loader").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#ftco-loader").style.display = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };