
//cpf

document.getElementById('formulario').addEventListener('submit', function(event) {
            const cpfInput = document.getElementById('cpf');
            const cpf = cpfInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            const errorMessage = document.getElementById('cpfError');

            if (!isValidCPF(cpf)) {
                errorMessage.textContent = 'CPF inválido. Por favor, verifique o número.';
                event.preventDefault(); // Impede o envio do formulário se o CPF for inválido
            } else {
                errorMessage.textContent = '';
            }
        });

        function isValidCPF(cpf) {
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
                return false; // Verifica se o CPF tem 11 dígitos e não é uma sequência de números iguais
            }

            let sum = 0;
            let remainder;

            // Valida o primeiro dígito verificador
            for (let i = 1; i <= 9; i++) {
                sum += parseInt(cpf[i - 1]) * (11 - i);
            }
            remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            if (remainder !== parseInt(cpf[9])) return false;

            // Valida o segundo dígito verificador
            sum = 0;
            for (let i = 1; i <= 10; i++) {
                sum += parseInt(cpf[i - 1]) * (12 - i);
            }
            remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            if (remainder !== parseInt(cpf[10])) return false;

            return true;
        }
//login

document.getElementById('formulario').addEventListener('submit', function(event) {
            const loginInput = document.getElementById('login');
            const login = loginInput.value;
            const errorMessage = document.getElementById('loginError');

            if (!isValidLogin(login)) {
                errorMessage.textContent = 'O login deve ter exatamente 6 caracteres alfabéticos.';
                event.preventDefault(); // Impede o envio do formulário se o login for inválido
            } else {
                errorMessage.textContent = '';
            }
        });

        function isValidLogin(login) {
            // Verifica se o login tem exatamente 6 caracteres alfabéticos
            const regex = /^[A-Za-z]{6}$/;
            return regex.test(login);
        }

//senha e confirmaçao de senha

document.getElementById('formulario').addEventListener('submit', function(event) {
            const senhaInput = document.getElementById('senha');
            const senha = senhaInput.value;
            const errorMessage = document.getElementById('senhaError');

            if (!isValidPassword(senha)) {
                errorMessage.textContent = 'A senha deve ter exatamente 8 caracteres alfabéticos.';
                event.preventDefault(); // Impede o envio do formulário se a senha for inválida
            } else {
                errorMessage.textContent = '';
                // Criptografar a senha (por exemplo, usando SHA-256)
                const encryptedPassword = encryptPassword(senha);
                // Substituir o valor da senha pelo valor criptografado
                senhaInput.value = encryptedPassword;
            }
        });

        function isValidPassword(password) {
            // Verifica se a senha tem exatamente 8 caracteres alfabéticos
            const regex = /^[A-Za-z]{8}$/;
            return regex.test(password);
        }

        function encryptPassword(password) {
            // Usando CryptoJS para criptografar a senha com SHA-256
            // Inclua a biblioteca CryptoJS a partir de um CDN ou localmente
            const crypto = window.crypto.subtle;
            return crypto.subtle.digest('SHA-256', new TextEncoder().encode(password))
                .then(hashBuffer => {
                    // Converter o ArrayBuffer para uma string hexadecimal
                    const hashArray = Array.from(new Uint8Array(hashBuffer));
                    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
                    return hashHex;
                });
        }

 document.getElementById('formulario').addEventListener('submit', async function(event) {
            const senhaInput = document.getElementById('senha');
            const confirmarSenhaInput = document.getElementById('confirmar_senha');
            const senha = senhaInput.value;
            const confirmarSenha = confirmarSenhaInput.value;
            const senhaError = document.getElementById('senhaError');
            const confirmarSenhaError = document.getElementById('confirmarSenhaError');

            // Validação da senha
            if (!isValidPassword(senha)) {
                senhaError.textContent = 'A senha deve ter exatamente 8 caracteres alfabéticos.';
                event.preventDefault(); // Impede o envio do formulário se a senha for inválida
                return;
            } else {
                senhaError.textContent = '';
            }

            // Validação da confirmação da senha
            if (senha !== confirmarSenha) {
                confirmarSenhaError.textContent = 'As senhas não coincidem.';
                event.preventDefault(); // Impede o envio do formulário se as senhas não coincidirem
                return;
            } else {
                confirmarSenhaError.textContent = '';
            }

            // Criptografia da senha
            try {
                const encryptedPassword = await encryptPassword(senha);
                senhaInput.value = encryptedPassword; // Substitui o valor da senha pelo valor criptografado
            } catch (error) {
                console.error('Erro na criptografia da senha:', error);
                event.preventDefault(); // Impede o envio do formulário em caso de erro na criptografia
            }
        });

        function isValidPassword(password) {
            // Verifica se a senha tem exatamente 8 caracteres alfabéticos
            const regex = /^[A-Za-z]{8}$/;
            return regex.test(password);
        }

        async function encryptPassword(password) {
            const encoder = new TextEncoder();
            const data = encoder.encode(password);

            const hashBuffer = await crypto.subtle.digest('SHA-256', data);
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

            return hashHex;
        }

//e-mail
 document.getElementById('formulario').addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email');
            const email = emailInput.value;
            const emailError = document.getElementById('emailError');

            // Validação de comprimento e formato do email
            if (!isValidEmail(email)) {
                emailError.textContent = 'O email deve ter entre 5 e 50 caracteres e seguir o formato padrão de email.';
                event.preventDefault(); // Impede o envio do formulário se o email for inválido
            } else {
                emailError.textContent = '';
            }
        });

        function isValidEmail(email) {
            // Verifica o comprimento do email e o formato padrão de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return email.length >= 5 && email.length <= 50 && emailRegex.test(email);
        }

//endereço
 document.getElementById('formulario').addEventListener('submit', function(event) {
            const enderecoInput = document.getElementById('endereco');
            const endereco = enderecoInput.value;
            const enderecoError = document.getElementById('enderecoError');

            // Validação do endereço
            if (!isValidEndereco(endereco)) {
                enderecoError.textContent = 'O endereço deve ter entre 10 e 100 caracteres e seguir o formato especificado.';
                event.preventDefault(); // Impede o envio do formulário se o endereço for inválido
            } else {
                enderecoError.textContent = '';
            }
        });

        function isValidEndereco(endereco) {
            // Verifica o comprimento e o formato do endereço
            const enderecoRegex = /^[\w\s,;.-]{10,100}$/; // Permite letras, números, espaços, vírgulas, pontos e hífens
            return enderecoRegex.test(endereco);
        }