function pst() {
    var xhr = new XMLHttpRequest();
    var params = '<?xml version="1.0" ?><form><email>' + document.getElementById("email").value + '</email><password>' + document.getElementById("password").value + '</password></form>';
    xhr.onreadystatechange = function() { //Call a function when the state changes.
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.includes("401")) {
                return;
            }
            if (xhr.responseText.includes("200")) {
                var arr = xhr.responseText.split("&")
                var email = arr[0];
                var id = arr[1];
                var name = arr[2];

                $.ajax({
                    url: "set_session.php",
                    data: { email: email, user_id: id, name: name },
                    success: function(result) {
                        window.location = "http://localhost/profile.php";
                    }
                });
            }
        }
    }
    xhr.open('POST', "http://localhost/login_script.php", true);
    xhr.send(params);

};