<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Calculator</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Center the form on the page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;

            background-image: url('1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        .card {
            width: 400px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Tax Calculator</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="income">Enter Annual Income:</label>
                    <input type="number" class="form-control" name="income" id="income" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Select Pay Frequency:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequency" id="monthly" value="monthly" required>
                        <label class="form-check-label" for="monthly">Monthly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequency" id="biMonthly" value="bi-monthly" required>
                        <label class="form-check-label" for="biMonthly">Bi-Monthly</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Calculate</button>
            </form>

            <?php
            // Function to calculate tax based on income and tax brackets
            function calculateTax($income) {
                if ($income <= 250000) {
                    $tax = 0;
                } elseif ($income <= 400000) {
                    $tax = 0.20 * ($income - 250000);
                } elseif ($income <= 800000) {
                    $tax = 22500 + 0.25 * ($income - 400000);
                } elseif ($income <= 2000000) {
                    $tax = 102500 + 0.30 * ($income - 800000);
                } elseif ($income <= 8000000) {
                    $tax = 402500 + 0.32 * ($income - 2000000);
                } else {
                    $tax = 2202500 + 0.35 * ($income - 8000000);
                }
                return $tax;
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $income = $_POST["income"];
                $frequency = $_POST["frequency"];

                // Validate the income input
                if ($income < 0) {
                echo "<p>Please enter a positive number for the income.</p>";
                exit;
                }    

                if ($frequency == "monthly") {
                    $annualIncome = $income * 12;
                } else if ($frequency == "bi-monthly") {
                    $annualIncome = $income * 24;
                }

                $annualTax = calculateTax($annualIncome);
                $monthlyTax = $annualTax / 12;

                // Display the results with formatted numbers
                echo "<h3 class='mt-4'>Results</h3>";
                echo "<p> You have chosen <b> $frequency </b> pay for your income of <b>" . number_format($income, 2) . "</b>.<br />";
                echo "<p> Here are the results </p>";
                echo "<p>Annual Income: " . number_format($annualIncome, 2) . "</p>";
                echo "<p>Annual Tax: " . number_format($annualTax, 2) . "</p>";
                echo "<p>Monthly Tax: " . number_format($monthlyTax, 2) . "</p>";
            }
            ?>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>