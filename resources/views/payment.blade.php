@extends('layouts.app')

@section('title', 'Kemungkinan Pembayaran')

@section('content')

<div class="container">
        <h1 class="title">Kemungkinan Pembayaran</h1>
        <p class="description">Di sini akan ditampilkan kemungkinan jumlah uang yang akan dibayarkan oleh konsumen.</p>
        
        <!-- Form untuk input total belanja -->
        <form id="payment-form" class="payment-form">
            <label for="total" class="total-label">Total Belanja (Rp):</label>
            <input type="number" id="total" name="total" class="total-input" required>
            <button type="submit" class="submit-button">Hitung Kemungkinan Pembayaran</button>
        </form>

        <!-- Container untuk menampilkan hasil pembayaran -->
        <div id="payment-results" class="payment-results" style="display: none;">
            <h2 class="payment-heading">Kemungkinan Pembayaran:</h2>
            <ul id="payment-list" class="list-group">
                <!-- Tempat untuk menampilkan hasil pembayaran -->
            </ul>
        </div>
    </div>


<script>

function generateDenominationCombinations(total, denominations) {
    var results = [];
    
    function generateCombinations(index, currentTotal, combination) {
        var sum = combination.reduce((acc, val) => acc + val, 0);

        if (currentTotal >= total) {
            if (currentTotal < 1000 && combination.length === denominations.length && sum != total && total != 700 && total > 200) {
                results.push(sum);     
            }
            return;
        }

        for (var i = index; i < denominations.length; i++) {

            if ((denominations[denominations.length-1] + denominations[denominations.length-2]) > total && total > 200 ){
                results.push(denominations[denominations.length-1] + denominations[denominations.length-2]);
                break;
            }

            combination.push(denominations[i]);
            generateCombinations(i, currentTotal + denominations[i], combination);
            combination.pop(); 
        }
    }
    
    generateCombinations(0, 0, []); 
    
    return results;
}
document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var total = parseFloat(document.getElementById('total').value);
    var availableDenominations = [100, 200, 500, 1000, 2000, 5000, 10000, 20000, 50000, 100000];
    var smallDenominations = [100, 200, 500, 1000];
    var paymentList = document.getElementById('payment-list');
    paymentList.innerHTML = ''; 

    var listItem = document.createElement('li');
    listItem.textContent = 'UANG PAS';
    paymentList.appendChild(listItem);

    var newDenominations = [];


    if (total< 500){
        smallDenominations = [100, 200];
        newDenominations = generateDenominationCombinations(total, smallDenominations);
    }
    else if (total < 1000) {
        // Jika total belanja kurang dari 1000
        smallDenominations = [100, 200, 500];
        newDenominations = generateDenominationCombinations(total, smallDenominations);
    } else if (total < 2000 && total > 1000){
        smallDenominations = [100, 200, 500, 1000];
        newDenominations = generateDenominationCombinations(total, smallDenominations);
        // jika total belanja di antara 1000 - 2000
    } else if (total > 100000){
        // jika total belanja lebih dari 100000
    }

    newDenominations.forEach(function(denomination) {
        var listItem = document.createElement('li');
        listItem.textContent = "Rp " + denomination;
        paymentList.appendChild(listItem);
    });

    availableDenominations.forEach(function(denomination) {
        if (denomination > total) {
            var listItem = document.createElement('li');
            listItem.textContent = "Rp " + denomination;
            paymentList.appendChild(listItem);
        }
    });

    var paymentResults = document.getElementById('payment-results');
    paymentResults.style.display = 'block';
});

</script>

@endsection
