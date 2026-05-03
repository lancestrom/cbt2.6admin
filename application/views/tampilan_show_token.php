<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="30"> <!-- Refresh every 60 seconds -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <title>CBT PENGAWAS SMK TUNAS HARAPAN</title>
    <link rel="icon" href="https://smkth-jakbar.com/assets/images/logo.png">

    <style>
        :root {
            --primary-color: #2c3e50;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-container {
            background: white;
            border-radius: 15px;
            padding: 15px;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 100px;
            height: auto;
        }

        .title-section h1 {
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .title-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            margin-top: 5px;
        }

        .token-card {
            height: 100%;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .token-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .token-card.card-keluar .card-header {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            padding: 20px;
            border: none;
        }

        .token-card.card-masuk .card-header {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            padding: 20px;
            border: none;
        }

        .token-card .card-header h4 {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
        }

        .token-card .card-body {
            padding: 30px 20px;
            background: white;
        }

        .token-value {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid;
        }

        .token-card.card-keluar .token-value {
            border-left-color: #e74c3c;
        }

        .token-card.card-masuk .token-value {
            border-left-color: #27ae60;
        }

        .refresh-indicator {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .title-section h1 {
                font-size: 1.4rem;
            }

            .logo-container img {
                max-width: 80px;
            }

            .token-card .card-body {
                padding: 20px 15px;
            }

            .token-value {
                font-size: 1.5rem;
            }

            .token-card {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px 0;
            }

            .title-section h1 {
                font-size: 1.2rem;
            }

            .title-section p {
                font-size: 0.85rem;
            }

            .logo-container {
                padding: 10px;
            }

            .logo-container img {
                max-width: 70px;
            }

            .token-card .card-header h4 {
                font-size: 0.95rem;
            }

            .token-value {
                font-size: 1.2rem;
            }

            .token-card .card-body {
                padding: 15px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="header-section">
            <div class="logo-container">
                <img src="https://smkth-jakbar.com/assets/images/logo.png" alt="Logo SMK Tunas Harapan"
                    class="img-fluid">
            </div>
            <div class="title-section">
                <h1>CBT PENGAWAS</h1>
                <p>SMK TUNAS HARAPAN</p>
            </div>
        </div>

        <!-- Token Cards Section -->
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card token-card card-masuk">
                    <div class="card-header">
                        <h4><i class="fa fa-sign-in"></i> Token Masuk</h4>
                    </div>
                    <div class="card-body">
                        <div class="token-value">
                            <?= $token_masuk['token'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="card token-card card-keluar">
                    <div class="card-header">
                        <h4><i class="fa fa-sign-out"></i> Token Keluar</h4>
                    </div>
                    <div class="card-body">
                        <div class="token-value">
                            <?= $token_keluar['token'] ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Refresh Indicator -->

    </div>


    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <script>
        // Smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.token-card');
            cards.forEach((card, index) => {
                card.style.animation = `fadeInUp 0.6s ease-out ${index * 0.2}s both`;
            });
        });

        // Add animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>