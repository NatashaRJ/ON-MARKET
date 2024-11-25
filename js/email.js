 document.getElementById('emailForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var email = document.getElementById('email').value;
            fetch('send_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'email=' + encodeURIComponent(email)
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                document.getElementById('emailForm').style.display = 'none';
                document.getElementById('verificationForm').style.display = 'block';
            });
        });

        document.getElementById('verificationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var code = document.getElementById('code').value;
            fetch('verify_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'code=' + encodeURIComponent(code)
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            });
        });