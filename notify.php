<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forex Trading Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Background and overall styling */
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }

        .trading-card {
            background: #1f1f1f;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 255, 128, 0.2);
        }

        /* Wave Animation */
        .wave-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(0,255,128,0.2) 0%, rgba(0, 255, 128, 0) 100%);
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            background: rgba(0, 255, 128, 0.5);
            border-radius: 50%;
            animation: wave-move 5s infinite linear;
        }

        @keyframes wave-move {
            0% { transform: translateX(-50%) translateY(10px); }
            50% { transform: translateX(0%) translateY(-10px); }
            100% { transform: translateX(50%) translateY(10px); }
        }

        .wave-2 {
            background: rgba(0, 255, 128, 0.3);
            animation-delay: 2s;
        }

        /* Live trading numbers */
        .trading-number {
            font-size: 24px;
            font-weight: bold;
            color: #0f0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Forex Trading Live Chart</h2>

    <div class="row mt-4">
        <div class="col-md-6 mx-auto">
            <div class="trading-card text-center">
                <h5>EUR/USD</h5>
                <p class="trading-number" id="forex-price">1.0987</p>
                <small class="text-muted">Live Price Movement</small>
            </div>
        </div>
    </div>

    <div class="wave-container mt-4">
        <div class="wave"></div>
        <div class="wave wave-2"></div>
    </div>

</div>

<script>
    // Simulating live price changes
    function updatePrice() {
        let basePrice = 1.0987;
        let randomChange = (Math.random() * 0.002 - 0.001).toFixed(4);
        let newPrice = (basePrice + parseFloat(randomChange)).toFixed(4);
        document.getElementById("forex-price").textContent = newPrice;
    }

    setInterval(updatePrice, 2000); // Update every 2 seconds
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
